@extends('layouts.app')
@section('content')
    <div class="card text-center" style="padding:0.25rem">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="/word">개인 단어장</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/word?order=1">전체 단어장</a>
                </li>
                <div style="margin-left: auto;">
                </div>
                <div class="float-right mr-2">
                    <a href="/word/create" class="float-right btn btn-primary btn">등록</a>
                </div>
            </ul>
        </div>
       <table class="type02 text-center">
        <tr class="">
            <th>영단어</th>
            <th>뜻</th>
            <th>난이도 [맞음 / 틀림]</th>
        </tr>
        @foreach($englishes as $english)
            <tr>
                <td>{{$english->word}}</td>
                <td>@foreach($english->koreans as $korean)
                        <span class="badge badge-pill badge-primary">{{ $korean->gubun }}</span> {{$korean->word}}
                    @endforeach
                    </td>
                <td>[ / ]</td>
            </tr>
        @endforeach
    </table>
    </div>
@endsection