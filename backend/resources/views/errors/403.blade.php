@extends('layouts.app')
<div id="error" class="flex column justified-c centered">
	<img class="logo" src="{{ asset('../images/logo-sm.png')}}"/>
	<h2 class="message">Oops {{ $exception->getMessage() }}...</h2>
</div>
