<div class="filter-results">
    @foreach($children as $child)
        <div class="filter-results-item">
            <span class="child-name">{{$child->child_id}} {{$child->child->name}}</span>
            <span class="child-care">
                @if($child->potty_trained == false)
                    <i class="fa fa-tint" aria-hidden="true"></i>
                @endif
            </span>
        </div>
    @endforeach
</div>