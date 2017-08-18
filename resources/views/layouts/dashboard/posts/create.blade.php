@extends('layouts.dashboard.master')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Posts <small>Create New</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Actions</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{url('dashboard/posts')}}">Listing</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30"></p>
                        <div class="row">
                            <div class="col-md-8">
                                <form id="addForm" class="form-horizontal form-label-left inlineForm">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" id="filename" name="filename">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="title">Title <span class="required">*</span></label>
                                                <input type="text" id="title" name="title" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="category_id">Category <span class="required">*</span></label>
                                                <select id="category_id" name="category_id" required="required" class="form-control">
                                                    @if(isset($categories) && count($categories) > 0)
                                                        <option value=""></option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="">No Category</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">&nbsp;</label>
                                                <div class="checkbox">
                                                    <label>
                                                        <input checked name="status" value="Active" type="checkbox" class="flat"> Publish?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description <span class="required">*</span></label>
                                        <textarea class="form-control" id="description" name="description" required="required"></textarea>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Create</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form id="fileUpload" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left uploadForm">
                                    <div class="form-group">
                                        <div id="parentDiv">
                                            <div id="placeholder">Choose a File</div>
                                            <input onchange="imagePreview(this);" type="file" id="image" name="image" accept="image/jpg,image/png,image/jpeg,image/gif">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="progress" style="display:none; margin-bottom:3px;">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:0%;">100%</div>
                                        </div>
                                        <div id="result" style="display:none;">
                                            <div id="imageHolder" style="margin-bottom: 10px;"></div>
                                            <button onclick="removeImage();" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Remove</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
            var thisObj = this;
            e.preventDefault();
            e.stopImmediatePropagation();
            var formData = new FormData($(this)[0]);
            formData.append('_token', '{{csrf_token()}}');
            $('.progress').show();
            $('#addForm button').hide();
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
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var result = data.split('|');
                    if(result[0] === 'success'){
                        messageNotif('Image uploaded', 'success', 'right');
                        $('#filename').val(result[1]);
                    } else{
                        messageNotif('Image not uploaded', 'error', 'right');
                    }
                    thisObj.reset();
                    $('#addForm button').show();
                },
                error: function(data){
                    var errors = data.responseJSON;
                    var message = "";
                    $.each(errors, function(index, value){
                        message += value+"<br>";
                    });
                    messageNotif(message, 'error', 'right');
                    $('#addForm button').show();
                }
            });
            return false;
        });
        
        $(document).on('submit', '#addForm', function(){
            $.ajax({
                url: '{{url("dashboard/posts")}}',
                type: 'POST',
                data: $('#addForm').serialize(),
                success: function (data){
                    if(data === 'success'){
                        messageNotif('Record added', 'success', 'right');
                        $('#addForm').trigger('reset');
                        $('#fileUpload').trigger('reset');
                        $('#result').hide();
                        $('#result #imageHolder').html('');
                        $('#filename').val('');
                        CKEDITOR.instances.description.setData('');
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