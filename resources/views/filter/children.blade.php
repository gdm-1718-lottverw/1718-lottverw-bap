<div class="row align-items-center" id="tesdt">
    <div class="list-group">
     @foreach($test as $child)
        <li class="list-group-item">{{$child->id}} {{$child->name}}</li>
     @endforeach
    </div>
</div>