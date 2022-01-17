@extends('layouts.app')
@section('content')
<div class="container">
<table class="table table-bordered table-hover">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

    @foreach ($products as $product)
       <tr>
        <td><a class="font-weight-normal text-dark text-decoration-none" href="/products/{{$product->id}}">{{ $product->name }}</a></td> 
                       {{-- ///////// "{{route('products.show', $product->id}) }}"  --}}
        <td>{{ $product->description }}
        <td>{{ $product->price }}</td>  
        <td class="w-25 p-0"><img class="w-25" src="\storage\product_images\{{$product->image}}"></td> 
        <td class="" >
            <form class="" action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                 <input class="btn btn-danger" type="submit" value="Delete ">
                {{-- <a class="btn btn-danger" href="{{ route ('products.destroy', $product->id) }}">Delete</a> --}}
            </form>
          <a class="btn btn-primary" href="/products/{{$product->id}}/edit">Update</a>
        </td>
    </tr> 
    @endforeach
</table>
</div>
@endsection