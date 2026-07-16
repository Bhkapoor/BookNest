@extends('layouts.user')

@section('content')

<div class="bn-create-page">

    <div class="bn-create-card">

        <div class="bn-create-header">
            <h2>Upload PYQ</h2>
            <p>Share previous year question papers with fellow students</p>
        </div>

        <form action="{{ route('pyq.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bn-form-row">

                <div class="bn-form-group">
                    <label>Subject Name *</label>
                    <input type="text"
                           name="subject_name"
                           placeholder="Enter subject name..."
                           required>
                </div>

                <div class="bn-form-group">
                    <label>Subject Code</label>
                    <input type="text"
                           name="subject_code"
                           placeholder="Enter subject code here...">
                </div>

            </div>

            <div class="bn-form-row">

                <div class="bn-form-group">
                    <label>Course *</label>
                    <input type="text"
                           name="course"
                           placeholder="Enter course..."
                           required>
                </div>

                <div class="bn-form-group">
                    <label>Semester *</label>

                    <select name="semester" required>
                        <option value="">Select Semester</option>

                        @for($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}">
                                Sem {{ $i }}
                            </option>
                        @endfor

                    </select>
                </div>

            </div>

            <div class="bn-form-row">

                <div class="bn-form-group">
                    <label>Year *</label>

                    <input type="number"
                           name="year"
                           placeholder="Exam year..."
                           min="2020"
                           max="{{ date('Y') }}"
                           required>

                    <small class="text-muted">
                        The year the exam was conducted.
                    </small>
                </div>

                <div class="bn-form-group">
                    <label>Exam Type *</label>

                    <select name="exam_type" required>
                        <option value="">Select Exam Type</option>
                        <option value="mid">Mid Semester</option>
                        <option value="end">End Semester</option>
                        <option value="internal">Internal Assessment</option>
                    </select>
                </div>

            </div>

            <div class="bn-form-group">
                <label>PDF File *</label>

                <input type="file"
                       name="file"
                       accept=".pdf"
                       required>

                <small class="text-muted">
                    PDF upload — maximum size 10 MB.
                </small>
            </div>

            <button type="submit" class="bn-submit-btn">
                📄 Upload PYQ
            </button>

        </form>

    </div>

</div>

@endsection