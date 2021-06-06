@extends('layouts.master',['hide_sidebar' => true])

@section('content')
<div class="container mx-auto sm:px-4 pt-10 pb-44">
    <div class="flex w-full justify-center">
        <div class="w-1/2 pr-4 pl-4 mt-14">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
                <div class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">{{ __('Login') }}</div>

                <div class="flex-auto p-6">

                    {{--  چه روت ها و اسامی داریم بعدش آن اسمی که با این هماهنگ باشه را می گیرد واون آدرس مسیر را اینجا قرار می دهد  web.php یعنی میاد توی  action="{{ route('contact') }}"  --}}
                    {{--   <form method="POST" action="{{ route('contact') }}">--}}

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4 flex w-full">
                            <label for="email" class="md:w-1/3 pr-11 pt-2 pb-2 mb-0 leading-normal md:text-right">{{ __('Email') }}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input id="email" type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded @error('email') bg-red-700 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="hidden mt-1 text-sm text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 flex w-full">
                            <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal md:text-right">{{ __('Password') }}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input id="password" type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded @error('password') bg-red-700 @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="hidden mt-1 text-sm text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 flex w-full pl-28">
                            <div class="relative block mb-2 pl-4">
                                <input class="absolute mt-1.5 ml-1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="text-gray-700 mb-0 pl-6" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-4 flex w-full pl-9 mb-0">
                            <div class="w-full pl-20">
                                <button type="submit" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 ml-4 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline font-normal text-blue-700 bg-transparent" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
