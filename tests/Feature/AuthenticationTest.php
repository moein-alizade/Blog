<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;


class AuthenticationTest extends TestCase
{
    // برای ما یک جدول مجازی می سازد
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // شروع بشود test اسم متد حتما باید با
    // homepage تست دسترس بودن
    public function test_homepage_is_accessible()
    {
        // $user ایجاد کاربر جدید فیک و ریختن آن در متعیر
        $user = User::factory()->create();

        // کاربر جدید فیک را لاگین می کند
        $response = $this->actingAs($user)
        ->get('/');

        // assertStatus() = چک کد وضعیتی که ما انتظار داریم
        // 200 = OK موفقیت آمیز یا
        $response->assertStatus(200);
    }

    // تست دسترسی صفحه درباره ما برای کاربران لاگین نکرده و نیز باید به صفحه لاگین ریدایرگت شود
    public function test_aboutpage_is_not_accessible_by_unauthenticated_user()
    {
        // get() تست باز گردن صفحه درباره ما توسط متد
        $response = $this->get('/about');

        // 302 = Found ریدایرکت یا
        $response->assertStatus(302);

        // assertRedirect() => چک روتی که ما انتطار داریم
        $response->assertRedirect('/login');
    }

}
