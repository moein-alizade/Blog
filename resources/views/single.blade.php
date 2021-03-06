@extends('layouts.'.$activeTheme,['hide_sidebar' => true])
@section('content')
    <div class="flex flex-row justify-between my-4">

        <div></div>

        <div class="text-4xl text-red-500">
            <h1>{{ $article->title }}</h1>
        </div>

        {{--     format('%B %d، %Y'); // دی 02، 1391  &   format('%A, %d %B %y'); // جمعه، 23 اسفند 97   &     format('Y/m/d')      --}}
        <div class="text-2xl text-green-600">
            {{ carbonToPersian($article->created_at)->format('Y/m/d')}}
        </div>
    </div>

    <!-- Blog Post -->

        <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 mb-4">
            {{--  asset()   =   شروع بشود ازش استفاده می کنیم public هر چیزی که از پوشه ی   --}}
            {{--  اگه عکس برای مقاله مشخص شده بود و وجود داشت آنگاه همان را بجای تصویر مقاله نشان بده و در غیر این صورت برای عکس مقاله ها از تصویر پیش فرض که خودمان مشخص کردیم را نشان بده        --}}
            <img class="w-full rounded rounded-t" src="{{ isset($article->image) ? asset($article->image) : asset('/image/default.jpeg') }}" alt="Card image cap">
            <div class="flex-auto p-6">
                <p class="mb-0">{{ $article->body }}</p>
            </div>
            <div class="py-3 px-6 border-t-1 border-gray-300 text-gray-700 border-b-4 border-dashed border-purple-400">
                {{--   نمایش دسته بندی ها بصورت استاتیک یعنی از دیتابیس بگیریم --}}
                <ul>
                    <li class="text-red-500">Categories :</li>
                    @foreach($article->categories()->get() as $category)
                        <li class="pl-5 text-blue-700">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="py-3 px-6 bg-blue-50 border-t-1 border-gray-300 text-gray-700">
                <h4 class="text-center pb-10 text-2xl text-indigo-400">Display Comments</h4>

                <form method="post" action="{{ route('comment.add') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="body">Add comment</label>
                        <textarea id="body" name="body" rows="4" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600"></textarea>
                        <input type="hidden" name="article_id" value="{{ $article->id }}" />
                    </div>
                    <div>
                        <input type="submit" class="w-1/12 h-full bg-green-300 hover:bg-green-400 hover:border-green-400 border-green-300 border border-solid font-normal inline-block no-underline px-3 py-0.5 rounded select-none text-center text-white mb-14" value="Send" />
                    </div>
                </form>
                @include('partials._comment_replies', ['comments' => $article->comments, 'article_id' => $article->id])
            </div>
        </div>
@endsection
