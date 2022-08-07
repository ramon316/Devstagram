<div>
    @if($posts->count())
    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
        @foreach ($posts as $post)
            <div>
                <a href="{{ route('posts.show', ['post'=>$post, 'user'=> $post->user])}}">
                    <img src="{{ asset('uploads'). '/' .$post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                </a>
            </div>
        @endforeach
    </div>
    <div class="my-5">
    {{$posts->links()}}
    </div>
@else
    <h1>No hay posts</h1>
@endif
</div>