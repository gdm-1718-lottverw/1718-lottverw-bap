@foreach($toCome as $tc) 
<div class="child-card flex">
  <div class="flex column btn">
    <i class="fa fa-sign-in" id="{{$tc->child_id}}"></i>
    <span class="padded"></span> 
    <i class="fa fa-pencil" id="{{$tc->child_id}}"></i>
  </div>
  <div class="child-info">
    <span class="name">{{$tc->name}}</span>
  </div>
</div>  
@endforeach