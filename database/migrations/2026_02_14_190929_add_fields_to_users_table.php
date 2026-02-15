<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('referral_code')->unique()->nullable()->after('email');
            $table->boolean('is_active')->default(true)->after('role');
            $table->foreignId('rank_id')->nullable()->constrained()->nullOnDelete()->after('is_active');
            $table->foreignId('referrer_id')->nullable()->constrained('users')->nullOnDelete()->after('rank_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['rank_id']);
            $table->dropForeign(['referrer_id']);
            $table->dropColumn(['referral_code', 'is_active', 'rank_id', 'referrer_id']);
        });
    }
};
