{{--  را که مقدارش برابر با درست می فرستد و می خواهد سایدبار مخفی شود $hide_sidebar یعنی به لایه مستر، متغیر   --}}
@extends('layouts.'.$activeTheme,['hide_sidebar' => true])
@section('content')
<html>
<head>
    <title>Registeration Form</title>
</head>
<body>

<div class="w-1/3 mx-auto">
        <div>
            @if(Session::has('success'))
                <div class="p-60 mb-80 border-2 border-solid border-transparent rounded-3xl colors.green.400 bg-green-200 border-red-200">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>

        <form method="POST" action="{{ route('store') }}">
            @csrf

                    <h2 class="text-center pb-4 pt-3 text-red-500">User Registry</h2>

            <div class="flex flex-col col-6 p-4">
                <div class="mb-4">
                    <label>* first name :</label>
                    <input type="text" name="first_name" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 hover:text-blue-500 rounded hover:text-pink-600" id="first_name" placeholder="3<characters<50">
                    @error('first_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label>* last name :</label>
                    <input type="text" name="last_name" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 hover:text-blue-500 rounded hover:text-pink-600" id="last_name" placeholder="3<characters<50">
                    @error('last_name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>* email :</label>
                    <input type="text" name="email" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" id="email" placeholder="your_email@info.com">
                    @error('email')
                        <span class="text-red-500">{{  $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>* password :</label>
                    <input type="password" name="password" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" id="password" placeholder="[a-z]+[A-Z]+[0-9]+[~!@#$%%^&*()] & min=6">
                    @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>* password_confirmed :</label>
                    <input type="password" name="password_confirmed" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" id="password_confirmed" placeholder="repeat password">
                    @error('password_confirmed')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>


                    <button class="w-2/12 h-full bg-green-600 hover:bg-green-700 hover:border-green-700 border-green-600 border border-solid font-normal inline-block no-underline py-0.5 rounded select-none text-center text-white mb-14">register</button>
            </div>
        </form>
</div>

</body>
</html>
@endsection
