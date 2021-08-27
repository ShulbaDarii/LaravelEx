<?php

namespace App\Http\Controllers;

use App\Models\Commentar;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments =Commentar::all();

        return view('comment.index',[
            'commentars' => $comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id=0;
        if(Auth::user()){
            $user_id=Auth::user()->id;
        }
        $comment = Commentar::create([
            'text' => $request->get('comment'),
            'status' => 0,
            'post_id'=> $request->get('post_id'),
            'user_id' => $user_id,
            'date' => date("d.m.y") 
         ]);
 
         if(!$comment){
             return redirect()->back();
         }
 
        $request->session()->flash('flash_message','Post is saved');
        return redirect()->route('post.index');
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
    public function edit(Commentar $comment)
    {
        return view('comment.update',[
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentar $comment)
    {
        $comment->fill($request->all());
        if($request->get('status')==='0'){
            $comment->status =1;
        } 
        
        if(!$comment->save()){
            return redirect()->back();
        }

       $request->session()->flash('flash_message','Comment is update');
       return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Commentar $comment)
    {
        if($comment->delete()){
            $request->session()->flash('flash_message','Comment is delete');
            return redirect()->route('comment.index');
        }else{
            return redirect()->back();
        }
    }
}
