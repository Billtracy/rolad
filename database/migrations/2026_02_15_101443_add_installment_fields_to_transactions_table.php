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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('installment_plan_id')->nullable()->after('property_id')->constrained()->nullOnDelete();
            $table->foreignId('installment_id')->nullable()->after('installment_plan_id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['installment_plan_id']);
            $table->dropForeign(['installment_id']);
            $table->dropColumn(['installment_plan_id', 'installment_id']);
        });
    }
};
