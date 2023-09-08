<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Counting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DELETE FROM countings");
        $date = Carbon::now();
        DB::table('countings')->insert([
            [
                'id' => 1,
                'left_category' => 1,
                'slider_category' => 1,
                'home_offer' => 1,
                'created_at' => $date,
                'updated_at' => $date,
            ]
        ]);
    }
}
