<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_sales', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("company");
            $table->string("phone");
            $table->string("email");
            $table->string("address");
            $table->string("city");
            $table->string("country");
            $table->enum("type",['B2B_Enquery','B2G_Enquiry','Corporate_Business']);
            $table->longText("enquery");
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
        Schema::dropIfExists('corporate_sales');
    }
}
