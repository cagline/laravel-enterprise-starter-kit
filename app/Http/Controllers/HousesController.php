 <?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\House;
use App\City;
use Illuminate\Support\Facades\Config;

class HousesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $apiType = $request->header('api-type', Config::get('settings.apiType.client'));
        $houses = null;
        if($apiType == Config::get('settings.apiType.row')){
            $houses = House::paginate();
        }else{
            $houses = House::api()->paginate();
        }
        return $houses;
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
    public function show(Request $request, $id)
    {
        $apiType = $request->header('api-type', Config::get('settings.apiType.client'));
        $house = null;
        if($apiType == Config::get('settings.apiType.row')){
            $house = House::find($id);
        }else{
            $house= House::api()->find($id);
        }
        return $house;
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
    public function searchHouses(Request $request, $cityId)
    {
        $minPrice = $request->get('minPrice', 0);
        $maxPrice = $request->get('maxPrice');

        $apiType = $request->header('api-type', House::API_TYPE_CLIENT);
        $houses = null;
        
        if($apiType == House::API_TYPE_ROW){
            $housesQuery = House::where('city_id', $cityId);
        }else{
            $housesQuery = House::api()->where('city_id', $cityId);
        }
        
        if($maxPrice){
            $housesQuery->whereBetween('price', [$minPrice, $maxPrice]);
        }else{
            $housesQuery->where('price', '>=' ,$minPrice );
        }
        $houses = $housesQuery->paginate();
        return $houses;
    }
    
}
