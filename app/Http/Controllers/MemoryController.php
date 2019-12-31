<?php

namespace App\Http\Controllers;

use App\Memory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MemoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memories = Memory::all();

        return view('memories/index', [
            'memories' => $memories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $memory = new Memory;
        $memory->user_id = $request->user()->id;
        $memory->who = $request->who;
        $memory->when = $request->when;
        $memory->where = $request->where;
        $memory->what = $request->what;
        $memory->how = $request->how;
        $memory->why = $request->why;
        $memory->save();

        return redirect(route('memory.index'));
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
    public function edit($id, Request $request)
    {
        $user_id = $request->user()->id;

        $memory = User::find($user_id)
            ->memories()
            ->find($id);

        $memory->when = date("Y-m-d", strtotime($memory->when))."T".date("H:i", strtotime($memory->when));
        return view('memories/edit', [
            'memory' => $memory,
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
        $memory = Memory::find($id);
        $memory->who = $request->who;
        $memory->when = $request->when;
        $memory->where = $request->where;
        $memory->what = $request->what;
        $memory->how = $request->how;
        $memory->why = $request->why;
        $memory->save();

        return redirect(route('memory.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $memory = Memory::find($id);
        $memory->deleted_at = Carbon::now();
        $memory->save();
        return redirect(route('memory.index'));
    }
}
