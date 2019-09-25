@extends('layouts.app')
@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["timeline"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var container = document.getElementById('daily');
            var chart = new google.visualization.Timeline(container);
            var dataTable = new google.visualization.DataTable();
            dataTable.addColumn({ type: 'string', id: 'Room' });
            dataTable.addColumn({ type: 'string', id: 'Name' });
            dataTable.addColumn({ type: 'date', id: 'Start' });
            dataTable.addColumn({ type: 'date', id: 'End' });
            dataTable.addRows([
                @foreach($todos as $todo)
                    @if($todo->today_c > 0)
                    [ '완료', '{{$todo->name}}', new Date(0,0,0,{{date("H",strtotime($todo->v_stime))}},{{date("i",strtotime($todo->v_stime))}},0), new Date(0,0,0,{{date("H",strtotime($todo->v_etime))}},{{date("i",strtotime($todo->v_etime))}},0) ],
                    @elseif($todo->position == 0)
                    [ '예정', '{{$todo->name}}', new Date(0,0,0,{{date("H",strtotime($todo->v_stime))}},{{date("i",strtotime($todo->v_stime))}},0), new Date(0,0,0,{{date("H",strtotime($todo->v_etime))}},{{date("i",strtotime($todo->v_etime))}},0) ],
                    @elseif($todo->today_c == 0)
                    [ '할일', '{{$todo->name}}', new Date(0,0,0,{{date("H",strtotime($todo->v_stime))}},{{date("i",strtotime($todo->v_stime))}},0), new Date(0,0,0,{{date("H",strtotime($todo->v_etime))}},{{date("i",strtotime($todo->v_etime))}},0) ],
                    @endif
                @endforeach
            ]);

            chart.draw(dataTable);
        }
    </script>
    <div class="wrapper">
        <a class="btn btn-primar ml-2" href="" role="button">한일 등록</a>
        <div class="float-right mr-2">
            <form class="input-group-prepend" action="/time" method="get">
                <input type="date" id="searchDate" name="searchDate" class="form-control" value="@if($request->searchDate > 0){{$request->searchDate}}@else{{date('Y-m-d')}}@endif">
                <button style="width:60px;" type="submit" class="ml-2 btn btn-primary btn-sm">검색</button>
            </form>
        </div>
    </div>
    <div id="daily" class="mt-2" style="min-height: 750px"></div>
    <script>

    </script>
@endsection
