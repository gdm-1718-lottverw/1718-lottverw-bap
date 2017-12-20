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
  </div>  
  @endforeach
</div>