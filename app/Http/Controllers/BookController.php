<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
public function browse(Request $request)
{
    $books = Book::available()
        ->filter($request)
        ->latest()
        ->get();

    $hasFilters = $request->filled('search')
        || $request->filled('semester')
        || $request->filled('listing_type')
        || $request->filled('condition');

    return view('books.browse', compact('books', 'hasFilters'));
}

    public function add()
    {
        return view('books.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'subject_code' => ['nullable', 'string', 'max:50'],
            'course' => ['required', 'string', 'max:100'],
            'semester' => ['required', 'integer', 'between:1,8'],
            'condition' => ['required', 'in:Like New,Good,Acceptable,Poor'],
            'listing_type' => ['required', 'in:sell,exchange,both'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'exchange_preference' => 'nullable|string|max:500',
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('book-photos', 'public');
        }

        Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'author' => $request->author,
            'subject' => $request->subject,
            'subject_code' => $request->subject_code,
            'course' => $request->course,
            'semester' => $request->semester,
            'condition' => $request->condition,
            'listing_type' => $request->listing_type,
            'price' => $request->price,
            'exchange_preference' => $request->exchange_preference,
            'photo' => $photoPath,
            'description' => $request->description,
            'status' => 'available',
        ]);
        

        return redirect()
            ->route('books.listings')
            ->with('success', 'Book listed successfully.');
    }

 public function myListings()
{
    $books = Book::where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('books.listings', compact('books'));
}

public function markAsSold(Book $book)
{
    if ($book->user_id != auth()->id()) {
        abort(403);
    }

    $book->update([
        'status' => 'sold'
    ]);

    return redirect()
        ->back()
        ->with('success', 'Book marked as sold.');
}

public function edit(Book $book)
{
    if ($book->user_id != auth()->id()) {
        abort(403);
    }

    return view('books.edit', compact('book'));
}

public function update(Request $request, Book $book)
{
    if ($book->user_id != auth()->id()) {
        abort(403);
    }

    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'author' => ['required', 'string', 'max:255'],
        'subject' => ['required', 'string', 'max:255'],
        'subject_code' => ['nullable', 'string', 'max:50'],
        'course' => ['required', 'string', 'max:100'],
        'semester' => ['required', 'integer', 'between:1,8'],
        'condition' => ['required', 'in:Like New,Good,Acceptable,Poor'],
        'listing_type' => ['required', 'in:sell,exchange,both'],
        'price' => ['nullable', 'numeric', 'min:0'],
        'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        'description' => ['nullable', 'string', 'max:1000'],
    ]);

    $photoPath = $book->photo;

    if ($request->hasFile('photo')) {
        if ($book->photo) {
            Storage::disk('public')->delete($book->photo);
        }

        $photoPath = $request->file('photo')->store('book-photos', 'public');
    }

    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'subject' => $request->subject,
        'subject_code' => $request->subject_code,
        'course' => $request->course,
        'semester' => $request->semester,
        'condition' => $request->condition,
        'listing_type' => $request->listing_type,
        'price' => $request->price,
        'photo' => $photoPath,
        'description' => $request->description,
    ]);

    return redirect()
        ->route('books.listings')
        ->with('success', 'Book updated successfully.');
}

public function destroy(Book $book)
{
    if ($book->user_id != auth()->id()) {
        abort(403);
    }

    if ($book->photo) {
        Storage::disk('public')->delete($book->photo);
    }

    $book->delete();

    return redirect()
        ->back()
        ->with('success', 'Book deleted successfully.');
}
}