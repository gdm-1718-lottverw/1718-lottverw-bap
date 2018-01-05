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
		{{Form::open(['action' => 'Backoffice\Child\IndexController@store'])}}
			{{-- TOKEN --}}
			{{ Form::hidden('_token', csrf_token() )}}
			{{ Form::hidden('_id', $id )}}
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
				<div class="flex row">
					<div class="form-group flex column">
						{{-- CHILD DOCTOR --}}
						{{ Form::label('doctor', 'Dokter')}}
						{{ Form::text('doctor')}} 
					</div>
					<div class="form-group flex column">
						{{-- CHILD DOCTOR PHONE NUMBER --}}
						{{ Form::label('doctor_phone', 'Telefoon nummer')}}
						{{ Form::text('doctor_phone')}} 
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- MEDICAL CARE --}}
						{{ Form::label('medical_care', 'Bescrijving medische aandoening')}}
						{{ Form::text('medical_care')}} 
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
			<div id="doctor" class="section">
				<div id="container_allergie">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- ALLERGIE --}}
						{{ Form::label('allergie_type', 'Type')}}
						{{ Form::select('allergie_type', array(
							'insect' => 'insecten', 
							'food' => 'voedsel',
							'latex' => 'latex',
							'animal' => 'dieren',
							'other' => 'andere',
						))}} 
					</div>
					<div class="form-group flex column">
						{{-- ALLERGIE --}}
						{{ Form::label('allergie_severe', 'Ernst')}}
						{{ Form::select('allergie_severe', array(
							'light' => 'heel oppervlakkig', 
							'medium' => 'matig',
							'severe' => 'zeer ernstig',
							'deadly' => 'dodelijk',
						))}} 
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- ALLERGIE --}}
						{{ Form::label('allergie', 'Bescrijving allergie')}}
						{{ Form::text('allergie')}} 
					</div>
				</div></div>
				<a id="allergie" onClick="addNode('allergie')">+ allergie</a>

				<div class="flex row"  id='container_pedagogic'>
					<div class="form-group flex column">
						{{-- PEDAGOGIC CARE --}}
						{{ Form::label('pedagogic_care', 'Beschrijving padagogische aandacht')}}
						{{ Form::text('pedagogic_care')}} 
						
					</div>
				</div>
				<a id="pedagogic" onClick="addNode('pedagogic')">+ pedagogische aandacht</a>
				
				<div class="flex row" id='container_medical'>
					<div class="form-group flex column">
						{{-- MEDICAL CARE --}}
						{{ Form::label('pedagogic_care', 'Beschrijving medische aandacht')}}
						{{ Form::text('pedagogic_care')}} 
						
					</div>
				</div>
				<a id="medical" onClick="addNode('medical')">+ aandoening</a>
				
			</div>
		</div>
		<i class="fa fa-comment-o"></i>
		<div class="section">
			<div class="flex row">
					<div class="form-group flex column">
					{{-- OTHER INFO --}}
					{{ Form::label('other_info', 'Andere opmerkingen.')}}
					{{ Form::text('other_info')}} 
				</div>
			</div>
		</div>
			{!! Form::submit('Volgende', array('class'=>'btn')) !!}

		{{Form::close()}}
	</div>
	
@endsection('content')