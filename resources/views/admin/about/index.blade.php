@extends('admin.layouts.app')

@section('page-title', 'About Page Management')

@section('content')
    <div class="form-card">
        <h2 style="margin-bottom: 30px; font-size: 24px; font-weight: 700;">Edit About Page Content</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger"
                style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <ul style="margin: 0;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- VISION SECTION BOX -->
            <div class="admin-section-box"
                style="background: #f8f9fa; padding: 25px; border-radius: 12px; margin-bottom: 30px; border-left: 4px solid #2c3e50;">
                <h3 style="margin: 0 0 25px; color: #2c3e50; font-size: 20px;">
                    📋 Our Vision Section
                </h3>

                <div class="form-group">
                    <label for="vision_title">Vision Title</label>
                    <input type="text" id="vision_title" name="vision_title"
                        value="{{ old('vision_title', $aboutSettings->vision_title ?? 'Our Vision for Pakistan\'s Events') }}">
                </div>

                <div class="form-group">
                    <label for="vision_description">Vision Description (Paragraph 1)</label>
                    <textarea id="vision_description" name="vision_description"
                        rows="4">{{ old('vision_description', $aboutSettings->vision_description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="vision_description2">Vision Description (Paragraph 2)</label>
                    <textarea id="vision_description2" name="vision_description2"
                        rows="4">{{ old('vision_description2', $aboutSettings->vision_description2 ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="vision_image">Vision Image</label>
                    @if($aboutSettings && $aboutSettings->vision_image)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ asset('storage/' . $aboutSettings->vision_image) }}" alt="Current"
                                style="max-width: 200px; border-radius: 8px;">
                        </div>
                    @endif
                    <input type="file" id="vision_image" name="vision_image" accept="image/*">
                    <small style="color: #666;">Image shown next to the vision text</small>
                </div>

                <h4 style="margin: 25px 0 15px; color: #555; border-top: 1px solid #ddd; padding-top: 20px;">
                    Our Focus Cards (Decorate, Food, Venue)
                </h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="decorate_title">Decorate Title</label>
                        <input type="text" id="decorate_title" name="decorate_title"
                            value="{{ old('decorate_title', $aboutSettings->decorate_title ?? 'Our Decorate') }}">
                    </div>
                    <div class="form-group">
                        <label for="food_title">Food Title</label>
                        <input type="text" id="food_title" name="food_title"
                            value="{{ old('food_title', $aboutSettings->food_title ?? 'Our Food') }}">
                    </div>
                    <div class="form-group">
                        <label for="venue_title">Venue Title</label>
                        <input type="text" id="venue_title" name="venue_title"
                            value="{{ old('venue_title', $aboutSettings->venue_title ?? 'Our Venue') }}">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="decorate_text">Decorate Text</label>
                        <textarea id="decorate_text" name="decorate_text"
                            rows="3">{{ old('decorate_text', $aboutSettings->decorate_text ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="food_text">Food Text</label>
                        <textarea id="food_text" name="food_text"
                            rows="3">{{ old('food_text', $aboutSettings->food_text ?? '') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="venue_text">Venue Text</label>
                        <textarea id="venue_text" name="venue_text"
                            rows="3">{{ old('venue_text', $aboutSettings->venue_text ?? '') }}</textarea>
                    </div>
                </div>

                <h4 style="margin: 25px 0 15px; color: #555; border-top: 1px solid #ddd; padding-top: 20px;">Stats Box</h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label for="stats_number">Stats Number</label>
                        <input type="text" id="stats_number" name="stats_number"
                            value="{{ old('stats_number', $aboutSettings->stats_number ?? '500+') }}"
                            placeholder="e.g., 500+">
                    </div>
                    <div class="form-group">
                        <label for="stats_label">Stats Label</label>
                        <input type="text" id="stats_label" name="stats_label"
                            value="{{ old('stats_label', $aboutSettings->stats_label ?? 'Successful Weddings Managed') }}">
                    </div>
                </div>
            </div>



            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save All Changes</button>
                <a href="{{ route('about') }}" target="_blank" class="btn btn-secondary">Preview Page</a>
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