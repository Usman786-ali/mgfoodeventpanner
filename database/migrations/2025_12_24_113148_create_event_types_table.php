<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Insert default event types
        DB::table('event_types')->insert([
            ['name' => 'Wedding', 'is_active' => true, 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corporate Event', 'is_active' => true, 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Birthday Party', 'is_active' => true, 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Engagement', 'is_active' => true, 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Anniversary', 'is_active' => true, 'order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conference', 'is_active' => true, 'order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Product Launch', 'is_active' => true, 'order' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other', 'is_active' => true, 'order' => 8, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_types');
    }
};
