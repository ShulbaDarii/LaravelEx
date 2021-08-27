@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12 mt-1 pt-3 pl-3 border border-success rounded text-right">
        <p>Name: {{ $post->user->name }} &nbsp; Email: {{ $post->user->email }}</p>
    </div>
    <div class="col-md-12 mt-1 pt-3 pl-3 border border-success rounded">
        <h4>{{ $post->title }}</h4>
        <p>{{ $post->body }}</p>
    </div>
    <div class="col-md-12 d-flex justify-content-end">
        <p>Date: {{ $post->date }}</p>
    </div>


    @if(Auth::user() && Auth::user()->hasRole('admin'))
    <div class="row d-flex justify-content-end">
        <div class="col-md-4-flex justify-content-end">
            <a href="{{ route('post.edit',$post->id) }}" class="btn btn-success">Edit</a>
        </div>
        <div class="col-md-6 justify-content-end">
            <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                {{ csrf_field() }}
                @method('delete')
                <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
    </div>
    @endif
    @if (!(Auth::user() && Auth::user()->id == $post->user_id))
    <div class="row d-flex justify-content-center">
        <div class="col-md-10 border border-primary mt-5 p-3 rounded" style='background-color: rgb(225 255 255)'>
            <form action="{{ route('comment.store') }}" method='POST' class="d-flex flex-column">
                {{ csrf_field() }}
                <label for="comment">Write your comment.</label>
                <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
                <input type="text" id="post_id" name="post_id" value="{{$post->id}}" class="invisible">
                <input type="submit" value="Add" class="btn btn-primary align-self-end mt-2" style="width:100px">
            </form>
        </div>
    </div>
    @endif
    @if (count($post->commentars))
        @foreach($post->commentars as $commentar)
            @if($commentar->status)
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 border border-primary mt-5 p-3 rounded" style='background-color: rgb(225 255 255)'>
                    <p>Name: {{$commentar->user->name}}</p>
                    <p>{{$commentar->text}}</p>
                    <p class="text-right">Date: {{ $post->date }}</p>
                </div>
            </div>
            @endif
        @endforeach
    @endif 

</div>


@endsection