<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\Pyq;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role', 'user')->count();

        $newStudentsThisMonth = User::where('role', 'user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $activeListings = Book::where('status', 'available')->count();

        $completedDeals = Transaction::where('status', 'completed')->count();

        $pendingPyqs = Pyq::where('verification_status', 'unverified')->count();

        $recentStudents = User::where('role', 'user')
            ->latest()
            ->take(3)
            ->get();

        $recentPyqs = Pyq::latest()
            ->take(3)
            ->get();

        $recentTransactions = Transaction::with(['book', 'buyer', 'seller'])
            ->latest()
            ->take(3)
            ->get();

        $bookStatusCounts = [
            'available' => Book::where('status', 'available')->count(),
            'reserved' => Book::where('status', 'reserved')->count(),
            'sold_exchanged' => Book::whereIn('status', ['sold', 'exchanged'])->count(),
        ];

        return view('admin.dashboard', compact(
            'totalStudents',
            'newStudentsThisMonth',
            'activeListings',
            'completedDeals',
            'pendingPyqs',
            'recentStudents',
            'recentPyqs',
            'recentTransactions',
            'bookStatusCounts'
        ));
    }
}