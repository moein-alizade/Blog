<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// HomeController@home   => اسم متد داخل کنترلر@اسم کنترلر
Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);


Route::get('/registery', [\App\Http\Controllers\Auth\UserRegisterController::class, 'index']);
Route::post('/registery/index', [\App\Http\Controllers\Auth\UserRegisterController::class, 'store'])->name('store');








//برای نشان دادن هر صفحه جدید باید یک روت جدیدایجاد کنیم
//single page articles
//Route::get('/articles/{articleSlug}' , [\App\Http\Controllers\ArticleController::class, 'single'])->middleware('guest');
Route::get('/articles/{articleSlug}' , [\App\Http\Controllers\ArticleController::class, 'single']);




//middleware('auth') =>  احراز هویت کاربر
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->middleware('auth');



//name('') => برای این مفید هست که از یک روت چند جا استفاده کردیم و اکنون بخوایم آدرس مسیر اون روت را عوض کنیم دیگه لازم نیست توی همه آنجا هایی که از روت استفاده کردیم، آدرس مسیرش را عوض کنیم
Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');



//  استفاد کردیم get می توان دریافت کرد چون از متد  get تنها توی روت  دیتا را بصورت
Route::prefix('admin')->namespace('Admin')->group(function() {

    // Route::get('/articles' , [ArticleController::class, 'index']);

    //نشان دادن فرم
    // Route::get('/articles/create' , [ArticleController::class, 'create']);


    // فرستادن دیتا از فرم بصورت پست به روت و ایجاد کردن فرم
    // Route::post('/articles/create' , [ArticleController::class, 'store']);

    // Route::post('/articles/create' , function (Request $request) {
    //     dd($request->all());
    // });



    //edit form
    // Route::get('/articles/{id}/edit' , [ArticleController::class, 'edit']);


    // {article} => اسم مدل , route model binding = این روش هست
    // Route::get('/articles/{article}/edit' , [ArticleController::class, 'edit']);

    // 2 ta route model binding (id & slug)
    // Route::get('/articles/{article}/edit' , [ArticleController::class, 'edit']);


    //دریافت داده های ارسال شده ویرایش شده
    // Route::post('/articles/{id}/edit' , function($id) {


    // put => باشد و برای ویرایش و آپدیت کردن استفاده می شود method="post"حتما باید
    // Route::put('/articles/{article}/edit' , [ArticleController::class, 'update']);


    // استفاده نمی شود برای جلوگیری از هک و نفوذ get هیچ وقت برای پاک کردن از روت
    // put or post => وجود داشته باشد csrf باعث میشه که برای حذف اطلاعات حتما باید یک
    // Route::delete('/articles/{article}' , [ArticleController::class, 'destroy']);

    //except([]);   =>    بجز
    Route::resource('articles' , 'ArticleController')->except(['show']);

    //only([]);     =>    فقط
    // Route::resource('articles' , 'ArticleController')->only(['destroy']);
});


Auth::routes();

