@extends('layouts/layoutv1/master')

@section('content')

    @if(isset($post))
    
        <div class="blog-post">
            <h2 class="blog-post-title">{{title_case($post->title)}}</h2>
            <p class="blog-post-meta"><small>July 17, 2017 by <a href="#">Tahir</a></small></p>
            <p>{!! $post->body !!}</p>
            <hr>
        </div><!-- /.blog-post -->
        
    @else
    
        <div class="alert alert-warning">
            <p>No post found.</p>
        </div>
        
    @endif

@endsection
