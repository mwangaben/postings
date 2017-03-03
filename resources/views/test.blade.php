@extends('../layouts.master')

@section('content')
	<h1>Laravel </h1>
	<form action="/test" method="POST">
		{{ csrf_field() }}
		<input type="text" name="name">
		<button type="submit">Submit</button>
	</form>
@stop