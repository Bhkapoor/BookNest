@extends(auth()->check() ? 'layouts.user' : 'layouts.app')

@section('content')
    <section class="pyq-page">

        <div class="pyq-hero text-white p-5">
            <p class="mb-3 opacity-75">Home / <strong>PYQ Papers</strong></p>

            <h1 class="fw-bold mb-2">
                Previous Year <span>Question Papers</span>
            </h1>

            <p class="mb-0 opacity-75">
                Free academic resources uploaded by your seniors
            </p>
        </div>

        {{-- alert --}}
        @if (session('success'))
            <div id="flash-message" class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div id="flash-message" class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('pyq.index') }}" class="mb-4">

                    <div class="bg-white shadow-sm rounded-3 p-3">
                        <div class="d-flex gap-1 align-items-center ">

                            <input type="text" name="search" value="{{ request('search') }}" class="form-control py-3"
                                style="max-width: 800px;" placeholder="Search subject, code or course...">

                            <select name="semester" class="form-select py-3" style="max-width: 215px;">
                                <option value="">All Semesters</option>

                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                        Sem {{ $i }}
                                    </option>
                                @endfor
                            </select>

                            <select name="exam_type" class="form-select py-3" style="max-width: 215px;">
                                <option value="">All Types</option>

                                <option value="mid" {{ request('exam_type') == 'mid' ? 'selected' : '' }}>
                                    Mid Semester
                                </option>

                                <option value="end" {{ request('exam_type') == 'end' ? 'selected' : '' }}>
                                    End Semester
                                </option>

                                <option value="internal" {{ request('exam_type') == 'internal' ? 'selected' : '' }}>
                                    Internal Assessment
                                </option>
                            </select>

                            <button type="submit" class="btn btn-success py-3 px-5 fw-semibold">
                                Search
                            </button>

                            @auth
                                <a href="{{ route('pyq.upload') }}" class="btn btn-outline-success py-3 px-4 fw-semibold">
                                    +
                                </a>
                            @endauth

                        </div>
                    </div>

                </form>
            </div>
        </div>

        @if ($pyqs->count())
            <div class="row g-4">
                @foreach ($pyqs as $pyq)
                    <div class="col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="fs-1">📄</div>

                                    @if ($pyq->verification_status == 'verified')
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Unverified</span>
                                    @endif
                                </div>

                                <h5 class="fw-bold mb-1">
                                    {{ $pyq->subject_name }}
                                </h5>

                                <p class="text-muted small mb-3">
                                    {{ $pyq->subject_code ?? 'No Subject Code' }}
                                </p>

                                <div class="small text-muted mb-3">
                                    <div>Course: <strong>{{ $pyq->course }}</strong></div>
                                    <div>Semester: <strong>Sem {{ $pyq->semester }}</strong></div>
                                    <div>Year: <strong>{{ $pyq->year }}</strong></div>
                                    <div>Exam: <strong>{{ ucfirst($pyq->exam_type) }}</strong></div>
                                    <div>Downloads: <strong>{{ $pyq->download_count }}</strong></div>
                                </div>

                                <p class="small text-muted">
                                    Uploaded by {{ $pyq->uploader->name ?? 'Unknown User' }}
                                </p>

                                @auth
                                    <a href="{{ route('pyq.download', $pyq->id) }}" class="btn btn-success rounded-pill w-100">
                                        Download PDF
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill w-100">
                                        Login to Download
                                    </a>
                                @endauth

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @if ($hasFilters)
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center py-5">

                        <div class="fs-1 mb-3">🔍</div>

                        <h4 class="fw-bold">
                            No PYQ papers found
                        </h4>

                        <p class="text-muted mb-4">
                            Try changing your search or filters.
                        </p>

                        <a href="{{ route('pyq.index') }}" class="btn btn-outline-success rounded-pill px-4">
                            Clear Filters
                        </a>

                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center py-5">

                        <div class="fs-1 mb-3">📄</div>

                        <h4 class="fw-bold">
                            No PYQ papers uploaded yet
                        </h4>

                        <p class="text-muted mb-4">
                            Once students upload PYQ papers, they will appear here.
                        </p>

                        @auth
                            <a href="{{ route('pyq.upload') }}" class="btn btn-success rounded-pill px-4">
                                Upload First PYQ
                            </a>
                        @endauth

                    </div>
                </div>
            @endif
        @endif

        </div>

    </section>
@endsection
