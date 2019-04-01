@extends("layouts.app")

@section("content")
    <h1> 
        {{$post->title}} 
        <a href="/posts" class="btn btn-secondary float-right">Go Back</a>
    </h1>
    <div class="clearfix"></div>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="" class="img-responsive">
    <br><br>
    <div>
        {!! $post->body !!}
    </div>
    <hr>
    <small>Written on <strong>{{$post->created_at}}</strong> by <strong>{{$post->user->name}}</strong></small>
    <br>
    <hr>

    @if (!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <div>
                {{-- Delete --}}
                <form method="POST" action="{{ route("posts.destroy", $post->id) }}">
                    <div>
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger float-right">Delete</button>
                        <a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                    </div>
                    <div class="clearfix"></div>      
                </form>
            </div>
        @endif
    @endif

@endsection
