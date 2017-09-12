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

    public function commentable(){
        return $this->morphTo();
    }
}
