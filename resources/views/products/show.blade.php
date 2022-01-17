@extends('layouts.app')
@section('content')
<h2>
    Your product Information :
</h2>
      <img class="w-25" src="\storage\product_images\{{$product->image}}">
  <h4>
    Name : {{$product ->name}}
  </h4> 
  <h4>
    Description : {{$product ->description}}
  </h4>
  <h4>
    Price : {{$product ->price}}  
  </h4>
  <h4>
    Craete at : {{$product ->created_at}}
  </h4>
  <h4>
    written by : {{$product ->user->name}}
  </h4>
  


@endsection
