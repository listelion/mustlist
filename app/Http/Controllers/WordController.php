<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\English;
use App\Korean;
use App\Korean_gubun;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    public function index(Request $request)
    {
        $englishes = English::with(['koreans'])->orderBy('id', 'desc')->get();

        foreach($englishes as $english){
            foreach ($english->koreans as $korean) {
                $korean->gubun = Korean_gubun::where('id', $korean->korean_gubun_id)->value('name');
            }
        }
        return view('words/index', [
            'englishes' => $englishes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $korean_gubuns = Korean_gubun::all();

        return view('words/create', [
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
            'english_word' => 'required',
            'korean_word' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('word.create'))
                ->withInput()
                ->withErrors($validator);
        }
        $temps = [];
        $i = 0;
        foreach($request->korean_gubun_id as $key => $value){
            foreach ($request->korean_word as $k => $v){
                if($key == $k){
                    $temps[$i]['id'] = $value;
                    $temps[$i]['word'] = $v;
                    $i += 1;
                }
            }
        }
        DB::transaction(function () use($request, $temps) {
            $english = new English;
            $english->word = $request->english_word;
            $english->user_id = $request->user()->id;
            $english->save();
            foreach($temps as $temp){
                $korean = new Korean;
                $korean->korean_gubun_id = $temp['id'];
                $korean->word =  $temp['word'];
                $korean->save();
                $korean->find($korean->id)->englishes()->attach($english->id);
            }
        });

        return redirect(route('word.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $location = Location::find($id);
        $locations = Location::all();
        $maxX = $locations->max('x');
        $maxY = $locations->max('y');

        return view('locations/edit', [
            'location' => $location,
            'locations' => $locations,
            'maxX' => $maxX,
            'maxY' => $maxY,
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
            'x' => 'required',
            'y' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('location.edit'))
                ->withInput()
                ->withErrors($validator);
        }

        $location = Location::find($id);
        $location->name = $request->name;
        $location->x = $request->x;
        $location->y = $request->y;
        $location->save();

        return redirect(route('location.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);
        $location->deleted_at = Carbon::now();
        $location->save();
        return redirect(route('location.index'));
    }
}
