@extends(auth()->check() ? 'layouts.user' : 'layouts.app')

@section('content')
    <div class="bg-light">

        <div class="bg-dark text-white py-5">
            <div class="container">
                <p class="mb-2 text-white-50">Dashboard / <strong class="text-white">Browse Books</strong></p>
                <h1 class="fw-bold">Find Your <span class="text-warning">Next Book</span></h1>
                <p class="mb-0 text-white-50">Browse available used books listed by campus students.</p>
            </div>
        </div>

        <div class="container py-4">
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
                    <form method="GET" action="{{ route('books.browse') }}" class="row g-3 align-items-center">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search title, author, subject,course..." value="{{ request('search') }}">
                        </div>

                        <div class="col-md-2">
                            <select name="semester" class="form-select">
                                <option value="">All Semesters</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                        Sem {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="listing_type" class="form-select">
                                <option value="">All Types</option>
                                <option value="sell" {{ request('listing_type') == 'sell' ? 'selected' : '' }}>For Sale
                                </option>
                                <option value="exchange" {{ request('listing_type') == 'exchange' ? 'selected' : '' }}>
                                    Exchange</option>
                                <option value="both" {{ request('listing_type') == 'both' ? 'selected' : '' }}>Both
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select name="condition" class="form-select">
                                <option value="">Any Condition</option>
                                <option value="Like New" {{ request('condition') == 'Like New' ? 'selected' : '' }}>Like
                                    New
                                </option>
                                <option value="Good" {{ request('condition') == 'Good' ? 'selected' : '' }}>Good</option>
                                <option value="Acceptable" {{ request('condition') == 'Acceptable' ? 'selected' : '' }}>
                                    Acceptable</option>
                                <option value="Poor" {{ request('condition') == 'Poor' ? 'selected' : '' }}>Poor</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-success w-100">Search</button>
                            <a href="{{ route('books.add') }}" class="btn btn-outline-success">+</a>
                        </div>

                    </form>
                </div>
            </div>

            <div class="row g-4">

                @forelse($books as $book)
                    <div class="col-md-6 col-lg-4">
                        <div class="bn-book-card">




                            @if ($book->photo)
                                <img src="{{ asset('storage/' . $book->photo) }}" class="bn-book-img"
                                    alt="{{ $book->title }}">
                            @else
                                <div class="bn-book-img bn-book-placeholder">
                                    📚
                                </div>
                            @endif

                            <div class="bn-book-body">

                                <div class="mb-2">
                                    @if ($book->listing_type == 'sell')
                                        <span class="bn-tag sell">FOR SALE</span>
                                    @elseif($book->listing_type == 'exchange')
                                        <span class="bn-tag exchange">EXCHANGE</span>
                                    @else
                                        <span class="bn-tag both">SELL/SWAP</span>
                                    @endif

                                    <span class="bn-tag condition">
                                        {{ strtoupper($book->condition) }}
                                    </span>
                                </div>

                                <h5>{{ $book->title }}</h5>

                                <p class="bn-author">
                                    by {{ $book->author }}
                                </p>

                                <p class="bn-course">
                                    {{ $book->course }}
                                </p>

                                <p class="bn-book-meta">
                                    📘 Sem {{ $book->semester }} · {{ $book->subject }}
                                </p>
                                @if(in_array($book->listing_type, ['exchange', 'both']) && $book->exchange_preference)
    <p class="bn-exchange-want">
        Wants: {{ Str::limit($book->exchange_preference, 55) }}
    </p>
@endif

                                <div class="bn-card-bottom">

                                    <div>
                                        @if ($book->listing_type == 'exchange')
                                            <div class="bn-exchange">Exchange</div>
                                            <div class="bn-subtext">No money needed</div>
                                        @else
                                            <div class="bn-price">₹{{ $book->price ?? 0 }}</div>
                                            <div class="bn-subtext">Click to view</div>
                                        @endif
                                    </div>

                               @auth
    @if(Auth::id() == $book->user_id)
        <button class="bn-request-btn border-0" disabled>Your Book</button>
    @else

        @if($book->listing_type == 'sell')
            <form action="{{ route('book.request.store', $book->id) }}" method="POST">
                @csrf
                <input type="hidden" name="request_type" value="buy">
                <button type="submit" class="bn-request-btn border-0">
                    Request
                </button>
            </form>

        @elseif($book->listing_type == 'exchange')
            <button type="button"
                    class="bn-request-btn border-0"
                    data-bs-toggle="modal"
                    data-bs-target="#requestModal{{ $book->id }}">
                Swap
            </button>

        @else
            <div class="d-flex gap-2">
                <form action="{{ route('book.request.store', $book->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="request_type" value="buy">
                    <button type="submit" class="bn-request-btn border-0">
                        Request
                    </button>
                </form>

                <button type="button"
                        class="bn-request-btn border-0"
                        data-bs-toggle="modal"
                        data-bs-target="#requestModal{{ $book->id }}">
                    Swap
                </button>
            </div>
        @endif

    @endif
@else
    <a href="{{ route('login') }}" class="bn-request-btn">Request</a>
@endauth

                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- modal --}}
                    @if(in_array($book->listing_type, ['exchange', 'both']))
<div class="modal fade" id="requestModal{{ $book->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">

            <form action="{{ route('book.request.store', $book->id) }}" method="POST">
                @csrf

                <input type="hidden" name="request_type" value="exchange">

                <div class="modal-header border-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-bold">Swap Request</h5>
                        <p class="text-muted small mb-0">
                            {{ $book->title }} · {{ $book->course }} · Sem {{ $book->semester }}
                        </p>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    @if($book->exchange_preference)
                        <div class="alert alert-warning small mb-3">
                            <strong>Seller wants:</strong> {{ $book->exchange_preference }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Your Offered Book *</label>
                        <textarea name="offered_book_details"
                                  class="form-control"
                                  rows="3"
                                  required
                                  placeholder="Example: DBMS book, Good condition, MCA Sem 3"></textarea>

                        <div class="form-text">
                            Offer a book that matches the seller's preference. Seller can accept or reject your request.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Message to Seller</label>
                        <textarea name="message"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Optional message..."></textarea>
                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button"
                            class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                            class="btn btn-success rounded-pill px-4">
                        Send Swap Request
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endif
                @empty
                    <div class="col-12">
                        @if ($hasFilters)
                            <div class="card border-0 shadow-sm text-center p-5">
                                <div class="fs-1 mb-3">🔍</div>
                                <h4>No books found</h4>
                                <p class="text-muted">Try changing your search or filters.</p>
 <div class="text-center mt-3">
    <a href="{{ route('books.browse') }}"
       class="btn btn-outline-success rounded-pill"
       style="width:140px;">
        Clear Filters
    </a>
</div>
                            </div>
                   
                        @else
                            <div class="card border-0 shadow-sm text-center p-5">
                                <div class="fs-1 mb-3">📦</div>
                                <h4>No books listed yet</h4>
                                <p class="text-muted">When students add books, they will appear here.</p>
                                <a href="{{ route('books.add') }}" class="btn btn-success mt-2">
                                    + List a Book
                                </a>
                            </div>
                        @endif
                    </div>
                    
                @endforelse

            </div>

        </div>
    </div>
@endsection
