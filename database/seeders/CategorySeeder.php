<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        \App\Models\Category::create([
            'name' => 'Cups & Bowls',
            'slug' => 'cups-bowls',
        ]);

        \App\Models\Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',  
        ]);
    }
}
