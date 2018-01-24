@extends('layouts.app')

@section('content')
<div class="container flex column justified-c register">
    <h1 class="flex-child center title">Registreer nu!</h1>
    <form class="form flex-child center" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="flex">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Bedrijf</label>
                <input id="name" type="text" placeholder="bedrijfsnaam" class="form-control" name="name" value="{{ old('name') }}" required>
                <div class="border"></div>
                @if ($errors->has('name'))
                    <span class="help-block">
                           <strong>{{ $errors->first('name') }}</strong>
                                </span>
                @endif
            </div>
                       
            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-4 control-label">Telefoon nummer</label>
                <input id="phone" type="text" placeholder="+321 23 45 67" class="form-control" name="phone" value="{{ old('phone') }}" required>
                <div class="border"></div>
                @if ($errors->has('phone'))
                    <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="flex">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Email adres</label>
                <input id="email" type="email" placeholder="voorbeeld@email.com" class="form-control" name="email" value="{{ old('email') }}" required>
                 <div class="border"></div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
     

            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">Gebruikersnaam</label>
                <input id="username" type="text" placeholder="Mijn unieke gebruikersnaam" class="form-control" name="username" value="{{ old('username') }}">
                <div class="border"></div>
                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="flex">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Wachtwoord</label>
                <input id="password" type="password" placeholder="Wachtwoord" class="form-control" name="password">
                <div class="border"></div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                 @endif
            </div>      
            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Herhaal wachtwoord</label>
                <input id="password-confirm" placeholder="Wachtwoord" type="password" class="form-control" name="password_confirmation">
                <div class="border"></div>
            </div>
        </div>

        <div class="flex justified-end">
            <button type="submit" class="btn">Register</button>
        </div>
    </form>
     <a class="flex-child center" href="/login">Ik heb al een account</a>
</div>
@endsection
