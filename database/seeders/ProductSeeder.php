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
            'slug' => 'mug',
            'description' =>'Custom mug',
            'price' => 75000,
            'stock' => 100,
            'image' => 'products/mug.jpg',
        ]);

        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Tumbler',
            'slug' => 'tumbler',
            'description' =>'Custom tumbler',
            'price' => 1750000,
            'stock' => 100,
            'image' => 'products/tumbler.jpg',
        ]);
    }
}
