<?php

namespace App\Http\Controllers;
use App\Todo;
use App\Complete;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $categories = User::find($user_id)
            ->categories()
            ->where('deleted_yn', false)
            ->get();

        $todos = User::find($user_id)
            ->todos()
            ->where('deleted_yn', false)
            ->where('completed', false)
            ->orderBy('level', 'desc')
            ->get();
        foreach ($todos as $todo){
            $todo->category = Category::where('id',$todo->category_id)->value('name');
            if(Complete::where('todo_id', $todo->id)
                ->whereDate('edate', date("Y-m-d"))
                ->value('id')){
                $todo->today_c = 1;
            }else{
                $todo->today_c = 0;
            }
        }

        return view('todos/index', [
            'categories' => $categories,
            'todos' => $todos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = $request->user()->id;
        $categories = User::find($user_id)
            ->categories()
            ->where('deleted_yn', false)
            ->get();

        return view('todos/create', [
            'categories' => $categories,
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
            'name' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('todo.create'))
                ->withInput()
                ->withErrors($validator);
        }

        $todo = new Todo;
        $todo->name = $request->name;
        $todo->user_id = $request->user()->id;
        $todo->content = $request->content;
        $todo->level = $request->level;
        $todo->category_id = $request->category_id;
        $todo->sdate = $request->sdate;
        $todo->stime = $request->stime;
        $todo->edate = $request->edate;
        $todo->etime = $request->etime;
        $todo->repeat = $request->repeat;
        $todo->save();

        return redirect(route('todo.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $user_id = $request->user()->id;
        $categories = User::find($user_id)
            ->categories()
            ->where('deleted_yn', false)
            ->get();

        $todo = User::find($user_id)
            ->todos()
            ->find($id);

        return view('todos/edit', [
            'categories' => $categories,
            'todo' => $todo,
            'id' => $id,
        ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('todo.edit'))
                ->withInput()
                ->withErrors($validator);
        }

        $todo = Todo::find($id);
        $todo->name = $request->name;
        $todo->user_id = $request->user()->id;
        $todo->content = $request->content;
        $todo->level = $request->level;
        $todo->category_id = $request->category_id;
        $todo->sdate = $request->sdate;
        $todo->stime = $request->stime;
        $todo->edate = $request->edate;
        $todo->etime = $request->etime;
        $todo->repeat = $request->repeat;
        $todo->save();

        return redirect(route('todo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->deleted_yn = 1;
        $todo->save();
        return redirect(route('todo.index'));
    }

    public function complete($id)
    {
        $todo = Todo::find($id);

        return view('todos/complete', [
            'todo' => $todo,
        ]);
    }
    public function complete_store($id, Request $request)
    {
        $todo = Todo::find($id);
        if($todo->repeat == 0){
            $todo->completed = 1;
            $todo->save();
        }

        $todo_complete = new Complete;
        $todo_complete->sdate = $request->sdate;
        $todo_complete->edate = $request->edate;
        $todo_complete->stime = $request->stime;
        $todo_complete->etime = $request->etime;
        $todo_complete->todo_id = $id;
        $todo_complete->save();

        return redirect(route('todo.index'));
    }
}
