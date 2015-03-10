@extends('layout')
@section('content')
WELCOME
	@foreach($employees as $emp )
		{{ print_r($emp->name); }}<br>
	@endforeach
@stop