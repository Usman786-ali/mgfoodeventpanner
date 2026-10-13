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

        static::saving(function ($blog) {
            if (empty($blog->slug)) {
                $slug = Str::slug($blog->title);
                if (empty($slug)) {
                    $slug = 'post-' . time();
                }
                $originalSlug = $slug;
                $count = 1;

                while (static::where('slug', $slug)->where('id', '!=', $blog->id ?? 0)->exists()) {
                    $slug = $originalSlug . '-' . $count;
                    $count++;
                }

                $blog->slug = $slug;
            }
        });
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset('storage/' . $this->image);
        }
        return asset('images/Blog-Background.jpeg');
    }
}
