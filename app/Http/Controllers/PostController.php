<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth', ['except' => ['index']]);

    }

    public function index()
    {

        $posts = Post::orderBy('created_at', 'desc')->paginate(25);
        $tags = Tag::all();

        return view('index', ['posts' => $posts, 'tags' => $tags]);

    }

    public function create()
    {
        return view('user.createPost');
    }

    public function store(StorePostRequest $request)
    {

        $request->request->add(['user_id' => auth()->user()->id]);
        $imageName = Post::saveImage($request);

        Post::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect('/')->with('success','Post upload!');

    }

    public function destroy(Post $post)
    {

        Storage::delete('public/posts/'.$post->image);
        $post->delete();

        return back()->with('success','Post deleted');

    }

    public function posts()
    {

        $userPosts = Post::where('user_id','=',auth()->user()->id)->get();

        return view('user.profile',['userPosts' => $userPosts]);

    }
}
