<div id="leftover" class="flex wrap justified-start">
  <h3 class='title-over'>Ochtend</h3>
  @foreach($leftOver as $lo) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      @if($lo->in == false && $lo->out == false)
      <i class="fa fa-sign-in" id="{{$lo->id}}"></i>
      @elseif($lo->in == true && $lo->out == false)
      <i class="fa fa-sign-out" id="{{$lo->id}}"></i>
      @endif
    <a href="/log"><i class="fa fa-pencil" id="{{$lo->id}}"></i></a>
    </div>
    <a href="/child/{{$lo->child_id}}" class="child-info flex column justified-start">
      <span class="name">{{$lo->name}} </span>
               @if($lo->parent_notes != null)
        <p class="description">Opmerking: {{$lo->parent_notes}}</p>
         @endif
       @if($lo->guardian_id != null)
         <p class="guard">Kind wordt opgehaald door {{$lo->guard}}</p>
      @endif
       <div class="icons flex row flex-child end "> 
          @if($lo->pictures == false)
            <span class="fa-stack fa-lg">
              <i class="fa fa-camera fa-stack-1x"></i>
              <i class="fa fa-ban fa-stack-2x red"></i>
              </span>
          @endif
          @if($lo->potty_trained == false)
             <span class="icon flex justified-c centered"><i class="fa fa-tint" aria-hidden="true"></i></span>
          @endif
          @if(\Carbon\Carbon::parse($lo->date_of_birth)->format('m-d') == \Carbon\Carbon::now()->format('m-d'))
             <span class="icon flex justified-c centered"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
          @endif
        </div>
    </a>
    @if(\Carbon\Carbon::parse($lo->created_at)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
        {{ Form::open(array('action' => 'Backoffice\Home\IndexController@destroy', 'class' => 'ban')) }} 
        {{ Form::hidden('_id', $lo->id )}}
        {{ Form::button('<i class="fa fa-ban" aria-hidden="true"></i>', ['type' => 'submit']) }}
        {{ Form::close()}}
      @endif
  </div>  
  @endforeach
</div>