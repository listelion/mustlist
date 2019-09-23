<?php

namespace App\Http\Controllers;

    use App\User;
    use App\Todo;
    use App\Complete;
    use Illuminate\Http\Request;
    use Validator;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        $search_date = date("Y-m-d", strtotime($request->search_date));
        if ($search_date == "1970-01-01") {
            $search_date = date("Y-m-d");
        }

        $todos = Todo::where('deleted_yn', false)
            ->where('user_id', $request->user()->id)
            ->wheredate('sdate', '<=', $search_date)
            ->wheredate('edate', '>=', $search_date)
            ->get();

        foreach ($todos as $todo) {
            $todo->v_stime = $todo->stime;
            $todo->v_etime = $todo->etime;
            if (Complete::where('todo_id', $todo->id)
                ->whereDate('edate', $search_date)
                ->value('id')) {
                $todo->today_c = 1;
                $todo->position = 1;
                $todo->v_stime = Complete::where('todo_id', $todo->id)
                    ->whereDate('edate', $search_date)
                    ->value('stime');
                $todo->v_etime = Complete::where('todo_id', $todo->id)
                    ->whereDate('edate', $search_date)
                    ->value('etime');
                ;
            } else {
                $todo->today_c = 0;
                $todo->position = 0;
                if ($search_date > date("Y-m-d", strtotime($todo->sdate))) {
                    $todo->v_sdate = $search_date;
                    $todo->v_stime = date("H:i", strtotime("00:00"));
                    $todo->position = 2;
                }
                if ($search_date < date("Y-m-d", strtotime($todo->edate))) {
                    $todo->v_sdate = $search_date;
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
