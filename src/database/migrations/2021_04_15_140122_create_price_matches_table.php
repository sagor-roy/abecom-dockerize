<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_matches', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("email");
            $table->string("phone");
            $table->double("price");
            $table->string("url");
            $table->longText("comment");
            $table->longText("reply")->nullable();
            $table->boolean("is_replied")->default(false);
            $table->foreignId("user_id")->nullable();
            $table->foreignId("product_id");
            
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
        Schema::dropIfExists('price_matches');
    }
}
