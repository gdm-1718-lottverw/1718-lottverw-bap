<div id="out"  class="flex wrap justified-start">
  @foreach($out as $o) 
    <div class="child-card flex">
      <div class="flex column btn justified-end">
       <a href="/log"><i class="fa fa-pencil" id="{{$o->id}}"></i></a>
      </div>
      <a href="/child/{{$o->child_id}}"  class="child-info flex column justified-start">
        <span class="name">{{$o->name}}</span>
         @if($o->parent_notes != null)
        <p class="description">Opmerking: {{$o->parent_notes}}</p>
         @endif
         @if($o->guardian_id != null)
          <p class="guard">Kind wordt opgehaald door {{$o->guard}}</p>
      @endif
         <div class="icons flex row flex-child end "> 
          @if($o->pictures == false)
            <span class="fa-stack fa-lg">
              <i class="fa fa-camera fa-stack-1x"></i>
              <i class="fa fa-ban fa-stack-2x red"></i>
              </span>
          @endif
          @if($o->potty_trained == false)
             <span class="icon flex justified-c centered"><i class="fa fa-tint" aria-hidden="true"></i></span>
          @endif

          @if(\Carbon\Carbon::parse($o->date_of_birth)->format('m-d') == \Carbon\Carbon::now()->format('m-d'))
           <span class="icon flex justified-c centered"> <i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
          @endif
        </div>
      </a>
    </div>  
  @endforeach
</div>
