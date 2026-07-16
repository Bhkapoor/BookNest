@extends('layouts.user')

@section('content')

<div class="container py-5">

    <h2 class="fw-bold mb-4">Schedule Meetup</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <p class="text-muted">
                Book: <strong>{{ $transaction->book->title ?? 'Book deleted' }}</strong>
            </p>

            <form action="{{ route('meetups.store', $transaction->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Meetup Location</label>
                    <select name="location" class="form-select" required>
                        <option value="">Select location</option>
                        <option value="Library">Library</option>
                        <option value="Hostel Area">Hostel Area</option>
                        <option value="Canteen">Canteen</option>
                        <option value="Department Block">Department Block</option>
                        <option value="Sports Ground">Sports Ground</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Custom Location</label>
                    <input type="text" name="custom_location" class="form-control"
                           placeholder="Required only if location is Other">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meetup Date</label>
                    <input type="date" name="meetup_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meetup Time</label>
                    <input type="time" name="meetup_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="3"
                              placeholder="Example: I will wait near library entrance."></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Propose Meetup
                </button>

                <a href="{{ route('books.request') }}" class="btn btn-light">
                    Back
                </a>

            </form>
        </div>
    </div>
</div>

@endsection