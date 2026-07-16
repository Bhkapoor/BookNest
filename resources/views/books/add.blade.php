@extends('layouts.user')

@section('content')

<div class="bn-create-page">

    <div class="bn-create-card">

        <div class="bn-create-header">
            <h2>List a Book</h2>
            <p>Fill in your book details to list it on campus</p>
        </div>

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bn-form-row">
                <div class="bn-form-group">
                    <label>Book Title *</label>
                    <input type="text" name="title" placeholder="Enter title...." required>
                </div>

                <div class="bn-form-group">
                    <label>Author Name *</label>
                    <input type="text" name="author" placeholder="Enter author name...." required>
                </div>
            </div>

            <div class="bn-form-row">
                <div class="bn-form-group">
                    <label>Subject *</label>
                    <input type="text" name="subject" placeholder="Subject name...." required>
                </div>

                <div class="bn-form-group">
                    <label>Subject Code</label>
                    <input type="text" name="subject_code" placeholder="like MCA201...">
                </div>
            </div>

            <div class="bn-form-row">
                <div class="bn-form-group">
                    <label>Course *</label>
                    <input type="text" name="course" placeholder="Enter course..." required>
                </div>

                <div class="bn-form-group">
                    <label>Semester of Book *</label>
                    <select name="semester" required>
                        <option value="">Select Semester</option>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">Sem {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="bn-form-group">
                <label>Book Condition *</label>
                <select name="condition" required>
                    <option value="">Select Condition</option>
                    <option>Like New</option>
                    <option>Good</option>
                    <option>Acceptable</option>
                    <option>Poor</option>
                </select>
            </div>

            <div class="bn-form-group">
                <label>Listing Type *</label>

                <div class="bn-type-buttons">
                    <label class="bn-type-option">
                        <input type="radio" name="listing_type" value="sell" checked>
                        <span>💰 For Sale</span>
                    </label>

                    <label class="bn-type-option">
                        <input type="radio" name="listing_type" value="exchange">
                        <span>🔄 Exchange</span>
                    </label>

                    <label class="bn-type-option">
                        <input type="radio" name="listing_type" value="both">
                        <span>Both</span>
                    </label>
                </div>
            </div>

            <div class="bn-form-group">
                <label>Expected Price (₹)</label>
                <input type="number" name="price" placeholder="Enter price..." min="0">
            </div>
            <div class="bn-form-group" id="exchangePreferenceBox" style="display: none;">
    <label>Exchange Preference</label>
    <textarea name="exchange_preference"
              placeholder="Example: Which book do you want  in exchange..."></textarea>
</div>

            <div class="bn-form-group">
                <label>Book Photo (optional)</label>
                <input type="file" name="photo" accept="image/*">
            </div>

            <div class="bn-form-group">
                <label>Description (optional)</label>
                <textarea name="description" placeholder="Any additional notes about the book..."></textarea>
            </div>

            <button type="submit" class="bn-submit-btn">
                📚 List My Book
            </button>

        </form>

    </div>

</div>

@endsection