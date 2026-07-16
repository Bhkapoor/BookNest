@extends('layouts.admin')

@section('page-title', 'Manage Students')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark">Students Management</h3>
                        <p class="text-muted mb-0">
                            View registered students, monitor account status and control misuse.
                        </p>
                    </div>

                    <span class="badge rounded-pill px-4 py-2" style="background:#2D6A4F;">
                        {{ $students->total() }} Students
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

    @if(session('error'))
        <div class="alert alert-danger rounded-4 border-0 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <form method="GET" action="{{ route('admin.students') }}">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-9 col-md-8">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control rounded-pill px-4"
                               placeholder="Search by name, email, registration ID or course...">
                    </div>

                    <div class="col-lg-3 col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-success rounded-pill px-4 w-100">
                            <i class="bi bi-search"></i> Search
                        </button>

                        @if(request('search'))
                            <a href="{{ route('admin.students') }}"
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
                            <th>Student</th>
                            <th>Registration ID</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $student->name }}</div>
                                    <small class="text-muted">{{ $student->email }}</small>
                                </td>

                                <td>{{ $student->registration_id ?? 'N/A' }}</td>

                                <td>{{ $student->course ?? 'N/A' }}</td>

                                <td>
                                    @if($student->semester)
                                        Sem {{ $student->semester }}
                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>{{ $student->phone ?? 'N/A' }}</td>

                                <td>
                                    @if($student->account_status === 'suspended')
                                        <span class="badge bg-danger">Suspended</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    @if($student->account_status === 'suspended')
                                        <form action="{{ route('admin.students.activate', $student->id) }}"
                                              method="POST"
                                                 class="d-inline activate-student-form">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-success rounded-pill px-3">
                                                Activate
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.students.suspend', $student->id) }}"
                                              method="POST"
                                             class="d-inline suspend-student-form">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                Suspend
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-people fs-1 d-block mb-2"></i>
                                        No students found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>

</div>

@endsection