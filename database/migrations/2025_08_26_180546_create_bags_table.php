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
        Schema::create('bags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
                    ->constrained('products')
                    ->onDelete('cascade')
                    ->comment('Reference to the main products table');
            
            $table->string('brand', 100)->index()->comment('Brand/manufacturer name');
            $table->decimal('weight', 8, 2)->comment('Weight in kilograms');
            $table->string('external_material', 50)->comment('Primary material used');
            $table->string('color', 30)->nullable()->comment('Bag color');
            $table->string('size', 100)->nullable()->comment('Dimensions or size category');
            
            $table->timestamps();
            $table->softDeletes()->comment('Soft delete support');
            
            // Indexes for better performance
            $table->index(['brand', 'external_material']);
            $table->index(['weight', 'size']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bags');
    }
};
