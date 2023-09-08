<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MenuSeeder::class,
            SubMenuSeeder::class,
            // SmallBannerSeeder::class,
            // ContactDetailSedder::class,
            // Counting::class,
            // UserSeeder::class,
            // ProductWarrantySeeder::class,
            // FooterWidgetSeeder::class,
        ]);

    }
}
