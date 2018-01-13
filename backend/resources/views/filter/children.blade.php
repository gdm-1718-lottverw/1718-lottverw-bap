<div class="filter-results flex wrap">
    @foreach($children as $child)
       <div class="filter-results-item flex column justified-start">
            <span class="child-name">{{$child->name}}</span>
            <span class="child-care"></span>
            <div class="icons flex row flex-child end">
                @if($child->potty_trained == false)
                   <span class="icon flex justified-c centered">  <i class="fa fa-tint" aria-hidden="true"></i></span>
                @endif
            </div>
        </div>
    @endforeach
</div>
