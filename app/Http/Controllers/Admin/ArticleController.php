<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// مدل آرتیکل را باید حتما یوز کنیم چون ازش استفاده کردیم
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{


    public function __construct()
    {
//        احراز هویت روی تمام متد ها
//        $this->middleware('auth');


//        only(['']) => یعنی فقط
//        احراز هویت روی تمام متد ها بجز ایندکس
        $this->middleware('auth')->except(['index']);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // روت اصلی,form delete
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
     * @return \Illuminate\Http\Response
     */
    // برای ایجاد کردن مقاله مون
    // public function store(Request $request){
    public function store(ArticleRequest $request)
    {

//    برگرداندن دیتای یوزری  که لاگین کرده است
//      return auth()->user();




        // $validate_data = Validator::make(request()->all() , [
        //     'title' => 'required|min:10|max:50',
        //     'body' => 'required'
        // ])->validated();


        //  ساده شده کد های اعتبار سنجی بالا
        // $validate_data = $this->validate(request() , [
        //     'title' => 'required|min:10|max:50',
        //     'body' => 'required'
        // ]);


        // validate request استفاده از
        // $validate_data = $request->validate([
        //     'title' => 'required|min:10|max:50',
        //     'body' => 'required'
        // ]);


        // دریافت اطلاعات اعتبار سنجی شده
        $validate_data = $request->validated();



//        return $request->all();



//        Article::create([
//            دیتای یوزر را می گیرد و به آیدی اش دسترسی پیدا می کنیم
//        solve1 -> error: General error: 1364 Field 'user_id' doesn't have a default value & Attempt to read property "id" on null
//            'user_id' => auth()->user()->id,
//            'title' => $validate_data['title'],
//            // 'slug' => $validate_data['title'],
//            'body' => $validate_data['body'],
//        ]);


//        solve2 (the best) -> error: General error: 1364 Field 'user_id' doesn't have a default value & Attempt to read property "id" on null
//      هست را صدا می زنیم articles() دیتای کاربری که لاگین کرده را می گیریم و بعد رابطه را که
//      create() ->  چون از این متد استفاده کردیم باید یک لیست از دیتا هایی که مدنظرمون هست پاس بدهیم
        $article = auth()->user()->articles()->create([
            'title' => $validate_data['title'],
            'body' => $validate_data['body'],
        ]);






//        $article->categories()->attach($request->input('categories'));
        $article->categories()->attach($validate_data['categories']);


//        return $request->all();




        return redirect('/admin/articles/create');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id){
    // هم باید تغییر بدیم return هم می توان استفاده کرد البته در  $id از  $article بجای
    // public function edit($article){
    // Article = خود مدل , $article = باید اسم مدل توی روت باشه
    public function edit( $id)
    {

        // $article = Article::findOrFail($id);

        $article = \App\Models\Article::where('id','=',$id)->first();

        // dd($article);
        // returnR $article;

        return view('admin.articles.edit' , [
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update($id){
    // public function update(ArticleRequest $request,$id){
    public function update(ArticleRequest $request,Article $article)
    {
        // قدم اول. اعتبار سنجی
        // $validate_data = Validator::make(request()->all() , [
        //     'title' => 'required|min:10|max:50',
        //     'body' => 'required'
        // ])->validated();



        // role
        // [
        //     'title' => 'required|min:10|max:50',
        //     'body' => 'required'
        // ]



        // ساده شده ی کد های اعتبار سنجی بالا
        // $validate_data = $this->validate(request() , [
        //     'title' => 'required|min:10|max:50',
        //     'body' => 'required'
        // ]);


        // دریافت اطلاعات اعتبار سنجی شده
        $validate_data = $request->validated();




        // article قدم دوم. پیدا کردن
        // Article = صدا زدن مدل یا الکونت آرتیکل هست
        // $article = Article::find($id);

        // ساده شده ی پایینی
        // $article = Article::findOrFail($id);

        // اگه آرتیکل خالی بود
        // if(is_null($article)) {
        //     abort(404);
        // }

        // return $article;

        // این فیلد ها رو توی آرتیکل آپدیت می کند
        // $article->update([
        //     'title' => $validate_data['title'],
        //     'slug' => $validate_data['title'],
        //     'body' => $validate_data['body'],
        // ]);

        // ساده شده بالایی
        // $validate_data = آرتیکل و بادی را بر می گرداند
        $article->update($validate_data);




//        بعد از آپدیت شدن دیتا ها ما باید دسته بندی ها رو هم آپدیت کنیم
//         کنیم  detach() اول باید دسته بندی هایی که از قبل وجود دارد را
//                                     کنیم attach() بعد مقادیر جدید را
//        sync()  => می کند attach() یعنی حذف می کند، سپس مقادیر جدید را  detach() اول دیتا های قبلی را
        $article->categories()->sync($validate_data['categories']);





        // return redirect('/admin/articles/create');
        // ریدایرکت به صفحه ی قبل(بجای کد بالایی این را استفاده می کنیم)
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function delete($id){
    public function destroy(Article $article)
    {
        // findOrFail => اگه وجود داشت بر می کرداند و اکه نه که خطای 404 را بر می گرداند
        // $article = Article::findOrFail($id);

        //delete() => متدی توی مدل ها هست که دیتا ها را حذف می کند
        $article->delete();

        // ریدایرکت به صفحه ی قبل
        return back();
    }
}
