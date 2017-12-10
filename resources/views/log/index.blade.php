@extends('layouts.app')

@section('content') 
  <section class="log" id="log">
    <table>
      <tbody>
      @if(count($log)  == 0)
        <h1>Er zijn geen log items gevonden.</h1>
        @else 
          @foreach($log as $l) 
          <tr> 
           
            <td class="ua">{{ Carbon\Carbon::parse($l->updated_at)->format('D d, H:i') }}</td>
            <td>{{$l->name}}</td>
            <td>{{$l->action}}</td>
            <td>{{ Carbon\Carbon::parse($l->time)->format('H:i') }}</td>
            <td class="hide {{$l->id}}"> 
            {{ Form::open(array('url' => 'log/' . $l->id . '/edit', 'method' => 'post')) }} 
            {{ Form::time('time', Carbon\Carbon::parse($l->time)->format('H:i'))}}
            {{ Form::button('Klaar', ['class' => 'btn', 'type' => 'submit']) }}
            {{ Form::close() }}
            </td>
            <td>
              <i class="fa fa-pencil" id="{{$l->id}}" aria-hidden="true"></i>
            </td>
            <td>
            {{ Form::open(array('url' => 'log/' . $l->id . '/delete', 'method' => 'post')) }} 
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