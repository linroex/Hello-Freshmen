<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('template');
});
Route::post('/add',function(){
    $validator = Validator::make(array(
        'type'=>Input::get('type'),
        'ticket'=>Input::get('ticket_num'),
        'facebook'=>Input::get('facebook_id')
    ),array(
        'type'=>'required',
        'ticket'=>'required|numeric',
        'facebook'=>'required|unique:freshmen'
    ));

    if($validator->fails()){
        return $validator->messages();
    }else{
        Freshmen::insert(array(
            'type'=>Input::get('type'),
            'ticket'=>Input::get('ticket_num'),
            'facebook'=>Input::get('facebook_id')
        ));
        return 'ok';
    }
});
Route::post('/search',function(){
    $validator = Validator::make(array(
        'type'=>Input::get('type'),
        'ticket'=>Input::get('ticket_num')
    ),array(
        'type'=>'required',
        'ticket'=>'required'
    ));

    if($validator->fails()){
        return $validator->messages();
    }else{
        $tickets = explode('\n', Input::get('ticket_num'));
        foreach ($tickets as $ticket) {
            dd(Freshmen::where('ticket','=',trim($ticket)));
        }
        
        return 'ok';
    }
});