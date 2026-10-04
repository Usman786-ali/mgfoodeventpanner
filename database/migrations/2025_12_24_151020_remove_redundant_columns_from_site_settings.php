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
            $table->dropColumn([
                'hero_video',
                'ceo_image',
                'director_image',
                'team_photo',
                'venue_hall_image',
                'event_setup_image',
                'wedding_feature_video',
                'contact_form_email'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('hero_video')->nullable();
            $table->string('ceo_image')->nullable();
            $table->string('director_image')->nullable();
            $table->string('team_photo')->nullable();
            $table->string('venue_hall_image')->nullable();
            $table->string('event_setup_image')->nullable();
            $table->string('wedding_feature_video')->nullable();
            $table->string('contact_form_email')->nullable();
        });
    }
};
