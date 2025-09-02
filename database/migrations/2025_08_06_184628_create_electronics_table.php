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
        Schema::create('electronics', function (Blueprint $table) {
            $table->id();
            
            // Hardware specifications
            $table->unsignedSmallInteger('ram')->comment('RAM in GB');
            $table->unsignedSmallInteger('storage')->comment('Storage in GB');
            $table->string('processor', 50);
            $table->string('camera', 100)->nullable();
            
            // Physical attributes
            $table->decimal('weight', 5, 2)->comment('Weight in kilograms');
            $table->decimal('screen_size', 4, 1)->comment('Screen size in inches');
            
            // Brand and software
            $table->string('brand', 50)->comment('Manufacturer brand');
            $table->string('operating_system', 50);
            
            // Foreign key relationship to products table
            $table->foreignId('product_id')
                    ->constrained()
                    ->cascadeOnDelete();

            // Indexes for frequently queried columns
            $table->index(['brand', 'ram']);
            $table->index(['storage', 'operating_system']);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electronics');
    }
};
