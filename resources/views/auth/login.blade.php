@extends('layouts.app')

@section('content')
<div class="login flex">
    <div class="intro flex justified-c ">
        <img class="flex-child center" src="{{ asset('../images/logo.png')}}"/>
    </div>
    <div class="column flex justified-c content">
    <div class="flex-child form-container center">
        {{ Form::open(array('route' => 'authenticate', 'class' => 'form column flex'))}}
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                <label for="username" class="col-md-4 control-label">Gebruikersnaam</label>
                <input id="username" type="text" placeholder="gebruikersnaam" class="form-control" name="username" value="{{ old('username') }}" required>
                <div class="border"></div>
                @if ($errors->has('username'))
                    <span class="help-block">
                       <strong>{{ $errors->first('username') }}</strong>
                    </span>
                 @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>
                <input id="password" type="password" placeholder="wachtwoord" class="form-control" name="password" required>
                <div class="border"></div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><label>Remember Me</label>
                </div>
            </div>
            <div class="form-group flex column">
                <button type="submit" class="flex-child end">Login</button>
            </div>
            <div class="flex-child center description">
                <a href="{{ route('register') }}">Registreer Nu</a>
            </div>
        {{Form::close()}}
        
    </div>
    </div>
</div>
@endsection
