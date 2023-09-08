<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_pages', function (Blueprint $table) {
            $table->id();

            $table->integer("position");
            $table->string("name")->unique();
            $table->string("slug")->unique();
            $table->longText("content")->nullable();
            $table->string("link")->nullable();
            $table->enum("type",['Page','Link']);
            $table->boolean("is_active")->default(false);
            $table->unsignedBigInteger("footer_widget_id");

            $table->foreign("footer_widget_id")->references("id")->on("footer_widgets")->onDelete("cascade");

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
        Schema::dropIfExists('custom_pages');
    }
}
