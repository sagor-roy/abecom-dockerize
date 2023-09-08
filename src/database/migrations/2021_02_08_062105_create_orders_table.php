<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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

            $table->integer('order_id');

            $table->foreignId('customer_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->foreignId('city_id');
            $table->foreignId('courier_id')->nullable();
            $table->string('country');
            $table->string('shipping_address');
            $table->double('customer_balance')->nullable();
            $table->string('note')->nullable();

            $table->string('amount');

            $table->double('shipping_charge');

            $table->boolean('discount_status')->default(false);
            $table->string('amount_after_discount')->nullable();
            $table->foreignId('coupon_id')->nullable();

            $table->boolean('is_verified')->default(false);

            $table->enum('paid_by', ['Cash', 'Online', 'Bank']);
            $table->json('payment_initiation_server_response')->nullable();
            $table->json('payment_validation_server_response')->nullable();
            $table->enum('order_status', ['Pending', 'OnProcess','Shipped', 'Delivered', 'Cancelled'])->default('Pending');
            $table->enum('payment_status', ['Pending', 'Success'])->default('Pending');

            $table->enum("delivery_type",["Home","Local"]);
            $table->unsignedBigInteger("pickup_id")->nullable();

            $table->boolean('is_delivered')->default(false);
            $table->boolean('is_active')->default(true);

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
}
