@extends('layout.default')
@section('content')
<h1>Welcome your email is {{ Auth::user()->email }}</h1>
<p><a href="http://laravel.testserver.co/oauth/authorize?client_id=newid&redirect_uri=http://testserver.co/index.php&response_type=code&scope=scope1">Authorize App</a></p>
<p> 
   {{ link_to_route('logout','Logout') }}
</p>
@endsection
