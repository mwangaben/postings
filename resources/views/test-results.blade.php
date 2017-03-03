@extends('../layouts.master')

@section('content')
	<h1>You typed {{ request('name') }}</h1>
@stop