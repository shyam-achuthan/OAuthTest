@extends('layout.default')
@section('content')
<h1>You are on the home page</h1>
<p> 
   {{ link_to_route('login','Login') }}
</p>
@endsection
