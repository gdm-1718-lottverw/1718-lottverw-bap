@extends('layouts.app')
@section('content')
	<div class="add-child">
			<p class="title">Voeg een kind toe</p>
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
			@for ($i = 0; Count($parents) > $i; $i++)
				{{ Form::hidden('parent_' . $i, $parents[$i] )}}
			@endfor
			@if($guards != null)
				@for ($i = 0; Count($guards) > $i; $i++)
					{{ Form::hidden('guard_' . $i, $guards[$i] )}}
				@endfor
			@endif
			
			<i class="fa fa-vcard"></i>
			<div id="child" class="section">
				<div class="flex row">
					<h6 class="section-header">Algemene info</h6>
				</div>
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
							 <select name="gender" id="type" class="form-control">
					            <option disabled selected value="">Selecteer een geslacht...</option>
					             <option value="vrouw">vrouw</option>
					            <option value="man">man</option>
				             </select>
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
								{{ Form::radio('potty_trained', 1, true)}} <p>Ja</p>
							</div>
							<div class="checkbox flex centered">
								{{ Form::radio('potty_trained', 0, false)}} <p>Nee</p>
							</div>
						</div>
					</div>
					<div class="form-group flex column">
						{{-- picture --}}
						{{ Form::label('picture', 'Foto')}}
						<div class="row flex">
						<div class="checkbox flex centered">
							{{ Form::radio('picture', 1, false)}} <p>Ja</p>
						</div>
						<div class='checkbox flex centered'>
							{{ Form::radio('picture', 0, true)}} <p>Nee</p>
						</div>
						</div>
					</div>
				</div>
			</div>
		<i class="fa fa-user-md"></i>
			<div class="section">
				<div class="flex row">
					<h6 class="section-header">Arts</h6>
				</div>
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
							<h6 class="section-header">Allergieën</h6>
						</div>
						<div class="flex row">
						<div class="form-group flex column">
							{{-- ALLERGIE --}}
							{{ Form::label('allergie_type_0', 'Type')}}
							<div class="select-dropdown">
							<select name="allergie_type_0" id="type" class="form-control">
					            <option disabled selected value="">Selecteer een type...</option>
					            <option value="food">voedsel</option>
					            <option value="insects">insecten</option>
					            <option value="animals">dieren</option>
					            <option value="other">andere</option>
				             </select>
							<div class="border"></div>
						</div>
						</div>
						<div class="form-group flex column">
							{{-- ALLERGIE --}}
							{{ Form::label('allergie_gravity_0', 'Ernst')}}
							<div class="select-dropdown">
								<select name="allergie_gravity_0" id="type" class="form-control">
						            <option disabled selected value="">Selecteer de ernst...</option>
						            <option value="light">heel oppervlakkig</option>
						            <option value="medium">matig</option>
						            <option value="severe">ernstig</option>
						            <option value="deadly">extreem gevaarlijk</option>
					            </select>
								<div class="border"></div>
							</div>
						</div>
					</div>
					<div class="flex row">
						<div class="form-group flex column">
							{{-- ALLERGIE --}}
							{{ Form::label('allergie_0', 'Omschrijf de allergie')}}
							{{ Form::text('allergie_0')}} 
							<div class="border"></div>
						</div>
					</div>
				</div>
				<a id="allergies" class="btn-plus" onClick="addNode('allergies')">+ allergie</a>
				<div class="flex row">
					<h6 class="section-header">Pedagogische aandacht</h6>
				</div>
				<div class="flex row"  id='container_pedagogic'>		
					<div class="form-group flex column">
						{{-- PEDAGOGIC CARE --}}
						{{ Form::label('pedagogic_care_0', 'Omschrijf de aandacht')}}
						{{ Form::text('pedagogic_care_0')}} 
						<div class="border"></div>
						
					</div>
				</div>
				<a id="pedagogic" class="btn-plus" onClick="addNode('pedagogic')">+ pedagogische aandacht</a>
				<div class="flex row">
							<h6 class="section-header">Medische info</h6>
						</div>
				<div class="flex row" id='container_medical'>
					<div class="form-group flex column">
						{{-- MEDICAL CARE --}}
						{{ Form::label('medical_care_0', 'Omschrijf de klacht')}}
						{{ Form::text('medical_care_0')}} 
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
		<i class="fa fa-plus"></i>
		<div class="section">
			<div class="row flex">
				<div class="form-group flex column">
					{{ Form::label('another_child', 'Nog een kind toevoegen.')}}
					<div class="row flex">
						<div class="checkbox flex centered">
							{{ Form::radio('another_child', 1, true)}} <p>Ja</p>
						</div>
						<div class="checkbox flex centered">
							{{ Form::radio('another_child', 0, false)}} <p>Nee</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row flex justified-end">
		{!! Form::submit('Opslaan', array('class'=>'btn', 'id' => 'submit'))!!}
		</div>
		{{Form::close()}}


	</div>
	
@endsection('content')