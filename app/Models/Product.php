<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $fillable = [
        'category',
        'productName',
        'description',
        'price',
        'photo',
    ];

    protected $casts = [
        'photoPreview' => 'json',
        'photoProgress' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
