<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pyq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminPyqController extends Controller
{
  public function index(Request $request)
{
    $pyqs = Pyq::with('uploader')
        ->when($request->search, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('subject_name', 'like', '%' . $request->search . '%')
                  ->orWhere('subject_code', 'like', '%' . $request->search . '%')
                  ->orWhere('course', 'like', '%' . $request->search . '%')
                  ->orWhere('year', 'like', '%' . $request->search . '%');
            });
        })
        ->when($request->status, function ($query) use ($request) {
            $query->where('verification_status', $request->status);
        })
        ->when($request->exam_type, function ($query) use ($request) {
            $query->where('exam_type', $request->exam_type);
        })
        ->latest()
        ->paginate(10);

    return view('admin.pyqs', compact('pyqs'));
}

    public function verify(Pyq $pyq)
    {
        $pyq->update([
            'verification_status' => 'verified',
        ]);

        return back()->with('success', 'PYQ paper verified successfully.');
    }

    public function destroy(Pyq $pyq)
    {
        if ($pyq->file_path && File::exists(public_path($pyq->file_path))) {
            File::delete(public_path($pyq->file_path));
        }

        $pyq->delete();

        return back()->with('success', 'PYQ paper removed successfully.');
    }
}