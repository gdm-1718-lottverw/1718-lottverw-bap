<div id="out"  class="flex wrap justified-start">
  @foreach($out as $o) 
    <div class="child-card flex">
      <div class="flex column btn">
        <span class="padded"></span> 
        <span class="padded"></span> 
        <i class="fa fa-pencil" id="{{$o->child_id}}"></i>
      </div>
      <div class="child-info flex column">
        <span class="name">{{$o->name}}</span>
      </div>
    </div>  
  @endforeach
</div>
