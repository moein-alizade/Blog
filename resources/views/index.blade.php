@extends('layouts.master')

@section('content')
<h1 class="my-4">Page Heading
    <small>Secondary Text</small>
    </h1>

    <!-- Blog Post -->
    @foreach($articles as $article)
        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-4">
            <img class="w-full rounded rounded-t" src="http://placehold.it/750x300" alt="Card image cap">
            <div class="flex-auto p-6">
                {{-- نمایش دادن عنوان آرتیکل--}}
                <h2 class="mb-3">{{ $article->title }}</h2>
                <p class="mb-0">{{ $article->body }}</p>
                <a href="/articles/{{ $article->slug }}" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded-b-2xl py-1 px-3 my-3 leading-normal no-underline bg-red-300 text-white hover:bg-red-400">Read More &rarr;</a>
            </div>
            <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300 text-gray-700">
                Posted on January 1, 2020 by
                <a href="#">Start Bootstrap</a>
            </div>
        </div>

    @endforeach

    <div class="mx-72">
        {{--   آرتیکل ها که شماره بندی شدند را تبدیل به لینک می کند     --}}
        {{ $articles->links()  }}
    </div>

@endsection

@section('sidebar')
    @parent
    <!-- Side Widget -->
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 my-4">
        <h5 class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">Side Bar Widget</h5>
        <div class="flex-auto p-6">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
    </div>
@endsection
