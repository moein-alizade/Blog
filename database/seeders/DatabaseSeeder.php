<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // ایجاد 10 تا کاربر که در قالب یک کالکشن بر می گرداند
        // کالکشن یعنی یک آبجکت از کلاس کالکشن بر می گرداند که به متد هاش دسترسی داشته باشیم
        // \App\Models\User::factory()->count(10)->create();

        // ذخیره سازی یک سری دیتا
        // object =  یک دیتایی داخلش است برای ذخیره سازی
        // each() = لیستی که برای ما بر می گرداند، آنها را تک تک پیمایش کند
        // در نهایت همین ها را گه پیمایش می کند به عنوان یوزر به این فانکشن پاس می دهد
        \App\Models\User::factory()->count(10)->create()->each(function ($user){
            // هم دسترسی داریم  articles()  حالا به آبجکتی از مدل یوزر ها دسترسی پیدا می کنیم یعنی به متد

            // create() -> هم داده را ایجاد می کند و هم توی دیتابیس ذخیره می کند
            // make() -> فقط داده ها را ایجاد می کند

            // برای هر کاربر یک آرتیکل اختصاص می دهد
            // $user->articles()->save(\App\Models\Article::factory()->make());

            // save() = ذخیره سازی تکی
            // saveMany() =  برای ذخیره سازی یک کالکشنی از آرتیکل ها یا ذخیره سازی تکی

            // بین 1 تا 6 تا مقاله برای هر کاربر ایجاد می کند
            $user->articles()->saveMany(\App\Models\Article::factory()->count(rand(1,6))->make());


            // ایجاد 10 تا دسته بندی
            \App\Models\Category::factory()->count(6)->create();
        });

    }

}
