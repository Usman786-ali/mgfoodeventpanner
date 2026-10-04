<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            // Hero Section Media
            $table->string('hero_video')->nullable();

            // Board Members Images
            $table->string('ceo_image')->nullable();
            $table->string('director_image')->nullable();

            // About Section Images
            $table->string('team_photo')->nullable();
            $table->string('venue_hall_image')->nullable();
            $table->string('event_setup_image')->nullable();

            // Wedding Feature Video
            $table->string('wedding_feature_video')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_video',
                'ceo_image',
                'director_image',
                'team_photo',
                'venue_hall_image',
                'event_setup_image',
                'wedding_feature_video'
            ]);
        });
    }
};
