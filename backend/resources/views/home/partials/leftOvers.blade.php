<h3 class='title'>Ochtend</h3>
<div id="leftover" class="flex wrap justified-start">
  @foreach($leftOver as $lo) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      <i class="fa fa-sign-in" id="{{$lo->child_id}}"></i>
    <a href="/log"><i class="fa fa-pencil" id="{{$lo->child_id}}"></i></a>
    </div>
    <a href="/child/{{$lo->child_id}}" class="child-info flex column">
      <span class="name">{{$lo->name}}</span>
      <p class="description">{{$lo->parent_notes}}</p>
    </a>
  </div>  
  @endforeach
</div>