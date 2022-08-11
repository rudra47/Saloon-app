<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saloon;
use Illuminate\Support\Collection;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saloonsAll = Saloon::where('status', 1)->get();
        //dd($saloons->toArray());
        //$coords = array_map(function($data) { return  $data['latitude'].",".$data['longitude']; }, $saloons->toArray() );
        //$from_latlong = implode("|", $coords);
        if(auth()->check()){
            $from_latlong = "".auth()->user()->latitude.",".auth()->user()->longitude;
        }else{
            $from_latlong = "23.7428818,90.4162051";
        }

        $saloons = new Collection;

        foreach ($saloonsAll as $saloon){
            $to_latlong = $saloon->latitude.",".$saloon->longitude;
            $googleApi = "AIzaSyBa0v-1H3GAkYu21zPyN_eUuedhxoTRZdw";
            $distance_data = file_get_contents(
                    'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$from_latlong.'&destinations='.$to_latlong.'&key='.$googleApi
                    );
            if(json_decode($distance_data, true)['rows'][0]['elements'][0]['distance']){
                if(json_decode($distance_data, true)['rows'][0]['elements'][0]['distance']['value']){
                    $distance = (json_decode($distance_data, true)['rows'][0]['elements'][0]['distance']['value']);
                }else{
                    $distance = 10000;
                }

                if($distance <= 5000){
                    $saloons->add($saloon);
                }
            }
        }

        return view('customer.index', compact('saloons'));
    }

    public function getSaloons($latitude,$longitude)
    {
        $saloonsAll = Saloon::where('status', 1)->get();
        $from_latlong = $latitude.",".$longitude;

        $saloons = new Collection;

        foreach ($saloonsAll as $saloon){
            $to_latlong = $saloon->latitude.",".$saloon->longitude;
            $googleApi = "AIzaSyBa0v-1H3GAkYu21zPyN_eUuedhxoTRZdw";
            $distance_data = file_get_contents(
                    'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$from_latlong.'&destinations='.$to_latlong.'&key='.$googleApi
                    );

            if(json_decode($distance_data, true)['rows'][0]['elements'][0]['distance']){
                if(json_decode($distance_data, true)['rows'][0]['elements'][0]['distance']['value']){
                    $distance = (json_decode($distance_data, true)['rows'][0]['elements'][0]['distance']['value']);
                }else{
                    $distance = 10000;
                }

                if($distance <= 5000){
                    $saloons->add($saloon);
                }
            }
        }

        return response()->json($saloons);
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
}
