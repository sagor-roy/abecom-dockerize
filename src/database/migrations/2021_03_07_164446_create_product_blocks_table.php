<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->unique();
            $table->string('color');
            $table->integer('per_category');
            $table->integer('per_brand');
            $table->integer('per_product');

            $table->string('block_thumbnail')->nullable();
            $table->foreignId('product_id')->nullable();

            $table->string('small_image')->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('product_blocks');
    }
}
