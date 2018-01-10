<div id="out"  class="flex wrap justified-start">
  @foreach($out as $o) 
    <div class="child-card flex">
      <div class="flex column btn justified-end">
       <a href="/log"><i class="fa fa-pencil" id="{{$o->id}}"></i></a>
      </div>
      <a href="/child/{{$o->child_id}}"  class="child-info flex column">
        <span class="name">{{$o->name}}</span>
        <p class="description">{{$o->parent_notes}}</p>
      </a>
    </div>  
  @endforeach
</div>
