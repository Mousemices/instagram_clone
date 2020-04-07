<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{

    public function index()
    {

        $posts = Tag::findOrFail(request('tag'))->posts()->paginate(20);
        $tags = Tag::all();
        $tagName = DB::table('tags')->where('id', request('tag'))->value('title');
        $comments = Comment::where('description','like','%'.$tagName.'%')->get();

        return view('specificPostsWithTag', [
            'posts' => $posts, 'tags' => $tags,
            'tagName' => $tagName, 'comments' => $comments
        ]);

    }



}
