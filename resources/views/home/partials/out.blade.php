<div id="out"  class="flex wrap justified-start">
  @foreach($out as $o) 
    <div class="child-card flex">
      <div class="flex column btn justified-end">
       <a href="/log"><i class="fa fa-pencil" id="{{$o->child_id}}"></i></a>
      </div>
      <div class="child-info flex column">
        <span class="name">{{$o->name}}</span>
        <p class="description">{{$o->parent_notes}}</p>
      </div>
    </div>  
  @endforeach
</div>
