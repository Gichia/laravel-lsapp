@extends("layouts.app")

@section("content")
    <h1> 
        Edit Post 
        <a href="/posts" class="btn btn-secondary float-right">Cancel</a>
    </h1>
    <div class="clearfix"></div>
    
    <form method="POST" action="{{ route("posts.update", $post->id) }}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            @method("PUT")
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{$post->title}}"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="article-ckeditor" cols="30" rows="6" class="form-control">{{$post->title}}</textarea>
        </div>
        <div class="form-group">
            <input type="file" name="cover_img">
        </div>
        <button type="submit" class="btn btn-warning">Edit Post</button>
    </form>

@endsection
