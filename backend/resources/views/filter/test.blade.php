@extends('layouts.app')
@section('content')
 <body>
        <div class="container">
         </br>
          </br>
            <div class="row align-items-start">
                <h1>Testing the filter.</h1>
                <p>Create a simple child filter with ajax. Use child in stead of to do's :).</p>
            </div>
  </br>
           <hr/>
            <div class="row align-items-end">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Text </label>
                        <input type="text" name="content" class="form-control" id="exampleInputEmail1"  aria-describedby="emailHelp" placeholder="Enter some text">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                    <button type="submit" id="send" class="btn btn-primary">Submit</button>
            </div>
              </br>
              <hr/>
                </br>
             <div class="row align-items-center" id="children">
                <div class="list-group">
                @foreach($test as $child)
                    <li class="list-group-item">{{$child->id}} {{$child->name}}</li>
                @endforeach
                </div>
            </div>
             <div id="magic"/></div>
        </div>
     
@endsection('content')