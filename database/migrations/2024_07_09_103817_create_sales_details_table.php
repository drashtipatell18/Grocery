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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_master_id'); // Foreign key column
            $table->unsignedBigInteger('product_id'); // Foreign key column
            $table->decimal('quantity',10,2)->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->decimal('discount',3,2)->nullable();
            $table->decimal('total_amount',3,2)->nullable();
            $table->foreign('sales_master_id')->references('id')->on('sales_masters')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
