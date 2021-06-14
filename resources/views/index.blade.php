@extends('layouts.master')
@section('content')
    <!-- Blog Post -->
    @foreach($articles as $article)
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-4 mt-9">
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
    @endforeach


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


