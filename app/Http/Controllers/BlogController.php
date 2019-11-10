<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;


class BlogController extends Controller
{
    public function getBlogPost()
    {
        $blogPost = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'blogPost'=>$blogPost

        ],200);
    }
    public function getSiglePost($id)
    {
        $singlePost = Post::with('user','category')->where('id',$id)->first();
        return response()->json([
            'singlePost'=>$singlePost
        ],200);
    }
    public function allCategory()
    {
        $allCategory = Category::all();
        return response()->json([
            'allCategory'=>$allCategory
        ],200);
    }
    public function caregories($id)
    {
        $posts = Post::with('user','category')
            ->where('category_id',$id)
            ->orderBy('id','desc')->get();
        return response()->json([
            'posts'=>$posts
        ],200);
    }
    public function searchPost()
    {
        $search = \Request::get('s');
        $posts = Post::with('user','category')
            ->where('title','LIKE',"%$search%")
            ->orWhere('description','LIKE',"%$search%")
            ->orderBy('id','desc')
            ->get();
        return response()->json([
            'posts'=>$posts
        ],200);

    }

}
