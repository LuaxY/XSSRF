<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Faker;

use Validator;

class FakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakers = Faker::all();

        return view('fakers.index', ['fakers' => $fakers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fakers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Faker::$rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $faker = new Faker;
        $faker->name        = $request->input('name');
        $faker->description = $request->input('description');
        $faker->filename    = $request->input('filename');
        $faker->html        = $request->input('html');
        $faker->save();

        session()->flash('message', 'Successfully created faker!');

        return redirect('admin/fakers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faker = Faker::findOrFail($id);

        return view('fakers.show', ['faker' => $faker]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faker = Faker::findOrFail($id);

        return view('fakers.edit', ['faker' => $faker]);
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
        $validator = Validator::make($request->all(), Faker::$rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $faker = Faker::findOrFail($id);
        $faker->name        = $request->input('name');
        $faker->description = $request->input('description');
        $faker->filename    = $request->input('filename');
        $faker->html        = $request->input('html');
        $faker->save();

        session()->flash('message', 'Successfully updated faker!');

        return redirect('admin/fakers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faker = Faker::findOrFail($id);
        $faker->delete();

        session()->flash('message', 'Successfully deleted faker!');

        return redirect('admin/fakers');
    }
}
