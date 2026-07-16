@extends('layouts.admin')

@section('page-title', 'Admin Dashboard')

@section('content')

    <div class="container-fluid">

        {{-- Welcome Section --}}
        <div class="row mb-5">
            <div class="col-12">

                <div class="admin-welcome-card d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <h3>Welcome back, Admin </h3>

                        <p>
                            Monitor BookNest users, listings, PYQ uploads and platform activity.
                        </p>
                    </div>

                    <span class="admin-role-badge">
                        <a href="#" class="btn btn-success rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#importCsvModal">
                            <i class="bi bi-upload"></i> Import CSV
                        </a>
                    </span>

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
                                <p class="text-muted fw-semibold mb-1">Registered Students</p>
                                <h2 class="fw-bold mb-0">{{ $totalStudents }}</h2>
                            </div>
                            <div class="dashboard-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <small class="text-success fw-semibold">
                            <i class="bi bi-arrow-up"></i> {{ $newStudentsThisMonth }} new this month
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted fw-semibold mb-1">Active Listings</p>
                                <h2 class="fw-bold mb-0">{{ $activeListings }}</h2>
                            </div>
                            <div class="dashboard-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-book-half"></i>
                            </div>
                        </div>
                        <small class="text-muted fw-semibold">
                            Available books on platform
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
                                <h2 class="fw-bold mb-0">{{ $completedDeals }}</h2>
                            </div>
                            <div class="dashboard-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-receipt-cutoff"></i>
                            </div>
                        </div>
                        <small class="text-muted fw-semibold">
                            Sell / exchange completed
                        </small>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted fw-semibold mb-1">Pending PYQ Verification</p>
                                <h2 class="fw-bold mb-0">{{ $pendingPyqs }}</h2>
                            </div>
                            <div class="dashboard-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </div>
                        </div>
                        <small class="text-danger fw-semibold">
                            Papers waiting for review
                        </small>
                    </div>
                </div>
            </div>

        </div>

        {{-- Main Content --}}
        <div class="row g-4">

            {{-- Recent Students --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-1">Recently Joined Students</h5>
                                <p class="text-muted mb-0 small">New users registered on BookNest</p>
                            </div>
                            <a href="{{ route('admin.students') }}"
                                class="btn btn-sm btn-outline-success rounded-pill px-3">View All</a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student</th>
                                        <th>Course</th>
                                        <th>Semester</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentStudents as $student)
                                        <tr>
                                            <td class="fw-semibold">
                                                {{ $student->name }}
                                            </td>

                                            <td>
                                                {{ $student->course }}
                                            </td>

                                            <td>
                                                {{ $student->semester }}
                                            </td>

                                            <td>
                                                @if ($student->account_status == 'active')
                                                    <span class="badge bg-success">
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Suspended
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No students found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PYQ Verification --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold mb-1">PYQ Verification</h5>
                                <p class="text-muted small mb-0">Recently uploaded papers</p>
                            </div>
                            <a href="{{ route('admin.pyqs') }}"
                                class="btn btn-sm btn-outline-success rounded-pill px-3">Review</a>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        @foreach ($recentPyqs as $pyq)
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div>
                                    <h6 class="fw-bold mb-1">
                                        {{ $pyq->subject_name }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $pyq->course }}
                                        • Sem {{ $pyq->semester }}
                                        • {{ $pyq->year }}
                                    </small>
                                </div>

                                @if ($pyq->verification_status == 'verified')
                                    <span class="badge bg-success">
                                        Verified
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Unverified
                                    </span>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Section --}}
        <div class="row g-4 mt-1">

            {{-- Recent Transactions --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fw-bold mb-1">Recent Transactions</h5>
                                <p class="text-muted small mb-0">
                                    Latest completed book exchanges
                                </p>
                            </div>

                            <a href="{{ route('admin.transactions') }}"
                                class="btn btn-sm btn-outline-success rounded-pill px-3">
                                View All
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        @foreach ($recentTransactions as $transaction)
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">

                                <div>
                                    <h6 class="fw-bold mb-1">
                                        {{ $transaction->book->title ?? 'Book Deleted' }}
                                    </h6>

                                    <small class="text-muted">
                                        {{ $transaction->seller->name ?? 'N/A' }}
                                        →
                                        {{ $transaction->buyer->name ?? 'N/A' }}
                                    </small>
                                </div>

                                @if ($transaction->status == 'completed')
                                    <span class="badge bg-success">
                                        Completed
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Ongoing
                                    </span>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Listing Status --}}
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-0 p-4 pb-0">
                        <h5 class="fw-bold mb-1">Book Listing Status</h5>
                        <p class="text-muted small mb-0">Current platform listing overview</p>
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Available</span>
                                <span class="fw-bold">{{ $bookStatusCounts['available'] }}</span>
                            </div>
                            <div class="progress" style="height: 9px;">
                                <div class="progress-bar bg-success" style="width: 65%;"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Reserved</span>
                                <span class="fw-bold">{{ $bookStatusCounts['reserved'] }}</span>
                            </div>
                            <div class="progress" style="height: 9px;">
                                <div class="progress-bar bg-warning" style="width: 25%;"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold">Sold / Exchanged</span>
                                <span class="fw-bold">{{ $bookStatusCounts['sold_exchanged'] }}</span>
                            </div>
                            <div class="progress" style="height: 9px;">
                                <div class="progress-bar bg-primary" style="width: 40%;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- modal --}}
    <div class="modal fade" id="importCsvModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header -->
                <div class="modal-header border-0 text-white"
                    style="background: linear-gradient(105deg,#1A1A2E,#16213E);">
                    <div>
                        <h5 class="modal-title fw-bold mb-1">
                            <i class="bi bi-upload me-2"></i>
                            Import Valid Students
                        </h5>
                        <small class="opacity-75">
                            Upload a CSV file containing student registration IDs.
                        </small>
                    </div>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">

                    <div class="alert border-0 rounded-3 mb-4" style="background:#F8F5F1;">
                        <strong>Instructions:</strong>
                        <ul class="mb-0 mt-2 ps-3">
                            <li>Upload only CSV file.</li>
                        </ul>
                    </div>

                    <form id="csvImportForm" action="{{ route('admin.valid-students.import') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Select CSV File
                            </label>

                            <input type="file" name="csv_file" accept=".csv" class="form-control form-control-lg" required>
                        </div>

                    </form>

                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 px-4 pb-4">

                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" form="csvImportForm" class="btn px-4 text-white" style="background:#C9A227;">
                        <i class="bi bi-cloud-upload me-1"></i>
                        Upload CSV
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection
