<?php

namespace App\Http\Controllers\Admin;
use App\Models\ValidStudent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValidStudentImportController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt'
    ]);

    $file = fopen(
        $request->file('csv_file')->getRealPath(),
        'r'
    );

    // Header skip
    fgetcsv($file);

    while (($row = fgetcsv($file, 1000, ',')) !== false) {

        $registrationId = trim($row[0]);

        if (!empty($registrationId)) {

            ValidStudent::firstOrCreate([
                'registration_id' => $registrationId
            ]);
        }
    }

    fclose($file);

    return back()->with(
        'success',
        'Valid students imported successfully.'
    );
}
}