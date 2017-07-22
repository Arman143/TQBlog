@extends('layouts.dashboard.master')

@section('content')

    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>POSTS</strong></div>
            <div class="panel-body">
                <div>
                    <a href="{{ url('dashboard/posts/create') }}" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> Create Post</a>
                </div>
                <hr>
                @include('layouts.dashboard.messages')
                <table id="recordList" class="table table-condensed">
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
    $(function() {
        $('#recordList').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{url("dashboard/posts/get-posts")}}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            initComplete: function () {
                this.api().columns([0,1]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            }
        });
    });
</script>

@endsection