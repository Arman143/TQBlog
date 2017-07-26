@extends('layouts.dashboard.master')

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">Edit Post
                <a href="{{ url()->previous() }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-backward"></i> Back</a>
            </h3>
        </div>
    </div>

    <div class="col-md-12">
        {!! Form::open(['action' => ['Dashboard\PostsController@update', $post->id], 'method' => 'POST']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $post->body, ['class' => 'form-control', 'placeholder' => 'Description'])}}
            </div>
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>

    <script>
        CKEDITOR.replace( 'description' );
    </script>

@endsection