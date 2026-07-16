@extends('layouts.user')

@section('content')

    <section class="requests-page">

        <div class="requests-hero text-white p-5">
            <p class="mb-3 opacity-75">Home / <strong>My Requests</strong></p>

            <h1 class="fw-bold mb-2">
                My <span>Requests</span>
            </h1>

            <p class="mb-0 opacity-75">
                Requests you sent and received
            </p>
        </div>

        <div class="container-fluid py-5 px-4">

            <ul class="nav nav-tabs request-tabs mb-4" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#sent" type="button">
                        📤 Sent Requests
                    </button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#received" type="button">
                        📥 Received Requests
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="sent">
                    <div class="card border-0 rounded-4 overflow-hidden">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="requests-table-head">
                                    <tr>
                                        <th>BOOK</th>
                                        <th>OWNER</th>
                                        <th>TYPE</th>
                                        <th>STATUS</th>
                                        <th>MEETUP</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($sentRequests as $request)
                                        <tr>
                                            <td>{{ $request->book->title ?? 'Book deleted' }}</td>
                                            <td>{{ $request->seller->name ?? 'Unknown' }}</td>
                                            <td>{{ ucfirst($request->request_type) }}</td>
                                            <td>{{ ucfirst($request->status) }}</td>
                                            <td>
                                                @if ($request->status == 'accepted' && $request->transaction)
                                                    @php
                                                        $meetup = $request->transaction->meetup;
                                                    @endphp

                                                    @if ($meetup)
                                                        <div class="small mb-2">
                                                            <strong>
                                                                {{ $meetup->location == 'Other' ? $meetup->custom_location : $meetup->location }}
                                                            </strong><br>

                                                            {{ $meetup->meetup_date }} at {{ $meetup->meetup_time }}<br>

                                                            @if ($meetup->status == 'proposed')
                                                                <span class="badge bg-warning text-dark">Proposed</span>
                                                            @else
                                                                <span class="badge bg-success">Confirmed</span>
                                                            @endif
                                                            @if ($request->transaction->meetup && $request->transaction->meetup->status == 'confirmed')
                                                                <div class="mt-2">
                                                                    <i class="bi bi-telephone-fill text-success me-1"></i>

                                                                    @if (auth()->id() == $request->book->user_id)
                                                                        {{ $request->user->phone }}
                                                                    @else
                                                                        {{ $request->book->user->phone }}
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if (!$meetup)
                                                        <button type="button" class="btn btn-outline-success btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#meetupModal{{ $request->transaction->id }}">
                                                            Schedule Meetup
                                                        </button>
                                                    @elseif($meetup->status == 'proposed' && $meetup->proposed_by == auth()->id())
                                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#meetupModal{{ $request->transaction->id }}">
                                                            Edit Proposal
                                                        </button>
                                                    @elseif($meetup->status == 'proposed' && $meetup->proposed_by != auth()->id())
                                                        <form action="{{ route('meetups.confirm', $meetup->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                Confirm
                                                            </button>
                                                        </form>

                                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#meetupModal{{ $request->transaction->id }}">
                                                            Suggest Another Time
                                                        </button>
                                                    @endif

                                                    {{-- Meetup Modal --}}
                                                    <div class="modal fade" id="meetupModal{{ $request->transaction->id }}"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered ">
                                                            <div class="modal-content border-0 rounded-4 shadow">

                                                                <form
                                                                    action="{{ route('meetups.store', $request->transaction->id) }}"
                                                                    method="POST">
                                                                    @csrf

                                                                    <!-- Header -->
                                                                    <div
                                                                        class="modal-header bg-success bg-opacity-90 border-0 text-white rounded-top-4">
                                                                        <div>
                                                                            <h4 class="fw-bold mb-1">
                                                                                <i class="bi bi-calendar-event me-2"></i>
                                                                                Schedule Meetup
                                                                            </h4>

                                                                            <small class="opacity-75">
                                                                                {{ $request->book->title ?? 'Book deleted' }}
                                                                            </small>
                                                                        </div>

                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"></button>
                                                                    </div>

                                                                    <!-- Body -->
                                                                    <div class="modal-body bg-light">

                                                                        <div class="card border-0 shadow-sm rounded-4">
                                                                            <div class="card-body">

                                                                                <!-- Location -->
                                                                                <div class="mb-4">
                                                                                    <label class="form-label fw-semibold">
                                                                                        <i
                                                                                            class="bi bi-geo-alt-fill text-success me-1"></i>
                                                                                        Meetup Location
                                                                                    </label>

                                                                                    <select name="location"
                                                                                        class="form-select rounded-3 shadow-sm"
                                                                                        required>

                                                                                        <option value="">Choose
                                                                                            Location</option>
                                                                                        <option value="Library">📚 Library
                                                                                        </option>
                                                                                        <option value="Canteen">🍔 Canteen
                                                                                        </option>
                                                                                        <option value="Department Block">🏢
                                                                                            Department Block</option>
                                                                                        <option value="Hostel Area">🏠
                                                                                            Hostel Area</option>
                                                                                        <option value="Sports Ground">🏏
                                                                                            Sports Ground</option>
                                                                                        <option value="Other">📍 Other
                                                                                        </option>

                                                                                    </select>
                                                                                </div>

                                                                                <!-- Custom Location -->
                                                                                <div class="mb-4">
                                                                                    <label class="form-label fw-semibold">
                                                                                        <i
                                                                                            class="bi bi-pin-map-fill text-success me-1"></i>
                                                                                        Custom Location
                                                                                    </label>

                                                                                    <input type="text"
                                                                                        name="custom_location"
                                                                                        class="form-control rounded-3 shadow-sm"
                                                                                        placeholder="Enter location if 'Other' selected">
                                                                                </div>

                                                                                <!-- Date & Time -->
                                                                                <div class="row">

                                                                                    <div class="col-md-6 mb-4">

                                                                                        <label
                                                                                            class="form-label fw-semibold">
                                                                                            <i
                                                                                                class="bi bi-calendar-date text-success me-1"></i>
                                                                                            Meetup Date
                                                                                        </label>

                                                                                        <input type="date"
                                                                                            name="meetup_date"
                                                                                            class="form-control rounded-3 shadow-sm"
                                                                                            required>

                                                                                    </div>

                                                                                    <div class="col-md-6 mb-4">

                                                                                        <label
                                                                                            class="form-label fw-semibold">
                                                                                            <i
                                                                                                class="bi bi-clock-fill text-success me-1"></i>
                                                                                            Meetup Time
                                                                                        </label>

                                                                                        <input type="time"
                                                                                            name="meetup_time"
                                                                                            class="form-control rounded-3 shadow-sm"
                                                                                            required>

                                                                                    </div>

                                                                                </div>

                                                                                <!-- Notes -->
                                                                                <div>

                                                                                    <label class="form-label fw-semibold">
                                                                                        <i
                                                                                            class="bi bi-chat-left-text-fill text-success me-1"></i>
                                                                                        Additional Note
                                                                                    </label>

                                                                                    <textarea name="notes" rows="3" class="form-control rounded-3 shadow-sm"
                                                                                        placeholder="Anything your partner should know?"></textarea>

                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <!-- Footer -->
                                                                    <div
                                                                        class="modal-footer border-0 bg-white rounded-bottom-4">

                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary rounded-pill px-4"
                                                                            data-bs-dismiss="modal">

                                                                            Cancel

                                                                        </button>

                                                                        <button type="submit"
                                                                            class="btn btn-success rounded-pill px-4 shadow-sm">

                                                                            <i class="bi bi-send-fill me-1"></i>
                                                                            Schedule Meetup

                                                                        </button>

                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    Not scheduled
                                                @endif
                                            </td>
                                            <td>
                                                @if (
                                                    $request->transaction &&
                                                        $request->transaction->meetup &&
                                                        $request->transaction->meetup->status == 'confirmed' &&
                                                        $request->transaction->status == 'ongoing')
                                                    @if (!$request->transaction->buyer_confirmed)
                                                        <form
                                                            action="{{ route('transactions.buyer.confirm', $request->transaction->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn btn-success btn-sm">
                                                                I received the book
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="badge bg-info text-dark">Waiting for seller</span>
                                                    @endif
                                                @elseif($request->transaction && $request->transaction->status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5">
                                                No sent requests yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="received">
                    <div class="card border-0 rounded-4 overflow-hidden">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="requests-table-head">
                                    <tr>
                                        <th>BOOK</th>
                                        <th>BUYER</th>
                                        <th>TYPE</th>
                                        <th>STATUS</th>
                                        <th>DETAILS</th>
                                        <th>MEETUP</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($receivedRequests as $request)
                                        <tr>
                                            <td>{{ $request->book->title ?? 'Book deleted' }}</td>
                                            <td>{{ $request->buyer->name ?? 'Unknown' }}</td>
                                            <td>{{ ucfirst($request->request_type) }}</td>
                                            <td>{{ ucfirst($request->status) }}</td>
                                            <td>
                                                @if ($request->request_type == 'exchange')
                                                    <div class="small">
                                                        <strong>Offered Book:</strong><br>
                                                        {{ $request->offered_book_details ?? 'No offered book details' }}
                                                    </div>

                                                    @if ($request->message)
                                                        <div class="small text-muted mt-2">
                                                            <strong>Message:</strong><br>
                                                            {{ $request->message }}
                                                        </div>
                                                    @endif
                                                @else
                                                    {{ $request->message ?? '-' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($request->status == 'accepted' && $request->transaction)
                                                    @php
                                                        $meetup = $request->transaction->meetup;
                                                    @endphp

                                                    @if ($meetup)
                                                        <div class="small mb-2">
                                                            <strong>
                                                                {{ $meetup->location == 'Other' ? $meetup->custom_location : $meetup->location }}
                                                            </strong><br>

                                                            {{ $meetup->meetup_date }} at {{ $meetup->meetup_time }}<br>

                                                            @if ($meetup->status == 'proposed')
                                                                <span class="badge bg-warning text-dark">Proposed</span>
                                                            @else
                                                                <span class="badge bg-success">Confirmed</span>
                                                            @endif

                                                            @if ($request->transaction->meetup && $request->transaction->meetup->status == 'confirmed')
                                                                <div class="mt-2">
                                                                    <i class="bi bi-telephone-fill text-success me-1"></i>

                                                                    @if (auth()->id() == $request->book->user_id)
                                                                        {{ $request->user->phone }}
                                                                    @else
                                                                        {{ $request->book->user->phone }}
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if (!$meetup)
                                                        <button type="button" class="btn btn-outline-success btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#meetupModal{{ $request->transaction->id }}">
                                                            Schedule Meetup
                                                        </button>
                                                    @elseif($meetup->status == 'proposed' && $meetup->proposed_by == auth()->id())
                                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#meetupModal{{ $request->transaction->id }}">
                                                            Edit Proposal
                                                        </button>
                                                    @elseif($meetup->status == 'proposed' && $meetup->proposed_by != auth()->id())
                                                        <form action="{{ route('meetups.confirm', $meetup->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-sm">
                                                                Confirm
                                                            </button>
                                                        </form>

                                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#meetupModal{{ $request->transaction->id }}">
                                                            Suggest Another Time
                                                        </button>
                                                    @endif

                                                    {{-- Meetup Modal --}}
                                                    <div class="modal fade"
                                                        id="meetupModal{{ $request->transaction->id }}" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-0 rounded-4 shadow">

                                                                <form
                                                                    action="{{ route('meetups.store', $request->transaction->id) }}"
                                                                    method="POST">
                                                                    @csrf

                                                                    <!-- Header -->
                                                                    <div
                                                                        class="modal-header bg-success border-0 text-white py-3">

                                                                        <div>
                                                                            <h5 class="modal-title fw-bold mb-1">
                                                                                <i class="bi bi-calendar-event me-2"></i>
                                                                                Schedule Meetup
                                                                            </h5>

                                                                            <small class="text-white-50">
                                                                                {{ $request->book->title ?? 'Book deleted' }}
                                                                            </small>
                                                                        </div>

                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"></button>

                                                                    </div>

                                                                    <!-- Body -->
                                                                    <div class="modal-body">

                                                                        <div class="card border-0 shadow-sm rounded-4">
                                                                            <div class="card-body p-4">

                                                                                <!-- Location -->
                                                                                <div class="mb-3">
                                                                                    <label class="form-label fw-semibold">
                                                                                        <i
                                                                                            class="bi bi-geo-alt-fill text-success me-2"></i>
                                                                                        Meetup Location
                                                                                    </label>

                                                                                    <select name="location"
                                                                                        class="form-select rounded-3"
                                                                                        required>

                                                                                        <option value="">Choose
                                                                                            Location</option>
                                                                                        <option value="Library">📚 Library
                                                                                        </option>
                                                                                        <option value="Canteen">🍔 Canteen
                                                                                        </option>
                                                                                        <option value="Department Block">🏢
                                                                                            Department Block</option>
                                                                                        <option value="Hostel Area">🏠
                                                                                            Hostel Area</option>
                                                                                        <option value="Sports Ground">🏏
                                                                                            Sports Ground</option>
                                                                                        <option value="Other">📍 Other
                                                                                        </option>

                                                                                    </select>
                                                                                </div>

                                                                                <!-- Custom Location -->
                                                                                <div class="mb-3">
                                                                                    <label class="form-label fw-semibold">
                                                                                        <i
                                                                                            class="bi bi-pin-map-fill text-success me-2"></i>
                                                                                        Custom Location
                                                                                    </label>

                                                                                    <input type="text"
                                                                                        name="custom_location"
                                                                                        class="form-control rounded-3"
                                                                                        placeholder="Enter custom location">
                                                                                </div>

                                                                                <!-- Date & Time -->
                                                                                <div class="row">

                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label fw-semibold">
                                                                                            <i
                                                                                                class="bi bi-calendar-date text-success me-2"></i>
                                                                                            Meetup Date
                                                                                        </label>

                                                                                        <input type="date"
                                                                                            name="meetup_date"
                                                                                            class="form-control rounded-3"
                                                                                            required>
                                                                                    </div>

                                                                                    <div class="col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label fw-semibold">
                                                                                            <i
                                                                                                class="bi bi-clock-fill text-success me-2"></i>
                                                                                            Meetup Time
                                                                                        </label>

                                                                                        <input type="time"
                                                                                            name="meetup_time"
                                                                                            class="form-control rounded-3"
                                                                                            required>
                                                                                    </div>

                                                                                </div>

                                                                                <!-- Notes -->
                                                                                <div class="mb-0">
                                                                                    <label class="form-label fw-semibold">
                                                                                        <i
                                                                                            class="bi bi-chat-left-text-fill text-success me-2"></i>
                                                                                        Additional Note
                                                                                    </label>

                                                                                    <textarea name="notes" rows="3" class="form-control rounded-3" placeholder="Write an optional note..."></textarea>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <!-- Footer -->
                                                                    <div class="modal-footer border-0 bg-white">

                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary rounded-pill px-4"
                                                                            data-bs-dismiss="modal">
                                                                            Cancel
                                                                        </button>

                                                                        <button type="submit"
                                                                            class="btn btn-success rounded-pill px-4">
                                                                            <i class="bi bi-send-fill me-1"></i>
                                                                            Schedule Meetup
                                                                        </button>

                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    Not scheduled
                                                @endif
                                            </td>
                                            <td>
                                                @if ($request->status == 'pending')
                                                    <form action="{{ route('requests.accept', $request->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Accept
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('requests.reject', $request->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Reject
                                                        </button>
                                                    </form>
                                                @elseif(
                                                    $request->transaction &&
                                                        $request->transaction->meetup &&
                                                        $request->transaction->meetup->status == 'confirmed' &&
                                                        $request->transaction->status == 'ongoing')
                                                    @if (!$request->transaction->seller_confirmed)
                                                        <form
                                                            action="{{ route('transactions.seller.confirm', $request->transaction->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn btn-success btn-sm">
                                                                I handed over the book
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="badge bg-info text-dark">Waiting for buyer</span>
                                                    @endif
                                                @elseif($request->transaction && $request->transaction->status == 'completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5">
                                                No received requests yet
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>


    </section>

@endsection
