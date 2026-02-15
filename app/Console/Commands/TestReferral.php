<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestReferral extends Command
{
    protected $signature = 'test:referral';
    protected $description = 'Test the referral system logic';

    public function handle()
    {
        $this->info('Starting Referral Test...');

        // Cleanup
        \App\Models\User::where('email', 'agent1@example.com')->delete();
        \App\Models\User::where('email', 'client2@example.com')->delete();

        // 1. Create Agent
        $agent = \App\Models\User::create([
            'name' => 'Agent One',
            'email' => 'agent1@example.com',
            'password' => bcrypt('password'),
            'role' => 'affiliate',
            'phone' => '1234567890',
            'referral_code' => 'RFTEST01',
            'is_active' => true,
        ]);

        // Create Wallet & Profile
        $agent->wallet()->create(['balance' => 0]);
        $agent->profile()->create(['address' => 'Test Address']);

        $this->info("Agent created: {$agent->name} ({$agent->referral_code})");

        // 2. Register Client with Agent's code
        $referrer = \App\Models\User::where('referral_code', 'RFTEST01')->first();

        $client = \App\Models\User::create([
            'name' => 'Client Two',
            'email' => 'client2@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
            'phone' => '0987654321',
            'referrer_id' => $referrer ? $referrer->id : null,
            'referral_code' => 'RFTEST02',
        ]);

        // Create Client Wallet & Profile
        $client->wallet()->create(['balance' => 0]);
        $client->profile()->create([]);

        // Create Referral Record
        if ($referrer) {
            \App\Models\Referral::create([
                'referrer_id' => $referrer->id,
                'user_id' => $client->id,
                'type' => 'client',
            ]);
            $this->info("Referral record created.");
        }

        // 3. Verify Link
        $client->refresh();
        if ($client->referrer_id === $agent->id) {
            $this->info("SUCCESS: Client is linked to Agent.");
        } else {
            $this->error("FAILURE: Client is NOT linked to Agent.");
        }

        $referralRecord = \App\Models\Referral::where('referrer_id', $agent->id)->where('user_id', $client->id)->first();
        if ($referralRecord) {
            $this->info("SUCCESS: Referral record exists.");
        } else {
             $this->error("FAILURE: Referral record missing.");
        }

        // 4. Test community count
        $count = $agent->referrals()->count();
        $this->info("Agent Referral Count: {$count}");
    }
}
