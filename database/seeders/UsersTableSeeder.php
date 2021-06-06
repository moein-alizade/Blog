<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;



class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // برو توی اپ/مدل/مدل آرتیکل حالا 10 تا داده ی فیک تولید کن
        return \App\Models\User::factory()->count(10)->create();
    }
}
