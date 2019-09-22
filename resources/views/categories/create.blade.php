@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            <ul class="list-group mb-3 ml-3 mr-3">
                <li class="list-group-item active">생성된 카테고리 리스트</li>
                @foreach($categories as $category)
                <li class="list-group-item">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        <form action="{{ route('categories.store') }}" method="POST">
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