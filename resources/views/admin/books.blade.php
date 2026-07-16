@extends('layouts.admin')

@section('page-title', 'Book Listings')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h3 class="fw-bold mb-1 text-dark">Book Listings</h3>
                        <p class="text-muted mb-0">
                            Monitor all listed books and manage suspicious or invalid listings.
                        </p>
                    </div>

                    <span class="badge rounded-pill px-4 py-2" style="background:#2D6A4F;">
                        {{ $books->total() }} Listings
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
            <form method="GET" action="{{ route('admin.books') }}">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control rounded-pill px-4"
                               placeholder="Search by title, author, subject, code or course...">
                    </div>

                    <div class="col-lg-3">
                        <select name="status" class="form-select rounded-pill px-4">
                            <option value="">All Status</option>
                            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                            <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                            <option value="exchanged" {{ request('status') == 'exchanged' ? 'selected' : '' }}>Exchanged</option>
                        </select>
                    </div>

                    <div class="col-lg-2 d-flex gap-2">
                        <button class="btn btn-success rounded-pill px-4 w-100">
                            <i class="bi bi-search"></i>
                        </button>

                        @if(request('search') || request('status'))
                            <a href="{{ route('admin.books') }}"
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
                            <th>Seller</th>
                            <th>Course/Sem</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $book->title }}</div>
                                    <small class="text-muted">
                                        {{ $book->subject }} {{ $book->subject_code ? '• '.$book->subject_code : '' }}
                                    </small>
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $book->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $book->user->email ?? '' }}</small>
                                </td>

                                <td>
                                    {{ $book->course ?? 'N/A' }}<br>
                                    <small class="text-muted">Sem {{ $book->semester ?? 'N/A' }}</small>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ ucfirst($book->listing_type) }}
                                    </span>
                                </td>

                                <td>
                                    @if($book->price)
                                        ₹{{ $book->price }}
                                    @else
                                        <span class="text-muted">Exchange</span>
                                    @endif
                                </td>

                                <td>
                                    @if($book->status === 'available')
                                        <span class="badge bg-success">Available</span>
                                    @elseif($book->status === 'reserved')
                                        <span class="badge bg-warning text-dark">Reserved</span>
                                    @elseif($book->status === 'sold')
                                        <span class="badge bg-primary">Sold</span>
                                    @else
                                        <span class="badge bg-info text-dark">Exchanged</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <form action="{{ route('admin.books.status', $book->id) }}"
                                          method="POST"
                                          class="d-inline-block mb-1">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status"
                                                class="form-select form-select-sm rounded-pill"
                                                onchange="this.form.submit()">
                                            <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available</option>
                                            <option value="reserved" {{ $book->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                            <option value="sold" {{ $book->status == 'sold' ? 'selected' : '' }}>Sold</option>
                                            <option value="exchanged" {{ $book->status == 'exchanged' ? 'selected' : '' }}>Exchanged</option>
                                        </select>
                                    </form>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}"
                                          method="POST"
                                         class="d-inline-block delete-book-form">
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
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-book fs-1 d-block mb-2"></i>
                                        No book listings found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $books->links() }}
            </div>
        </div>
    </div>

</div>

@endsection