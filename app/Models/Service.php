<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'features',
        'button_text',
        'button_link',
        'is_active',
        'order'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];
}
