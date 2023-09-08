<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM menus");
        DB::table('menus')->insert([
            [
                'id' => 1,
                'name' => 'Banners',
                'icon' => 'fas fa-sliders-h',
                'url' => null,
                'position' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Category & Brand',
                'icon' => 'fas fa-sort',
                'url' => null,
                'position' => 2,
            ],
            [
                'id' => 3,
                'name' => 'Product Management',
                'icon' => 'fab fa-product-hunt',
                'url' => null,
                'position' => 3,
            ],
            [
                'id' => 4,
                'name' => 'Offer Management',
                'icon' => 'fas fa-gift',
                'url' => null,
                'position' => 4,
            ],
            [
                'id' => 5,
                'name' => 'Customer Management',
                'icon' => 'fas fa-user-secret',
                'url' => null,
                'position' => 5,
            ],
            [
                'id' => 6,
                'name' => 'Order Management',
                'icon' => 'fas fa-shopping-bag',
                'url' => null,
                'position' => 7,
            ],
            [
                'id' => 7,
                'name' => 'Delivery Management',
                'icon' => 'fas fa-truck',
                'url' => null,
                'position' => 8,
            ],
            [
                'id' => 8,
                'name' => 'Site Settings',
                'icon' => 'fas fa-cog',
                'url' => null,
                'position' => 10,
            ],
            [
                'id' => 9,
                'name' => 'User Management',
                'icon' => 'fas fa-user',
                'url' => null,
                'position' => 6,
            ],
            [
                'id' => 10,
                'name' => 'All Pages',
                'icon' => 'fas fa-user',
                'url' => null,
                'position' => 9,
            ],
        ]);
    }
}
