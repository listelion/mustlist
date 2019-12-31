<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function index(){
        return view('js-study/index');
    }
    public function create(){
        return view('js-study/create');
    }
}
