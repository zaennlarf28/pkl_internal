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
            'name' => 'Baju Anak',
            'slug' => 'baju-anak',
            'description' =>'Lorem Ipsum',
            'price' => 75000,
            'stock' => 100,
            'image' => 'image.png',
        ]);

        \App\Models\Product::create([
            'category_id' => 2,
            'name' => 'Samsung S25 5g',
            'slug' => 'samsung-s25-5g',
            'description' =>'Lorem Ipsum',
            'price' => 1750000,
            'stock' => 100,
            'image' => 'image.png',
        ]);
    }
}
