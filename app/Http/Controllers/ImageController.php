<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Image;

use Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();

        return view('images.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function upload(Request $request)
    {
        $reponse = new \stdClass;

        $validator = Validator::make($request->all(), Image::$rules['upload']);

        if ($validator->fails())
        {
            $reponse->success = false;
            return response(json_encode($reponse), 415);
        }

        $reponse->success = true;
        $reponse->files = [];

        foreach ($request->file('files') as $file)
        {
            $filename = str_random(8) . '.' . $file->getClientOriginalExtension();

            $image = new Image;
            $image->path = $file->getClientOriginalName();
            $image->save();

            $image->filename = $filename;
            $image->size     = $file->getSize();

            $file->move(base_path() . '/public/i/' , $filename);

            $reponse->files[] = $image->serialize();
        }

        return json_encode($reponse);
    }

    public function Image($image)
    {
        return redirect('/i/' . $image);
    }
}
