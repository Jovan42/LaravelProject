<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsto(User::class);
    }
    public function post()
    {
        return $this->belongsto(Post::class);
    }
    public function replayed()
    {
        return $this->belongsto(Comment::class);
    }
    public function replays()
    {
        return $this->hasMany(Comment::class);
    }
    public function rates()
    {
        return $this->hasMany(Rates::class);
    }
}
