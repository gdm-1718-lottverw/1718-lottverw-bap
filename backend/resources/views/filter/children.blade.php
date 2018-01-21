<div class="filter-results flex wrap">
    @foreach($children as $child)
       <div class="filter-results-item flex column justified-start">
            <span class="child-name">{{$child->name}}</span>
            <div class="child-care">
                @if($child->parent_notes != null)
                   <p class="description">{{$child->parent_notes}}</p>
                @endif
                 @if($child->allergie != null)
                   <p class="description">{{$child->type}} {{$child->gravity}} {{$child->description}}</p>
                @endif
            </div>
            <div class="icons flex row flex-child end">
                @if($child->allergie == "food")
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-cutlery fa-stack-1x"></i>
                        <i class="fa fa-ban fa-stack-2x red"></i>
                    </span>
                    @elseif($child->allergie == "animals")
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-paw fa-stack-1x"></i>
                        <i class="fa fa-ban fa-stack-2x red"></i>
                    </span>
                    @elseif($child->allergie == "insects")
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-bug fa-stack-1x"></i>
                        <i class="fa fa-ban fa-stack-2x red"></i>
                    </span>
                    @elseif($child->allergie == "other")
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-cutlery fa-stack-1x"></i>
                        <i class="fa fa-ban fa-stack-2x red"></i>
                    </span>
                @endif
                @if($child->pictures == false)
                    <span class="fa-stack fa-lg">
                      <i class="fa fa-camera fa-stack-1x"></i>
                      <i class="fa fa-ban fa-stack-2x red"></i>
                    </span>
                @endif
                @if($child->pedagogic_description != null)
                    <span class="icon flex justified-c centered"><i class="fa fa-exclamation" aria-hidden="true"></i></span>
                @endif
                @if($child->potty_trained == false)
                    <span class="icon flex justified-c centered"><i class="fa fa-tint" aria-hidden="true"></i></span>
                @endif
                @if(\Carbon\Carbon::parse($child->date_of_birth)->format('m') == \Carbon\Carbon::now()->format('m'))
                    <span class="icon flex justified-c centered"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
                @endif
            </div>
        </div>
    @endforeach
</div>
