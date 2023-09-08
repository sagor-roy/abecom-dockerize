<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_stores', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("address")->nullable();
            $table->string("hotline")->nullable();
            $table->string("phone")->nullable();
            $table->longText("map")->nullable();
            $table->foreignId("parent_id");
            $table->integer("position")->nullable();
            
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
        Schema::dropIfExists('our_stores');
    }
}
