@extends('layouts.dashboard.master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Posts <small>Listing</small></h2>
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
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p class="text-muted font-13 m-b-30"></p>
                        <table id="recordList" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>USER</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<script>
    $(document).ready(function(){
        
        var customDataTable = $('#recordList').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url("dashboard/posts/ajax")}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'category.name', name: 'category.name'},
                {data: 'user.name', name: 'user.name'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', class: 'text-right', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns([0,1,2,3,4]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).addClass('form-control input-sm');
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            },
            columnDefs: [ {
                targets: 1,
                render: function ( data, type, row ) {
                    return data.length > 40 ?
                        data.substr( 0, 40 ) +'…' :
                        data;
                }
            } ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
                lengthMenu: "_MENU_",
                processing: '<img src="{{asset("public/images/processing.gif")}}">Processing...'
            },
//            stateSave: true
        });
        
        $(document).on('click', '.btnDelete', function(){
            
            var id = $(this).data('id');
            var token = $(this).data('token');
            
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#000',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url: '{{url("dashboard/posts")}}/'+id,
                    type: 'DELETE',
                    data: {
                        'id': id,
                        '_method': 'DELETE',
                        '_token': token
                    },
                    success: function (data){
                        if(data === 'success'){
                            messageNotif('Record deleted', 'success', 'right');
                            customDataTable.ajax.reload();
                        } else{
                            messageNotif('Record not deleted', 'error', 'right');
                        }
                    }
                });
            }, function (dismiss) {
                return false;
            });
        });
    });
</script>

@endsection