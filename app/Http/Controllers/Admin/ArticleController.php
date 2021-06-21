<?php

namespace App\Http\Controllers\Admin;


// کنیم use از هر مدلی که استفاده کردیم حتما باید آنرا
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ArticleController extends Controller
{


    // احراز هویت متد ها
    public function __construct()
    {
        // index() احراز هویت روی تمام متد ها بجز
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
              // گرفتن مقالات
              // 'articles' => Article::all()

              // گرفتن مقالات بصورتی که مقاله تازه ایجاد شده در ابتدا نشان بدهد
              // orderBy('', '')  =>   فیلد اول نام ستونی که می خواهیم مرتب کنیم و فلید نوع مرتب شدن مثل صعودی یا نزولی هست
              // 'articles' => Article::orderBy('created_at', 'desc')->get()

              // ساده شده دستور بالایی
              'articles' => Article::latest()->get()
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

    // ذخیره سازی مقاله ها در پایگاه داده
    public function store(ArticleRequest $request)
    {

        // 1. validate

        //  Method1:   $validate_data = $this->validate(request() ,
        //             [
        //                'title' => 'required|min:10|max:50',
        //                'body' => 'required'
        //             ]);
        //


        //  Method2:   $validate_data = $request->validate([
        //                'title' => 'required|min:10|max:50',
        //                'body' => 'required'
        //             ]);




        // 2. upload file
        // انجام دادیم فقط اطلاعات اعتبار سنجی شده را دریافت می کنیم ArticleRequest گام اول: اعتبار سنجی کردن چون قبلا با
            $data = $request->validated();


        // upload() =  اضافه می کنیم /vendor/laravel/framework/src/illuminate/foundation/helpers.php این تابع را خودمان  توی فایل
        // را به تابع آپلود پاس می دهد که در نهایت تابع آپلود مسیر رسیدن به عکس را درون یک رشته بر می کرداند $data['image'] آبجکت
        // $data['image'] ذخیره مسیر رسیدن به عکس در این آبجکت

        // اگه عکسی توی آرایه ی داده هایی که فرستادیم، بود آنگاه تابع آپلود را صدا بزن
        if(isset($data['image']))
        {
            $data['image'] = upload($data['image']);
        }



        // 3. انتقال به دیتابیس
        $article = auth()->user()->articles()->create([
            'title' => $data['title'],
             // ُStr::slug($title, $separator)  =  "-" توسط دستور رو به رو خط های فاصله تبدیل شود به کاراکتر slug از کارکتر فاصله استفاده شود باید برای title چون ممکن است درون
            'slug' => Str::slug($data['title'], '-'),
            'body' => $data['body'],
             // اگه عکسی توی آرایه ی داده هایی که فرستادیم، بود آنگاه آن عکس را به دیتابیس بفرست و در غیر این صورت مقدارش را تهی بگذار
            'image' => isset($data['image']) ? $data['image'] : null,
        ]);




        // ذخیره کن  category دسته بندی ها این آرتیکل را در جدول  ، categories() با استفاده از رابطه ی
        // $article->categories()->attach($request->input('categories'));

        // sync()  => می کند attach() یعنی حذف می کند، سپس مقادیر جدید را  detach() اول دیتا های قبلی را
             $article->categories()->sync($data['categories']);

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
        // ذخیره کن $article اولین آیدی مقاله ای که درخواست ویرایش داده شده را درون متغیر
        $article = \App\Models\Article::where('id','=',$id)->first();

        // برگشت به صفحه ی ویرایش مقاله ای که درخواست ویرایش شده
        return view('admin.articles.edit' , [
            // 'key' => 'value'
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
        // 1. دریافت اطلاعات اعتبار سنجی شده
        $data = $request->validated();


        // 2. حذف تصاویر قبلی چون می خواهیم تصویر جدید را آپلود بکنیم
        // آنگاه باید عکس قبلی را پاک کنیم تا بعدش عکس جدید را در دیتابیس خود آپدیت کنیم  (article->image) و این پستی که ما داریم، خودش از قبل تصویر داشت  ($data['image']) اکه یک تصویر جدید در آرایه ی داده های ارسالی وجود داشت
        if(isset($data['image']) &&  isset($article->image))
        {
            deleteFile($article->image);
        }


        // upload() =  اضافه می کنیم /vendor/laravel/framework/src/illuminate/foundation/helpers.php این تابع را خودمان  توی فایل
        // را به تابع آپلود پاس می دهد که در نهایت تابع آپلود مسیر رسیدن به عکس را درون یک رشته بر می کرداند $data['image'] آبجکت
        // $data['image'] ذخیره مسیر رسیدن به عکس در این آبجکت
        // 3. اگه عکسی توی آرایه ی داده هایی که فرستادیم، بود آنگاه تابع آپلود را صدا بزن
        if(isset($data['image']))
        {
            $data['image'] = upload($data['image']);
        }



        //  article قدم دوم آپدیت مقاله: پیدا کردن
        // Article = صدا زدن مدل یا الکونت آرتیکل هست
        // $article = Article::find($id);


        // findOrFail => اگه وجود داشت بر می کرداند و اکه نه که خطای 404 را بر می گرداند
        // اگه آرتیکل خالی بود
        // if(is_null($article)) {
        //     abort(404);
        // }


        // قدم سوم آپدیت مقاله: این فیلد ها رو توی آرتیکل آپدیت می کند
        // $article->update([
        //     'title' => $validate_data['title'],
        //     'slug' => $validate_data['title'],
        //     'body' => $validate_data['body'],
        // ]);

        // ساده شده بالایی
        // $data = عنوان و متن را بر می گرداند
        $article->update($data);


        // قدم چهارم آپدیت مقاله: بعد از آپدیت شدن دیتا ها ما باید دسته بندی ها رو هم آپدیت کنیم حالا
        // کنیم attach() کنیم و بعد مقادیر جدید را  detach() اول باید دسته بندی هایی که از قبل وجود دارد را
        // sync()  => می کند attach() یعنی حذف می کند، سپس مقادیر جدید را  detach() اول دیتا های قبلی را
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
        // delete() => متدی توی مدل ها هست که دیتا ها را حذف می کند
        $article->delete();


        // بکنی deleteFile() اکه مقاله ما از قبل تصویر داشت باید
        if($article->image)
        {
            deleteFile($article->image);
        }

        return redirect('/admin/articles');

    }



    // id = $article توی  ,  Article = model Article
    public function destroyImage(Article $article)
    {
        // استفاده می کنیم return $article الان ما تمام مقادیر آرتیکل را دریافت کرده ایم و برای تست از دستور

        // ات را آپدیت کن ( که ما در اینجا می خواهیم هیچی را نشان ندهد) image آرتیکل برو فیلد
        $article->update(['image' => null ]);
        return back();
    }



    public function single($article)
    {
        // return view('single' , ['article' => $article]);
        // compact() => کارش ساده سازی هست مثلا دستور زیر برابر با دستور بالایی هست
        return view('single' , compact('article'));
    }

}




