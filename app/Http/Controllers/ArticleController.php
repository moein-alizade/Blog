<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function __construct()
    {
//        را انجام می دهد middleware into web.php دقیقا همان کار
        $this->middleware('auth');
    }

    //        تمام روت ها و یا متد هایی که اینجا توی این کنترلر تعریف شده باشند و به یک روتی متصل شدند، آن روت ها همگی احراز هویت می شوند
    public function single($article)
    {
        // return view('single' , ['article' => $article]);
        return view('single' , compact('article'));
    }
}
