<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * Ensure user login
     */
    public function __construct()
    {
        $this->middleware("auth", ["except" => ["index", "show"]]);
    }

    /**
     * Home
     */
    public function index()
    {
        // $posts = DB::select("SELECT * FROM posts");
        // $posts = Post::orderBy("created_at", "desc")->take(1)->get();

        $posts = Post::orderBy("created_at", "desc")->paginate(5);
        return view("posts.index")->with("posts", $posts);
    }

    /**
     * Create Post
     */
    public function create()
    {
        return view("posts.create");
    }

    /**
     * Save post to Db
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "body" => "required",
            "cover_img" => "image|nullable|max:1999"
        ]);

        // Handle file upload
        if($request->hasFile("cover_img"))
        {
            // Get filename with ext
            $filenameWithExt = $request->file("cover_img")->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file("cover_img")->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename."_".time().".".$extension;
            // Upload Image
            $path = $request->file("cover_img")->storeAs("public/cover_images", $fileNameToStore);
        } 
        else
        {
            $fileNameToStore = "noimage.jpg";
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect("posts")->with("success", "Post Created");

    }

    /**
     * Get Specific Post
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view("posts.show")->with("post", $post);
    }

    /**
     * Edit Post
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id != $post->user_id)
        {
            return redirect("/posts")->with("error", "Unauthorized Access!");
        }

        return view("posts.edit")->with("post", $post);
    }

    /**
     * Update a post
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title" => "required",
            "body" => "required",
            "cover_img" => "image|nullable|max:1999"
        ]);

        // Handle file upload
        if($request->hasFile("cover_img"))
        {
            // Get filename with ext
            $filenameWithExt = $request->file("cover_img")->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file("cover_img")->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename."_".time().".".$extension;
            // Upload Image
            $path = $request->file("cover_img")->storeAs("public/cover_images", $fileNameToStore);
        }

        // Create Post
        $post = Post::find($id);
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        if($request->hasFile("cover_img"))
        {$post->cover_image = $fileNameToStore;}
        $post->save();

        return redirect("posts")->with("success", "Post Updated");
    }

    /**
     * Delete Post
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id != $post->user_id)
        {
            return redirect("/posts")->with("error", "Unauthorized Access!");
        }

        // Check for image
        if ($post->cover_image != "noimage.jpg")
        {
            // Delete Image
            Storage::delete("public/cover_images/".$post->cover_image);
        }

        $post->delete();
        return redirect("posts")->with("success", "Post Deleted!");
    }
}
