@extends('admin.layouts.app')

@section('page-title', 'Ramadan Settings')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">🌙 Ramadan Settings</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.ramadan.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-section-box"
                style="background: #fff8e1; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #fbc02d;">

                <h4 style="margin: 0 0 15px; color: #f9a825; border-bottom: 2px solid #fdd835; padding-bottom: 10px;">
                    🏠 Home Page Section
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="ramadan_home_heading">Section Title</label>
                        <input type="text" id="ramadan_home_heading" name="ramadan_home_heading"
                            value="{{ $settings->where('key', 'ramadan_home_heading')->first()->value ?? 'Ramadan Special Offers' }}">
                    </div>
                    <div class="form-group">
                        <label for="ramadan_home_badge">Badge Text</label>
                        <input type="text" id="ramadan_home_badge" name="ramadan_home_badge"
                            value="{{ $settings->where('key', 'ramadan_home_badge')->first()->value ?? 'Coming Soon' }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="ramadan_home_food_title">Food Card Title</label>
                        <input type="text" id="ramadan_home_food_title" name="ramadan_home_food_title"
                            value="{{ $settings->where('key', 'ramadan_home_food_title')->first()->value ?? 'Exclusive Food Packages' }}">
                    </div>
                    <div class="form-group">
                        <label for="ramadan_home_decor_title">Decor Card Title</label>
                        <input type="text" id="ramadan_home_decor_title" name="ramadan_home_decor_title"
                            value="{{ $settings->where('key', 'ramadan_home_decor_title')->first()->value ?? 'Decor Discount Packages' }}">
                    </div>
                </div>

                <h4 style="margin: 30px 0 15px; color: #f9a825; border-bottom: 2px solid #fdd835; padding-bottom: 10px;">
                    🍲 Food Page Settings
                </h4>

                <div class="form-group">
                    <label for="ramadan_food_hero_bg">Food Page Hero Image</label>
                    <input type="file" id="ramadan_food_hero_bg" name="ramadan_food_hero_bg" accept="image/*">
                    @if($settings->where('key', 'ramadan_food_hero_bg')->first())
                        <img src="{{ asset('storage/' . $settings->where('key', 'ramadan_food_hero_bg')->first()->value) }}"
                            style="max-width: 200px; margin-top: 10px; border-radius: 8px;">
                    @endif
                </div>

                <div class="form-group">
                    <label style="font-size: 18px; font-weight: 600; margin-bottom: 15px; display: block;">
                        📋 Menu Images (Upload up to 30 menus)
                    </label>
                    <p style="color: #666; margin-bottom: 20px; font-size: 14px;">
                        Upload your Ramadan food menu images. They will be displayed in a grid layout (5 per row).
                        Recommended size: 800x1120px
                    </p>

                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
                        @for($i = 1; $i <= 30; $i++)
                            <div style="border: 2px dashed #ddd; border-radius: 8px; padding: 15px; background: #fafafa;">
                                <label for="ramadan_food_menu_{{ $i }}"
                                    style="font-weight: 600; color: #f9a825; margin-bottom: 8px; display: block;">
                                    Menu #{{ $i }}
                                </label>
                                <input type="file" id="ramadan_food_menu_{{ $i }}" name="ramadan_food_menu_{{ $i }}"
                                    accept="image/*" style="font-size: 12px; margin-bottom: 10px;">

                                <div class="form-group" style="margin-bottom: 10px;">
                                    <label style="font-size: 12px; margin-bottom: 5px; display: block;">Price (e.g. 485 Per
                                        Box)</label>
                                    <input type="text" name="ramadan_food_price_{{ $i }}"
                                        value="{{ $settings->where('key', 'ramadan_food_price_' . $i)->first()->value ?? '' }}"
                                        placeholder="Enter Price" style="font-size: 13px; padding: 5px 10px;">
                                </div>

                                @php
                                    $currentMenu = $settings->where('key', 'ramadan_food_menu_' . $i)->first();
                                @endphp

                                @if($currentMenu)
                                    <div style="margin-top: 10px;">
                                        <img src="{{ asset('storage/' . $currentMenu->value) }}"
                                            style="width: 100%; height: 150px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                    </div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>


                <h4 style="margin: 30px 0 15px; color: #f9a825; border-bottom: 2px solid #fdd835; padding-bottom: 10px;">
                    ✨ Decor Page Settings
                </h4>

                <div class="form-group">
                    <label for="ramadan_decor_hero_bg">Decor Page Hero Image</label>
                    <input type="file" id="ramadan_decor_hero_bg" name="ramadan_decor_hero_bg" accept="image/*">
                    @if($settings->where('key', 'ramadan_decor_hero_bg')->first())
                        <img src="{{ asset('storage/' . $settings->where('key', 'ramadan_decor_hero_bg')->first()->value) }}"
                            style="max-width: 200px; margin-top: 10px; border-radius: 8px;">
                    @endif
                </div>

                <div class="form-group">
                    <label for="ramadan_decor_menu">Decor Packages List (One item per line)</label>
                    <textarea id="ramadan_decor_menu" name="ramadan_decor_menu" rows="5"
                        placeholder="Arabic Lantern Setup || Coming Soon">{{ $settings->where('key', 'ramadan_decor_menu')->first()->value ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-actions" style="display: flex; gap: 10px; align-items: center;">
                <button type="submit" class="btn btn-primary">Save Ramadan Settings</button>
                <a href="{{ route('ramadan.food') }}" target="_blank" class="btn btn-secondary"
                    style="background: #6c757d; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; transition: 0.3s;">👁️
                    Preview Food Page</a>
                <a href="{{ route('ramadan.decor') }}" target="_blank" class="btn btn-secondary"
                    style="background: #6c757d; color: #fff; text-decoration: none; padding: 10px 20px; border-radius: 8px; font-weight: 600; font-size: 14px; transition: 0.3s;">🏠
                    Preview Decor Page</a>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .alert-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }
    </style>
@endpush