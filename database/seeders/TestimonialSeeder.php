<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Adebayo Ogunleye',
                'client_title' => 'Homeowner',
                'content' => 'Rolad Properties made my dream of owning a home in Lagos a reality. Their transparency and professionalism throughout the process was second to none. I highly recommend them to anyone looking for genuine real estate in Nigeria.',
                'rating' => 5,
                'sort_order' => 1,
            ],
            [
                'client_name' => 'Chidinma Nwosu',
                'client_title' => 'Investor',
                'content' => 'I was skeptical about investing in real estate, but Rolad Properties walked me through every step. Their documentation process is seamless, and I was handed my C of O in record time. Truly a trustworthy company.',
                'rating' => 5,
                'sort_order' => 2,
            ],
            [
                'client_name' => 'Oluwaseun Bakare',
                'client_title' => 'Landowner',
                'content' => 'The speed and integrity of Rolad Properties is unmatched. I purchased two plots of land and the entire process from inspection to documentation took less than a month. They live up to their values of respect, integrity, and speed.',
                'rating' => 5,
                'sort_order' => 3,
            ],
            [
                'client_name' => 'Fatima Ibrahim',
                'client_title' => 'First-time Buyer',
                'content' => 'As a first-time buyer, I had so many questions and concerns. The Rolad team patiently guided me through everything. Their flexible payment plan made it possible for me to own property even on my salary. Thank you Rolad!',
                'rating' => 4,
                'sort_order' => 4,
            ],
            [
                'client_name' => 'Emeka Okonkwo',
                'client_title' => 'Property Developer',
                'content' => 'I have been in the real estate business for years and I can confidently say that Rolad Properties is one of the most reliable companies in Nigeria. Their properties are well-documented and located in prime areas.',
                'rating' => 5,
                'sort_order' => 5,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
