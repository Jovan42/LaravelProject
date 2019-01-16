<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;

class CommentController extends Controller
{
    
    public function getById(Comment $id) 
    {
        $id['rate'] = [
            'likes' => count($id->rates->where('like', true)),
            'dislikes' =>count($id->rates->where('like', false))
        ];
        

        return response()->json($id, 200);
    }

    public function add(Post $post)
    {
        
        // TODO: uncomment
        //if(!Auth::check())    return response()->json("Unauthorized to add post", 401);
        $validator = Validator::make(request()->all(), [
            'text' => ['required', 'min:1'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 409);
        }
        $comment = request()->all();
       
        $comment['post_id']= $post->id;
        $comment['user_id'] = 1;

        
        $comment = Comment::create($comment);
        return response()->json($comment, 200);
    }

    public function edit(Comment $id)
    {
        $validator = Validator::make(request()->all(), [
            'text' => ['required', 'min:1']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 409);
        }

        $id->text = request()->text;
        $id->update();
        return response()->json($id, 200);
    }

    public function delete(Comment $id)
    {
        //if(Auth::check() == null)     return response()->json("Unauthorized to delete this user", 401);
        $id->deleted = true;
        $id->update();
        return response()->json("Successfully deleted", 200);
    }
}
