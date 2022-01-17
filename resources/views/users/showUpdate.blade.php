@extends('layouts.app')
@section('content')
<form action="/update" method="POST" enctype="multipart/form-data">

    @csrf
<div class="panel panel-default container">
     <div class="panel-heading">
           <h1>Update your information:</h1>
     </div>

     <div class="panel-body">
         <input type="hidden" name="id" value="{{$userInfo->id}}">
         <h3 class="text-left">name : </h3>
         <input class="text-primary border border-left form-control mr-2" type="text" name="name" value="{{$userInfo->name}}" >
         <h3 class="text-left">eamil : </h3>
         <input class="text-primary border border-left form-control mr-2" type="text" name="email" value="{{$userInfo->email}}" >
         <h3 class="text-left">image : </h3>
         <input type="file" name="image" >
         <br>
         <br>
         <input class="btn btn-success" type="submit" value="update">
    </div>

    <div class="panel-footer">
        <br>
         All Right Reserved
    </div>


</div>



</form>

@endsection
