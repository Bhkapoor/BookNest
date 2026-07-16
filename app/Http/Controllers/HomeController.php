<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookRequest;
use App\Models\Transaction;
use App\Models\Pyq;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 public function index()
{
    $userId = Auth::id();

    $myListingsCount = Book::where('user_id', $userId)->count();

    $requestsSentCount = BookRequest::where('buyer_id', $userId)->count();

    $requestsReceivedCount = BookRequest::where('seller_id', $userId)->count();

    $completedDealsCount = Transaction::where(function ($query) use ($userId) {
            $query->where('buyer_id', $userId)
                  ->orWhere('seller_id', $userId);
        })
        ->where('status', 'completed')
        ->count();

    $pendingRequestsCount = BookRequest::where(function ($query) use ($userId) {
            $query->where('buyer_id', $userId)
                  ->orWhere('seller_id', $userId);
        })
        ->where('status', 'pending')
        ->count();

    $acceptedRequestsCount = BookRequest::where(function ($query) use ($userId) {
            $query->where('buyer_id', $userId)
                  ->orWhere('seller_id', $userId);
        })
        ->where('status', 'accepted')
        ->count();

    $recentListings = Book::where('user_id', $userId)
        ->latest()
        ->take(3)
        ->get();

    $recentPyqs = Pyq::latest()
        ->take(2)
        ->get();

    return view('home', compact(
        'myListingsCount',
        'requestsSentCount',
        'requestsReceivedCount',
        'completedDealsCount',
        'pendingRequestsCount',
        'acceptedRequestsCount',
        'recentListings',
        'recentPyqs'
    ));
}
}
