<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $clients = App\Models\Client::where('is_active', true)
        ->orderBy('order')
        ->get();

    $portfolioItems = App\Models\PortfolioItem::active()
        ->ordered()
        ->limit(3)
        ->get();

    $reviews = App\Models\GoogleReview::active()
        ->ordered()
        ->get();

    $reels = App\Models\Reel::active()->ordered()->get();

    $siteSettings = App\Models\SiteSetting::all()->pluck('value', 'key')->toArray();

    $estimatorTypes = App\Models\EstimatorType::where('is_active', true)
        ->orderBy('order')
        ->with(['packages' => fn($q) => $q->orderBy('order'),
                'addons'   => fn($q) => $q->where('is_active', true)->orderBy('order')])
        ->get();

    // Pre-build JS data arrays to avoid complex expressions inside @json() in Blade
    $packageTitles = ['Decor' => '3. Select Decor Package', 'Food' => '3. Catering & Menu Option'];
    $addonTitles   = ['Decor' => '4. Add-on Premium Decor & Services', 'Food' => '4. Add-on Food & Beverage Extras'];

    $packagesData = $estimatorTypes->mapWithKeys(function ($t) use ($packageTitles) {
        return [
            $t->name => [
                'title'   => $packageTitles[$t->name] ?? '3. Select Package',
                'options' => $t->packages->map(function ($p) {
                    $valMap = [1 => 'basic', 2 => 'premium', 3 => 'luxury'];
                    return [
                        'val'     => $valMap[$p->order] ?? 'basic',
                        'name'    => $p->name,
                        'desc'    => $p->description,
                        'price'   => $p->price,
                        'perHead' => (bool) $p->per_head,
                    ];
                })->values(),
            ],
        ];
    });

    $addonsData = $estimatorTypes->mapWithKeys(function ($t) use ($addonTitles) {
        $firstId = $t->addons->first() ? $t->addons->first()->id : null;
        return [
            $t->name => [
                'title' => $addonTitles[$t->name] ?? '4. Add-on Services',
                'items' => $t->addons->map(function ($a, $i) use ($firstId, $t) {
                    return [
                        'id'      => 'addon-' . $a->id,
                        'name'    => $a->name,
                        'price'   => $a->price,
                        'checked' => $i === 0 && $a->id === $firstId && $t->name === 'Decor',
                    ];
                })->values(),
            ],
        ];
    });

    return view('home', compact('clients', 'portfolioItems', 'siteSettings', 'reviews', 'reels', 'estimatorTypes', 'packagesData', 'addonsData'));
})->name('home');

Route::get('/portfolio', function () {
    $portfolioItems = App\Models\PortfolioItem::active()
        ->ordered()
        ->get();
    return view('portfolio', compact('portfolioItems'));
})->name('portfolio');

Route::get('/services', function () {
    $services = App\Models\Service::where('is_active', true)
        ->orderBy('order')
        ->get();
    return view('services', compact('services'));
})->name('services');

Route::get('/about', function () {
    $teamMembers = App\Models\TeamMember::where('is_active', true)
        ->orderBy('order')
        ->get();
    $aboutSettings = App\Models\AboutSetting::first();
    return view('about', compact('teamMembers', 'aboutSettings'));
})->name('about');

Route::get('/ramadan/food', function () {
    return view('ramadan-food');
})->name('ramadan.food');

Route::get('/ramadan/decor', function () {
    return view('ramadan-decor');
})->name('ramadan.decor');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');

// Test route - remove after testing
Route::get('/test-event-types', function () {
    return view('test-event-types');
});

Route::get('/reels', function () {
    $reels = App\Models\Reel::active()->ordered()->get();
    return view('reels', compact('reels'));
})->name('reels');

