@extends('layouts.app')
@section('content')
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="panel panel-defualt">
    <div class="panel-heading">
        <h1> Add Product</h1>
    </div>
    <div class="panel-body container">
        <h5 class="text-left">Name :</h5>
        <input class="form-control" type="text" name="name" >
        <h5 class="text-left">Description :</h5>
        <input class="form-control" type="text" name="description" >
        <h5 class="text-left">Price :</h5>
        <input class="form-control" type="text" name="price" >
        <h5 class="text-left">Image :</h5>
        <input class="form-control" type="file" name="image" ><br>
        <input class="btn btn-success" type="submit" value="ADD" > 
    </div>
    <div class="panel-footer">
        All Rights Reserved
    </div>
</div>
</form>
@endsection