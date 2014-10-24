<?php

class SessionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /sessions
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /sessions/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
            return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /sessions
	 *
	 * @return Response
	 */
	public function store()
	{
		$input=Input::all();
                
                /** Auth::atempt() works perfectly always but the logged in 
                 * session is not retained when eloquent driver is selected 
                 * in auth.php **/
                $attempt=Auth::attempt([
                    'email'=>$input['email'],
                    'password'=>$input['password']                    
                ]);
                if($attempt) 
                {
                    
                    return Redirect::to('/profile');
                }                   
                else
                    echo 'Problem'.storage_path();                
	}
	public function refreshToken()
	{
		 echo '123s';
                 $ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"http://laravel.testserver.co/oauth/access_token?grant_type=refresh_token&
refresh_token=gOoTnxWoVU9bUebxjIOOUNqewJbRitMj5nfAWAVl&
client_id=newid&
client_secret=shyam1");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "grant_type=refresh_token&refresh_token=gOoTnxWoVU9bUebxjIOOUNqewJbRitMj5nfAWAVl&client_id=newid&client_secret=shyam1");

// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec ($ch);

curl_close ($ch);
var_dump($server_output);
                 
                 
	}

	/**
	 * Display the specified resource.
	 * GET /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /sessions/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /sessions/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		//
           Auth::logout();
            return Redirect::intended('');
	}
public function test()
{
    echo 'hei shilpa';
}
}