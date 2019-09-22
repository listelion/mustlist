<?php

namespace App\Http\Controllers;
    use App\User;
    use App\Todo;
    use Illuminate\Http\Request;
    use Validator;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        $search_date = date("Y-m-d", strtotime($request->search_date));
        if($search_date == "1970-01-01") {
            $search_date = date("Y-m-d");
        }

        $todos = Tdoo::where('deleted_yn', false)
            ->where('user_id', $request->user()->id)
            ->wheredate('sdate', '<=', $search_date)
            ->wheredate('edate', '>=', $search_date)
            ->get();

        foreach ($todos as $todo){
            if($search_date > date("Y-m-d", strtotime($todo->sdate))){
                $todo->v_sdate = $search_date;
                $todo->v_time = date("H:i", 0);
            }else{
                $todo->v_sdate = $todo->sdate;
                $todo->v_stime = $todo->stime;
            }

            if($search_date < date("Y-m-d", strtotime($todo->edate))){
                $todo->v_sdate = $search_date;
                $todo->v_time = date("H:i", 0);
            }
            $todo->minus = (int)date("d",(strtotime($todo->edate) - strtotime($todo->sdate)));
        }
        return view('calendar/daily',[
            'request' => $request,
            'members' => $members,
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calendar/create',[
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('calendar.create'))
                ->withInput()
                ->withErrors($validator);
        }

        $schedule = new Schedule;
        $schedule->title = $request->title;
        $schedule->member_id = $request->user()->member_id;
        $schedule->sdate = $request->sdate;
        $schedule->edate = $request->edate;
        $schedule->save();

        return redirect(route('calendar.index'));
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
