@extends('layouts.dashboard.master')

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Edit Post
            <a href="{{ url()->previous() }}" class="btn btn-xs"><i class="fa fa-arrow-left"></i> BACK</a>
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form id="editForm">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{$post->title}}" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{$post->body}}</textarea>
            </div>
            <input type="hidden" name="id" value="{{$post->id}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="PUT">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> SAVE</button>
        </form>
    </div>
</div>

<script>
    CKEDITOR.replace( 'description' );
    $(document).ready(function(){
        $(document).on('submit', '#editForm', function(){
            $.ajax({
                url: '{{url("dashboard/posts/$post->id")}}',
                type: 'PUT',
                data: $('#editForm').serialize(),
                success: function (data){
                    if(data === 'success'){
                        messageNotif('Record updated', 'success', 'right');
                    } else{
                        messageNotif('Record not updated', 'error', 'right');
                    }
                },
                error: function(data){
                    var errors = data.responseJSON;
                    var message = "";
                    $.each(errors, function(index, value){
                        message += value+"<br>";
                    });
                    messageNotif(message, 'error', 'right');
                }
            });
            return false;
        });
    });
</script>

@endsection