Route::get('/blog', function () {
    $blogs = App\Models\Blog::where('is_published', true)
        ->orderBy('created_at', 'desc')
        ->paginate(9);

    $featuredBlog = App\Models\Blog::where('is_published', true)
        ->where('is_featured', true)
        ->latest()
        ->first();

    return view('blog', compact('blogs', 'featuredBlog'));
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    $blog = App\Models\Blog::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    return view('blog-detail', compact('blog'));
})->name('blog.show');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (login)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login']);
    });

    // Protected routes (requires authentication)
    Route::middleware(App\Http\Middleware\AdminMiddleware::class)->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        // Blog Management
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);

        // Portfolio Management
        Route::resource('portfolio', App\Http\Controllers\Admin\PortfolioController::class);

        // Clients Management
        Route::resource('clients', App\Http\Controllers\Admin\ClientController::class);

        // Profile Management
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        // Services Management
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);

        // About Page Management
        Route::get('/about', [App\Http\Controllers\Admin\AboutController::class, 'index'])->name('about.index');
        Route::post('/about', [App\Http\Controllers\Admin\AboutController::class, 'update'])->name('about.update');

        // Team Members Management
        Route::resource('team', App\Http\Controllers\Admin\TeamMemberController::class);

        // Contact Form Management (includes Event Types)
        Route::prefix('contact-form')->name('contact-form.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\ContactFormController::class, 'index'])->name('index');
            Route::get('/{submission}', [App\Http\Controllers\Admin\ContactFormController::class, 'show'])->name('show');
            Route::delete('/{submission}', [App\Http\Controllers\Admin\ContactFormController::class, 'destroy'])->name('destroy');

            // Event Types sub-section
            Route::get('/event-types/manage', [App\Http\Controllers\Admin\ContactFormController::class, 'eventTypes'])->name('event-types');
            Route::post('/event-types', [App\Http\Controllers\Admin\ContactFormController::class, 'storeEventType'])->name('event-types.store');
            Route::put('/event-types/{eventType}', [App\Http\Controllers\Admin\ContactFormController::class, 'updateEventType'])->name('event-types.update');
            Route::delete('/event-types/{eventType}', [App\Http\Controllers\Admin\ContactFormController::class, 'destroyEventType'])->name('event-types.destroy');

            // Email update route
            Route::post('/update-email', [App\Http\Controllers\Admin\ContactFormController::class, 'updateEmail'])->name('update-email');

            // SMTP update route
            Route::post('/update-smtp', [App\Http\Controllers\Admin\ContactFormController::class, 'updateSmtp'])->name('update-smtp');
        });

        // Settings Management
        Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('settings.update');

        // Ramadan Settings
        Route::get('/ramadan', [App\Http\Controllers\Admin\RamadanController::class, 'index'])->name('ramadan.index');
        Route::put('/ramadan', [App\Http\Controllers\Admin\RamadanController::class, 'update'])->name('ramadan.update');

        // Reels Management
        Route::resource('reels', App\Http\Controllers\Admin\ReelController::class);

        // Google Reviews Management
        Route::resource('reviews', App\Http\Controllers\Admin\GoogleReviewController::class);

        // Cost Estimator Management
        Route::prefix('estimator')->name('estimator.')->group(function () {
            Route::get('/', [App\Http\Controllers\Admin\EstimatorController::class, 'index'])->name('index');

            // Types
            Route::get('/type/create',              [App\Http\Controllers\Admin\EstimatorController::class, 'createType'])->name('type.create');
            Route::post('/type',                    [App\Http\Controllers\Admin\EstimatorController::class, 'storeType'])->name('type.store');
            Route::get('/type/{type}/edit',         [App\Http\Controllers\Admin\EstimatorController::class, 'editType'])->name('type.edit');
            Route::put('/type/{type}',              [App\Http\Controllers\Admin\EstimatorController::class, 'updateType'])->name('type.update');
            Route::delete('/type/{type}',           [App\Http\Controllers\Admin\EstimatorController::class, 'destroyType'])->name('type.destroy');

            // Packages
            Route::get('/type/{type}/packages',                      [App\Http\Controllers\Admin\EstimatorController::class, 'packagesIndex'])->name('packages');
            Route::post('/type/{type}/packages',                     [App\Http\Controllers\Admin\EstimatorController::class, 'storePackage'])->name('package.store');
            Route::put('/type/{type}/packages/{package}',            [App\Http\Controllers\Admin\EstimatorController::class, 'updatePackage'])->name('package.update');
            Route::delete('/type/{type}/packages/{package}',         [App\Http\Controllers\Admin\EstimatorController::class, 'destroyPackage'])->name('package.destroy');

            // Add-ons
            Route::get('/type/{type}/addons',                        [App\Http\Controllers\Admin\EstimatorController::class, 'addonsIndex'])->name('addons');
            Route::post('/type/{type}/addons',                       [App\Http\Controllers\Admin\EstimatorController::class, 'storeAddon'])->name('addon.store');
            Route::put('/type/{type}/addons/{addon}',                [App\Http\Controllers\Admin\EstimatorController::class, 'updateAddon'])->name('addon.update');
            Route::delete('/type/{type}/addons/{addon}',             [App\Http\Controllers\Admin\EstimatorController::class, 'destroyAddon'])->name('addon.destroy');
        });
    });
});

