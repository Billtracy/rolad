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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('payment_reference')->nullable()->after('status');
            $table->string('payment_status')->default('pending')->after('payment_reference'); // pending, paid, failed
            $table->decimal('amount_paid', 15, 2)->default(0)->after('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['payment_reference', 'payment_status', 'amount_paid']);
        });
    }
};
