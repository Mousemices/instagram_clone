<?php

namespace App\Observers;

use App\Post;

class PostObserver
{

    public function saved(Post $post)
    {
        $description = $post->description;

        $newPost = new Post();
        $tagsId = $newPost->insertTagsIfHaveSharpSymbol($description);

        $post->tags()->attach($tagsId);

    }

}
