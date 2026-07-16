<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'request_id',
        'book_id',
        'buyer_id',
        'seller_id',
        'transaction_type',
        'agreed_price',
        'exchange_book_details',
        'buyer_confirmed',
        'seller_confirmed',
        'status',
        'completed_at',
    ];

    public function request()
    {
        return $this->belongsTo(BookRequest::class, 'request_id');
    }

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

    public function meetup()
{
    return $this->hasOne(Meetup::class);
}
}