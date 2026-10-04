@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <div class="dashboard-grid">
        <!-- Stats Cards -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon" style="background: #D4A853;">📝</div>
                <div class="stat-info">
                    <h3>{{ $stats['total_blogs'] }}</h3>
                    <p>Total Blog Posts</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #4CAF50;">✅</div>
                <div class="stat-info">
                    <h3>{{ $stats['published_blogs'] }}</h3>
                    <p>Published Blogs</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #2196F3;">🖼️</div>
                <div class="stat-info">
                    <h3>{{ $stats['portfolio_items'] }}</h3>
                    <p>Portfolio Items</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #FF9800;">👁️</div>
                <div class="stat-info">
                    <h3>{{ $stats['total_blogs'] - $stats['published_blogs'] }}</h3>
                    <p>Draft Posts</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #fbbc05;">⭐</div>
                <div class="stat-info">
                    <h3>{{ $stats['total_reviews'] }}</h3>
                    <p>Google Reviews</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="actions-grid">
                <a href="{{ route('admin.blogs.create') }}" class="action-btn">
                    <span class="icon">➕</span>
                    <span>Create New Blog Post</span>
                </a>
                <a href="{{ route('admin.portfolio.create') }}" class="action-btn">
                    <span class="icon">🖼️</span>
                    <span>Add Portfolio Item</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="action-btn">
                    <span class="icon">⚙️</span>
                    <span>Manage Settings</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="action-btn">
                    <span class="icon">🌐</span>
                    <span>View Website</span>
                </a>
            </div>
        </div>

        <!-- Recent Blog Posts -->
        <div class="recent-posts">
            <h2>Recent Blog Posts</h2>
            <div class="posts-list">
                @forelse($stats['recent_blogs'] as $blog)
                    <div class="post-item">
                        <div class="post-info">
                            <h4>{{ $blog->title }}</h4>
                            <p class="post-meta">{{ $blog->category }} • {{ $blog->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="post-actions">
                            <span class="badge {{ $blog->is_published ? 'badge-success' : 'badge-draft' }}">
                                {{ $blog->is_published ? 'Published' : 'Draft' }}
                            </span>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn-edit">Edit</a>
                        </div>
                    </div>
                @empty
                    <p class="no-data">No blog posts yet. <a href="{{ route('admin.blogs.create') }}">Create your first post
                            →</a></p>
                @endforelse
            </div>
        </div>
    </div>
@endsection