<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactDetailSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM contact_details");
        DB::table('contact_details')->insert([
            [
                'id' => 1,
                'logo' => 'image.jpg',
                'fav' => 'image.jpg',
                'footer_logo' => 'image.jpg',
                "address" => "aaa",
                "map" => "aaa",
                "store_info" => "aaa",
                "hotline" => "aaa",
                "phone" => "aaa",
                "email" => "aaa",
                "open_time" => "aaa",
                "close_time" => "aaa",
                "offer_title" => "aaa",
                "footer_title" => "aaa",
                "corporate_sale" => "aaa",
                "service_complaint" => "aaa",
                "product_details_title" => "aaa",
                "product_details_list" => "aaa",
                "about_us_image" => "about_us_image",
                "checkout_page_nb" => "Checkout page NB",
            ]
        ]);
    }
}
