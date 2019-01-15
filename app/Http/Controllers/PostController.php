<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Tag;
use App\PostsTags;

class PostController extends Controller
{
    public function getForUser()
    {
        $user = User::where('email', request()->email)->first();
        if($user == null)   return response()->json("User does not exist", 404);
        
        $posts = $user->posts::where('deleted', false);
        foreach ($posts as  $post) {
            $post->category;
            $post->tags;
        }

        return response()->json($posts, 200);
    }

    public function getById(Post $id = Post) 
    {
        $id->category;
        $id->tags;

        return response()->json($id, 200);
    }

    public function getAll() 
    {
        $posts = Post::all()->where('deleted', 0);
        foreach ($posts as  $post) {
            $post->category;
            $post->tags;
        }

        return response()->json($posts, 200);
    }

    public function delete(Post $id = Post)
    {
        if(Auth::check() == null)     return response()->json("Unauthorized to delete this user", 401);
        $id->deleted = true;
        $id->update();
        return response()->json("Successfully deleted", 200);
    }


    public function add()
    {
        // TODO: uncomment
        //if(!Auth::check())    return response()->json("Unauthorized to add post", 401);
        $validator = Validator::make(request()->all(), [
            'title' => ['required', 'min:6'],
            'body' => ['required'],
           
        ]);
        if ($validator->fails()) {    
            return response()->json($validator->errors()->messages(), 409);
        }
        $post = request()->all();
      
        $post = Post::create($post);
        return response()->json($post, 200);
    }

    public function edit(Post $id)
    {   
        $validator = Validator::make(request()->all(), [
            'title' => ['min:6'],           
        ]);

        if ($validator->fails()) {    
            return response()->json($validator->errors()->messages(), 409);
        }

      
        $id->title = request()->title;
        $id->body = request()->body;
        $id->category_id = request()->category_id;
      
        $id->update();
        return response()->json($id, 200);
    }

    public function getWithCategory(Category $id)
    {
        return response()->json($id->posts, 200);
      
    }

    public function getWithTag(Tag $id)
    {
        return response()->json($id->posts, 200);
      
    }

    public function addTag(Post $id) {
        $tagId =  request()->tagId;
        
        $pt = [
            'post_id' => $id->id,
            'tag_id' => $tagId    
        ];
        PostsTags::create($pt);
    }

    public function removeTag(Post $id)
    {
        $tagId =  request()->tagId;
        $pt = PostsTags::where('post_id', $id->id)->where('tag_id', $tagId)->delete();
    }
}
