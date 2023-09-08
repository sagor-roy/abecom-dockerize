<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmallBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM small_banners");

        DB::table('small_banners')->insert([
            [
                'id' => 1,
                'name' => 'Banner One',
                'link' => null,
                'image' => asset('images/smallbanner/1616475789qrlzRAi23LwR.jpg'),
                'position' => 1,
                'parent_id' => 0 
            ],
            [
                'id' => 2,
                'name' => 'Banner Two',
                'link' => null,
                'image' => asset('images/smallbanner/1616475789qrlzRAi23LwR.jpg'),
                'position' => 2,
                'parent_id' => 0 
            ],
            [
                'id' => 3,
                'name' => 'Banner Three',
                'link' => null,
                'image' => asset('images/smallbanner/1616475789qrlzRAi23LwR.jpg'),
                'position' => 3,
                'parent_id' => 0 
            ],
        ]);
    }
}
