<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\PortfolioItem;
use App\Models\SiteSetting;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::where('is_published', true)->count(),
            'portfolio_items' => PortfolioItem::count(),
            'total_reviews' => \App\Models\GoogleReview::count(),
            'recent_blogs' => Blog::latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
