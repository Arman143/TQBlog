@extends('layouts.dashboard.master')

@section('content')

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>POSTS</strong>
                <a href="{{ url('dashboard/posts/create') }}" class="pull-right btn btn-xs btn-default"><i class="glyphicon glyphicon-plus"></i> New</a>
            </div>
            <div class="panel-body">
                <table id="recordList" class="table table-condensed compact">
                    <thead>
                        <tr>
                            <th>ID#</th>
                            <th>TITLE</th>
                            <th class="text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
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
                {data: 'action', class: 'text-right', name: 'action', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns([0,1]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).addClass('form-control input-sm');
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            },
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
                lengthMenu: "_MENU_"
            },
            stateSave: true
//            dom: '<"toolbar">frtip'
        });
        
        $('#recordList_wrapper > div:first > div').attr('class', '');
        
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