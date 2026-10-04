<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Event types for estimator (Decor, Food, Venue)
        Schema::create('estimator_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // e.g. Decor
            $table->string('icon')->nullable(); // emoji or icon class
            $table->integer('base_price')->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Packages per type (Basic, Premium, Luxury)
        Schema::create('estimator_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimator_type_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('price')->default(0);
            $table->boolean('per_head')->default(true); // per head or fixed
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Add-ons per type (4 per type)
        Schema::create('estimator_addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimator_type_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('price')->default(0);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estimator_addons');
        Schema::dropIfExists('estimator_packages');
        Schema::dropIfExists('estimator_types');
    }
};
