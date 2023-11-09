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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('slug')->unique();
            $table->foreignId('category_id');
            $table->string('name');
            $table->integer('price');
            $table->integer('stock')->default(0);
            $table->integer('size')->nullable();
            $table->text('fragrances');
            $table->float('weight');
            $table->string('box');
            $table->text('description');
            $table->text('images')->nullable();
            $table->float('rating')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
