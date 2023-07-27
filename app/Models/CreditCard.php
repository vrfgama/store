<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CreditCard extends Model
{
    use HasFactory;

    protected $table= 'credit_cards';

    protected $fillable= [
        'number', 
        'expiration_date',
        'type',
        'cvv',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
