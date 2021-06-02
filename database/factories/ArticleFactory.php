<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Faker\Generator as Faker;
use App\Models\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {

        return [
//            مقدار پیش فرض آیدی یوزر برابر با عدد 5 هست
//            'user_id' => 5,

//      برو توی اپ/مدل/مدل یوزر حالا بطور تصادفی یک آیدی را انتخاب کن و توی آیدی بگذار
//            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'title' => $this->faker->text(50),
            'slug' => $this->faker->slug(),
            'body' => $this->faker->paragraph(rand(5,20))
            // نیست زیرا خود مدل ها این مقداردهی کردن را انجام می دهند created_at & updated_at چون از مدل ها استفاده می کند پس دیگه لازم به
            // 'created_at' => now(),
            // 'updated_at' => now()
        ];
    }

}



