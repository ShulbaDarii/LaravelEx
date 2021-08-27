@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('partial.error')
        </div>
        <div class="offset-md-4 col-md-8">
            <form method="post" action="{{ route('comment.update', $comment->id) }}">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="body">Text</label>
                    <textarea id="body" name="body" cols="30" row="5" class="form-control">{{ $comment->text }}</textarea>
                </div>
                <div class="row d-flex justify-content-end">   

                <div class="form-group">
                    @if($comment->status)
                        <input type="checkbox" class="form-check-input" id="status" name="status" checked value="{{ $comment->status }}">
                    @else
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="{{ $comment->status }}">
                    @endif
                    <label class="form-check-label" for="status">Status</label>
                </div>
                </div>
                <div class="row d-flex justify-content-end">   
                <input type="submit" value="update" class="btn btn-success" style="margin-right:20px">
            </form>
            <form action="{{ route('comment.destroy',$comment->id) }}" method="POST">
                        {{ csrf_field() }}
                        @method('delete')
                    <input type="submit" value="Delete" class="btn btn-danger">
            </form>
        </div>
        </div>
    </div>
</div>
    
@endsection