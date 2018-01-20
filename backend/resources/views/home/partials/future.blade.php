<div id="to-come" class="flex wrap justified-start">
  @foreach($toCome as $tc) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      <i class="fa fa-sign-in" id="{{$tc->id}}"></i>
      <a href="/log"><i class="fa fa-pencil" id="{{$tc->id}}"></i></a>
    </div>
      <a href="/child/{{$tc->child_id}}" class="child-info flex justified-start column">
        <span class="name">{{$tc->name}}</span>
        <p class="description">Opmerking: {{$tc->parent_notes}}</p>
          @if($tc->guardian_id != null)
           <p class="guard">Kind wordt opgehaald door {{$tc->guard}}</p>
          @endif
          <div class="icons flex-child end flex row"> 
          @if($tc->pictures == false)
            <span class="fa-stack fa-lg">
              <i class="fa fa-camera fa-stack-1x"></i>
              <i class="fa fa-ban fa-stack-2x red"></i>
              </span>
          @endif
          @if($tc->potty_trained == false)
            <span class="icon flex justified-c centered"><i class="fa fa-tint" aria-hidden="true"></i></span>
          @endif
          @if(\Carbon\Carbon::parse($tc->date_of_birth)->format('m-d') == \Carbon\Carbon::now()->format('m-d'))
            <span class="icon flex justified-c centered"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
          @endif
        </div>
      </a>

  </div>  
  @endforeach
</div>

