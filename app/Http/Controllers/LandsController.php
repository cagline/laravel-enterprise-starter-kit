<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Land;
use App\City;

class LandsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Land::api()->paginate();
        $apiType = $request->header('api-type', Land::API_TYPE_CLIENT);
        $lands = null;
        if($apiType == Land::API_TYPE_ROW){
            $lands = Land::paginate();
        }else{
            $lands = Land::api()->paginate();
        }
        return $lands;
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
        return Land::api()->find($id);
        $apiType = $request->header('api-type', Config::get('settings.apiType.client'));
        $land = null;
        if($apiType == Config::get('settings.apiType.row')){
            $land = Land::find($id);
        }else{
            $land= Land::api()->find($id);
        }
        return $land;
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

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchLands(Request $request, $cityId)
    {
        $minPrice = $request->get('minPrice', 0);
        $maxPrice = $request->get('maxPrice');

        $apiType = $request->header('api-type', Land::API_TYPE_CLIENT);
        $lands = null;
        
        if($apiType == Land::API_TYPE_ROW){
            $landsQuery = Land::where('city_id', $cityId);
        }else{
            $landsQuery = Land::api()->where('city_id', $cityId);
        }
        
        if($maxPrice){
            $landsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        }else{
            $landsQuery->where('price', '>=' ,$minPrice );
        }
        $lands = $landsQuery->paginate();
        return $lands;
    }

}
