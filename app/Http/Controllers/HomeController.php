<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complete;
use App\Category;
use App\Test;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dt = Carbon::now();
        $dt->subWeeks(1);
        $weeklies = Complete::with('todo')->where('edate', '>', $dt)->where('sdate', '>', $dt)->get();

        foreach ($weeklies as $weekly) {
            if ($weekly->todo->category_id > 0) {
                $weekly->category_name = Category::where('id', $weekly->todo->category_id)->value('name');
            } else {
                $weekly->category_name = "패턴없음";
            }
            $weekly->stime = Carbon::parse($weekly->stime);
            $weekly->etime = Carbon::parse($weekly->etime);
            $weekly->cha = $weekly->etime->diffInMinutes($weekly->stime);
        }
        $weeklies = $weeklies->groupBy('category_name')->map(function ($row) {
            return $row->sum('cha');
        });
        return view('home', [
            'weeklies' => $weeklies,
            ]);
    }
    public function test()
    {
        return view('tests/test');
    }
}
