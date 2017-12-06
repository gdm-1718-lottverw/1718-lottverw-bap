
<section class="home">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div id="to-come" class="flex">
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
                <div>
        </div>  
    </div>  
    @endforeach
</div>  
<div id="in" class="flex">
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
    </div>
   </div>
      </div>
      </div>
            </div>

    <div id="out" class="flex">
        @foreach($out as $o) 
            <div class="child-card flex">
                <div class="flex column btn">
                <span class="padded"></span>
                    <span class="padded"></span>
                    <i class="fa fa-pencil" id="{{$o->child_id}}"></i>
                </div>
                <div class="child-info">
                    <span class="name">{{$o->name}}</span>
                </div>
           </div>

        @endforeach
    </div>
       </div>
          </div>

 
</section>
