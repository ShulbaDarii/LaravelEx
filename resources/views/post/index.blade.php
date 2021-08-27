@extends('layouts.app')

@section('content')

    <div class="container">
        @include('partial.success')
        @if(Auth::user() && Auth::user()->hasRole('author'))
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('post.create') }}" class="btn btn-success">Create</a>
                </div>
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    @if(Auth::user() && Auth::user()->hasRole('admin'))
                    <th>ID</th>
                    @endif
                    <th>Title</th>
                    <th>Author</th>
                    @if(Auth::user() && Auth::user()->hasRole('admin'))
                    <th>Status</th>
                    @endif
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($posts))
                    @foreach ($posts as $post)
                        <tr>
                            @if(Auth::user() && Auth::user()->hasRole('admin'))
                            <th>{{ $post->id }}</th>
                            @endif
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            @if(Auth::user() && Auth::user()->hasRole('admin'))
                            <td>
                               
                                    @if($post->status)
                                        Published
                                    @else
                                        Unpublished
                                    @endif
                                
                            </td>
                            @endif
                                <td>
                                    <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View</a>
                                </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection