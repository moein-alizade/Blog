<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // استفاده از داده های فیک
        // $faker = \Faker\Factory::create();
        // foreach (range(1,10) as $item) {
        //     DB::table('articles')->insert([
        //         'title' => $faker->text(50),
        //         'slug' => $faker->slug(),
        //         'body' => $faker->paragraph(rand(5,20)),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        // }



        // برو توی اپ/مدل/مدل آرتیکل حالا 10 تا داده ی فیک تولید کن
        return \App\Models\Article::factory()->count(10)->create();

    }

}










