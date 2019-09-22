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
                    @foreach($members as $member)
                [ '{{$member->name}}', '출', new Date(0,0,0,8,30,0), new Date(0,0,0,8,30,0) ],
                [ '{{$member->name}}', '퇴', new Date(0,0,0,18,0,0), new Date(0,0,0,18,0,0) ],
                    @endforeach
                    @foreach($schedules as $schedule)
                    @if($schedule->allday =='y')
                [ '{{$schedule->member_name}}', '{{$schedule->title}}', new Date(0,0,0,8,30,0), new Date(0,0,0,18,0,0) ],
                    @else
                [ '{{$schedule->member_name}}', '{{$schedule->title}}', new Date(0,0,0,{{$schedule->stimeH}},{{$schedule->stimeM}},0), new Date(0,0,0,{{$schedule->etimeH}},{{$schedule->etimeM}},0) ],
                @endif
                @endforeach
            ]);
            var options = {
                timeline: { colorByRowLabel: true }
            };

            chart.draw(dataTable, options);
        }
    </script>
    <div class="wrapper">
        <a class="btn btn-primary float-left ml-2" href="{{route('calendar.create')}}" role="button">일정 등록</a>
        <nav class="tabs">
            <div class="selector"></div>
            <a href="/calendar" class="active">하루일정표</a>
            <a href="/calendar/weekly">주간일정표</a>
        </nav>
        <div class="float-right mr-2">
            <form class="input-group-prepend" action="/calendar" method="get">
                <input type="date" id="search_date" name="search_date" class="form-control float-right" value="@if($request->search_date > 0){{$request->search_date}}@else{{date('Y-m-d')}}@endif">
                <button type="submit" class="btn btn-primary">검색</button>
            </form>
        </div>
    </div>
    <div id="daily" style="max-width:1000px; min-height: 750px"></div>
    <script>

    </script>
@endsection
