<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Mail\BookRequestAcceptedMail;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{

public function index()
{
$sentRequests = BookRequest::with(['book', 'seller', 'transaction.meetup'])
    ->where('buyer_id', auth()->id())
    ->latest()
    ->get();

$receivedRequests = BookRequest::with(['book', 'buyer', 'transaction.meetup'])
    ->where('seller_id', auth()->id())
    ->latest()
    ->get();

    return view('books.request', compact('sentRequests', 'receivedRequests'));
}


  public function store(Request $request, Book $book)
{
    if ($book->user_id == Auth::id()) {
        return back()->with('error', 'You cannot send request for your own book.');
    }

    if ($book->status != 'available') {
        return back()->with('error', 'This book is not available anymore.');
    }

    $alreadyRequested = BookRequest::where('book_id', $book->id)
        ->where('buyer_id', Auth::id())
        ->where('status', 'pending')
        ->exists();

    if ($alreadyRequested) {
        return back()->with('error', 'You already sent a request for this book.');
    }

    if ($book->listing_type == 'sell' && $request->request_type != 'buy') {
        return back()->with('error', 'This book is only available for buying.');
    }

    if ($book->listing_type == 'exchange' && $request->request_type != 'exchange') {
        return back()->with('error', 'This book is only available for exchange.');
    }

    $rules = [
        'request_type' => 'required|in:buy,exchange',
        'message' => 'nullable|string|max:500',
    ];

    if ($request->request_type == 'exchange') {
        $rules['offered_book_details'] = 'required|string|max:500';
    }

    $request->validate($rules);

    BookRequest::create([
        'book_id' => $book->id,
        'buyer_id' => Auth::id(),
        'seller_id' => $book->user_id,
        'request_type' => $request->request_type,
        'message' => $request->message,
        'offered_book_details' => $request->offered_book_details,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Request sent successfully.');
}
public function create(Book $book)
{
    if ($book->user_id == auth()->id()) {
        return redirect()->route('books.browse')
            ->with('error', 'You cannot send request for your own book.');
    }

    if ($book->status !== 'available') {
        return redirect()->route('books.browse')
            ->with('error', 'This book is no longer available.');
    }

    return view('requests.create', compact('book'));
}

public function accept(BookRequest $request)
{
    DB::transaction(function () use ($request) {

        $request->load('book','buyer');

        // Sirf seller accept kar sakta hai
        if ($request->seller_id !== Auth::id()) {
            abort(403);
        }

        // Sirf pending request accept ho sakti hai
        if ($request->status !== 'pending') {
            abort(400, 'This request is already processed.');
        }

        // Request accepted
        $request->update([
            'status' => 'accepted',
        ]);

        // Book reserved
        $request->book->update([
            'status' => 'reserved',
        ]);

        // Baaki requests auto reject
        BookRequest::where('book_id', $request->book_id)
            ->where('id', '!=', $request->id)
            ->where('status', 'pending')
            ->update([
                'status' => 'rejected',
            ]);
            $buyer = $request->buyer;
           $book = $request->book;

                Mail::to($buyer->email)->send(
        new BookRequestAcceptedMail($book)
    );

        // Transaction create
        Transaction::create([
            'request_id' => $request->id,
            'book_id' => $request->book_id,
            'buyer_id' => $request->buyer_id,
            'seller_id' => $request->seller_id,

            'transaction_type' => $request->request_type,

            'agreed_price' => $request->request_type === 'buy'
                ? $request->book->price
                : null,

            'exchange_book_details' => $request->request_type === 'exchange'
    ? $request->offered_book_details
    : null,

            'buyer_confirmed' => false,
            'seller_confirmed' => false,

            'status' => 'ongoing',
        ]);
    });

    return back()->with(
        'success',
        'Request accepted successfully. Book reserved and transaction created.'
    );
}

public function reject(BookRequest $request)
{
    if ($request->seller_id !== Auth::id()) {
        abort(403);
    }

    if ($request->status !== 'pending') {
        return back()->with('error', 'This request is already processed.');
    }

    $request->update([
        'status' => 'rejected',
    ]);

    return back()->with('success', 'Request rejected successfully.');
}


}