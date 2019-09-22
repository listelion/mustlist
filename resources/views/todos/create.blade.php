@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('todo.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_cd">카테고리
                    <a href=" {{ url(route('categories.create')) }}"><span class="badge badge-pill badge-primary">+ 추가</span></a>
                </label>
                <select class="form-control" name="category_id" id="category_id">
                    <option value="0">없음</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">할일</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="입력하세요">
            </div>
            <div class="form-group">
                <label for="content">상세내용</label>
                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="sdate">시작일</label>
                <input type="date" class="form-control" id="sdate" name="sdate" value="<?php echo date("Y-m-d");?>">
            </div>
            <div class="form-group">
                <label for="stime">시작시간</label>
                <input type="time" class="form-control" id="stime" name="stime" value="<?php echo date("H:i");?>">
            </div>
            <div class="form-group">
                <label for="edate">종료일
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">무기한</label>
                    </div>
                </label>
                <input type="date" class="form-control" id="edate" name="edate" value="<?php echo date("Y-m-d");?>">
            </div>
            <div class="form-group">
                <label for="etime">종료시간</label>
                <input type="time" class="form-control" id="etime" name="etime" value="<?php echo date("H:i");?>">
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    중요도
                    <input class="form-check-input ml-2" type="radio" name="level" value="0" checked="checked">
                    <label class="form-check-label" for="level">하</label>
                    <input class="form-check-input ml-2" type="radio" name="level" value="1">
                    <label class="form-check-label" for="level">중</label>
                    <input class="form-check-input ml-2" type="radio" name="level" value="2">
                    <label class="form-check-label" for="level">상</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    반복
                    <input class="form-check-input ml-2" type="radio" name="repeat" value="0" checked="checked">
                    <label class="form-check-label" for="repeat">아니요</label>
                    <input class="form-check-input ml-2" type="radio" name="repeat" value="1">
                    <label class="form-check-label" for="repeat">예</label>
                </div>
            </div>
            <button type="submit" class="float-right mr-3 btn btn-primary btn-lg">Submit</button>
        </form>
    </div>
@endsection