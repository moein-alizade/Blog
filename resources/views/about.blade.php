{{--        {{   dd($activeTheme)   }}      --}}
{{--        @dd($activeTheme)       --}}

{{--  سایدبار را در صفحه آرتیکل ها مخفی می کند  --}}
@extends('layouts.'.$activeTheme,['hide_sidebar' => true, 'full' => true])

{{--    محتوای مثال آشپزخانه    --}}
@section('content')


    <div class="p-3.5 text-center text-white bg-blue-500 mb-6 w-full">
        <h1>About Us Page</h1>
        <p>In this personal blog. articles on</p>
        <p> Laravel topics,technology,education,entertainment,etc are published.</p>
    </div>

    <h2 class="text-center mt-2 mb-2">Our Team</h2>
    <div class="flex flex-row justify-center">
        <div class="w-1/3 mb-6 pl-3 pr-3 text-left">
            <div class="m-3 shadow-2xl">
                <img src="/image/user1.jpg" alt="Fateme" class="w-full">
                <div class="text-center text-black text-sm my-2 pb-3">
                    <h2>Fateme Jafarinejad</h2>
                    <p>Project Manager</p>
                    <p>PhD Artificial Intelligence</p>
                    <a href="mailto:jafarinejad@shahroodut.ac.ir"><img src="/image/email.png" class="w-1/12 mx-auto" alt="email"></a>
                </div>
            </div>
        </div>
        <div class="w-1/3 mb-6 pl-3 pr-3 text-left">
            <div class="m-3 shadow-2xl">
                <img src="/image/user2.jpg" alt="Moein" class="w-full">
                <div class="text-center text-black text-sm my-2 pb-3">
                    <h2>Moein Alizade</h2>
                    <p>Web Developer</p>
                    <p>Bachelor Information Technology</p>
                    <a href="mailto:m.alizade58010@gmail.com"><img src="/image/email.png" class="w-1/12 mx-auto" alt="email"></a>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('sidebar')
    @parent
@endsection
