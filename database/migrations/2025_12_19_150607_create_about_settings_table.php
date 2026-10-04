<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            $table->string('vision_title')->nullable();
            $table->text('vision_description')->nullable();
            $table->text('vision_description2')->nullable();
            $table->string('mission_title')->nullable();
            $table->text('mission_text')->nullable();
            $table->string('value_title')->nullable();
            $table->text('value_text')->nullable();
            $table->string('stats_number')->nullable();
            $table->string('stats_label')->nullable();
            $table->string('vision_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_settings');
    }
};
