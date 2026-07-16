<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meetup extends Model
{
    protected $fillable = [
    'transaction_id',
    'proposed_by',
    'location',
    'custom_location',
    'meetup_date',
    'meetup_time',
    'notes',
    'status',
    'confirmed_at',
];

public function transaction()
{
    return $this->belongsTo(Transaction::class);
}

public function proposedBy()
{
    return $this->belongsTo(User::class, 'proposed_by');
}
}
