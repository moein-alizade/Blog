@extends('layouts.'.$activeTheme)
@section('content')
    <!-- Blog Post -->
    <h2 class="text-center py-2 text-red-500">{{   $category->name   }}</h2>
    <hr />

    {{--    دارد که وقتی شرط اون چیز وجود نداشته باشد می توان کدهای دلخواهمان را داخلش بگذاریم @empty هست اما این  foreach مثل     --}}
    @forelse ($articles as $article)
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-4 mt-4">
            {{--  اگه عکس برای مقاله مشخص شده بود و وجود داشت آنگاه همان را بجای تصویر مقاله نشان بده و در غیر این صورت برای عکس مقاله ها از تصویر پیش فرض که خودمان مشخص کردیم را نشان بده        --}}
            <img class="w-full rounded rounded-t" src="{{ isset($article->image) ? asset($article->image) : asset('/image/default.jpeg') }}" alt="Card image cap">
            <div class="flex-auto p-6">
                {{-- نمایش دادن عنوان آرتیکل--}}
                <h2 id="head" class="mb-3">{{ $article->title }}</h2>
                <p class="mb-0">{{ $article->body }}</p>
                <a href="/articles/{{ $article->slug }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded-b-2xl py-1 px-3 my-3 leading-normal no-underline bg-red-300 text-white hover:bg-red-400">Read More &rarr;</a>
            </div>
            <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300 text-green-600">
                <p>پست شده در {{ carbonToPersian($article->created_at)->format("Y.m.d") }}</p>
            </div>
        </div>
    {{--    اگه همجنین دسته بندی وجود نداشت، متن زیر را نشان بده    --}}
    @empty
        <h2 class="text-center py-2"> !یافت نشد {{   $category->name   }} مقالاتی مرتبط با دسته بندی </h2>
    @endforelse


    <div>
        {{--   آرتیکل ها که شماره بندی شدند را تبدیل به لینک می کند     --}}
        {{ $articles->links()  }}
    </div>

    <div class="w-1/12 fixed right-1 bottom-3.5">
        <a href="#mlogo"><img src="/image/top-arrow.png" class="w-1/3 h-full"></a>
    </div>

@endsection


@section('sidebar')
    @parent
@endsection


