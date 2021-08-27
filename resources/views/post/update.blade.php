@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('partial.error')
        </div>
        <div class="offset-md-4 col-md-8">
            <form method="post" action="{{ route('post.update', $post->id) }}">
                {{ csrf_field() }}
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    <label for="body">Text</label>
                    <textarea id="body" name="body" cols="30" row="5" class="form-control">{{ $post->body }}</textarea>
                </div>
                <div class="row d-flex justify-content-end">
                <div class="form-group">
                    @if($post->status)
                        <input type="checkbox" class="form-check-input" id="status" name="status" checked value="{{ $post->status }}">
                    @else
                        <input type="checkbox" class="form-check-input" id="status" name="status" value="{{ $post->status }}">
                    @endif
                    <label class="form-check-label" for="status">Status</label>
                <input type="submit" value="submit" class="btn btn-success">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection