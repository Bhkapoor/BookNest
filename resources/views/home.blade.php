@extends('layouts.user')

@section('content')
    <div class="container-fluid">

        {{-- Welcome Section --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <div>
                            <h3 class="fw-bold mb-1">
                                Welcome back,
                                <span style="color:#2D6A4F;">
                                    {{ Auth::user()->name ?? 'Student' }}
                                </span>
                            </h3>

                            <p class="text-muted mb-0">
                                Manage your book listings, requests, campus meetups and PYQ papers.
                            </p>
                        </div>

                        <a href="{{ route('books.add') }}" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-plus-circle me-1"></i>
                            List a Book
                        </a>

                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row g-4 mb-4">

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted fw-semibold mb-1">My Listings</p>
                                <h2 class="fw-bold mb-0">{{ $myListingsCount }}</h2>
                            </div>

                            <div class="dashboard-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-book-half"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold">
                            Books you added for sell/exchange
                        </small>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted fw-semibold mb-1">Requests Sent</p>
                                <h2 class="fw-bold mb-0">{{ $requestsSentCount }}</h2>
                            </div>

                            <div class="dashboard-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-send-fill"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold">
                            Buy/exchange requests sent by you
                        </small>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted fw-semibold mb-1">Requests Received</p>
                                <h2 class="fw-bold mb-0">{{ $requestsReceivedCount }}</h2>
                            </div>

                            <div class="dashboard-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-inbox-fill"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold">
                            Requests on your listed books
                        </small>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted fw-semibold mb-1">Completed Deals</p>
                                <h2 class="fw-bold mb-0">{{ $completedDealsCount }}</h2>
                            </div>

                            <div class="dashboard-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                        </div>

                        <small class="text-muted fw-semibold">
                            Successfull campus transactions
                        </small>

                    </div>
                </div>
            </div>

        </div>

        {{-- Campus Info --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert border-0 shadow-sm rounded-4 mb-0 d-flex align-items-center gap-3"
                    style="background:#fff7ed; color:#1A1A2E;">

                    <div class="dashboard-icon bg-warning bg-opacity-25 text-warning">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <div>
                        <h6 class="fw-bold mb-1">Offline Campus Meetup Only</h6>
                        <p class="mb-0">
                            All book exchanges happen offline at campus meetup points —
                            Library Gate, Canteen, Hostel Reception, or Department Block.
                        </p>
                    </div>

                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="row g-4">

            {{-- Quick Actions --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-1">Quick Actions</h5>
                        <p class="text-muted small mb-0">Start your common tasks quickly</p>
                    </div>

                    <div class="card-body p-4">

                        <div class="d-grid gap-3">

                            <a href="{{ route('books.add') }}" class="btn btn-success rounded-pill py-2">
                                <i class="bi bi-plus-circle me-1"></i>
                                List a Book
                            </a>

                            <a href="{{ route('books.request') }}" class="btn btn-outline-success rounded-pill py-2">
                                <i class="bi bi-arrow-left-right me-1"></i>
                                View Requests
                            </a>

                            <a href="{{ route('pyq.index') }}" class="btn btn-outline-success rounded-pill py-2">
                                <i class="bi bi-file-earmark-pdf me-1"></i>
                                PYQ Papers
                            </a>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Request Status --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="fw-bold mb-1">Request Overview</h5>
                                <p class="text-muted small mb-0">Track buy and exchange request activity</p>
                            </div>

                            <a href="{{route('books.request')}}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                View All
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Pending Requests</span>
                                <span class="fw-bold">{{ $pendingRequestsCount }}</span>
                            </div>
                            <div class="progress" style="height: 9px;">
                                <div class="progress-bar bg-warning" style="width: 15%;"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Accepted Requests</span>
                                <span class="fw-bold">{{ $acceptedRequestsCount }}</span>
                            </div>
                            <div class="progress" style="height: 9px;">
                                <div class="progress-bar bg-success" style="width: 35%;"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Completed Transactions</span>
                                <span class="fw-bold">{{ $completedDealsCount }}</span>
                            </div>
                            <div class="progress" style="height: 9px;">
                                <div class="progress-bar bg-primary" style="width: 45%;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Section --}}
        <div class="row g-4 mt-1">

            {{-- Recent Listings --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-1">My Recent Listings</h5>
                        <p class="text-muted small mb-0">Books you recently listed on BookNest</p>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">

                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Book</th>
                                        <th>Type</th>
                                        <th>Condition</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($recentListings as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ ucfirst($book->listing_type) }}</td>
                                            <td>{{ ucfirst($book->condition) }}</td>
                                            <td>
                                                <span class="badge bg-success">
                                                    {{ ucfirst($book->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                You have not listed any books yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

            {{-- PYQ Section --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-1">PYQ Papers</h5>
                        <p class="text-muted small mb-0">Upload and access previous year papers</p>
                    </div>

                    <div class="card-body p-4">
                        @php
    $firstPyq = $recentPyqs->get(0);
    $secondPyq = $recentPyqs->get(1);
@endphp

                   @if($firstPyq)
<div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
    <div>
        <h6 class="fw-bold mb-1">{{ $firstPyq->subject_name }}</h6>
        <small class="text-muted">
            {{ $firstPyq->course }} • Sem {{ $firstPyq->semester }}
        </small>
    </div>

    <span class="badge {{ $firstPyq->verification_status == 'verified' ? 'bg-success' : 'bg-warning text-dark' }}">
        {{ ucfirst($firstPyq->verification_status) }}
    </span>
</div>
@endif

             @if($secondPyq)
<div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
    <div>
        <h6 class="fw-bold mb-1">{{ $secondPyq->subject_name }}</h6>
        <small class="text-muted">
            {{ $secondPyq->course }} • Sem {{ $secondPyq->semester }}
        </small>
    </div>

    <span class="badge {{ $secondPyq->verification_status == 'verified' ? 'bg-success' : 'bg-warning text-dark' }}">
        {{ ucfirst($secondPyq->verification_status) }}
    </span>
</div>
@endif

                        <a href="{{ route('pyq.index') }}" class="btn btn-outline-success rounded-pill w-100 mt-2">
                            <i class="bi bi-file-earmark-pdf me-1"></i>
                            Explore PYQ Papers
                        </a>

                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
