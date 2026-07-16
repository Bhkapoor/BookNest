<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Pyq extends Model
{
    protected $fillable = [
        'uploaded_by',
        'subject_name',
        'subject_code',
        'course',
        'semester',
        'year',
        'exam_type',
        'file_path',
        'verification_status',
        'download_count',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

}