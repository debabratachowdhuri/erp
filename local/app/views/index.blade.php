@extends('master')
@section('content')
<h1>Welcome</h1>

	@foreach($employees as $emp )
		{{ $emp->name;}}<br>
	@endforeach
	
@stop