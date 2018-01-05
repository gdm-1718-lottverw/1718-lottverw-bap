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
		{{Form::open(array('action' => 'Backoffice\Child\IndexController@store', 'class' => 'form'))}}
			{{-- TOKEN --}}
			{{ Form::hidden('_token', csrf_token() )}}
			{{ Form::hidden('_id', $id )}}
			<i class="fa fa-vcard"></i>
			<div id="child" class="section">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- Child Name --}}
						{{ Form::label('child_name', 'Naam')}}
						{{ Form::text('child_name')}} 
						<div class="border"></div>
					</div>
					<div class="form-group flex column">
						{{-- NATIONAL REGESTRY NUMBER --}}
						{{ Form::label('national_regestry_number', 'Rijksregister nummer')}}
						{{ Form::text('national_regestry_number')}} 
						<div class="border"></div>
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- Child gender --}}
						{{ Form::label('gender', 'Geslacht')}}
						<div class="select-dropdown">
						{{ Form::select('gender', array(
							null => 'selecteer een geslacht...', 
							'man' => 'meisje', 
							'vrouw' => 'jongen',
						))}} 
						<div class="border"></div>
					</div>
					</div>
					<div class="form-group flex column">
						{{-- DATE OF BIRTH --}}
						{{ Form::label('date_of_birth', 'Geboorte datum')}}
						{{ Form::date('date_of_birth', \Carbon\Carbon::now())}} 
						<div class="border"></div>
					</div>
				</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- POTTY TRAINED --}}
						{{ Form::label('potty_trained', 'Zindelijk')}}
						<div class="row flex">
							<div class="checkbox flex centered">
								{{ Form::radio('potty_trained', true, true)}} <p>Ja</p>
							</div>
							<div class="checkbox flex centered">
								{{ Form::radio('potty_trained', false)}} <p>Nee</p>
							</div>
						</div>
					</div>
					<div class="form-group flex column">
						{{-- picture --}}
						{{ Form::label('picture', 'Foto')}}
						<div class="row flex">
						<div class="checkbox flex centered">
							{{ Form::radio('picture', true)}} <p>Ja</p>
						</div>
						<div class='checkbox flex centered'>
							{{ Form::radio('picture', false, true)}} <p>Nee</p>
						</div>
						</div>
					</div>
				</div>

			</div>
			<i class="fa fa-users"></i>
			<div class="section">
				<div id="container_guardian" class="flex row">
					<div class="form-group flex column">
						{{-- GUARDIAN --}}
						{{ Form::label('guardian_name', 'Kind mag ook opgehaald worden door:')}}
						{{ Form::text('guardian_name')}} 
						<div class="border"></div>
					</div>
					<div class="form-group flex column">
						{{-- PHONE NUMBER --}}
						{{ Form::label('guardian_phone_number', 'Telefoon nummer')}}
						{{ Form::text('guardian_phone_number')}} 
						<div class="border"></div>
					</div>
				</div>
				<a id="guardian" onClick="addNode('guardian')" class="btn-plus">+ voeg persoon toe</a>
			</div>
				<i class="fa fa-user-md"></i>
			<div class="section">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- CHILD DOCTOR --}}
						{{ Form::label('doctor', 'Dokter')}}
						{{ Form::text('doctor')}} 
						<div class="border"></div>
					</div>
					<div class="form-group flex column">
						{{-- CHILD DOCTOR PHONE NUMBER --}}
						{{ Form::label('doctor_phone', 'Telefoon nummer')}}
						{{ Form::text('doctor_phone')}} 
						<div class="border"></div>
					</div>
				</div>
			</div>
			<i class="fa fa-medkit"></i>
			<div id="doctor" class="section">
				<div id="container_allergies">
					<div class="flex row">
						<div class="form-group flex column">
							{{-- ALLERGIE --}}
							{{ Form::label('allergie_type', 'Type')}}
							<div class="select-dropdown">
							{{ Form::select('allergie_type', array(
								null => 'selecteer een type...', 
								'insect' => 'insecten', 
								'food' => 'voedsel',
								'latex' => 'latex',
								'animal' => 'dieren',
								'other' => 'andere',
							))}} 
							<div class="border"></div>
						</div>
						</div>
						<div class="form-group flex column">
							{{-- ALLERGIE --}}
							{{ Form::label('allergie_severe', 'Ernst')}}
							<div class="select-dropdown">
								{{ Form::select('allergie_severe', array(
									null => 'selecteer een ernst...', 
									'light' => 'heel oppervlakkig', 
									'medium' => 'matig',
									'severe' => 'zeer ernstig',
									'deadly' => 'dodelijk',
								))}} 
								<div class="border"></div>
							</div>
						</div>
					</div>
					<div class="flex row">
						<div class="form-group flex column">
							{{-- ALLERGIE --}}
							{{ Form::label('allergie', 'Bescrijving allergie')}}
							{{ Form::text('allergie')}} 
							<div class="border"></div>
						</div>
					</div>
				</div>
				<a id="allergies" class="btn-plus" onClick="addNode('allergies')">+ allergie</a>

				<div class="flex row"  id='container_pedagogic'>
					<div class="form-group flex column">
						{{-- PEDAGOGIC CARE --}}
						{{ Form::label('pedagogic_care', 'Beschrijving padagogische aandacht')}}
						{{ Form::text('pedagogic_care')}} 
						<div class="border"></div>
						
					</div>
				</div>
				<a id="pedagogic" class="btn-plus" onClick="addNode('pedagogic')">+ pedagogische aandacht</a>
				
				<div class="flex row" id='container_medical'>
					<div class="form-group flex column">
						{{-- MEDICAL CARE --}}
						{{ Form::label('pedagogic_care', 'Beschrijving medische aandacht')}}
						{{ Form::text('pedagogic_care')}} 
						<div class="border"></div>
					</div>
				</div>
				<a id="medical" class="btn-plus" onClick="addNode('medical')">+ aandoening</a>
				
			</div>
		<i class="fa fa-comment-o"></i>
		<div class="section">
			<div class="flex row">
					<div class="form-group flex column">
					{{-- OTHER INFO --}}
					{{ Form::label('other_info', 'Andere opmerkingen.')}}
					{{ Form::text('other_info')}} 
					<div class="border"></div>
				</div>
			</div>
		</div>
		{!! Form::submit('Volgende', array('class'=>'btn')) !!}

		{{Form::close()}}
	</div>
	
@endsection('content')