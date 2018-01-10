@extends('layouts.app')

@section('content') 
  <section class="log" id="log">
    <table>
      <thead>
        <tr>
          <td class="row-2">Datum</td>
          <td class="row-3">Kind</td>
          <td class="row-2">type</td>
          <td class="row-1 text-align-c">Actie</td>
          <td class="row-1 text-align-c">Tijd</td>
          <td class="row-1"></td>
          <td class="row-1"></td>
        </tr>
      </thead>
      <tbody>
      @if(count($log)  == 0)
        <h1>Er zijn geen log items gevonden.</h1>
        @else 
          @foreach($log as $l) 
          <tr> 
            <td class="row-2">{{ Carbon\Carbon::parse($l->updated_at)->format('D d, H:i') }}</td>
            <td class="row-3">{{$l->name}}</td>
            <td class="row-2">{{$l->type}}</td>
            <td class="row-1 text-align-c">{{$l->action}}</td>
            <td class="row-1 text-align-c">{{ Carbon\Carbon::parse($l->time)->format('H:i') }}</td>
            <td class="hide row-3 {{$l->id}} text-align-c"> 
            {{ Form::open(array('url' => 'log/' . $l->id . '/edit', 'method' => 'post', 'id' => 'edit')) }} 
            {{ Form::time('time', Carbon\Carbon::parse($l->time)->format('H:i'))}}
            {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i>', ['class' => 'btn', 'type' => 'submit']) }}
            <i id="close-{{$l->id}}" class="fa fa-times btn cancel" aria-hidden="true"></i>
            {{ Form::close() }}
            </td>
            <td class="row-1 text-align-c" id="btn-edit">
              <i class="fa fa-pencil" id="{{$l->id}}" aria-hidden="true"></i>
            </td>
            <td class="row-1 text-align-c">
            {{ Form::open(array('url' => 'log/' . $l->id . '/delete', 'method' => 'post','id' => 'delete')) }} 
            {{ Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['class' => 'btn', 'type' => 'submit']) }}
            {{ Form::close() }}
            </td>
          </tr>
          @endforeach
      @endif
      </tbody>
    </table>
</section
@endsection('content')