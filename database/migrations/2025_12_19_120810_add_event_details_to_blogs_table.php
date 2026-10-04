<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->date('event_date')->nullable()->after('category');
            $table->string('venue')->nullable()->after('event_date');
            $table->boolean('has_food')->default(false)->after('venue');
            $table->boolean('has_decor')->default(false)->after('has_food');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['event_date', 'venue', 'has_food', 'has_decor']);
        });
    }
};
