<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip_code')->nullable();

            // Financials
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2)->default(3.00);
            $table->decimal('tax', 10, 2)->default(2.00);
            $table->decimal('total', 10, 2);

            // Payment
            $table->enum('payment_method', ['card', 'cod'])->default('cod');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('card_last4')->nullable(); // Only store last 4 digits

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
