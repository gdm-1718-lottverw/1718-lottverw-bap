<div id="to-come"  class="flex wrap justified-start">
  @foreach($toCome as $tc) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      <i class="fa fa-sign-in" id="{{$tc->child_id}}"></i>
      <i class="fa fa-pencil" id="{{$tc->child_id}}"></i>
    </div>
    <div class="child-info flex column">
      <span class="name">{{$tc->name}}</span>
      <p class="description">{{$tc->parent_notes}}</p>
    </div>
  </div>  
  @endforeach
</div>

