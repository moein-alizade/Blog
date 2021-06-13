{{--  سایدبار را در صفحه آرتیکل ها مخفی می کند  --}}
@extends('layouts.master',['hide_sidebar' => true])

@section('content')
    <!DOCTYPE html>
    <html class="box-border">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

    <div class="p-3.5 text-center text-white bg-blue-500">
        <h1>About Us Page</h1>
        <p>In this personal blog. articles on</p>
        <p> Laravel topics,technology,education,entertainment,etc are published.</p>
    </div>

    <h2 class="text-center mt-2 mb-2">Our Team</h2>
    <div class="flex flex-row justify-center">
        <div class="w-1/3 mb-6 pl-3 pr-3 text-left">
            <div class="m-3 shadow-md">
                <img src="/image/user1.jpg" alt="Fateme" class="w-full">
                <div class="text-center text-green-450">
                    <h2>Fateme Jafarinejad</h2>
                    <p>Project Manager</p>
                    <p>PhD Artificial Intelligence</p>
                    <p>jafarinejad@shahroodut.ac.ir</p>
                </div>
            </div>
        </div>
        <div class="w-1/3 mb-6 pl-3 pr-3 text-left">
            <div class="m-3 shadow-md">
                <img src="/image/user2.jpg" alt="Moein" class="w-full">
                <div class="text-center text-green-450">
                    <h2>Moein Alizade</h2>
                    <p>Web Developer</p>
                    <p>Bachelor Information Technology</p>
                    <p>m.alizade58010@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

    </body>
    </html>

@endsection


@section('sidebar')
    @parent
@endsection
