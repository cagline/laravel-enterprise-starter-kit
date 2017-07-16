<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Land;
use App\City;

class LandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lands = Land::all();
        return view('land.index', compact('lands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::lists('name_en', 'id');
        return view('land.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $land = Land::create($input);

        $inputWithImage = $this->uploadImages($input, $land);
dd($inputWithImage);
        if ($land->update($inputWithImage)) {
            \Session::flash('alert-class', 'success');
            \Session::flash('message', 'Successfully  Created');
        } else {
            \Session::flash('alert-class', 'error');
            \Session::flash('message', 'Something wrong with Creation !');
        }
        return redirect('land');
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
        $land = Land::find($id);
        $cities = City::lists('name_en', 'id');
        return view('land.edit', compact('land', 'cities'));
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
        $land = Land::find($id);
        $input = $request->all();
        $land->update($input);
        $inputWithImage = $this->uploadImages($input, $land);

        if ($land->update($inputWithImage)) {
            \Session::flash('alert-class', 'success');
            \Session::flash('message', 'Successfully  Updated');
        } else {
            \Session::flash('alert-class', 'error');
            \Session::flash('message', 'Something wrong with Updating !');
        }
        return redirect('land');
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

    public function uploadImages($input, $land)
    {
        for ($i = 1; $i <= 10; $i++) {

            if (isset($input['image' . $i]) && $input['image' . $i] != "") {
                $image = $input['image' . $i];
                $extension = $image->getClientOriginalExtension();
                $fileName = 'land-' . time() . '-' . $land->id . '-' . $i . '.' . $extension;
                Storage::disk('local')->put($fileName, File::get($image));
                
                $input['image' . $i] = $fileName;
            } elseif (empty(object_get($land, "image{$i}"))) {
                $input['image' . $i] = Land::DEFAULT_IMAGE;
            }
        }

        return $input;
    }

}
