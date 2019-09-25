<?php

namespace App\Http\Controllers;

use App\User;
use App\Todo;
use App\Complete;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $searchDate = Carbon::now()->format("Y-m-d");
        if(isset($request->searchDate)) {
            $searchDate = Carbon::createFromFormat(
                'Y-m-d',
                $request->input('searchDate')
            )->format("Y-m-d");
        }

        $todos = Todo::where('user_id', $user->id)
            ->wheredate('sdate', '<=', $searchDate)
            ->wheredate('edate', '>=', $searchDate)
            ->get();

        foreach ($todos as $todo) {
            $todo->v_stime = $todo->stime;
            $todo->v_etime = $todo->etime;
            if (Complete::where('todo_id', $todo->id)
                ->whereDate('sdate', '<=', $searchDate)
                ->whereDate('edate', '>=', $searchDate)
                ->value('id') > 0) {
                $todo->today_c = 1;
                $todo->position = 1;
                $completes = Complete::where('todo_id', $todo->id)
                    ->whereDate('sdate', '<=', $searchDate)
                    ->whereDate('edate', '>=', $searchDate)
                    ->first();
                if ($searchDate > date("Y-m-d", strtotime($completes->sdate))) {
                    $todo->v_stime = date("H:i", strtotime("00:00"));
                } else {
                    $todo->v_stime = $completes->stime;
                }
                if ($searchDate < date("Y-m-d", strtotime($completes->edate))) {
                    $todo->v_etime = date("H:i", strtotime("23:59"));
                } else {
                    $todo->v_etime = $completes->etime;
                }
            } else {
                $todo->today_c = 0;
                $todo->position = 0;
                if ($searchDate > date("Y-m-d", strtotime($todo->sdate))) {
                    $todo->v_sdate = $searchDate;
                    $todo->v_stime = date("H:i", strtotime("00:00"));
                    $todo->position = 2;
                }
                if ($searchDate < date("Y-m-d", strtotime($todo->edate))) {
                    $todo->v_sdate = $searchDate;
                    $todo->v_etime = date("H:i", strtotime("23:59"));
                    $todo->position = 3;
                }
            }
        }

        $todos = $todos->sortBy('position');
        return view('times/index', [
            'request' => $request,
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar/create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
