@extends('layouts.master')

@section('content')
    <h2>About Page</h2>
    <!-- /.row -->

@endsection

@section('sidebar')
    @parent
    <!-- Side Widget -->
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 my-4">
        <h5 class="py-3 px-6 mb-0 bg-gray-200 border-b-1 border-gray-300 text-gray-900">About Widget</h5>
        <div class="flex-auto p-6">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
    </div>
@endsection