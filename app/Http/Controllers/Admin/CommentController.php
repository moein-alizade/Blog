<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Nullable;

class CommentController extends Controller
{

    // ذخیره می کنیم morphMany() نظراات خود را توسط رابطه
    public function store(Request $request)
    {

        //  validate
        $data = $request->validate([
            'body' => 'required|string',
            'article_id' => 'required',
        ]);

        // پیدا کردن آرتیکل مربوطه
        $article = Article::where('id',$data['article_id'])->first();

        // comments() ریختن نظر توی دیتابیس توسط رابطه
        $article->comments()->create([
            'body' => $data['body'],
            'parent_id' => null,
            'user_id' => auth()->user()->id,
        ]);

        return back();
    }

    // ما نظرات والد و پاسخ مربوط به هر کدام را درون یک جدول یکسان نگهداری می کنیم اما موقعی که نظر والد را ذخیره می کنیم
    // هست store , replyStore است و این تفاوت این دو متد Comment_id است و وقتی پاسخ را می خواهیم ذخیره کنیم، مقدار این فیلد برابر با null برابر  parent_id مقدار فیلد

    public function replyStore(Request $request)
    {

        //  validate
        $data = $request->validate([
            'body' => 'required|string',
            'article_id' => 'required',
            'parent_id' => 'nullable',
        ]);


        // پیدا کردن آرتیکل مربوطه
        $article = Article::where('id',$data['article_id'])->first();


        // comments() ریختن نظر توی دیتابیس توسط رابطه
        $article->comments()->create([
            'body' => $data['body'],
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : null,
            'user_id' => auth()->user()->id,
        ]);


        return back();
    }
}
