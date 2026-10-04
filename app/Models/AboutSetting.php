<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'vision_title',
        'vision_description',
        'vision_description2',
        'mission_title',
        'mission_text',
        'value_title',
        'value_text',
        'stats_number',
        'stats_label',
        'vision_image',
        'decorate_title',
        'decorate_text',
        'food_title',
        'food_text',
        'venue_title',
        'venue_text'
    ];
}
