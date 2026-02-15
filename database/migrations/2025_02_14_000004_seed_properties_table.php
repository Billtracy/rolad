<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('properties')->insert([
            [
                'title' => 'The OAK Farms',
                'slug' => 'the-oak-farms',
                'description' => 'The OAK Farms is more than just land; it\'s a wealth-creation vehicle.',
                'location' => 'Lagos-Ibadan Expressway',
                'price' => 5000000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Dry Land', 'C of O', 'Instant Allocation']),
                'images' => json_encode(['https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Rolad Heights',
                'slug' => 'rolad-heights',
                'description' => 'Rolad Heights offers a perfect blend of nature and modern living.',
                'location' => 'Ibeju-Lekki, Lagos',
                'price' => 12000000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Gated Community', 'Security', 'Electricity']),
                'images' => json_encode(['https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Bloom Haven',
                'slug' => 'bloom-haven',
                'description' => 'Bloom Haven is located in the heart of Mowe, offering serenity and class.',
                'location' => 'Mowe, Ogun State',
                'price' => 2500000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Perimeter Fencing', 'Good Roads']),
                'images' => json_encode(['https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        // No down needed as this is a seed migration
    }
};
