<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ApiPostController extends Controller
{
    public function create(PostRequest $request,$id)
    {
        $user = User::where('id',$id)->first();
        if(!$user){
            return response()->json([
                'status' => 'error',
                'message_error' => 'Invalid user_id'
            ]);
        }
            $post = Post::create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => $id,
            'date' => date("d.m.y"),
        ]);

        return new PostCollection([$post]);
    } 


    // public function getPost(Request $request)
    // {
    //     if($request->id)
    //     {
    //         $post = Post::where('id',$request->id)->first();
    //         return response()->json($post);
    //     }else{
    //         $posts = Post::all();
    //         return response()->json($posts);
    //     }
    // }
}
