@extends("layouts.app")

@section("content")
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This is a website from "Laravel Framework" youtube series</p> 
        @if(Auth::guest())
            <p><a href="/login" class="btn btn-primary btn-lg">Login</a> <a href="/register" class="btn btn-secondary btn-lg">Sign Up</a></p>
        @endif
    </div>  
@endsection

