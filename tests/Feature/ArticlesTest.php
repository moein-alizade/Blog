<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    // برای ما یک جدول مجازی می سازد
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    //  تست نوانایی پافشاری کردن یک مقاله
    public function test_an_article_can_persist()
    {
        // withoutExceptionHandling() => نشان ندادن بصورت کد بلکه بصورت متن
        $this->withoutExceptionHandling();

        // ایجاد کاربر جدید فیک
        $user = User::factory()->create();

        // ایجاد دسته بندی جدید فیک
        $category = Category::factory()->create();
        $category2 = Category::factory()->create();

        // ایجاد مقاله با مفادیر دلخواه
        $article = [
            'title' => 'hello',
            'body' => 'hi hi hi hi hi',
            'categories' => [$category->id,$category2->id],
            'user_id' => User::factory()->create()->id,
        ];

        // و مقاله ی جدید را که بالا ایجاد کردیم را بهش پاس می دهد '/admin/articles' ابتدا کاربر را لاگین می کند بعد با متد پست درخواست ارسال می کند که ورودی هاش روت
        $response = $this->actingAs($user)->post('/admin/articles', $article);

        // assertStatus() = چک کد وضعیتی که ما انتظار داریم
        // 302 = Found ریدایرکت یا
        $response->assertStatus(302);

        // assertRedirect() => چک روتی که ما انتطار داریم
        $response->assertRedirect('/admin/articles');

        // چک کردن رکورد درون دیتابیس
        $this->assertDatabaseHas('articles', ['title' => 'hello','body' => 'hi hi hi hi hi']);
    }
}
