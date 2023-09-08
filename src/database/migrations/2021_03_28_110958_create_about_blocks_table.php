<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_blocks', function (Blueprint $table) {
            $table->id();

            $table->string("icon")->nullable();
            $table->string("text")->nullable();
            $table->string("title");
            $table->string("description");
            $table->integer("position")->unique();

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
        Schema::dropIfExists('about_blocks');
    }
}
