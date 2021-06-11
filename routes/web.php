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



Route::get('/', [\App\Http\Controllers\HomeController::class, 'home']);
Route::get('/registery', [\App\Http\Controllers\Auth\UserRegisterController::class, 'index']);
Route::post('/registery/index', [\App\Http\Controllers\Auth\UserRegisterController::class, 'store'])->name('store');



//single page articles
Route::get('/articles/{articleSlug}' , [\App\Http\Controllers\Admin\ArticleController::class, 'single']);


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


    // Route-model-binding => باید اسمی که توی روت تعریف می کنیم، دقیقا همان اسم توی متد در کنترل مربوطه اش باشد
    //
    //                    {article} = (id & slug) اسم مدل
    //                       Route::put('/articles/{article}/edit' , [ArticleController::class, 'update'])
    //                       public function update(ArticleRequest $request,Article $article)


    //edit form
    // Route::get('/articles/{id}/edit' , [ArticleController::class, 'edit']);
    // Route::get('/articles/{article}/edit' , [ArticleController::class, 'edit']);


    // put => باشد و برای ویرایش و آپدیت کردن استفاده می شود method="post"حتما باید
    // Route::put('/articles/{article}/edit' , [ArticleController::class, 'update']);


    // put or post => وجود داشته باشد csrf باعث میشه که برای حذف اطلاعات حتما باید یک
    // استفاده نمی شود get() برای جلوگیری از هک و نفوذ، هیچ وقت برای پاک کردن از روت
    // Route::delete('/articles/{article}' , [ArticleController::class, 'destroy']);


    //  خودکار خودش با این دستور ایجاد می کند show تعیین کردیم البته بجز  articles تمام روت هایی که ما مثلا برای
    Route::resource('articles' , 'ArticleController')->except(['show']);


    //only([]) => فقط
    // Route::resource('articles' , 'ArticleController')->only(['destroy']);


    //  که برای حذف عکس آرتیکل به هنگام درخواست و کلیک بر علامت ضربدر route-model-binding و به روش get ایجاد روتی از نوع
    Route::get('/articles/remove-image/{article}',[\App\Http\Controllers\Admin\ArticleController::class, 'destroyImage']);


    Route::post('/comment/store',[\App\Http\Controllers\Admin\CommentController::class, 'store'])->name('comment.add');


    Route::post('/reply/store', [\App\Http\Controllers\Admin\CommentController::class, 'replyStore'])->name('reply.add');

});

    // روت های احراز هویت را خودش خودکار با این دستور ایجاد می کند
    Auth::routes();

