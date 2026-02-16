<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How do I buy a property from Rolad Properties?',
                'answer' => 'Buying a property with Rolad is simple. Browse our available properties, select a property you like, schedule an inspection, and once satisfied, make your payment (full or installment). We handle all documentation including the Certificate of Occupancy (C of O), Deed of Assignment, and Survey Plan.',
                'category' => 'Buying',
                'sort_order' => 1,
            ],
            [
                'question' => 'Do you offer installment payment plans?',
                'answer' => 'Yes! We understand that not everyone can make a one-time payment. Rolad Properties offers flexible installment payment plans that allow you to spread your payment over 3 to 12 months. Contact us to discuss a plan that works for your budget.',
                'category' => 'Payment',
                'sort_order' => 2,
            ],
            [
                'question' => 'What documents will I receive after purchase?',
                'answer' => 'After completing your payment, you will receive the following documents: Deed of Assignment, Survey Plan, Certificate of Occupancy (C of O) or Governor\'s Consent (where applicable), Receipt of Purchase, and a Contract of Sale.',
                'category' => 'Documentation',
                'sort_order' => 3,
            ],
            [
                'question' => 'Are your properties government-approved?',
                'answer' => 'Absolutely. All Rolad Properties estates are located in government-approved areas with proper documentation. We ensure that every property we sell has a valid title and is free from government acquisition or any encumbrances.',
                'category' => 'Legal',
                'sort_order' => 4,
            ],
            [
                'question' => 'Can I inspect the property before purchasing?',
                'answer' => 'Yes, we strongly encourage property inspections. You can schedule a free inspection by contacting us via phone at 08039619391 or through our website. Our team will arrange a convenient time to take you to the site.',
                'category' => 'Buying',
                'sort_order' => 5,
            ],
            [
                'question' => 'Where are your properties located?',
                'answer' => 'Rolad Properties has estates across prime locations in Lagos and other major cities in Nigeria. Our properties are strategically located in areas with high appreciation value, good road networks, and proximity to essential amenities.',
                'category' => 'Location',
                'sort_order' => 6,
            ],
            [
                'question' => 'How can I become a Rolad Properties affiliate/agent?',
                'answer' => 'Becoming a Rolad affiliate is easy! Simply register on our platform, and you will receive a unique referral link. You earn commissions for every successful referral that leads to a property purchase. Contact us for more details on commission structures.',
                'category' => 'Affiliate',
                'sort_order' => 7,
            ],
            [
                'question' => 'What happens if I default on my installment payments?',
                'answer' => 'We understand that financial situations can change. If you are unable to continue your installment payments, please contact us immediately. We will work with you to find a resolution, which may include restructuring your payment plan or other arrangements.',
                'category' => 'Payment',
                'sort_order' => 8,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
