<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        return view('posts', compact('posts'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxLike(Request $request)
    {
        $post = Post::find($request->id);
        $response = auth()->user()->toggleLikeDislike($post->id, $request->like);

        return response()->json(['success' => $response]);
    }
}
