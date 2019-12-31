@extends('layouts.app')
@section('content')
    <div class="card text-center" style="padding:0.25rem">
        <div class="float-right mr-3">
            <button onclick="location.href='/memory/create'" type="button" class="float-right mr-3 mb-3 btn btn-primary btn">등록</button>
        </div>
        <div class="card-body" style="padding:0">
                <div class="card mb-3 border-secondary">
                    @foreach($memories as $memory)
                    <div class="card-header h5 flex">
                        <div class="float-left">{{$memory->who}} {{$memory->where}} {{$memory->what}}  {{$memory->how}}  {{$memory->why}}</div>
                        <div class="form-inline float-right">
                            <span class="small mr-3">{{$memory->when}}</span>
                            <a style="font-size:12px;" href="{{ route('memory.edit', $memory->id) }}">수정</a>
                            <form class="ml-2" action="{{ route('memory.destroy', $memory->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">삭제</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>

    </div>
@endsection