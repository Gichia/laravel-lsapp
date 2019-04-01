@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-header">Dashboard</h2>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="mb-4">
                        Your Blog Posts
                        <a href="posts/create" class="btn btn-info float-right">Create New Post</a>
                    </h3>
                    <div class="clearfix"></div>

                    @if (count($posts) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach ($posts as $post)
                                <tr>
                                    <td> {{$post->title}} </td>
                                    <td> <a class="btn btn-warning" href="posts/{{$post->id}}/edit">Edit</a> </td>
                                    <td> 
                                        <form method="POST" action="{{ route("posts.destroy", $post->id) }}">
                                            <div>
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>     
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table> 
                    @else
                        <p>
                            You have no posts yet!
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
