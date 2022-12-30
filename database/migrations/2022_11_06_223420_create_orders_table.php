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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['pending', 'cancelled', 'processing', 'shipped', 'completed'])->default('pending');
            $table->enum('payment_status', ['unpaid', 'paid', 'refund', 'cancelled', 'failed']);
            $table->unsignedFloat('shipping')->default(0);
            $table->unsignedFloat('discount')->default(0);
            $table->unsignedFloat('tax')->default(0);
            $table->unsignedFloat('total')->default(0);
            $table->string('billing_name');
            $table->string('billing_country_name');
            $table->string('billing_company_name')->nullable();
            $table->string('billing_address');
            $table->string('billing_apartment_name')->nullable();
            $table->string('billing_city');
            $table->string('billing_state');
            $table->unsignedInteger('billing_postcode');
            $table->string('billing_email');
            $table->string('billing_phone_number');
            $table->text('note')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_country_name')->nullable();
            $table->string('shipping_company_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_apartment_name')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->unsignedInteger('shipping_postcode')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone_number')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
