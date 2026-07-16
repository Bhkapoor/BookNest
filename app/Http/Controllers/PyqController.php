<?php

namespace App\Http\Controllers;

use App\Models\Pyq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PyqController extends Controller
{
public function index(Request $request)
{
    $pyqs = Pyq::with('uploader')
        ->when($request->search, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('subject_name', 'like', '%' . $request->search . '%')
                  ->orWhere('subject_code', 'like', '%' . $request->search . '%')
                  ->orWhere('course', 'like', '%' . $request->search . '%');
            });
        })
        ->when($request->semester, function ($query) use ($request) {
            $query->where('semester', $request->semester);
        })
        ->when($request->exam_type, function ($query) use ($request) {
            $query->where('exam_type', $request->exam_type);
        })
        ->latest()
        ->get();

    $hasFilters =
        $request->filled('search') ||
        $request->filled('semester') ||
        $request->filled('exam_type');

    return view('pyq.index', compact('pyqs', 'hasFilters'));
}

    public function show($id)
    {
        return view('pyq.show');
    }

    public function upload()
    {
        return view('pyq.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'nullable|string|max:50',
            'course' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:8',
            'year' => 'required|integer|min:2020|max:' . date('Y'),
            'exam_type' => 'required|in:mid,end,internal',
            'file' => 'required|mimes:pdf|max:10240',
        ]);

        $path = $request->file('file')->store('pyqs', 'public');

        Pyq::create([
            'uploaded_by' => Auth::id(),
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'course' => $request->course,
            'semester' => $request->semester,
            'year' => $request->year,
            'exam_type' => $request->exam_type,
            'file_path' => $path,
        ]);

        return redirect()->route('pyq.index')
            ->with('success', 'PYQ uploaded successfully.');
    }

    public function download(Pyq $pyq)
{
    if (!Storage::disk('public')->exists($pyq->file_path)) {
        return back()->with('error', 'File not found.');
    }

    $pyq->increment('download_count');

    return Storage::disk('public')->download($pyq->file_path);
}
}