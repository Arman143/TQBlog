@extends('layouts.dashboard.master')

@section('content')

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>EDIT POST</strong></div>
            <div class="panel-body">
                <div>
                    <a href="{{ url('dashboard/posts') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
                <hr>
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
        </div>
    </div>

    <script>
        CKEDITOR.replace( 'description' );
    </script>

@endsection