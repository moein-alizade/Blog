<!-- Side Widget -->
<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300">
    <h5 class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">Clock Widget</h5>
    <div class="flex-auto p-6">
        <div class="3/12 flex items-center">
            {{--     Clock Widget with Javascript       --}}
            <div id="ClockDisplay" class="w-1/2 h-full bg-blue-400 border-blue-400 border border-solid rounded-tl-full rounded-br-full text-white mx-auto text-lg text-center"></div>
            <script type="text/javascript">
                function ShowTime()
                {
                    var date = new Date();
                    var h = date.getHours();
                    var m = date.getMinutes();
                    var s = date.getSeconds();
                    var session = "AM";
                    if(h == 0){
                        h = 12;
                    }
                    if(h > 12){
                        h = h - 12;
                        session = "PM";
                    }
                    h = (h < 10) ? "0" + h : h;
                    m = (m < 10) ? "0" + m : m;
                    s = (s < 10) ? "0" + s : s;
                    var time = h + ":" + m + ":" + s + " " + session;
                    document.getElementById('ClockDisplay').innerText = time;
                    document.getElementById('ClockDisplay').textContent = time;
                    setTimeout(ShowTime , 1000);
                }
                ShowTime();
            </script>
        </div>
    </div>
</div>


<!-- Categories Widget -->
<div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 my-4">
<h5 class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">Categories</h5>
<div class="flex-auto p-6">
<div class="flex flex-wrap ">
    <div class="lg:w-1/2 pr-4 pl-4">
    <ul class="list-unstyled mb-0">
        {{--    گرقتن دسته بندی ها بصورت پویا یا داینامیک از دیتابیس    --}}
        @foreach(\App\Models\Category::take(3)->latest('updated_at')->get() as $category)
            <li><a href="/categories/{{ $category->name }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
    </div>
    <div class="lg:w-1/2 pr-4 pl-4">
    <ul class="list-unstyled mb-0">
        @foreach(\App\Models\Category::skip(3)->take(3)->latest('updated_at')->get() as $category)
            <li><a href="/categories/{{ $category->name }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
    </div>
</div>
</div>
</div>
