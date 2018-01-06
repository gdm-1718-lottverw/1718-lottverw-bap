@extends('layouts.app')
@section('content')
	<div class="add-child">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		{{Form::open(array('action' => 'Backoffice\Parents\IndexController@storeGeneralInfo', 'class' => 'form'))}}
			{{-- TOKEN --}}
			{{ Form::hidden('_token', csrf_token() )}}
			{{ Form::hidden('_id', $id )}}
			
		{!! Form::submit('Opslaan', array('class'=>'btn')) !!}

		{{Form::close()}}
	</div>
	
@endsection('content')