<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $now = now();

        // Insert Types
        $types = [
            ['name' => 'Decor', 'icon' => '🎨', 'base_price' => 150000, 'is_active' => true, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Food',  'icon' => '🍽️', 'base_price' => 120000, 'is_active' => true, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Venue', 'icon' => '🏛️', 'base_price' => 200000, 'is_active' => true, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ];
        DB::table('estimator_types')->insert($types);

        $decorId = DB::table('estimator_types')->where('name', 'Decor')->value('id');
        $foodId  = DB::table('estimator_types')->where('name', 'Food')->value('id');
        $venueId = DB::table('estimator_types')->where('name', 'Venue')->value('id');

        // Packages
        DB::table('estimator_packages')->insert([
            // Decor
            ['estimator_type_id' => $decorId, 'name' => 'Basic Decor',   'description' => 'Standard stage, lighting, and seating',            'price' => 1200,   'per_head' => true,  'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $decorId, 'name' => 'Premium Decor', 'description' => 'Floral stage, imported lights, lounge seating',     'price' => 2500,   'per_head' => true,  'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $decorId, 'name' => 'Luxury Decor',  'description' => 'Royal theme, chandeliers, complete marquee decor',  'price' => 4000,   'per_head' => true,  'order' => 3, 'created_at' => $now, 'updated_at' => $now],
            // Food
            ['estimator_type_id' => $foodId,  'name' => 'Traditional Feast',      'description' => 'Standard Pakistani Menu (Qurma, Biryani, Naan, Sweet)',    'price' => 1500, 'per_head' => true,  'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $foodId,  'name' => 'Deewan-e-Khas Buffet',   'description' => 'Premium BBQ, Sajji, Karahi, Chinese & Mocktails',           'price' => 2800, 'per_head' => true,  'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $foodId,  'name' => 'Royal Shehnai Feast',    'description' => 'Luxury live cooking stations, international starters',       'price' => 4500, 'per_head' => true,  'order' => 3, 'created_at' => $now, 'updated_at' => $now],
            // Venue
            ['estimator_type_id' => $venueId, 'name' => 'Standard Marquee',   'description' => 'Capacity up to 300 guests, basic amenities',           'price' => 100000, 'per_head' => false, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $venueId, 'name' => 'Premium Banquet',    'description' => 'Capacity up to 600 guests, VIP lounges, valet',        'price' => 250000, 'per_head' => false, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $venueId, 'name' => 'Luxury Farmhouse',   'description' => 'Outdoor scenic view, poolside, capacity 1000+',        'price' => 500000, 'per_head' => false, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Add-ons
        DB::table('estimator_addons')->insert([
            // Decor
            ['estimator_type_id' => $decorId, 'name' => 'Stage & Backdrop Decor',        'price' => 80000, 'is_active' => true, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $decorId, 'name' => 'Premium Imported Floral Setup', 'price' => 60000, 'is_active' => true, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $decorId, 'name' => 'Professional Sound & DJ Setup', 'price' => 35000, 'is_active' => true, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $decorId, 'name' => 'Grand Entrance Royal Walkway',  'price' => 25000, 'is_active' => true, 'order' => 4, 'created_at' => $now, 'updated_at' => $now],
            // Food
            ['estimator_type_id' => $foodId,  'name' => 'Live BBQ Grill Station',    'price' => 50000, 'is_active' => true, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $foodId,  'name' => 'Dessert & Mithai Counter',  'price' => 25000, 'is_active' => true, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $foodId,  'name' => 'Mocktail & Drinks Corner',  'price' => 20000, 'is_active' => true, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $foodId,  'name' => 'Chaat & Gol Gappa Station', 'price' => 15000, 'is_active' => true, 'order' => 4, 'created_at' => $now, 'updated_at' => $now],
            // Venue
            ['estimator_type_id' => $venueId, 'name' => 'Bridal Room / VIP Lounge',       'price' => 15000, 'is_active' => true, 'order' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $venueId, 'name' => 'Valet Parking Service',           'price' => 30000, 'is_active' => true, 'order' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $venueId, 'name' => 'Generator Backup (Full Night)',   'price' => 35000, 'is_active' => true, 'order' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['estimator_type_id' => $venueId, 'name' => 'Extra AC / Cooling Units',        'price' => 40000, 'is_active' => true, 'order' => 4, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        DB::table('estimator_addons')->truncate();
        DB::table('estimator_packages')->truncate();
        DB::table('estimator_types')->truncate();
    }
};
