@extends('layouts.admin')

@section('page-title', 'Transactions')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark">Transactions</h3>
                        <p class="text-muted mb-0">
                            Monitor accepted requests, ongoing deals and completed book exchanges.
                        </p>
                    </div>

                    <span class="badge rounded-pill px-4 py-2" style="background:#2D6A4F;">
                        {{ $transactions->total() }} Transactions
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <form method="GET" action="{{ route('admin.transactions') }}">
                <div class="row g-3 align-items-center">

                    <div class="col-lg-6">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control rounded-pill px-4"
                               placeholder="Search by book, buyer, seller or email...">
                    </div>

                    <div class="col-lg-2">
                        <select name="status" class="form-select rounded-pill px-4">
                            <option value="">All Status</option>
                            <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <select name="type" class="form-select rounded-pill px-4">
                            <option value="">All Types</option>
                            <option value="buy" {{ request('type') == 'buy' ? 'selected' : '' }}>Buy</option>
                            <option value="exchange" {{ request('type') == 'exchange' ? 'selected' : '' }}>Exchange</option>
                        </select>
                    </div>

                    <div class="col-lg-2 d-flex gap-2">
                        <button class="btn btn-success rounded-pill px-4 w-100">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('search') || request('status') || request('type'))
                            <a href="{{ route('admin.transactions') }}"
                               class="btn btn-outline-secondary rounded-pill px-4">
                                Reset
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>

        <div class="card-body p-4 pt-0">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Book</th>
                            <th>Buyer</th>
                            <th>Seller</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>
                                    <div class="fw-bold">
                                        {{ $transaction->book->title ?? 'Book Removed' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $transaction->book->subject ?? 'N/A' }}
                                    </small>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $transaction->buyer->name ?? 'N/A' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $transaction->buyer->email ?? '' }}
                                    </small>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $transaction->seller->name ?? 'N/A' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $transaction->seller->email ?? '' }}
                                    </small>
                                </td>

                                <td>
                                    @if($transaction->transaction_type === 'exchange')
                                        <span class="badge bg-info text-dark">Exchange</span>
                                    @else
                                        <span class="badge bg-light text-dark border">Buy</span>
                                    @endif
                                </td>

                                <td>
                                    @if($transaction->status === 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @elseif($transaction->status === 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Ongoing</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $transaction->created_at->format('d M Y') }}
                                    <br>
                                    <small class="text-muted">
                                        {{ $transaction->created_at->format('h:i A') }}
                                    </small>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                                        No transactions found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>

</div>

@endsection