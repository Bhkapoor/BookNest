<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BookRequest;

class Book extends Model
{
    protected $fillable = [
    'user_id',
    'title',
    'author',
    'subject',
    'subject_code',
    'course',
    'semester',
    'condition',
    'listing_type',
    'price',
    'exchange_preference',
    'photo',
    'description',
    'status',
];



public function scopeAvailable($query)
{
    return $query->where('status', 'available');
}

public function scopeFilter($query, $request)
{
    return $query
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('subject_code', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%");
            });
        })

        ->when($request->semester, fn($query, $semester) =>
            $query->where('semester', $semester)
        )
        ->when($request->listing_type, fn($query, $type) =>
            $query->where('listing_type', $type)
        )
        ->when($request->condition, fn($query, $condition) =>
            $query->where('condition', $condition)
        );
}

// request
public function requests()
{
    return $this->hasMany(BookRequest::class);
}

public function owner()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
