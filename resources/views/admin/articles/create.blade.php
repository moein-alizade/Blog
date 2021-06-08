<!-- farakhani master page -->
@extends('layouts.master',['hide_sidebar' => true])

@section('content')
<div class="w-1/2 mx-auto">
    <h2 class="text-center pb-4 pt-3 text-red-500">Create Article</h2>


    {{--    نمایش خطا ها   --}}
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

    {{--    توی فرم های ایجاد و ویرایش مقاله html ایجاد قابلیت آپلود فایل یا تصویر خصوصا از طرف      --}}
    <form action="/admin/articles" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <lable for="title">title :</lable>
            <input type="text" name="title" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600">
        </div>

        <div class="mb-4">
            <lablae for="">category :</lablae>
    {{--  برای ایجاد امکان انتخاب چند تایی = multiple  --}}
    {{--          مشخص می کند که دسته بندی ما آرایه هست و چند تا مقدار را می تواند بر گرداند => name="categories[]  --}}
            <select name="categories[]" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" multiple>
    {{--                <option value="1">laravel</option>--}}
    {{--                <option value="2">css</option>--}}

    {{--    تمام دسته بندی ها را می گیرد = \App\Models\Category::all() --}}
    {{--    as category = توسط این پیمایش اش می کند --}}
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>



        <div class="mb-4">
            <lable for="body">body :</lable>
            <textarea name="body" cols="30" rows="10" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600"></textarea>
        </div>



        <div class="mb-4">
            <lable for="image">upload a new image :</lable>
            <input type="file" name="image" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600">
        </div>



        <button class="w-2/12 h-full bg-green-600 hover:bg-green-700 hover:border-green-700 border-green-600  border  border-solid font-normal inline-block  no-underline px-3 py-0.5 rounded select-none text-center text-white mb-14">send</button>
        <a href="/" class="w-2/12 h-full bg-red-700 hover:bg-red-800 hover:border-red-800 border-red-700 border font-normal inline-block ml-4 no-underline px-3 py-0.5 rounded select-none text-center text-white my-2">cancel</a>
    </form>
</div>
@endsection
