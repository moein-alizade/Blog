<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;





class HomeController extends Controller
{
    public function home(){

        // آرتیکل ها را بصورتی که آیدی شان نزولی هست، تولید می کند
        // paginate(10) = برای شماره بندی صفحات در انتها سایت هست یعنی توی هر صفحه 10 آرتیکل را قرار می دهد
        $articles = Article::orderBy('id' , 'desc')->paginate(10);




        //ارسال آرتیکل
        //compact() =  برای ساده سازی استفاده می شود
        //به ما بر می کرداند ['articles' => $articles] یک لیستی شبیه به این
        //return view('index', ['articles' => $articles]);
        return view('index', compact('articles'));

    }

    public function about(){

        return view('about');

    }

    public function contact(){
        return view('contact');
    }
}
