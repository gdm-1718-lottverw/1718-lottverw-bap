<div id="in"  class="flex wrap justified-start">
  @foreach($in as $i) 
  <div class="child-card flex">
    <div class="flex column btn justified-s">
      <i class="fa fa-sign-out" id="{{$i->id}}"></i>
    <a href="/log"><i class="fa fa-pencil" id="{{$i->id}}"></i></a>
    </div>
    <a href="/child/{{$i->child_id}}"  class="child-info flex justified-start column">
      <span class="name">{{$i->name}}</span>

      <p class="description">{{$i->parent_notes}}</p>
      @if($i->guardian_id != null)
        <p class="guard">Kind wordt opgehaald door {{$i->guard}}</p>
      @endif
      <div class="icons flex row flex-child end"> 
          @if($i->pictures == false)
            <span class="fa-stack fa-lg">
              <i class="fa fa-camera fa-stack-1x"></i>
              <i class="fa fa-ban fa-stack-2x red"></i>
              </span>
          @endif
          @if($i->potty_trained == true)
           <span class="icon flex justified-c centered"><i class="fa fa-tint" aria-hidden="true"></i></span>
          @endif
          @if(\Carbon\Carbon::parse($i->date_of_birth)->format('m-d') == \Carbon\Carbon::now()->format('m-d'))
             <span class="icon flex justified-c centered"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
          @endif
        </div>
    </a>
     @if(\Carbon\Carbon::parse($i->created_at)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
        {{ Form::open(array('action' => 'Backoffice\Home\IndexController@destroy', 'class' => 'ban')) }} 
        {{ Form::hidden('_id', $i->id )}}
        {{ Form::button('<i class="fa fa-ban" aria-hidden="true"></i>', ['type' => 'submit']) }}
        {{ Form::close()}}
      @endif
  </div>  
  @endforeach
    <div id="headCount" class="out info-fab deeppink bottom flex centered justified-c row">{{$count}}</div>
    <span class="tip">Aanwezigen</span>
</div>