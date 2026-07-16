<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $fillable = [
        'book_id',
        'buyer_id',
        'seller_id',
        'request_type',
        'message',
        'offered_book_details',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    
    public function transaction()
{
    return $this->hasOne(Transaction::class, 'request_id');
}

public function user()
{
    return $this->belongsTo(User::class, 'buyer_id');
}
}