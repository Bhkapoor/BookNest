<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function buyerConfirm(Transaction $transaction)
    {
        if ($transaction->buyer_id !== Auth::id()) {
            abort(403);
        }

        if ($transaction->status === 'completed') {
            return back()->with('error', 'This transaction is already completed.');
        }

        $transaction->update([
            'buyer_confirmed' => true,
        ]);

        $this->completeIfBothConfirmed($transaction);

        return back()->with('success', 'You confirmed receiving the book.');
    }

    public function sellerConfirm(Transaction $transaction)
    {
        if ($transaction->seller_id !== Auth::id()) {
            abort(403);
        }

        if ($transaction->status === 'completed') {
            return back()->with('error', 'This transaction is already completed.');
        }

        $transaction->update([
            'seller_confirmed' => true,
        ]);

        $this->completeIfBothConfirmed($transaction);

        return back()->with('success', 'You confirmed handing over the book.');
    }

    private function completeIfBothConfirmed(Transaction $transaction)
    {
        $transaction->refresh();

        if ($transaction->buyer_confirmed && $transaction->seller_confirmed) {
            $transaction->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            $transaction->book->update([
                'status' => $transaction->transaction_type === 'buy'
                    ? 'sold'
                    : 'exchanged',
            ]);
        }
    }
}