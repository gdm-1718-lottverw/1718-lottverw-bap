<div id="in"  class="flex wrap justified-start">
  @foreach($in as $i) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      <i class="fa fa-sign-out" id="{{$i->child_id}}"></i>
    <a href="/log"><i class="fa fa-pencil" id="{{$i->child_id}}"></i></a>
    </div>
    <a href="/child/{{$i->child_id}}"  class="child-info flex column">
      <span class="name">{{$i->name}}</span>
      <p class="description">{{$i->parent_notes}}</p>
    </a>
     @if(\Carbon\Carbon::parse($i->created_at)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
        {{ Form::open(array('action' => 'Backoffice\Home\IndexController@destroy', 'class' => 'ban')) }} 
        {{ Form::hidden('_id', $i->id )}}
        {{ Form::button('<i class="fa fa-ban" aria-hidden="true"></i>', ['type' => 'submit']) }}
        {{ Form::close()}}
      @endif
  </div>  
  @endforeach
</div>