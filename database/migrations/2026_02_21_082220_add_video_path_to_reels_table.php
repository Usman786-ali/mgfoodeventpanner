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
        Schema::table('reels', function (Blueprint $table) {
            $table->string('video_path')->nullable()->after('embed_url');
            $table->string('type')->default('link')->after('video_path'); // 'link' or 'file'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reels', function (Blueprint $table) {
            $table->dropColumn(['video_path', 'type']);
        });
    }
};
