@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Text</th>
                    <th>Post</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($commentars))
                    @foreach ($commentars as $commentar)
                        <tr>
                            <td>{{ $commentar->id }}</td>
                            <td>{{ $commentar->text }}</td>
                            <td>{{ $commentar->post->title }}</td>
                            <td>{{ $commentar->user->name }}</td>
                            <td>                          
                                    @if($commentar->status)
                                        Published
                                    @else
                                        Unpublished
                                    @endif      
                            </td>
                                <td>
                                    <a href="{{ route('comment.edit', $commentar->id) }}" class="btn btn-primary">View</a>
                                </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

@endsection