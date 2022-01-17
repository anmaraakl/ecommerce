@extends('layouts.app')
@section('content')
<div class="container">
<table class="table table-bordered table-hover">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Written by</th>
        @if(Auth::user()!=null)
        @if(Auth::user()->role=='admin')
            <th>Actions</th>
        @endif
        @endif
    </tr>

    @foreach ($products as $product)
       <tr>
        <td><a class="font-weight-normal text-dark text-decoration-none" href="/products/{{$product->id}}">{{ $product->name }}</a></td> 
                       {{-- ///////// "{{route('products.show', $product->id}) }}"  --}}
        <td>{{ $product->description }}</td>  
        <td>{{ $product->price }}</td>  
        <td><img class="w-25" src="\storage\product_images\{{$product->image}}"></td> 
        <td>{{ $product->user->name }}</td> 
        @if(Auth::user()!=null)
        @if(Auth::user()->role=='admin')
        <td><a class="btn btn-primary" href="/assignto/{{ $product->id }}">ASSIGN TO</a></td>
        @endif
        @endif
    </tr> 
    @endforeach
</table>
</div>
@endsection