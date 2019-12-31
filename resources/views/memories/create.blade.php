@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('memory.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="edate">언제</label>
                <input type="datetime-local" class="form-control" id="when" name="when" value="<?php echo date("Y-m-d")."T".date("H:i");?>">
            </div>

            <div class="form-group">
                <label for="name">누가</label>
                <input type="text" class="form-control" id="who" name="who">
            </div>
            <div class="form-group">
                <label for="name">어디서</label>
                <input type="text" class="form-control" id="where" name="where">
            </div>
            <div class="form-group">
                <label for="name">무엇을</label>
                <input type="text" class="form-control" id="what" name="what">
            </div>
            <div class="form-group">
                <label for="name">어떻게</label>
                <input type="text" class="form-control" id="how" name="how">
            </div>
            <div class="form-group">
                <label for="name">왜</label>
                <input type="text" class="form-control" id="why" name="why">
            </div>
            <button type="submit" class="float-right mr-3 btn btn-primary btn-lg">Submit</button>
        </form>
    </div>
@endsection