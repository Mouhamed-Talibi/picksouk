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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Foreign key to products
            $table->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->string('product_name')
                ->nullable();

            // Client details
            $table->string('client_name');
            $table->string('client_address');
            $table->string('client_phone');

            // Order details
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);

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
