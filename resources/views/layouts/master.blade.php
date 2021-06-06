<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Home - Start Bootstrap Template</title>


  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="/css/app.css">
</head>

<body>

  <!-- Navigation -->
    @include('layouts.header')

  <!-- Page Content -->
  <div class="container mx-auto sm:px-4">

    <div class="flex flex-wrap ">

    <!-- Blog Entries Column -->

    {{--   اگه متغیر سایدبار وجود داشت و نیز مقدارش برابر با درست بود آنگاه عرض بلاگ را 100 درصد بگذار و در غیر این صورت عرض را برابر با 2/3 بگذار    --}}
    <div class="{{isset($hide_sidebar) && $hide_sidebar == true ? 'w-full' : 'md:w-2/3'}} pr-4 pl-4">
        @yield('content')
    </div>

    <!-- Sidebar Widgets Column -->
    {{--   isset()    آیا همچنین متغیری تعریف شده یا نه --}}
    {{--      اگه متغیر سایدبار وجود نداشت یا مقدارش برابر با غلط بود آنگاه سایدبار را نشان بده  --}}
        @if(!isset($hide_sidebar) || $hide_sidebar != true)
        <div class="md:w-1/3 pr-4 pl-4 py-10">
            @section('sidebar')
                @include('layouts.sidebar')
            @show
        </div>
        @endif

    <!-- /.row -->

    </div>
  </div>
  <!-- /.container -->

  <!-- Footer -->
    @include('layouts.footer')


</body>

</html>
