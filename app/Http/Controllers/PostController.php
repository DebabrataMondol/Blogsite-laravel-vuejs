<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Auth;
use Image;

class PostController extends Controller
{

    public function viewPost()
    {
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts'=>$posts
        ],200);
    }

    public function savePost(Request $request){
        $this->validate($request,[
            'title'=>'required|min:2|max:100',
            'description'=>'required|min:2'
        ]);

        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(200, 200);
        $upload_path = public_path()."/uploadimage/";
        $img->save($upload_path.$name);
        $post = new Post();
        $post->title = $request->title;
        $post->description= $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return response()->json([
            'post'=>$post
        ],200);
    }
    public function updatePost($id,Request $request){
        $post = Post::find($id);

        $this->validate($request,[
            'title'=>'required|min:2|max:100',
            'description'=>'required|min:2'
        ]);



        if ($request->photo!=$post->photo){
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(200, 200);
            $upload_path = public_path()."/uploadimage/";
            $photo = $upload_path.$post->photo;
            $img->save($upload_path.$name);
            if (file_exists($photo)){
                @unlink($photo);
            }
        }else{
            $name = $post->photo;
        }
        $post->title = $request->title;
        $post->description= $request->description;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }
    public function deletePost($id)
    {
        $post = Post::find($id);
        $photo_path = public_path()."/uploadImage/";
        $photo =$photo_path.$post->photo;
        if (file_exists($photo)){
            @unlink($photo);
        }
        $post->delete();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
