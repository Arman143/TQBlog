@extends('layouts.dashboard.master')

@section('content')

<style>
    input[type="file"] {
        position: absolute;
        left: 0;
        opacity: 0;
        top: 0;
        bottom: 0;
        width: 100%;
    }
    
    #placeholder {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fafafa;
        border: 3px dotted #bebebe;
        border-radius: 10px;
    }

    #parentDiv {
        display: inline-block;
        position: relative;
        height: 35px;
        width: 250px;
    }
</style>
    
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Posts <small>Edit</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Actions</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{url('dashboard/posts/create')}}">Add New</a></li>
                                        <li><a href="{{url('dashboard/posts')}}">Listing</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30"></p>
                        <form id="fileUpload" action="" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">
                                    Image
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <div id="parentDiv">
                                        <div id="placeholder">Choose a File</div>
                                        <input type="file" id="image" name="image">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <div class="progress" style="display:none; margin-bottom:3px;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:0%;">100%</div>
                                    </div>
                                    <div id="result" style="display:none;"></div>
                                </div>
                            </div>
                        </form>
                        <form id="editForm" class="form-horizontal form-label-left">
                            <input type="hidden" name="id" value="{{$row->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                                    Title <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <input value="{{$row->title}}" type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                    Description <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" id="description" name="description" required="required">{{$row->body}}</textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_id">
                                    Category <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <select id="category_id" name="category_id" required="required" class="form-control col-md-7 col-xs-12">
                                        @if(isset($categories))
                                            @foreach($categories as $category)
                                                <option {{$category->id === $row->category_id ? "selected" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @else
                                            <option value=""></option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                                    Status <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <select name="status" class="form-control col-md-7 col-xs-12" required="required">
                                        <option <?php echo $row->status === 'Active' ? 'selected' : ''; ?> value="Active">Active</option>
                                        <option <?php echo $row->status === 'Inactive' ? 'selected' : ''; ?> value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace( 'description' );
    $(document).ready(function(){
        
        $('#fileUpload').on('change', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData($(this)[0]);
            var file = $('input[type=file]')[0].files[0];
            formData.append('upload_file',file);
            formData.append('_token', '{{csrf_token()}}');
            $('.progress').show();
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress-bar').css('width',percentComplete+"%");
                            $('.progress-bar').html(percentComplete+"%");
                            if (percentComplete === 100) {
                                setTimeout(function(){
                                    $('.progress').slideUp(function(){
                                        $('.progress-bar').css('width', '0%');
                                        $('.progress-bar').html('');
                                    });
                                }, 3000);
                            }
                        }
                    }, false);
                    return xhr;
                },
                type:'POST',
                url: '{{url("dashboard/posts/ajax-image-upload")}}',
                data: formData,
                //async:false,
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data === 'success'){
                        $('#result').html(data);
                        $('#result').fadeIn();
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
        
        $(document).on('submit', '#editForm', function(){
            $.ajax({
                url: '{{url("dashboard/posts/$row->id")}}',
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