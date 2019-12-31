@extends('layouts.app')

@section('content')
<div style="height: auto">
    <div id="weeklyChart" style="width: 100%; height: 50vh;"></div>
</div>
{{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
{{--<script type="text/javascript">--}}
    {{--google.charts.load("current", {packages:["corechart"]});--}}
    {{--google.charts.setOnLoadCallback(drawChart);--}}
    {{--function drawChart() {--}}
        {{--var data = google.visualization.arrayToDataTable([--}}
            {{--['Language', '주간 패턴 분석'],--}}
            {{--@foreach($weeklies as $key => $cha)--}}
            {{--['{{ $key }}',  {{ $cha }}],--}}
            {{--@endforeach--}}
        {{--]);--}}

        {{--var options = {--}}
            {{--legend: 'none',--}}
            {{--pieSliceText: 'label',--}}
            {{--title: '주간 패턴 분석',--}}
            {{--pieStartAngle: 100,--}}
        {{--};--}}

        {{--var chart = new google.visualization.PieChart(document.getElementById('weeklyChart'));--}}
        {{--chart.draw(data, options);--}}
    {{--}--}}
{{--</script>--}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['패턴', '시간'],
                @foreach($weeklies as $key => $cha)
            ['{{ $key }}',  {{ $cha }}],
            @endforeach
        ]);

        var options = {
            chart: {
                title: '주간 패턴 분석',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('weeklyChart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
@endsection
