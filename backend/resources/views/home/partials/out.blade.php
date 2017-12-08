<div id="out"  class="flex wrap justified-start">
  @foreach($out as $o) 
    <div class="child-card flex">
      <div class="flex column btn justified-end">
        <i class="fa fa-pencil" id="{{$o->child_id}}"></i>
      </div>
      <div class="child-info flex column">
        <span class="name">{{$o->name}}</span>
        <p class="description">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
      </div>
    </div>  
  @endforeach
</div>
