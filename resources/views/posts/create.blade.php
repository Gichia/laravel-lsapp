@extends("layouts.app")

@section("content")
    <h1> 
        Create Post 
        <a href="/posts" class="btn btn-secondary float-right">Cancel</a>
    </h1>
    <div class="clearfix"></div>

    <form method="POST" action="{{ route("posts.store") }}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="article-ckeditor" cols="30" rows="6" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <input type="file" name="cover_img">
        </div>
        <button type="submit" class="btn btn-success btn-lg">Publish</button>
    </form>

@endsection
