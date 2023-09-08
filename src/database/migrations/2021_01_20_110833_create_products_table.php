<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('category_id');
            $table->string('sub_category_id');

            $table->string('brand_id');
            $table->string('name')->unique();
            $table->string('slug');

            $table->string('thumbnail');
            $table->string('qty')->nullable();

            $table->double('price');
            $table->double('offer_price')->nullable();

            $table->foreignId('delivery_charge_id');

            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('specification')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_onsale')->default(false);
            $table->boolean('is_top_rated')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('offer_status')->default(false);

            $table->foreignId('offer_id')->nullable();

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
}
