<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function getById(Category $id = tag)
    {
        if($id->deleted)     return response()->json("Category does not exist", 404);
        $id->posts;

        return response()->json($id, 200);
    }

    public function getAll()
    {
        $categories = Category::all()->where('deleted', 0);

        return response()->json($categories, 200);
    }

    public function delete(Category $id)
    {
        /*if (Auth::check() == null) {
            return response()->json('Unauthorized to delete this category', 401);
        }*/
        $id->delete();
        return response()->json('Successfully deleted', 200);
    }

    public function add()
    {
        // TODO: uncomment
        //if(!Auth::check())    return response()->json("Unauthorized to add category", 401);
        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'min:1'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->messages(), 409);
        }
        $category = request()->all();

        $category = Category::create($category);
        return response()->json($category, 200);
    }

    public function edit(Category $id)
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

    public function getForPost(Post $id)
    {
        return response()->json($id->category, 200);
    }
}
