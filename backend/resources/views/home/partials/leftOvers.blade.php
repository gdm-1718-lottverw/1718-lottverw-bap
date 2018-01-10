<h3 class='title'>Ochtend</h3>
<div id="leftover" class="flex wrap justified-start">
  @foreach($leftOver as $lo) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      @if($lo->in == false && $lo->out == false)
      <i class="fa fa-sign-in" id="{{$lo->id}}"></i>
      @elseif($lo->in == true && $lo->out == false)
      <i class="fa fa-sign-out" id="{{$lo->id}}"></i>
      @endif
    <a href="/log"><i class="fa fa-pencil" id="{{$lo->id}}"></i></a>
    </div>
    <a href="/child/{{$lo->child_id}}" class="child-info flex column">
      <span class="name">{{$lo->name}}</span>
      <p class="description">{{$lo->parent_notes}}</p>
    </a>
    @if(\Carbon\Carbon::parse($lo->created_at)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
        {{ Form::open(array('action' => 'Backoffice\Home\IndexController@destroy', 'class' => 'ban')) }} 
        {{ Form::hidden('_id', $lo->id )}}
        {{ Form::button('<i class="fa fa-ban" aria-hidden="true"></i>', ['type' => 'submit']) }}
        {{ Form::close()}}
      @endif
  </div>  
  @endforeach
</div>