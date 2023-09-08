<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_complaints', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("phone");
            $table->string("email");
            $table->string("showroom");
            $table->string("invoice_number");
            $table->string("product_brand");
            $table->string("product_type")->nullable();
            $table->string("product_model_number")->nullable();
            $table->string("subject");
            $table->longText("complain");
            $table->boolean("is_replied")->default(false);
            $table->longText("reply")->nullable();
            $table->foreignId("user_id")->nullable();

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
        Schema::dropIfExists('service_complaints');
    }
}
