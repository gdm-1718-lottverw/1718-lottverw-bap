@foreach($out as $o) 
<div class="child-card flex">
  <div class="flex column btn">
    <i class="fa fa-sign-in" id="{{$o->child_id}}"></i>
    <span class="padded"></span> 
    <i class="fa fa-pencil" id="{{$o->child_id}}"></i>
  </div>
  <div class="child-info">
    <span class="name">{{$o->name}}</span>
  </div>
</div>  
@endforeach