<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\House;
use App\City;

class HouseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houses = House::all();
        return view('house.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::lists('name_en', 'id');
        return view('house.create', compact('cities'));
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
        $house = House::create($input);

        $inputWithImage = $this->uploadImages($input, $house);

        if ($house->update($inputWithImage)) {
            \Session::flash('alert-class', 'success');
            \Session::flash('message', 'Successfully  Created');
        } else {
            \Session::flash('alert-class', 'error');
            \Session::flash('message', 'Something wrong with Creation !');
        }
        return redirect('house');
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
        $house = House::find($id);
        $cities = City::lists('name_en', 'id');
        return view('house.edit', compact('house', 'cities'));
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
        $house = House::find($id);
        $input = $request->all();
        $house->update($input);
        $inputWithImage = $this->uploadImages($input, $house);
        
        if ($house->update($inputWithImage)) {
            \Session::flash('alert-class', 'success');
            \Session::flash('message', 'Successfully  Updated');
        } else {
            \Session::flash('alert-class', 'error');
            \Session::flash('message', 'Something wrong with Updating !');
        }
        return redirect('house');
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

    public function uploadImages($input, $house)
    {
        for ($i = 1; $i <= 10; $i++) {

            if (isset($input['image' . $i]) && $input['image' . $i] != "") {
                $image = $input['image' . $i];
                $extension = $image->getClientOriginalExtension();
                $fileName = 'house-' . time() . '-' . $house->id . '-' . $i . '.' . $extension;
                Storage::disk('local')->put($fileName, File::get($image));
                $input['image' . $i] = $fileName;
            } elseif (empty(object_get($house, "image{$i}"))) {
                $input['image' . $i] = House::DEFAULT_IMAGE;
            }
        }

        return $input;
    }

}
