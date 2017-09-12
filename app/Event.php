<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function location(){
        return $this->morphMany('App\Location', 'locatable');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('follows', 'attended');
    }
}
