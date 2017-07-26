@extends('layouts.dashboard.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-header">Posts
                <a href="{{ url('dashboard/posts/create') }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-plus"></i> New</a>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="recordList" class="table table-hover table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID#</th>
                        <th>TITLE</th>
                        <th>USER</th>
                        <th class="text-right">ACTIONS</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

<script>
    $(document).ready(function(){
        
        var customDataTable = $('#recordList').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url("dashboard/posts/get-posts")}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'user.name', name: 'user.name'},
                {data: 'action', class: 'text-right', name: 'action', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns([0,1,2]).every(function () {
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
                        '_token': token,
                    },
                    success: function (data){
                        if(data === 'success'){
                            notif({
                                msg: "<b>Success!</b> Record deleted!",
                                type: "success",
                                position: "right"
                            });
                            customDataTable.ajax.reload();
                        } else{
                            notif({
                                msg: "<b>Oops!</b> Record not deleted!",
                                type: "error",
                                position: "right"
                            });
                        }
                        console.log(data);
                    }
                });
            }, function (dismiss) {
                return false;
            });
        });
    });
</script>

@endsection