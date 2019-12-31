<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\English;
use App\Korean;
use App\Korean_gubun;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class Korean_gubunController extends Controller
{
    public function create(Request $request)
    {
        $korean_gubuns = Korean_gubun::all();

        return view('korean_gubuns/create', [
            'korean_gubuns' => $korean_gubuns,
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
        ]);

        if ($validator->fails()) {
            return redirect(route('korean_gubun.create'))
                ->withInput()
                ->withErrors($validator);
        }

        $gubun = new Korean_gubun;
        $gubun->name = $request->name;
        $gubun->save();

        return redirect(route('korean_gubun.create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $gubun = Korean_gubun::find($id);
        $gubuns = Korean_gubun::all();

        return view('korean_gubuns/edit', [
            'gubun' => $gubun,
            'gubuns' => $gubuns,
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
        ]);

        if ($validator->fails()) {
            return redirect(route('korean_gubun.edit'))
                ->withInput()
                ->withErrors($validator);
        }

        $gubun = Korean_gubun::find($id);
        $gubun->name = $request->name;
        $gubun->save();

        return redirect(route('korean_gubun.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gubun = Korean_gubun::find($id);
        $gubun->deleted_at = Carbon::now();
        $gubun->save();
        return redirect(route('korean_gubun.create'));
    }
}
