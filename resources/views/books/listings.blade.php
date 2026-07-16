@extends('layouts.user')

@section('content')
    @if (session('success'))
        <div id="flash-message" class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bn-panel mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>My Book Listings</h4>

            <a href="{{ route('books.add') }}" class="btn btn-success btn-sm">
                + List New Book
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Condition</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>
                                @if ($book->photo)
                                    <img src="{{ asset('storage/' . $book->photo) }}" alt="{{ $book->title }}" width="60"
                                        height="75" style="object-fit: cover; border-radius: 8px;">
                                @else
                                    <span class="text-muted">No photo</span>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $book->title }}</strong><br>
                                <small class="text-muted">{{ $book->author }}</small>
                            </td>

                            <td>
                                {{ $book->subject }}<br>
                                <small class="text-muted">Sem {{ $book->semester }}</small>
                            </td>

                            <td>{{ ucfirst($book->listing_type) }}</td>

                            <td>
                                @if ($book->price)
                                    ₹{{ $book->price }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $book->condition }}</td>

                            <td>
                                @if ($book->status == 'available')
                                    <span class="badge bg-success">Available</span>
                                    @elseif($book->status=='ongoing')
                                    <span class="badge bg-warning">Ongoing</span>
                                    @elseif($book->status=='reserved')
                                    <span class="badge bg-info">Reserved</span>
                                   @elseif($book->status == 'sold')
                                    <span class="badge bg-danger">Sold</span>
                                   @endif
                            </td>

                            <td>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" 
                                    class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                </form>
                           
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No listings yet. List your first book to get started!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
