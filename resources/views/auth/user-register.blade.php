@extends('layouts.master')
@section('content')
<html>
<head>
    <title>Registeration Form</title>
</head>
<body>

<div class="w-2/3 mx-auto">
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
                    <label>Name :</label>
                    <input type="text" name="name" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 hover:text-blue-500 rounded hover:text-pink-600" id="name">
                    @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Email :</label>
                    <input type="text" name="email" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" id="email">
                    @error('email')
                        <span class="text-red-500">{{  $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Password :</label>
                    <input type="password" name="password" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" id="password">
                </div>

                <div class="mb-4">
                    <label>Confirm Password :</label>
                    <input type="password" name="passwordconfirm" class="block appearance-none w-full py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600" id="passwordconfirm">
                </div>


                    <button class="w-2/12 h-full bg-green-600 hover:bg-green-700 hover:border-green-700 border-green-600 border border-solid font-normal inline-block no-underline px-3 py-0.5 rounded select-none text-center text-white mb-14">register</button>
            </div>
        </form>
</div>

</body>
</html>
@endsection
