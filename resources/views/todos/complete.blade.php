@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{route('todo.completeStore', $todo->id)}}" method="POST">
            @csrf
            <div class="form-group">
                {{$todo->name}}
            </div>
            <div class="form-group">
                {{$todo->content}}
            </div>
            <div class="form-group">
                <label for="sdate">시작일</label>
                <input type="date" class="form-control" id="sdate" name="sdate" value="@if($todo->repeat == 1){{date("Y-m-d")}}@else{{ $todo->sdate }}@endif">
            </div>
            <div class="form-group">
                <label for="stime">시작시간</label>
                <input type="time" class="form-control" id="stime" name="stime" value="@if($todo->repeat == 1){{date("H:i")}}@else{{ $todo->stime }}@endif">
            </div>
            <div class="form-group">
                <label for="edate">종료일</label>
                <input type="date" class="form-control" id="edate" name="edate" value="{{date("Y-m-d")}}">
            </div>
            <div class="form-group">
                <label for="etime">종료시간</label>
                <input type="time" class="form-control" id="etime" name="etime" value="{{date("H:i")}}">
            </div>
            <button type="submit" class="float-right mr-3 btn btn-primary btn-lg">완료</button>
        </form>
    </div>
@endsection