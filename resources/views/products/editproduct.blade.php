@extends('layouts.app')
@section('content')
<form action="{{route('products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
    
    @csrf {{-- تشفير --}}
    @method('PUT')
    <div class="panel panel-default container">
     <div class="panel-heading">
           <h1>Update your product information:</h1>
     </div>

     <div class="panel-body">
         <h5 class="text-left">name : </h5>
         <input class="text-primary border border-left form-control mr-2" type="text" name="name" value="{{$product->name}}" >
         <h5 class="text-left">description : </h5>
         <input class="text-primary border border-left form-control" type="text" name="description" value="{{$product->description}}" >
         <h5 class="text-left">price : </h5>
         <input class="text-primary border border-left form-control" type="text" name="price" value="{{$product->price}}" >
         <h5 class="text-left">Image : </h5>
         <input class="form-control" type="file" name="image" ><br>
         <img class="w-25" src="\storage\product_images\{{$product->image}}">
         <br>
         <br><input class="btn btn-success" type="submit" value="Edit">&nbsp; 
    </div>

    <div class="panel-footer">
        <br>
         All Right Reserved
    </div>


</div>



</form>

@endsection
