<!-- farakhani master page -->
@extends('layouts.master',['hide_sidebar' => true])

@section('content')
<div class="w-1/2 mx-auto">
    <h2 class="text-center pb-4 pt-3 text-red-500">Edit Article</h2>


    <!-- any = هر -->
    @if($errors->any())
        <div class="relative px-3 py-3 mb-4 border rounded bg-red-200 border-red-300 text-red-800">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- فرستادن دیتا ها به این پست -->
    {{--    توی فرم های ایجاد و ویرایش مقاله html ایجاد قابلیت آپلود فایل یا تصویر خصوصا از طرف      --}}
    <form action="/admin/articles/{{ $article->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-4">
            <lable for="title">title :</lable>
            <input type="text" name="title" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" value="{{ $article->title }}">
        </div>


        <div class="mb-4">
            <lablae for="">category :</lablae>
            {{--  برای ایجاد امکان انتخاب چند تایی = multiple  --}}
            {{--          مشخص می کند که دسته بندی ما آرایه هست و چند تا مقدار را می تواند بر گرداند => name="categories[]  --}}
            <select name="categories[]" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" multiple>
                {{--                <option value="1">laravel</option>--}}
                {{--                <option value="2">css</option>--}}

                {{--تمام دسته بندی ها را می گیرد = \App\Models\Category::all() --}}
                {{--  as category= با این پیمایش اش می کند --}}
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id , $article->categories()->pluck('id')->toArray()) ? 'selected' : '' }} >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>




        <div class="mb-4">
            <lable for="body">body :</lable>
            <textarea name="body" cols="30" rows="10" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600">{{ $article->body }}</textarea>
        </div>



        <div class="mb-4">
            <lable for="image">replace the previous image :</lable>
                {{--   asset()   =   شروع بشود ازش استفاده می کنیم public هر چیزی که از پوشه ی   --}}
                {{--   در صفحه ویرایش آرتیکل، اگه کاربر برای مقاله اش عکس بارگذاری گرد که همان را بجای عکس آرتیکل اش بگذار و در غیر این صورت هیچ عکسی را در صفحه ویرایش آرتیکل نشان نده (اما ما قبلا مشخص کردیم که عکس پیش فرض مقالات چی باشد و در نتیجه همان را نشان می دهد)      --}}
                @if(isset($article->image))
                    <div class="container flex flex-row mt-2">
                        <img class="flex w-11/12 rounded border border-solid border-blue-900 border-t-2 border-b-2 border-r-2 border-l-2" src="{{ asset($article->image) }}" alt="Card image cap">
                        {{--     دکمه ضربدر برای حذف تصویر مقاله در صفحه ویرایش اش     --}}
                        <a href="/admin/articles/remove-image/{{ $article->id  }}" class="flex w-1/12 h-full"><img src="/image/z1.png" alt="remove"></a>
                    </div>
                @endif
        </div>

        <input type="file" name="image" class="block appearance-none w-11/12 py-2 px-2 mt-2 mb-4 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600">
        <button class="w-2/12 h-full bg-green-800 hover:bg-green-900 hover:border-green-900 border-green-800 border border-solid font-normal inline-block no-underline px-3 py-0.5 rounded select-none text-center text-white mb-14">update</button>
        <a href="/admin/articles" class="w-2/12 h-full bg-red-700 hover:bg-red-800 hover:border-red-800 border-red-700 border font-normal inline-block ml-4 no-underline px-3 py-0.5 rounded select-none text-center text-white my-2">cancel</a>
    </form>

</div>
@endsection
