@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <ul class="list-group mb-3 ml-3 mr-3">
                <li class="list-group-item active">생성된 구분 리스트</li>
                @foreach($korean_gubuns as $korean_gubun)
                    <li class="list-group-item"><a href="{{route('korean_gubun.edit', ['korean_gubun' => $korean_gubun->id])}}">{{ $korean_gubun->name }}</a>
                        <form class="float-right" action="{{ route('korean_gubun.destroy', ['korean_gubun' => $korean_gubun->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn-sm text-danger">X</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
        <form action="{{ route('korean_gubun.store') }}" method="POST">
            @csrf
            <div>
                <div class="form-group">
                    <label for="name">이름</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="입력하세요">
                </div>
                <button type="submit" class="float-right mr-3 btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
    </div>
@endsection