<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('user')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('author', 'like', '%' . $request->search . '%')
                      ->orWhere('subject', 'like', '%' . $request->search . '%')
                      ->orWhere('subject_code', 'like', '%' . $request->search . '%')
                      ->orWhere('course', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.books', compact('books'));
    }

    public function updateStatus(Request $request, Book $book)
    {
        $request->validate([
            'status' => 'required|in:available,reserved,sold,exchanged',
        ]);

        $book->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Book status updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Book listing removed successfully.');
    }
}