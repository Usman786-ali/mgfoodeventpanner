<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->string('why_badge')->nullable();
            $table->string('why_title')->nullable();
            $table->string('card1_title')->nullable();
            $table->text('card1_text')->nullable();
            $table->string('card2_title')->nullable();
            $table->text('card2_text')->nullable();
            $table->string('card3_title')->nullable();
            $table->text('card3_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('about_settings', function (Blueprint $table) {
            $table->dropColumn(['why_badge', 'why_title', 'card1_title', 'card1_text', 'card2_title', 'card2_text', 'card3_title', 'card3_text']);
        });
    }
};
