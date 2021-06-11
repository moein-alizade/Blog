@foreach($comments as $comment)
    <div class="pl-8">
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('reply.add') }}">
            @csrf
            <div>
                <textarea id="body" name="body" rows="2" class="w-1/2 block appearance-none py-2 px-2 mt-2 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded hover:text-pink-600"></textarea>
                <input type="hidden" name="article_id" value="{{ $article_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div>
                <input type="submit" class="w-1/12 mt-4 h-full bg-red-300 hover:bg-red-400 hover:border-red-400 border-red-300 border border-solid font-normal inline-block no-underline px-3 py-0.5 rounded select-none text-center text-white mb-14" value="Reply" />
            </div>
        </form>
        @include('partials._comment_replies', ['comments' => $comment->replies])
    </div>
@endforeach
