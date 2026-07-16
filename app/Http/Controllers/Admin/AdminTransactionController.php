<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with(['book', 'buyer', 'seller'])
            ->when($request->search, function ($query) use ($request) {
                $query->whereHas('book', function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('subject', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('buyer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('seller', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->type, function ($query) use ($request) {
                $query->where('transaction_type', $request->type);
            })
            ->latest()
            ->paginate(10);

        return view('admin.transactions', compact('transactions'));
    }
}