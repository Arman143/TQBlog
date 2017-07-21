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
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>ID#</th>
                            <th>TITLE</th>
                            <th class="text-right">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($posts))
                            @foreach($posts as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td class="text-right">
                                    <a href="{{ url('dashboard/posts/'.$row->id.'/edit') }}" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    {!! Form::open(['action' => ['Dashboard\PostsController@destroy', $row->id], 'method' => 'POST']) !!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-xs btn-danger'])}}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
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

@endsection