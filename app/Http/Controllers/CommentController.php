<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Helpers\Helper;
use App\Http\Requests\StoreCommentRequest;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreCommentRequest $request, Post $post)
    {

        Helper::insertTagsIfHaveSharpSymbol($request->description);
        $request->request->add(['user_id' => auth()->user()->id]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $request->user_id,
            'description' => $request->description
        ]);

        return back()->with('success','Comment added!');

    }

    public function show(Comment $comment)
    {
        //
    }


    public function edit(Comment $comment)
    {
        //
    }


    public function update(Request $request, Comment $comment)
    {
        //
    }


    public function destroy(Comment $comment)
    {

        if($this->authorize('adminOrOwner', $comment)){
            $comment->delete();
            return back()->with('success', 'Comment eliminated');
        }

        return back();

    }
}
