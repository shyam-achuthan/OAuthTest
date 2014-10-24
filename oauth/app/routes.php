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

/** Everything related to user login and laravel Auth:: **/
Route::get('login',array('as'=>'login','uses'=>'SessionsController@create'));
Route::get('logout',array('as'=>'logout','uses'=>'SessionsController@destroy'));

Route::resource('sessions','SessionsController');

Route::get('profile',array('before' => 'auth', function()
{
    return View::make('profile')->with('title','Profile Page Loaded');
}));
 
Route::controller('password', 'RemindersController');

Route::get('user/profile', 'HomeController@showWelcome');
 
 

Route::match(array('GET', 'POST'), '/', function()
{
   return View::make('home')->with('title','Homepage Loaded');
});
/** End of Everything related to user login and laravel Auth:: **/


/** All routes for OAuth **/
Route::get('oauth/access_token', function()
{
    return AuthorizationServer::performAccessTokenFlow();
});

Route::get('/oauth/authorize', array('before' => 'check-authorization-params|auth', function()
{
    // get the data from the check-authorization-params filter
    $params = Session::get('authorize-params');

    // get the user id
    $params['user_id'] = Auth::user()->id;

    // display the authorization form
    return View::make('authorization-form', array('params' => $params));
}));

Route::post('/oauth/authorize', array('before' => 'check-authorization-params|auth|csrf', function()
{
    // get the data from the check-authorization-params filter
    $params = Session::get('authorize-params');

    // get the user id
    $params['user_id'] = Auth::user()->id;

    // check if the user approved or denied the authorization request
    if (Input::get('approve') !== null) {

        $code = AuthorizationServer::newAuthorizeRequest('user', $params['user_id'], $params);
        Session::forget('authorize-params');
        return Redirect::to(AuthorizationServer::makeRedirectWithCode($code, $params));
    }

    if (Input::get('deny') !== null) {

        Session::forget('authorize-params');

        return Redirect::to(AuthorizationServer::makeRedirectWithError($params));
    }
}));
/** End of All routes for OAuth **/



/** Secured End Points **/

Route::get('get-user', array('before' => 'oauth', function(){    
    $userid=ResourceServer::getOwnerId(); 
    $user=User::find($userid);
   die(json_encode($user)); 
}));

Route::get('get-user-role', array('before' => 'oauth:api', function(){    
   
    $user=User::where('email','=',Input::get('email'))->first();
    
    if($user)
    die(
           json_encode(
                   array(
                       'role'=>$user->user_role
                   )
                   )
           );
   else
       die(json_encode(array('status'=>403,'error'=>'forbidden','message'=>'No such user')));
}));



Route::get('secure-route-user', array('before' => 'oauth:scope1|oauth-owner:client', function(){
     
    return "oauth secured route for clients only<br>"
    . "Type: ".ResourceServer::getOwnerType()
    . "<br>Id : ".ResourceServer::getOwnerId();
}));
/** Secured End Points **/
