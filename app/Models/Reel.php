<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    protected $fillable = [
        'title',
        'platform',
        'embed_url',
        'video_path',
        'type',
        'thumbnail',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    /**
     * Convert any video URL (YouTube, Vimeo, Facebook, Instagram) to proper embed URL
     */
    public static function convertToEmbedUrl(string $url): string
    {
        $url = trim($url);

        // Already an embed URL
        if (
            str_contains($url, 'youtube.com/embed/') ||
            str_contains($url, 'player.vimeo.com') ||
            str_contains($url, 'facebook.com/plugins/video.php')
        ) {
            return $url;
        }

        // --- YouTube ---
        // YouTube watch URL: https://www.youtube.com/watch?v=VIDEO_ID
        if (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }
        // YouTube Shorts: https://youtube.com/shorts/VIDEO_ID
        if (preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }
        // youtu.be short URL
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // --- Facebook ---
        if (str_contains($url, 'facebook.com') || str_contains($url, 'fb.watch')) {
            // Strip query strings to get a clean video URL for the plugin
            $cleanUrl = explode('?', $url)[0];
            return 'https://www.facebook.com/plugins/video.php?href=' . urlencode($cleanUrl) . '&show_text=0&t=0&autoplay=1';
        }

        // --- Instagram ---
        if (str_contains($url, 'instagram.com/reel/') || str_contains($url, 'instagram.com/p/') || str_contains($url, 'instagram.com/reels/')) {
            $baseUrl = rtrim($url, '/');
            $baseUrl = explode('?', $baseUrl)[0];
            return $baseUrl . '/embed/';
        }

        return $url;
    }
}
