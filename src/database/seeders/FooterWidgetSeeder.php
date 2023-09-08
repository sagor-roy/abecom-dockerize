<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterWidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM footer_widgets");
        DB::table("footer_widgets")->insert([
            [
                'id' => 1,
                'widget' => 'Corporate',
                'position' => 1,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'widget' => 'Useful Links',
                'position' => 2,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'widget' => 'Customer Services',
                'position' => 3,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'widget' => 'Information',
                'position' => 4,
                'is_active' => true,
            ],
        ]);
    }
}
