<?php

namespace App\Http\Controllers;

use App\Todo;
use App\User;
use App\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        /**
         * TODO : deleted_yn 을 쓰지 말고 deleted_at 을 쓰세요.
         */
        /** @var EloquentCollection|Category[] $categories */
        $categories = $user->categories()
            ->get();
        /** @var EloquentCollection|Todo[] $todos */
        $todos = $user->todos()
            ->where('completed', false)
            ->orderBy('level', 'desc')
            ->with([
                'category',
                'completes',
            ])
            ->get();

        /**
         * mutator 를 쓰면 쉽게 해결됩니다.
         */
//        foreach ($todos as $todo) {
//            if (Complete::where('todo_id', $todo->id)
//                ->whereDate('edate', date("Y-m-d"))
//                ->value('id')) {
//                $todo->is_today_completed = 1;
//            } else {
//                $todo->is_today_completed = 0;
//            }
//        }

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
        /** @var User $user */
        $user = $request->user();
        /** @var EloquentCollection|Category[] $categories */
        $categories = $user->categories()
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
        /** @var User $user */
        $user = $request->user();

        $data = $request->validate([
            'name' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
            'content' => 'nullbale',
            'level' => 'nullbale',
            'category_id' => 'nullbale',
            'stime' => 'nullbale',
            'etime' => 'nullbale',
            'repeat' => 'nullbale',
        ]);

        $user->todos()
            ->create($data);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Todo $todo)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var EloquentCollection|Category[] $categories */
        $categories = $user->categories()
            ->get();

        return view('todos/edit', [
            'categories' => $categories,
            'todo' => $todo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'name' => 'required',
            'sdate' => 'required',
            'edate' => 'required',
            'content' => 'nullbale',
            'level' => 'nullbale',
            'category_id' => 'nullbale',
            'stime' => 'nullbale',
            'etime' => 'nullbale',
            'repeat' => 'nullbale',
        ]);

        $todo->update($data);

        return redirect(route('todo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect(route('todo.index'));
    }

    public function complete(Todo $todo)
    {
        return view('todos/complete', [
            'todo' => $todo,
        ]);
    }

    public function storeComplete(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'sdate' => 'required',
            'edate' => 'required',
            'stime' => 'required',
            'etime' => 'required',
        ]);

        /**
         * == 보다는 === 를 씁니다.
         */
        if ($todo->repeat === 0) {
            $todo->completed = 1;
            $todo->save();
        }

        $todo->completes()
            ->create($data);

        return redirect(route('todo.index'));
    }
}
