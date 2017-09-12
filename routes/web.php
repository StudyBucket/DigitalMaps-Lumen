<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return \App\User::all();
});

$router->get('/test', function () use ($router) {
		$uid  = App\User::select('id')->orderByRaw("RAND()")->first()->id;
    $user = App\User::find($uid );

    echo $user->name;
		foreach ($user->events as $event) {
		    echo "<br>".$event->title;
		    if($event->pivot->follows == 1){
		    	echo "*";
		    }

		    if($event->pivot->attended == 1){
		    	echo "+";
		    }
		}
});


