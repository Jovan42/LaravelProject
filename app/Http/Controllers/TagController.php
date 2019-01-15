<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class TagController extends Controller
{
    public function getById(Tag $id = tag)
    {
        if($id->deleted)     return response()->json("Tag does not exist", 404);
        $id->posts;

        return response()->json($id, 200);
    }

    public function getAll()
    {
        $tags = Tag::all()->where('deleted', 0);

        return response()->json($tags, 200);
    }

    public function delete(Tag $id)
    {
        /*if (Auth::check() == null) {
            return response()->json('Unauthorized to delete this tag', 401);
        }*/
        $id->deleted = true;
        $id->update();
        return response()->json('Successfully deleted', 200);
    }

    public function add()
    {
        // TODO: uncomment
        //if(!Auth::check())    return response()->json("Unauthorized to add post", 401);
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'min:1'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 409);
        }
        $tag = request()->all();

        $tag = Tag::create($tag);
        return response()->json($tag, 200);
    }

    public function edit(Tag $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => ['min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 409);
        }

        $id->name = request()->name;
        $id->update();
        return response()->json($id, 200);
    }
}