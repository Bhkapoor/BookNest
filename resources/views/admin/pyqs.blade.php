@extends('layouts.admin')

@section('page-title', 'PYQ Papers')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark">PYQ Papers</h3>
                        <p class="text-muted mb-0">
                            Review uploaded question papers, verify genuine files and remove invalid uploads.
                        </p>
                    </div>

                    <span class="badge rounded-pill px-4 py-2" style="background:#2D6A4F;">
                        {{ $pyqs->total() }} Papers
                    </span>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 border-0 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <form method="GET" action="{{ route('admin.pyqs') }}">
                <div class="row g-3 align-items-center">

                    <div class="col-lg-6">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control rounded-pill px-4"
                               placeholder="Search by subject, code, course or year...">
                    </div>

                    <div class="col-lg-2">
                        <select name="status" class="form-select rounded-pill px-4">
                            <option value="">All Status</option>
                            <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                        </select>
                    </div>

                    <div class="col-lg-2">
                        <select name="exam_type" class="form-select rounded-pill px-4">
                            <option value="">All Types</option>
                            <option value="Mid" {{ request('exam_type') == 'Mid' ? 'selected' : '' }}>Mid</option>
                            <option value="End" {{ request('exam_type') == 'End' ? 'selected' : '' }}>End</option>
                            <option value="Internal" {{ request('exam_type') == 'Internal' ? 'selected' : '' }}>Internal</option>
                        </select>
                    </div>

                    <div class="col-lg-2 d-flex gap-2">
                        <button class="btn btn-success rounded-pill px-4 w-100">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('search') || request('status') || request('exam_type'))
                            <a href="{{ route('admin.pyqs') }}"
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
                            <th>Paper</th>
                            <th>Course/Sem</th>
                            <th>Year</th>
                            <th>Exam Type</th>
                            <th>Uploaded By</th>
                            <th>Downloads</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pyqs as $pyq)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $pyq->subject_name }}</div>
                                    <small class="text-muted">
                                        {{ $pyq->subject_code ?? 'No subject code' }}
                                    </small>
                                </td>

                                <td>
                                    {{ $pyq->course ?? 'N/A' }}<br>
                                    <small class="text-muted">Sem {{ $pyq->semester ?? 'N/A' }}</small>
                                </td>

                                <td>{{ $pyq->year }}</td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $pyq->exam_type }}
                                    </span>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $pyq->uploader->name ?? 'N/A' }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $pyq->user->email ?? '' }}
                                    </small>
                                </td>

                                <td>{{ $pyq->download_count ?? 0 }}</td>

                                <td>
                                    @if($pyq->verification_status === 'verified')
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unverified</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    @if($pyq->file_path)
                                        <a href="{{ asset('storage/' . $pyq->file_path) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            View
                                        </a>
                                    @endif

                                    @if($pyq->verification_status !== 'verified')
                                        <form action="{{ route('admin.pyqs.verify', $pyq->id) }}"
                                              method="POST"
                                              class="d-inline-block">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                Verify
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.pyqs.destroy', $pyq->id) }}"
                                          method="POST"
                                          class="d-inline-block delete-pyq-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-file-earmark-pdf fs-1 d-block mb-2"></i>
                                        No PYQ papers found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pyqs->links() }}
            </div>
        </div>
    </div>

</div>

@endsection