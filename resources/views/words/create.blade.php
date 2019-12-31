@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('word.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">영단어</label>
                <input type="text" class="form-control" id="english_word" name="english_word" placeholder="입력하세요">
            </div>
            <div id="koreanForm">
                <div class="form-group row">
                    <div class="col-3">
                        <label for="category_cd">구분
                            <a href="{{ url(route('korean_gubun.create')) }}"><span class="badge badge-pill badge-primary">+ 추가</span></a>
                        </label>
                        <select class="form-control" name="korean_gubun_id[]">
                            @foreach($korean_gubuns as $korean_gubun)
                                <option value="{{ $korean_gubun->id }}">{{ $korean_gubun->name }}<form action></form></option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-9">
                        <label for="content">뜻</label>
                        <input type="text" class="form-control" name="korean_word[]" placeholder="입력하세요">
                    </div>
                </div>
            </div>
            <div id="koreanField">
            </div>
            <div class="text-center">
                <button type="button" onClick="addRow()" class="mr-3 btn btn-info btn">폼 추가</button>
            </div>
            <button type="submit" class="float-right mr-3 btn btn-primary btn">저장</button>
        </form>
    </div>
    <script>
        function addRow(){
            var div = document.createElement('div');
            div.innerHTML = document.getElementById('koreanForm').innerHTML;
            document.getElementById('koreanField').appendChild(div);
        }
    </script>
@endsection