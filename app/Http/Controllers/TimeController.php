<?php

namespace App\Http\Controllers;

use App\User;
use App\Todo;
use App\Complete;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $searchDate = Carbon::createFromFormat(
            'Y-m-d',
            $request->input('search_date', '1970-01-01')
        );

        $todos = Todo::where('deleted_yn', false)
            ->where('user_id', $user->id)
            ->wheredate('sdate', '<=', $searchDate)
            ->wheredate('edate', '>=', $searchDate)
            ->with(['complete'])
            ->get();

        /**
         * TODO : 굳이 이렇게 할 필요가 있을까요?
         * - complete 와 todo에 관계 설정을 하세요. 그러면 with 명령어로 필요한 데이타는 다 빼올수 있습니다.
         *   아래 foreach 가 필요없어요.
         * - 모든 datetime 형식은 carbon 이나 DateTime 을 사용하세요.
         * - todo의 v-stime, v-etime 이 date 인지 datetime 인지를 구분해서 컬럼에 추가해주세요.
         * - migration 에 migration 파일이 없으니 무슨 컬럼인지 혹은 테스트 스키마를 만들수가 없습니다.
         * - foreach 로 저런식의 set 은 사용시 주의 해야 합니다. setAttribute 를 사용하는게 좋아요.
         * - collection map 함수를 사용해서 간소화 하세요.
         */
//        foreach ($todos as $todo) {
//            /** @var Complete $complete */
//            $complete = Complete::where('todo_id', $todo->id)->first();
//
//            $todo->v_stime = $todo->stime;
//            $todo->v_etime = $todo->etime;
//            if ($complete instanceof Complete) {
//                $todo->today_c = 1;
//                $todo->position = 1;
//                $todo->v_stime = $complete->stime;
//                $todo->v_etime = $complete->etime;
//            } else {
//                $todo->today_c = 0;
//                $todo->position = 0;
//                if ($searchDate > $todo->sdate) {
//                    $todo->v_sdate = $searchDate;
//                    $todo->v_stime = '00:00';
//                    $todo->position = 2;
//                } else {
//                    $todo->v_sdate = $searchDate;
//                    $todo->v_etime = '23:59';
//                    $todo->position = 3;
//                }
//            }
//        }
//
//        $todos = $todos->sortBy('position');

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
        return view('calendar/create');
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
