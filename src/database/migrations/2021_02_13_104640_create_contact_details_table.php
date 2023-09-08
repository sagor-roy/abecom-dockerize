<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('logo');
            $table->string('footer_logo');
            $table->string('fav');
            $table->string('address');
            $table->longText("map");
            $table->longText("store_info");
            $table->string('hotline');
            $table->string('phone');
            $table->string('email');
            $table->string('open_time');
            $table->string('close_time');

            $table->string('offer_title');
            $table->string('footer_title');

            $table->longText('corporate_sale');
            $table->longText('service_complaint');

            $table->string("product_details_title");
            $table->longText("product_details_list");

            $table->text('about_us_image');

            $table->longText('checkout_page_nb')->nullable();

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
        Schema::dropIfExists('contact_details');
    }
}
