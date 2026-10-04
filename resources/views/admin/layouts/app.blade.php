<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @yield('styles')
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="admin-brand"
                style="padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.1);">
                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                    <div>
                        <h2
                            style="margin:0; font-size: 1.6rem; line-height: 1.1; color: #D4A853; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                            MG Food & <br> Event Planners
                        </h2>
                        <p
                            style="margin:5px 0 0; font-size: 0.75rem; opacity: 0.6; letter-spacing: 3px; font-weight: 600; color: #fff;">
                            ADMIN PANEL</p>
                    </div>
                    <div class="admin-user-menu">
                        <button class="dots-btn" id="userMenuBtn"
                            style="color: #D4A853; font-size: 28px; background:none; border:none; cursor:pointer; padding: 5px; opacity: 0.8; transition: 0.3s;">⋮</button>
                        <div class="user-dropdown" id="userDropdown" style="left: auto; right: 0; margin-top: 10px;">
                            <a href="{{ route('admin.profile.index') }}">👤 Profile Settings</a>
                            <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit"
                                    style="width: 100%; text-align: left; background: none; border: none; color: #ff6b6b; cursor: pointer; padding: 10px 15px; font-size: 14px; display: block;">🚪
                                    Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <span class="icon">📊</span>
                    Dashboard
                </a>
                <a href="{{ route('admin.blogs.index') }}"
                    class="nav-item {{ Request::is('admin/blogs*') ? 'active' : '' }}">
                    <span class="icon">📝</span>
                    Blog Posts
                </a>
                <a href="{{ route('admin.portfolio.index') }}"
                    class="nav-item {{ Request::is('admin/portfolio*') ? 'active' : '' }}">
                    <span class="icon">🖼️</span>
                    Portfolio
                </a>
                <a href="{{ route('admin.clients.index') }}"
                    class="nav-item {{ Request::is('admin/clients*') ? 'active' : '' }}">
                    <span class="icon">👥</span>
                    Client Logos
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="nav-item {{ Request::is('admin/services*') ? 'active' : '' }}">
                    <span class="icon">🏢</span>
                    Venues
                </a>
                <a href="{{ route('admin.about.index') }}"
                    class="nav-item {{ Request::is('admin/about*') ? 'active' : '' }}">
                    <span class="icon">ℹ️</span>
                    About Page
                </a>
                <a href="{{ route('admin.team.index') }}"
                    class="nav-item {{ Request::is('admin/team*') ? 'active' : '' }}">
                    <span class="icon">👥</span>
                    Team Members
                </a>
                <a href="{{ route('admin.contact-form.index') }}"
                    class="nav-item {{ Request::is('admin/contact-form*') ? 'active' : '' }}">
                    <span class="icon">📧</span>
                    Contact Form
                </a>
                <a href="{{ route('admin.ramadan.index') }}"
                    class="nav-item {{ request()->routeIs('admin.ramadan.*') ? 'active' : '' }}">
                    <span class="icon">🌙</span>
                    Ramadan Settings
                </a>
                <a href="{{ route('admin.reels.index') }}"
                    class="nav-item {{ request()->routeIs('admin.reels.*') ? 'active' : '' }}">
                    <span class="icon">🎬</span>
                    Reels / Videos
                </a>
                <a href="{{ route('admin.settings.index') }}"
                    class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Site Settings
                </a>
                <a href="{{ route('admin.estimator.index') }}"
                    class="nav-item {{ request()->routeIs('admin.estimator.*') ? 'active' : '' }}">
                    <span class="icon">🧮</span>
                    Cost Estimator
                </a>
                <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.05);">
                    <a href="{{ route('home') }}" target="_blank" class="nav-item" style="color: #3498db;">
                        <span class="icon">🌐</span>
                        Visit Website
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="topbar">
                <h1>@yield('page-title', 'Dashboard')</h1>
                <div class="topbar-actions">
                    <span class="user-info">Welcome, {{ Auth::guard('admin')->user()->name }}</span>
                </div>
            </div>

            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-scripts.js') }}"></script>
    @yield('scripts')
    <style>
        .admin-user-menu {
            position: relative;
        }

        .dots-btn {
            background: none;
            border: none;
            color: #d4a853;
            font-size: 24px;
            cursor: pointer;
            padding: 5px 10px;
            line-height: 1;
            transition: 0.3s;
        }

        .dots-btn:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .user-dropdown {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            background: #2c2c34;
            min-width: 160px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            z-index: 1000;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        .user-dropdown.show {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-dropdown a {
            display: block;
            padding: 10px 15px;
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .user-dropdown a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #d4a853;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dotsBtn = document.getElementById('userMenuBtn');
            const dropdown = document.getElementById('userDropdown');

            if (dotsBtn) {
                dotsBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    dropdown.classList.toggle('show');
                });
            }

            document.addEventListener('click', function () {
                if (dropdown) dropdown.classList.remove('show');
            });
        });
    </script>
</body>

</html>