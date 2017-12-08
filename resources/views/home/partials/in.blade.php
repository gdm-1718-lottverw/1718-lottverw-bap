<div id="in"  class="flex wrap justified-start">
  @foreach($in as $i) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      <i class="fa fa-sign-out" id="{{$i->child_id}}"></i>
      <i class="fa fa-pencil" id="{{$i->child_id}}"></i>
    </div>
    <div class="child-info flex column">
      <span class="name">{{$i->name}}</span>
      <p class="description">{{$i->parent_notes}}</p>
    </div>
  </div>  
  @endforeach
</div>