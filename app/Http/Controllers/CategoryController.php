<?php

namespace App\Http\Controllers;
use App\Category;
use App\User;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        $user_id = $request->user()->id;
        $categories = User::find($user_id)
            ->categories()
            ->where('deleted_yn', false)
            ->get();

        return view('categories/create',[
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
        ]);

        if ($validator->fails()) {
            return redirect(route('categories.create'))
                ->withInput()
                ->withErrors($validator);
        }

        $category = new Category;
        $category->name = $request->name;
        $category->user_id = $request->user()->id;
        $category->save();

        return redirect(route('categories.create'));
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
