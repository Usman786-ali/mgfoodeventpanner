<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'gallery_images',
        'category',
        'client_name',
        'event_date',
        'venue',
        'has_food',
        'has_decor',
        'is_published',
        'is_featured',
        'order'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'has_food' => 'boolean',
        'has_decor' => 'boolean',
        'event_date' => 'date',
        'gallery_images' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $slug = Str::slug($blog->title);
                $originalSlug = $slug;
                $count = 1;

                // Check if slug exists and make it unique
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $blog->slug = $slug;
            }
        });
    }
}
