<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // همه مقالاتی مرتبط با دسته بندی فعلی باشند و آیدی بزرگتر از 10 داشته باشند
        // $articles = $category->articles()->where('id','>',10)->get();

        // همه مقالاتی که مرتبط با دسته بندی فعلی باشد
        // $articles = $category->articles;

        $articles = $category->articles()->paginate(10);

        return view('categories.index',[
            // 'articles'  = می توان استفاده کنیم blade متغیر که توی
            'articles' => $articles,
            // blade فرستادن خود دسته بندی مربوطه به
            'category' => $category
        ]);
    }
}
