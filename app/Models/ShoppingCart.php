<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShoppingCart extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'idUser',
        'idProduct',
        'qty',
        'totalPrice',
    ];

    protected $dates = ['deleted_at'];
}
