@extends('master')
@section('content')

	<form action="{{ action('EmployeeController@create') }}" method="post" role="form" > 
		<table>
			<tr>
				<td>Name</td><td><input type="text" name="bname"> </td>
			</tr>
			<tr>
				<td>Bio</td><td><input type="text" name="bio"> </td>
			</tr>
			<tr>
				<td colspan="2">
				<input type="Submit">
				</td>
			</tr>
		</table>
	
	</form>
</html>
@stop