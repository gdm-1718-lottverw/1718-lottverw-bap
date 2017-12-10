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
            <td class="ua">{{ Carbon\Carbon::parse($l->updated_at)->format('d-m-\'y H:i:s') }}</td>
            <td>{{$l->name}}</td>
            <td>{{$l->action}}</td>
            <td>{{ Carbon\Carbon::parse($l->time)->format('H:i') }}</td>
            <td>
            {{ Form::open(array('url' => 'log/' . $l->id . '/edit', 'method' => 'post')) }} 
            {{ Form::button('<i class="fa fa-pencil" aria-hidden="true"></i>', ['id' => 'edit', 'class' => 'btn', 'type' => 'submit']) }}
            {{ Form::close() }}
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