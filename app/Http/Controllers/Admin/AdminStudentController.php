<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $students = User::where('role', 'user')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%')
                      ->orWhere('registration_id', 'like', '%' . $request->search . '%')
                      ->orWhere('course', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.students', compact('students'));
    }

    public function suspend(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin account cannot be suspended.');
        }

        $user->update([
            'account_status' => 'suspended',
        ]);

        return back()->with('success', 'Student account suspended successfully.');
    }

    public function activate(User $user)
    {
        $user->update([
            'account_status' => 'active',
        ]);

        return back()->with('success', 'Student account activated successfully.');
    }
}