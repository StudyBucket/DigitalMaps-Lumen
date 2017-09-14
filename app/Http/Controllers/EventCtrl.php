<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use Validator;

class EventCtrl extends Controller
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
            'title'     => 'required|unique:events|max:255',
            'start_date'=> 'required|date',
            'end_date'=> 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
        
        $event = Event::create($request->all());
        return response()->json($event);
    }

    public function read(Request $request, $id){
        $event  = Event::find($id);
        return response()->json($event);
    }
 
    public function update(Request $request, $id){
        $event = Event::find($id);
        $validator = \Validator::make($request->all(), [
            'title'     => 'nullable|unique:events|max:255',
            'start_date'=> 'nullable|date',
            'end_date'=> 'nullable|date',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        if($request->input('title')) $event->title = $request->input('title'); 
        if($request->input('start_date')) $event->start_date = $request->input('start_date'); 
        if($request->input('end_date')) $event->end_date = $request->input('end_date');

        $event->save();
        return response()->json($event);
    }  

    public function delete($id){
        $event  = Event::find($id);
        $event->delete();
        return response()->json('Removed successfully.');
    } 

    public function index(){
        $events = Event::all();
        $events->load('Location');
        return response()->json($events);
    }


    // Additional Query Functions

    public function getAttendants($id){
        if(Event::find($id)) {
            $attendants = Event::find($id)->users()->where('event_user.attended', 1)->get();
            $attendants->load('Location');
            return $attendants;  
        }
        return [];     
    }

     public function getFollowers($id){
        if(Event::find($id)) {
            $followers = Event::find($id)->users()->where('event_user.follows', 1)->get();
            $followers->load('Location');
            return $followers;  
        }
        return [];     
    }
}











