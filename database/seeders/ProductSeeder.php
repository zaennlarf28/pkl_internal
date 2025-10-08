<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        \App\Models\Product::create([
            'category_id' => 1,
            'name' => 'Mug',
            'slug' => 'cups-bowls',
            'description' =>'Custom mug',
            'image' => 'products/mugg.jpg',
        ]);

        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Tumbler',
            'slug' => 'cups-bowls',
            'description' =>'Custom tumbler',
            'image' => 'products/tumbler.jpg',
        ]);
    }
}
