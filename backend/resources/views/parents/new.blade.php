@extends('layouts.app')
@section('content')
	<section class="add-parent">
		<p class="title">Registreer ouders en kinderen</p>
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		{{Form::open(array('action' => 'Backoffice\Parents\IndexController@store', 'class' => 'form'))}}
			{{-- TOKEN --}}
			{{ Form::hidden('_token', csrf_token() )}}
			{{-- USERNAME --}}
		<i class="fa fa-user"></i>
		<div class="section">
			<div class="flex row">
				<div class="form-group flex column">
					{{ Form::label('username', 'Gebruikersnaam')}}
					{{ Form::text('username')}} 
					<div class="border"></div>
				</div>
				<div class="form-group flex column">
					{{-- PASSWORD AND PASSWORD CONFIMATION --}}
					{{ Form::label('password', 'wachtwoord')}}
					{{ Form::password('password')}} 
					<div class="border"></div>
				</div>
			</div>

			<div class="flex row">
				<div class="form-group flex column">
					{{ Form::label('password_confirmation', 'herhaal wachtwoord')}}
					{{ Form::password('password_confirmation')}}
					<div class="border"></div> 
				</div>
				<div class="form-group flex column">
					{{-- FAMILY TYPE --}}
					{{ Form::label('family_type', 'Familie type')}}
					<div class="select-dropdown">
					 	<select name="family_type" id="family_type" class="form-control">
					        <option disabled value="">Selecteer een familie type...</option>
					        <option value="kerngezin">kerngezin</option>
			                <option value="nieuw samengesteld gezin">nieuw samengesteld gezin</option>
				            <option value="alleenstaande ouder">alleenstaande ouder</option>
			                <option value="adoptie gezin">adoptie gezin</option>
			             </select>
					<div class="border"></div> 
				</div>	</div>
			</div>
			<div id="parent">
				<div class="flex row">
					<div class="form-group flex column">
						{{-- NAME --}}
						{{ Form::label('parent_1_name', 'Naam')}}
						{{ Form::text('parent_1_name')}} 
						<div class="border"></div>
					</div>
					<div class="form-group flex column">
						{{ Form::label('parent_1_relation', 'Relatie tot het kind')}}
						<div class="select-dropdown">
					        <select name="parent_1_relation" id="parent_1_relation" class="form-control">
					            <option disabled selected value="">Selecteer een relatie...</option>
					            <option value="mama">mama</option>
			                    <option value="papa">papa</option>
				                <option value="plus mama">plus mama</option>
				                <option value="plus papa">plus papa</option>
				             </select>
					         <div class="border"></div></div>
				        </div>
					</div>
				<div class="flex row">
					<div class="form-group flex column">
						{{-- EMAIL --}}
						{{ Form::label('parent_1_email', 'Email adres')}}
						{{ Form::email('parent_1_email')}} 
						<div class="border"></div>
					</div>
					<div class="form-group flex column">
						{{-- PHONE NUMBER --}}
						{{ Form::label('parent_1_phone_number', 'Telefoon nummer')}}
						{{ Form::text('parent_1_phone_number')}} 
						<div class="border"></div>
					</div>
				</div>
			</div>
		</div>
		<div id='parent-section' class="section">
			<div id="parent-1">
					<div class="flex row">
						<div class="form-group flex column">
							{{-- NAME --}}
							{{ Form::label('parent_2_name', 'Naam')}}
							{{ Form::text('parent_2_name')}} 
							<div class="border"></div>
						</div>
						<div class="form-group flex column">
							{{-- PARENT CHILD RELATIONSHIP --}}
							{{ Form::label('parent_2_relation', 'Relatie tot het kind')}}
							<div class="select-dropdown">
					            <select name="parent_2_relation" id="type" class="form-control">
					                <option disabled selected value="">Selecteer een relatie...</option>
					                <option value="mama">mama</option>
					                <option value="papa">papa</option>
					                <option value="plus mama">plus mama</option>
					                <option value="plus papa">plus papa</option>
		         	            </select>
				          <div class="border"></div></div>
					    </div>
					</div>
					<div class="flex row">
						<div class="form-group flex column">
							{{-- EMAIL --}}
							{{ Form::label('parent_2_email', 'Email adres')}}
							{{ Form::email('parent_2_email')}} 
							<div class="border"></div>
						</div>
						<div class="form-group flex column">
							{{-- PHONE NUMBER --}}
							{{ Form::label('parent_2_phone_number', 'Telefoon nummer')}}
							{{ Form::text('parent_2_phone_number')}} 
							<div class="border"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<i class="fa fa-globe" aria-hidden="true"></i>
		<div id="general" class="section">
			<div class="flex row">
				<div class="form-group flex column">
					{{-- ADDRESS --}}
					{{ Form::label('street', 'Straat')}}
					{{ Form::text('street')}} 
					<div class="border"></div>
				</div>
				<div class="form-group flex column">
					{{-- ADDRESS --}}
					{{ Form::label('number', 'Huisnummer')}}
					{{ Form::text('number')}} 
					<div class="border"></div>
				</div>
			</div>
			<div class="flex row">
				<div class="form-group flex column">
					{{-- ADDRESS --}}
					{{ Form::label('city', 'Gemeente')}}
					{{ Form::text('city')}} 
					<div class="border"></div>
				</div>
				<div class="form-group flex column">
					{{-- ADDRESS --}}
					{{ Form::label('postal_code', 'Postcode')}}
					{{ Form::text('postal_code')}} 
					<div class="border"></div>
				</div>
			</div>
			<div class="flex row">
				<div class="form-group flex column">
					{{-- ADDRESS --}}
					{{ Form::label('country', 'Land')}}
					{{ Form::text('country')}} 
					<div class="border"></div>
				</div>
			</div>
		</div>
		<i class="fa fa-users"></i>
		<div class="section">
			<div id="container_guardian" class="flex row">
				<div class="form-group flex column">
					{{-- GUARDIAN --}}
					{{ Form::label('guardian_name_0', 'Kind mag ook opgehaald worden door:')}}
					{{ Form::text('guardian_name_0')}} 
					<div class="border"></div>
				</div>
				<div class="form-group flex column">
					{{-- PHONE NUMBER --}}
					{{ Form::label('guardian_phone_number_0', 'Telefoon nummer')}}
					{{ Form::text('guardian_phone_number_0')}} 
					<div class="border"></div>
				</div>
			</div>
			<a id="guardian" onClick="addNode('guardian')" class="btn-plus">+ voeg persoon toe</a>
		</div>
		{!! Form::submit('Volgende', array('class'=>'btn')) !!}
		{{Form::close()}}
	</section>
	
@endsection('content')