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
		{{Form::open()}}
			{{-- TOKEN --}}
			{{ Form::hidden('_token', csrf_token() )}}
			<i class="fa fa-users"></i>
			<div class="section">
				<div id="guardian" class="flex row">
					<div class="form-group flex column">
						{{-- GUARDIAN --}}
						{{ Form::label('guardian_name', 'Voogd')}}
						{{ Form::text('guardian_name')}} 
						<a id="add-guardian" class="btn btn-plus">+ voeg voogd toe</a>
					</div>
					<div class="form-group flex column">
						{{-- PHONE NUMBER --}}
						{{ Form::label('guardian_phone_number', 'Telefoon nummer')}}
						{{ Form::text('guardian_phone_number')}} 
					</div>
				</div>
			</div>
			<i class="fa fa-vcard"></i>
			<div id="child" class="section">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- Child Name --}}
						{{ Form::label('child_name', 'Naam')}}
						{{ Form::text('child_name')}} 
					</div>
					<div class="form-group flex column">
						{{-- NATIONAL REGESTRY NUMBER --}}
						{{ Form::label('national_registry_number', 'Rijksregister nummer')}}
						{{ Form::text('national_registry_number')}} 
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- Child Name --}}
						{{ Form::label('gender', 'Geslacht')}}
						{{ Form::select('gender', array(
							'man' => 'meisje', 
							'vrouw' => 'jongen',
						))}} 
					</div>
					<div class="form-group flex column">
						{{-- DATE OF BIRTH --}}
						{{ Form::label('date_of_birth', 'Geboorte datum')}}
						{{ Form::date('name', \Carbon\Carbon::now())}} 
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- POTTY TRAINED --}}
						{{ Form::label('potty_trained', 'Zindelijk')}}
						<div class="form-item-check">
							{{ Form::checkbox('potty_trained', 'ja')}} <p>Ja</p>
							{{ Form::checkbox('potty_trained', 'neen')}} <p>Neen</p>
						</div>
					</div>
					<div class="form-group flex column">
						{{-- Pictures --}}
						{{ Form::label('pictures', 'Foto')}}
						<div class="form-item-check">
							{{ Form::checkbox('pictures', 'ja')}} <p>Ja</p>
							{{ Form::checkbox('pictures', 'neen')}} <p>Neen</p>
						</div>
					</div>
				</div>

			</div>
			<i class="fa fa-medkit"></i>
			<div class="section"></div>
			<i class="fa fa-comment-o"></i>
			{!! Form::submit('Volgende', array('class'=>'btn')) !!}

		{{Form::close()}}
	</div>
	
@endsection('content')