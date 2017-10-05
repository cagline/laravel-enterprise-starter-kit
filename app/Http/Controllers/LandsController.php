<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Land;
use App\City;
use Illuminate\Support\Facades\Config;

class LandsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiType = $request->header('api-type', Land::API_TYPE_CLIENT);
        $lands = null;
        if($apiType == Land::API_TYPE_ROW){
            $lands = Land::defaultType()->paginate();
        }else{
            $lands = Land::api()->defaultType()->paginate();
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
            $landsQuery = Land::defaultType()->where('city_id', $cityId);
        }else{
            $landsQuery = Land::api()->defaultType()->where('city_id', $cityId);
        }
        
        if($maxPrice){
            $landsQuery->whereBetween('price', [$minPrice, $maxPrice]);
        }else{
            $landsQuery->where('price', '>=' ,$minPrice );
        }
        $lands = $landsQuery->paginate();
        return $lands;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLandServeys(Request $request)
    {
        $apiType = $request->header('api-type', Config::get('settings.apiType.client'));
        $lands = null;
        if($apiType == Config::get('settings.apiType.row')){
            $lands = Land::landServey()->paginate();
        }else{
            $lands = Land::api()->landServey()->paginate();
        }
        return $lands;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOnGoingLandServeys(Request $request)
    {
        $apiType = $request->header('api-type', Config::get('settings.apiType.client'));
        $lands = null;
        if($apiType == Config::get('settings.apiType.row')){
            $lands = Land::landServey()->paginate();
        }else{
            $lands = Land::api()->onGoingLandServey()->paginate();
        }
        return $lands;
    }
}
