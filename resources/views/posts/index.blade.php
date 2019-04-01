@extends("layouts.app")

@section("content")
    <div>
        <h1>All Posts <a href="/posts/create" class="btn btn-info btn-lg float-right">Create Post</a></h1>
        <div class="clearfix"></div>
    </div>

    @if (count($posts) > 0)
        {{-- Loop Through Posts --}}
        @foreach ($posts as $post)
            <div class="card p-3 my-3">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%;height:300px" src="/storage/cover_images/{{$post->cover_image}}" alt="" class="img-responsive">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on <strong>{{$post->created_at}}</strong> by <strong>{{$post->user->name}}</strong></small>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Pagination --}}
        {{$posts->links()}}
    @else
        <p>No posts yet!</p>
    @endif

@endsection