<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Location;
use Validator;

class LocationCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //
    }

    public function create(Request $request){

        $validator = \Validator::make($request->all(), [
            'title' => 'required|min:3|max:255',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'locatable_id' => 'required|numeric',
            'locatable_type' => ['required', Rule::in(['App\Event', 'App\User'])],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        
        $location = Location::create($request->all());

        $addressString = $request->input('title');
        $location->geocode();

        /*
        if(!$request->input('lat') || !$request->input('lat')){

            // address to map
            $map_address = $request->input('title');
            $url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".urlencode($map_address);
            $lat_long = get_object_vars(json_decode(file_get_contents($url)));
           
            // pick out what we need (lat,lng)
            $lat = $lat_long['results'][0]->geometry->location->lat;
            $lng = $lat_long['results'][0]->geometry->location->lng;
            
            $request['lat'] = $lat;
            $request['lng'] = $lng;
        }
        */
        
        return response()->json($location);
    }

    public function read(Request $request, $id){
        $location  = Location::find($id);
        return response()->json($location);
    }
 
    public function update(Request $request, $id){
        $location = Location::find($id);
        $validator = \Validator::make($request->all(), [
            'title'     => 'nullable|unique:events|max:255',
            'start_date'=> 'nullable|date',
            'end_date'=> 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if($request->input('title')) $location->title = $request->input('title'); 
        if($request->input('start_date')) $location->start_date = $request->input('start_date'); 
        if($request->input('end_date')) $location->end_date = $request->input('end_date');

        $location->save();
        return response()->json($location);
    }  

    public function delete($id){
        $location  = Location::find($id);
        $location->delete();
        return response()->json('Removed successfully.');
    } 

    public function index(){
        $locations  = Location::all();
        return response()->json($locations);
    }
}
