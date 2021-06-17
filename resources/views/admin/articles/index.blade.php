<!-- farakhani master page -->
{{--  سایدبار را در صفحه آرتیکل ها مخفی می کند  --}}
@extends('layouts.'.$activeTheme,['hide_sidebar' => true])

@section('content')
<div class="w-10/12 mx-auto">

    <div class="flex pb-4 pt-6 w-full">
        <div class="w-1/7 h-auto"><h2>All Article</h2></div>
        <div class="w-1/6 h-auto"><a href="/admin/articles/create" class="w-1/2 h-full bg-green-400 hover:bg-green-500 hover:border-green-500 border-green-400 border font-normal inline-block ml-4 no-underline px-3 py-0.5 rounded select-none text-center text-white">create</a></div>
    </div>

    <table class="w-full max-w-full bg-transparent mb-11">
        <thead class="border-2 border-indigo-200 border-solid">
            <tr>
                <th>id</th>
                <th>title</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody class="border-2 border-indigo-200 border-dashed text-center">

            <!-- پاس بده foreach تک تک آرتیکل ها را به  -->
            @foreach($articles as $article)
                <!-- <tr>
                        <td>1</td>
                        <td>this is article 1</td>
                        <td><a href="#" class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-red-600 text-white hover:bg-red-700">delete</a></td>
                    </tr> -->

                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>

                    <td>
                        <a href="/admin/articles/{{ $article->id }}/edit" class="w-1/4 h-full bg-blue-400 hover:bg-blue-500 hover:border-blue-500 border-blue-400 border font-normal inline-block ml-4 no-underline px-3 py-0.5 rounded select-none text-center text-white my-2">edit</a>
                        <form action="/admin/articles/{{ $article->id }}" method="post" class="inline-block">
                            @csrf
                            @method('delete')
                            <button class="w-full h-full bg-red-400 hover:bg-red-500 hover:border-red-500 border-red-400 border border-solid font-normal inline-block ml-4 no-underline px-3 py-0.5 rounded select-none text-center text-white my-2">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>
</div>
@endsection
