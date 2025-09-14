<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'loaned_at',
        'return_date',
        'loan_date',
        'status',
    ];

    protected $dates = [
        'loan_date',
        'return_date',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'loan_date' => 'date',
        'return_date' => 'date',
        'status' => 'string',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function book() 
    {
        return $this->belongsTo(Book::class);
    }

}
