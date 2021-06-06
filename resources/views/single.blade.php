@extends('layouts.master')

@section('content')
    <h1 class="my-4">{{ $article->title }}</h1>

    <!-- Blog Post -->

        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-4">
            {{--            <img class="w-full rounded rounded-t" src="http://placehold.it/750x300" alt="Card image cap">--}}
            {{--            asset()   =   شروع بشود ازش استفاده می کنیم public هر چیزی که از پوشه ی   --}}
            {{--  اگه عکس برای مقاله مشخص شده بود و وجود داشت آنگاه همان را بجای تصویر مقاله نشان بده و در غیر این صورت برای عکس مقاله ها از تصویر پیش فرض که خودمان مشخص کردیم را نشان بده        --}}
            <img class="w-full rounded rounded-t" src="{{ isset($article->image) ? asset($article->image) : asset('/image/default.jpeg') }}" alt="Card image cap">
            <div class="flex-auto p-6">
                {{-- نمایش دادن عنوان آرتیکل--}}
                <h2 class="mb-3">{{ $article->title }}</h2>
                <p class="mb-0">{{ $article->body }}</p>
            </div>
            <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300 text-gray-700">
                Posted on January 1, 2020 by

                {{--   نمایش دسته بندی ها --}}
                <ul>
                    @foreach($article->categories()->get() as $category)
                        <li>*{{ $category->name }}</li>
                    @endforeach
                </ul>

                <a href="#">Start Bootstrap</a>
            </div>
        </div>

@endsection
