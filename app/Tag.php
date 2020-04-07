<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['post_id', 'user_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

}
