@extends('layouts.dashboard.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h3 class="page-header">Add Post
            <a href="{{ url()->previous() }}" class="btn btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form id="addForm">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> ADD</button>
        </form>
    </div>
</div>

<script>
    CKEDITOR.replace( 'description' );
    $(document).ready(function(){
        $(document).on('submit', '#addForm', function(){
            $.ajax({
                url: '{{url("dashboard/posts")}}',
                type: 'POST',
                data: $('#addForm').serialize(),
                success: function (data){
                    if(data === 'success'){
                        messageNotif('Record added', 'success', 'right');
                    } else{
                        messageNotif('Record not added', 'error', 'right');
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