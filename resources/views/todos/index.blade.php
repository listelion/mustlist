@extends('layouts.app')
@section('content')
    <div class="card text-center" style="padding:0.25rem">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/todo">Todo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/todo?complete=1">Complete</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Repeat</a>
                </li>
                <div style="margin-left: auto;">
                    <form class="form-inline">
                        <select class="form-control form-control-sm ml-2">
                            <option value="0">전체</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </ul>

        </div>
        <div class="card-body" style="padding:0">
            @foreach($todos as $todo)
            <div class="card mb-3 border-secondary">
                <div class="card-header h5 flex">
                    @if($todo->category_id > 0)<span class="badge badge-dark">{{$todo->category}}</span>@endif
                    @if($todo->repeat > 0)<span class="badge badge-dark">반복</span>@endif
                    @if($todo->level > 1)<span class="badge badge-danger">상</span>
                    @elseif($todo->level === 1)<span class="badge badge-warning">중</span>
                    @else<span class="badge badge-info">하</span>@endif
                        @if($todo->today_c == 1) <del>@endif
                    {{$todo->name}}</del>
                        <div class="form-inline float-right">
                        <a style="font-size:12px;" href="{{ route('todo.edit', $todo->id) }}">수정</a>
                        <form class="ml-2" action="{{ route('todo.destroy', $todo->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">삭제</button>
                        </form>
                    </div>
                </div>
                <div class="card-body text-secondary">
                    @if($todo->content > 0)<h6 class="card-title">{{$todo->content}}</h6>@endif
                    <p class="card-text h6">
                        목표 :
                        @if($todo->edate === '9999-12-31')기한없음
                        @elseif($todo->sdate === date('Y-m-d'))오늘 {{$todo->stime}} ~ {{$todo->edate}} {{$todo->etime}} 까지
                        @elseif($todo->edate === date('Y-m-d')){{$todo->sdate}} {{$todo->stime}} ~ 오늘 {{$todo->etime}} 까지
                        @else {{$todo->sdate}} {{$todo->stime}} ~ {{$todo->edate}} {{$todo->etime}}
                        @endif
                    </p>
                        @if($todo->today_c == 0)<a href="{{route('todo.complete', $todo->id)}}" class="btn btn-success btn-sm">완료</a>@endif
                </div>
            </div>
            @endforeach
        </div>
        <div class="float-right mr-3">
            <button onclick="location.href='/todo/create'" type="button" class="float-right mr-3 btn btn-primary btn-lg">등록</button>
        </div>
    </div>
@endsection