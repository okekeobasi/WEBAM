@extends('layouts.table')

@section('title','Department Records')

@section('parent','Attendance')

@section('current','Records')

@section('box-mods')
    <a href="#">
        <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Create New</button>
    </a>
    <hr>
@endsection

@section('table-content')
    <thead>
    <tr>
        <th>ID</th>
        <th>Department</th>
        <th>Population</th>
        <th>Resumption</th>
        <th>Closing</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($departments as $department)
        <tr onclick="foo({{$department->id}})">
            <td>{{$department->id}}</td>
            <td>{{$department->department}}</td>
            <td>{{$department->population}}</td>
            <td>{{$department->resumption}}</td>
            <td>{{$department->closing}}</td>
            <td>
                @if(strtolower($department->status) == "active")
                    <span class="label label-success">{{$department->status}}</span>
                @else
                    <span class="label label-danger">{{$department->status}}</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Department</th>
        <th>Population</th>
        <th>Resumption</th>
        <th>Closing</th>
        <th>Status</th>
    </tr>
    </tfoot>
@endsection

@section('js')
    <script type="text/javascript">
        function foo(num) {
            var url = 'screen/' + num;
            window.open(url,'_self');
        }
    </script>
@endsection