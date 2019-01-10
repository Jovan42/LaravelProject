<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentRate extends Model
{
    public function comment()
    {
        return $this->belongsto(Comment::class);
    }
}
