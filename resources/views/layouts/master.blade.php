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
    <div class="md:w-2/3 pr-4 pl-4">
        @yield('content')

    </div>

    <!-- Sidebar Widgets Column -->
        <div class="md:w-1/3 pr-4 pl-4 py-10">
            @section('sidebar')
                @include('layouts.sidebar')
            @show
        </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
    @include('layouts.footer')


</body>

</html>
