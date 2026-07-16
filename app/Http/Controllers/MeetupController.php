<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Meetup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MeetupUpdatedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MeetupController extends Controller
{
    public function create(Transaction $transaction)
    {
        if ($transaction->buyer_id !== Auth::id() && $transaction->seller_id !== Auth::id()) {
            abort(403);
        }

        return view('meetups.create', compact('transaction'));
    }

    public function store(Request $request, Transaction $transaction)
    {
        if ($transaction->buyer_id !== Auth::id() && $transaction->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'location' => 'required|string',
            'custom_location' => 'nullable|string|max:255',
            'meetup_date' => 'required|date|after_or_equal:today',
            'meetup_time' => 'required',
            'notes' => 'nullable|string|max:500',
        ]);

        if ($request->location === 'Other' && empty($request->custom_location)) {
            return back()->with('error', 'Please enter custom location.');
        }


        Meetup::updateOrCreate(
            ['transaction_id' => $transaction->id],
            [
                'proposed_by' => Auth::id(),
                'location' => $request->location,
                'custom_location' => $request->custom_location,
                'meetup_date' => $request->meetup_date,
                'meetup_time' => $request->meetup_time,
                'notes' => $request->notes,
                'status' => 'proposed',
                'confirmed_at' => null,
            ]
        );

        // for mail
        $recipient = Auth::id() == $transaction->seller_id
    ? User::find($transaction->buyer_id)
    : User::find($transaction->seller_id);

$message = Auth::id() == $transaction->seller_id
    ? 'The seller has scheduled a meetup.'
    : 'The buyer has suggested a new meetup time.';

Mail::to($recipient->email)->send(
    new MeetupUpdatedMail($transaction, $message)
);

        return redirect()->route('books.request')
            ->with('success', 'Meetup proposed successfully.');
    }

    public function confirm(Meetup $meetup)
    {
        $transaction = $meetup->transaction;

        if ($transaction->buyer_id !== Auth::id() && $transaction->seller_id !== Auth::id()) {
            abort(403);
        }

        if ($meetup->proposed_by === Auth::id()) {
            return back()->with('error', 'Other party must confirm the meetup.');
        }

        $meetup->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);

        $recipient = Auth::id() == $transaction->seller_id
    ? User::find($transaction->buyer_id)
    : User::find($transaction->seller_id);

Mail::to($recipient->email)->send(
    new MeetupUpdatedMail(
        $transaction,
        'The meetup has been confirmed.'
    )
);

        return back()->with('success', 'Meetup confirmed successfully.');
    }
}