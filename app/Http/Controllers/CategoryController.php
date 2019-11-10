<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function saveCategory(Request $request)
    {
        $this->validate($request,[
           'category_name'=>'required|min:2|max:50'
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        return ['message'=>'Save Successfully'];
    }
    public function viewCategory()
    {
        $categories = Category::all();
        return response()->json([
           'categories'=>$categories
        ],200);
    }
    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
    }
    public function editCategory($id){
        $category = Category::find($id);
        return response()->json([
            'category'=> $category
        ],200);
    }
    public function updateCategory($id,Request $request){
        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->save();

    }
}
