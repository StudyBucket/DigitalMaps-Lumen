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


$router->group(['prefix' => 'api/v1'], function($router){

	$router->post('user','UserCtrl@create');
	$router->post('user/{id}','UserCtrl@update');
	$router->get('user/{id}','UserCtrl@read');
	$router->delete('user/{id}','UserCtrl@delete');
	$router->get('user','UserCtrl@index');

	$router->get('user/{id}/attended','UserCtrl@getAttended');
	$router->get('user/{id}/followed','UserCtrl@getFollowed');

});


$router->group(['prefix' => 'api/v1'], function($router){

	$router->post('event','EventCtrl@create');
	$router->post('event/{id}','EventCtrl@update');
	$router->get('event/{id}','EventCtrl@read');
	$router->delete('event/{id}','EventCtrl@delete');
	$router->get('event','EventCtrl@index');

	$router->get('event/{id}/attendants','EventCtrl@getAttendants');
	$router->get('event/{id}/followers','EventCtrl@getFollowers');

});


$router->group(['prefix' => 'api/v1'], function($router){

	$router->post('location','LocationCtrl@create');
	$router->post('location/{id}','LocationCtrl@update');
	$router->get('location/{id}','LocationCtrl@read');
	$router->delete('location/{id}','LocationCtrl@delete');
	$router->get('location','LocationCtrl@index');

});
