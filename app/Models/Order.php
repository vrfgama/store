<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'total_price',
        'total_itens',
        'credit_card_id',
        'delivery_address_id'
    ];
}
