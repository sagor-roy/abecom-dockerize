<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductWarrantySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        DB::statement("DELETE FROM product_warranties");
        DB::table('product_warranties')->insert([
            [
                'id' => 1,
                'product_warranty' => 'Product Warrant 5 Years.',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
