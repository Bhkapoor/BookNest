@extends('layouts.user')

@section('content')

<div class="bn-create-page">

    <div class="bn-create-card">

        <div class="bn-create-header">
            <h2>Edit Book</h2>
            <p>Update your book details</p>
        </div>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bn-form-row">
                <div class="bn-form-group">
                    <label>Book Title *</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
                </div>

                <div class="bn-form-group">
                    <label>Author Name *</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" required>
                </div>
            </div>

            <div class="bn-form-row">
                <div class="bn-form-group">
                    <label>Subject *</label>
                    <input type="text" name="subject" value="{{ old('subject', $book->subject) }}" required>
                </div>

                <div class="bn-form-group">
                    <label>Subject Code</label>
                    <input type="text" name="subject_code" value="{{ old('subject_code', $book->subject_code) }}">
                </div>
            </div>

            <div class="bn-form-row">
                <div class="bn-form-group">
                    <label>Course *</label>
                    <input type="text" name="course" value="{{ old('course', $book->course) }}" required>
                </div>

                <div class="bn-form-group">
                    <label>Semester of Book *</label>
                    <select name="semester" required>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester', $book->semester) == $i ? 'selected' : '' }}>
                                Sem {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="bn-form-group">
                <label>Book Condition *</label>
                <select name="condition" required>
                    @foreach(['Like New', 'Good', 'Acceptable', 'Poor'] as $condition)
                        <option value="{{ $condition }}" {{ old('condition', $book->condition) == $condition ? 'selected' : '' }}>
                            {{ $condition }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="bn-form-group">
                <label>Listing Type *</label>

                <div class="bn-type-buttons">
                    <label class="bn-type-option">
                        <input type="radio" name="listing_type" value="sell"
                            {{ old('listing_type', $book->listing_type) == 'sell' ? 'checked' : '' }}>
                        <span>💰 For Sale</span>
                    </label>

                    <label class="bn-type-option">
                        <input type="radio" name="listing_type" value="exchange"
                            {{ old('listing_type', $book->listing_type) == 'exchange' ? 'checked' : '' }}>
                        <span>🔄 Exchange</span>
                    </label>

                    <label class="bn-type-option">
                        <input type="radio" name="listing_type" value="both"
                            {{ old('listing_type', $book->listing_type) == 'both' ? 'checked' : '' }}>
                        <span>Both</span>
                    </label>
                </div>
            </div>

            <div class="bn-form-group">
                <label>Expected Price (₹)</label>
                <input type="number" name="price" value="{{ old('price', $book->price) }}" min="0">
            </div>
            <div class="bn-form-group" id="exchangePreferenceBox">
    <label>Exchange Preference</label>
    <textarea name="exchange_preference"
              placeholder="Which book do you want in exchange...">{{ old('exchange_preference', $book->exchange_preference) }}</textarea>
</div>

            <div class="bn-form-group">
                <label>Current Photo</label><br>

                @if($book->photo)
                    <img src="{{ asset('storage/'.$book->photo) }}" width="100" style="border-radius: 8px; object-fit: cover;">
                @else
                    <p class="text-muted">No photo uploaded</p>
                @endif
            </div>

            <div class="bn-form-group">
                <label>Change Book Photo</label>
                <input type="file" name="photo" accept="image/*">
            </div>

            <div class="bn-form-group">
                <label>Description</label>
                <textarea name="description">{{ old('description', $book->description) }}</textarea>
            </div>

            <button type="submit" class="bn-submit-btn">
                Update Book
            </button>

        </form>

    </div>

</div>

@endsection