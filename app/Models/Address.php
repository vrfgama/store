<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;

    use SoftDeletes;
    

    protected $table= 'addresses';

    protected $fillable= [
        'street', 
        'number', 
        'cep', 
        'district', 
        'city', 
        'state', 
        'country'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
