<?php

namespace App\Http\Controllers\Admin;


//کنیم  use از هر مدلی که استفاده کردیم حتما باید آنرا
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ArticleController extends Controller
{


    //    احراز هویت متد ها
    public function __construct()
    {
    //        احراز هویت روی تمام متد ها
    //        $this->middleware('auth');

    //        احراز هویت روی تمام متد ها بجز ایندکس
              $this->middleware('auth')->except(['index']);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // روت اصلی
    public function index()
    {
        return view('admin.articles.index' , [
            'articles' => Article::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // برای نمایش دادن فرم
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */

    // برای ایجاد کردن مقاله مون
    public function store(ArticleRequest $request)
    {

        //       validate

        //       Method1:   $validate_data = $this->validate(request() ,
        //                    [
        //                      'title' => 'required|min:10|max:50',
        //                      'body' => 'required'
        //                    ]);
        //


        //        Method2:   $validate_data = $request->validate([
        //                      'title' => 'required|min:10|max:50',
        //                      'body' => 'required'
        //                    ]);






        // upload file
        // انجام دادیم فقط اطلاعات اعتبار سنجی شده را دریافت می کنیم ArticleRequest گام اول: اعتبار سنجی کردن چون قبلا با
                  $data = $request->validated();


        //        نمایش محتوای فایل که بصورت موقتی در سرور ذخیره شده است
        //        dd($data['image']);


        //        upload() =  اضافه می کنیم /vendor/laravel/framework/src/illuminate/foundation/helpers.php این تابع را خودمان  توی فایل
        //        را به تابع آپلود پاس می دهد که در نهایت تابع آپلود مسیر رسیدن به عکس را درون یک رشته بر می کرداند $data['image'] آبجکت
        //        $data['image'] ذخیره مسیر رسیدن به عکس در این آبجکت
                  $data['image'] = upload($data['image']);




        //        انتقال به دیتابیس
                  $article = auth()->user()->articles()->create([
                      'title' => $data['title'],
                      //          ُStr::slug($title, $separator);       =          "-" توسط دستور رو به رو خط های فاصله تبدیل شود به کاراکتر slug از کارکتر فاصله استفاده شود باید برای  title چون ممکن است درون
                      'slug' => Str::slug($data['title'], '-'),
                      'body' => $data['body'],
                      'image' => $data['image'],
                  ]);








        //     ذخیره کن  category دسته بندی ها این آرتیکل را در جدول  ، categories() با استفاده از رابطه ی
        //      $article->categories()->attach($request->input('categories'));
                $article->categories()->attach($data['categories']);


                return redirect('/admin/articles');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function edit($id)
    {

        // Article = خود مدل , $article = باید اسم مدل توی روت باشه
        // ذخیره کن $article اولین آیدی مقاله ای که درخواست ویرایش داده شده را درون متغیر
        $article = \App\Models\Article::where('id','=',$id)->first();

        // برگشت به صفحه ی ویرایش مقاله ای که درخواست ویرایش شده
        return view('admin.articles.edit' , [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(ArticleRequest $request,Article $article)
    {

        // upload file
        // دریافت اطلاعات اعتبار سنجی شده
        $data = $request->validated();



        //     حذف تصاویر قبلی چون می خواهیم تصویر جدید را آپلود بکنیم
        //     آنگاه باید عکس قبلی را پاک کنیم  (article->image) و این پستی که ما داریم، خودش از قبل تصویر داشت  $data['image'] اکه یک تصویر جدید آپلود شده بود
        if($data['image'] &&  isset($article->image))
        {
            deleteFile($article->image);
        }



        //        upload() =  اضافه می کنیم /vendor/laravel/framework/src/illuminate/foundation/helpers.php این تابع را خودمان  توی فایل
        //        را به تابع آپلود پاس می دهد که در نهایت تابع آپلود مسیر رسیدن به عکس را درون یک رشته بر می کرداند $data['image'] آبجکت
        //        $data['image'] ذخیره مسیر رسیدن به عکس در این آبجکت

        $data['image'] = upload($data['image']);



        // article قدم دوم آپدیت مقاله: پیدا کردن
        // Article = صدا زدن مدل یا الکونت آرتیکل هست
        // $article = Article::find($id);


        // اگه آرتیکل خالی بود
        // if(is_null($article)) {
        //     abort(404);
        // }


        // این فیلد ها رو توی آرتیکل آپدیت می کند
        // $article->update([
        //     'title' => $validate_data['title'],
        //     'slug' => $validate_data['title'],
        //     'body' => $validate_data['body'],
        // ]);

        // ساده شده بالایی
        // $data = آرتیکل و بادی را بر می گرداند
        $article->update($data);




        //        قدم سوم آپدیت مقاله: بعد از آپدیت شدن دیتا ها ما باید دسته بندی ها رو هم آپدیت کنیم حالا باید
        //        کنیم attach() کنیم و بعد مقادیر جدید را  detach() اول باید دسته بندی هایی که از قبل وجود دارد را
        //        sync()  => می کند attach() یعنی حذف می کند، سپس مقادیر جدید را  detach() اول دیتا های قبلی را
        $article->categories()->sync($data['categories']);


        return redirect('/admin/articles');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(Article $article)
    {
        // findOrFail => اگه وجود داشت بر می کرداند و اکه نه که خطای 404 را بر می گرداند

        //delete() => متدی توی مدل ها هست که دیتا ها را حذف می کند
        $article->delete();



        // بکنی deleteFile() اکه مقاله ما از قبل تصویر داشت باید
        if($article->image)
        {
            deleteFile($article->image);
        }


        return back();

    }




    // id = $article     ,      Article = model Article
    public function destroyImage(Article $article)
    {
        // استفاده می کنیم return $article الان ما تمام مقادیر آرتیکل را دریافت کرده ایم و برای تست از دستور


        // ات را آپدیت کن ( که ما در اینجا می خواهیم هیچی را نشان ندهد) image آرتیکل برو فیلد
        $article->update(['image' => null ]);
        return back();

    }



}




