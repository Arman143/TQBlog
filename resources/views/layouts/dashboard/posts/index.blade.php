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
                </table>
                @if(isset($posts))
                <hr>
                <div class="text-right">
                    {{ @$posts->links() }}
                </div>
                @endif
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
                {data: 'id'},
                {data: 'title'}
            ]
        });
    });
</script>

@endsection