<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('property_id')->constrained();
            $table->decimal('amount', 15, 2);
            $table->string('reference')->unique();
            $table->string('status')->default('pending'); // pending, success, failed
            $table->string('payment_method')->default('card'); // card, transfer, wallet
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
