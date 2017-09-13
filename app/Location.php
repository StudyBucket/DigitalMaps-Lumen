<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'lat', 'lng', 'locatable_id', 'locatable_type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function locatable(){
        return $this->morphTo();
    }

    public function geocode($addressString=NULL){
        if($addressString == NULL && $this->title != NULL){
            $addressString = $this->title;
        } else {
            return 'No geocodable string given.';
        }
        // address to map
        $url = "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=".urlencode($addressString);
        $lat_long = get_object_vars(json_decode(file_get_contents($url)));
        // pick out what we need (lat,lng)
        $result['lat'] = $lat_long['results'][0]->geometry->location->lat;
        $result['lng'] = $lat_long['results'][0]->geometry->location->lng;
        // write 
        $this->lat = $result['lat'];
        $this->lng = $result['lng'];
        $this->save();
    }
}
