<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostsTags extends Model
{
    protected $fillable = [
        'post_id',
        'tag_id'
     ];
}
