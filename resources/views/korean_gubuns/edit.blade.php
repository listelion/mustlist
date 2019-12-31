@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <ul class="list-group mb-3 ml-3 mr-3">
                <li class="list-group-item active">생성된 구분 리스트<a href="{{ route('korean_gubun.create') }}" class="float-right text-white">돌아가기</a></li>
                @foreach($gubuns as $kgubun)
                    <li class="list-group-item"><a class="@if($kgubun->id == $gubun->id) bg-primary text-white @endif"href="{{route('korean_gubun.edit', ['korean_gubun' => $kgubun->id])}}">{{ $kgubun->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <form action="{{ route('korean_gubun.update', ['korean_gubun' => $gubun->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <div class="form-group">
                    <label for="name">이름</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$gubun->name}}">
                </div>
                <button type="submit" class="float-right mr-3 btn btn-primary btn-lg">수정</button>
            </div>
        </form>
    </div>
@endsection