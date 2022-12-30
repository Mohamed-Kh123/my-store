<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->enum('dimension', ['40x60cm','60x90cm','80x120cm'])->nullable();
            $table->enum('status', ['active', 'draft']);
            $table->string('discount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
