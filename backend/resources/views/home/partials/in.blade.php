@foreach($in as $i) 
<div class="child-card flex">
  <div class="flex column btn">
    
    <span class="padded"></span> 
    <i class="fa fa-sign-out" id="{{$i->child_id}}"></i>
    <i class="fa fa-pencil" id="{{$i->child_id}}"></i>
  </div>
  <div class="child-info">
    <span class="name">{{$i->name}}</span>
  </div>
</div>  
@endforeach