<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_banners', function (Blueprint $table) {
            $table->id();

            $table->string("image");
            $table->string("name");
            $table->integer("position");
            $table->enum("type",["Shop","Offer"]);
            $table->string("link")->nullable();
            $table->string("button")->nullable();


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
        Schema::dropIfExists('all_banners');
    }
}
