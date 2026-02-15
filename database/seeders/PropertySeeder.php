<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'title' => 'The OAK Farms',
                'slug' => 'the-oak-farms',
                'description' => 'Experience the tranquility of nature with The OAK Farms. Perfect for agricultural ventures or a serene getaway. Located swiftly along the Lagos-Ibadan Expressway.',
                'location' => 'Lagos-Ibadan Expressway',
                'price' => 5000000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Arable Land', 'Good Road Network', 'Secure Environment']),
                'images' => json_encode(['https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => true,
            ],
            [
                'title' => 'Rolad Heights',
                'slug' => 'rolad-heights',
                'description' => 'Rolad Heights offers premium luxury living in the heart of Ibeju-Lekki. Surrounded by major developments and providing high ROI.',
                'location' => 'Ibeju-Lekki, Lagos',
                'price' => 12000000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Perimeter Fencing', 'Gate House', 'Drainage System', 'Electricity']),
                'images' => json_encode(['https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => true,
            ],
            [
                'title' => 'Bloom Haven',
                'slug' => 'bloom-haven',
                'description' => 'Build your dream home in Bloom Haven. A serene environment perfect for raising a family, located in Mowe, Ogun State.',
                'location' => 'Mowe, Ogun State',
                'price' => 2500000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Dry Land', 'Documentation', 'Security']),
                'images' => json_encode(['https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => true,
            ],
            [
                'title' => 'Prestige City',
                'slug' => 'prestige-city',
                'description' => 'A smart city concept designed for the modern family. Features smart security, green energy, and recreational centers.',
                'location' => 'Epe, Lagos',
                'price' => 8000000.00,
                'type' => 'land',
                'status' => 'available',
                'features' => json_encode(['Smart Security', 'Recreational Center', 'Paved Roads']),
                'images' => json_encode(['https://images.unsplash.com/photo-1448630360428-65456885c650?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => false,
            ],
            [
                'title' => 'Coral Views',
                'slug' => 'coral-views',
                'description' => 'Luxury apartments with a sea view. Enjoy the breeze and the beautiful scenery of the Atlantic Ocean.',
                'location' => 'Victoria Island, Lagos',
                'price' => 85000000.00,
                'type' => 'apartment',
                'status' => 'available',
                'features' => json_encode(['Sea View', 'Swimming Pool', '24/7 Power', 'Gym']),
                'images' => json_encode(['https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80']),
                'is_featured' => false,
            ],
        ];

        foreach ($properties as $property) {
            Property::updateOrCreate(['slug' => $property['slug']], $property);
        }
    }
}
