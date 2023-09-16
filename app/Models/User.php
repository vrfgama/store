<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    use SoftDeletes;


    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'birth', 
        'gender', 
        'fone', 
        'rg', 
        'cpf'
    ];


    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class);
    }

}
