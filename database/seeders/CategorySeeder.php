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
            'name' => 'Fashion',
            'slug' => 'fashion',
        ]);

        \App\Models\Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',  
        ]);
    }
}
