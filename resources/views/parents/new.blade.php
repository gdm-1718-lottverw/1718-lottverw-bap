@extends('layouts.app')
@section('content')
	<div class="add-parent">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		{{Form::open(['action' => 'Backoffice\Parents\IndexController@store'])}}
			{{-- TOKEN --}}
			{{ Form::hidden('_token', csrf_token() )}}
			{{-- USERNAME --}}
		<i class="fa fa-unlock-alt"></i>
		<div class="section">
			<div class="flex row">
				<div class="form-group flex column">
					{{ Form::label('username', 'Gebruikersnaam')}}
					{{ Form::text('username')}} 
				</div>
				<div class="form-group flex column">
					{{-- PASSWORD AND PASSWORD CONFIMATION --}}
					{{ Form::label('password', 'wachtwoord')}}
					{{ Form::password('password')}} 
				</div>
			</div>

			<div class="flex row">
				<div class="form-group flex column">
					{{ Form::label('password_confirmation', 'herhaal wachtwoord')}}
					{{ Form::password('password_confirmation')}} 
				</div>
				<div class="form-group flex column">
					{{-- FAMILY TYPE --}}
					{{ Form::label('family_type', 'Familie type')}}
					{{ Form::select('family_type', array(
						'kerngezin' => 'kerngezin', 
						'nieuw samengesteld gezin' => 'nieuw samengesteld gezin',
						'alleenstaande ouder' => 'alleenstaande ouder',
						'adoptie gezin' => 'adoptie gezin',
					))}} 
				</div>
			</div>
			<div id="parent">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- NAME --}}
						{{ Form::label('parent_1_name', 'Naam')}}
						{{ Form::text('parent_1_name')}} 
					</div>
					<div class="form-group flex column">
						{{-- PARENT CHILD RELATIONSHIP --}}
						{{ Form::label('parent_1_relation', 'Relatie tot het kind')}}
						{{ Form::select( 'parent_1_relation', array(
							'mama' => 'mama', 
							'papa' => 'papa',
							'voogd' => 'voogd',
						))}} 
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- EMAIL --}}
						{{ Form::label('parent_1_email', 'Email adres')}}
						{{ Form::email('parent_1_email')}} 
				</div>
					<div class="form-group flex column">
						{{-- PHONE NUMBER --}}
						{{ Form::label('parent_1_phone_number', 'Telefoon nummer')}}
						{{ Form::text('parent_1_phone_number')}} 
					</div>
				</div>
			</div>
		</div>
		<div id="parent-1">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- NAME --}}
						{{ Form::label('parent_2_name', 'Naam')}}
						{{ Form::text('parent_2_name')}} 
					</div>
					<div class="form-group flex column">
						{{-- PARENT CHILD RELATIONSHIP --}}
						{{ Form::label('parent_2_relation', 'Relatie tot het kind')}}
						{{ Form::select('parent_2_relation', array(
							'mama' => 'mama', 
							'papa' => 'papa',
							'voogd' => 'voogd',
						))}} 
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- EMAIL --}}
						{{ Form::label('parent_2_email', 'Email adres')}}
						{{ Form::email('parent_2_email')}} 
					</div>
					<div class="form-group flex column">
						{{-- PHONE NUMBER --}}
						{{ Form::label('parent_2_phone_number', 'Telefoon nummer')}}
						{{ Form::text('parent_2_phone_number')}} 
					</div>
				</div>
			</div>
		</div>
		{!! Form::submit('Volgende', array('class'=>'btn')) !!}

		{{Form::close()}}
	</div>
	
@endsection('content')