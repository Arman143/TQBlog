@extends('layouts.dashboard.master')

@section('content')
    
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Categories <small>Edit</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Actions</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{url('dashboard/categories/create')}}">Add New</a></li>
                                        <li><a href="{{url('dashboard/categories')}}">Listing</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30"></p>
                        <form id="editForm" class="form-horizontal form-label-left">
                            <input type="hidden" name="id" value="{{$row->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                    Name <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <input value="{{$row->name}}" type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">
                                    Title <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                    <input value="{{$row->title}}" type="text" id="title" name="title" required="required" class="form-control col-md-7 col-xs-12">
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
    //CKEDITOR.replace( 'description' );
    $(document).ready(function(){
        $(document).on('submit', '#editForm', function(){
            $.ajax({
                url: '{{url("dashboard/categories/$row->id")}}',
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