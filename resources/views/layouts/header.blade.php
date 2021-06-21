<nav class="relative flex flex-wrap items-center content-between px-4 text-white bg-gray-900 top-0">
    <div class="container mx-auto sm:px-4">
      <div class="flex row justify-end w-full" id="navbarResponsive">
          <div class="w-3/12 h-1/6 ml-9">
              <a href="/"><img src="/image/mlogo2.png" id="mlogo" class="w-1/4"></a>
          </div>

          <div class="w-9/12 h-1/6 pt-5">
                  <ul class="flex flex-row-reverse">
                      <li>
                          <a class="inline-block py-2 px-4 no-underline" href="/registery">register</a>
                      </li>
                      <li>
                          <a class="inline-block py-2 px-4 no-underline" href="/">home</a>
                      </li>
                      <li>
                          <a class="inline-block py-2 px-4 no-underline" href="/admin/articles">articles</a>
                      </li>

                      <li>
                          <a class="inline-block py-2 px-4 no-underline" href="/about">about</a>
                      </li>
                      <li>
                          <a href="{{   route('theme')   }}" class="text-green-450 inline-block py-2 px-4 no-underline">{{   $activeTheme   }}</a>
                      </li>
                  </ul>
          </div>



          @if(auth()->check())
              <a href="/admin/articles" class="w-1/12 h-1/6 mt-7 bg-blue-400 hover:bg-blue-500 hover:border-blue-500 border-blue-400 border border-solid  font-normal inline-block ml-1 no-underline rounded-lg select-none text-center text-white my-2">{{ auth()->user()->first_name }}</a>
          {{--   helper-function = route('')       --}}
              <form action="{{ route('logout') }}" method="post" class="h-1/6">
                  @csrf
                  <button type="submit" class="w-10/12 h-1/6 mt-7 bg-red-400 hover:bg-red-500 hover:border-red-500 border-red-400 border border-solid font-normal inline-block ml-2.5 my-2 no-underline px-2 rounded-lg text-center text-white">logout</button>
              </form>
          @else
              <a href="{{ route('login') }}" class="w-1/13 h-1/6 mt-5 bg-green-800 hover:bg-green-900 hover:border-green-900 border-green-800 border border-solid font-normal inline-block no-underline px-3 py-1.5 rounded-lg select-none text-center text-white">login</a>
          @endif


      </div>
    </div>
  </nav>
