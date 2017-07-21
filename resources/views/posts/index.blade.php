@extends('layouts/layoutv1/master')

@section('content')

    @if(isset($posts))
    
        @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="{{url('/posts',[$post->id])}}">{{title_case($post->title)}}</a></h2>
                <p class="blog-post-meta"><small>July 17, 2017 by <a href="#">Tahir</a></small></p>
                <p>{!! str_limit($post->body, 300) !!}</p>
                <hr>
            </div><!-- /.blog-post -->
        @endforeach
        
<!--        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>-->
        
        <nav aria-label="Page navigation example">
            {{$posts->links()}}
        </nav>
        
    @else
    
        <div class="alert alert-warning">
            <p>No post found.</p>
        </div>
        
    @endif

@endsection
