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
        Schema::table('about_settings', function (Blueprint $table) {
            $table->string('decorate_title')->nullable();
            $table->text('decorate_text')->nullable();
            $table->string('food_title')->nullable();
            $table->text('food_text')->nullable();
            $table->string('venue_title')->nullable();
            $table->text('venue_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn(['decorate_title', 'decorate_text', 'food_title', 'food_text', 'venue_title', 'venue_text']);
        });
    }
};
