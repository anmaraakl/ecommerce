@extends('layouts.app')
@section('content')
<form action="/upateinformation" method="POST" enctype="multipart/form-data">
    
    @csrf 
<div class="panel panel-default container">
     <div class="panel-heading">
           <h1>Update your information:</h1>
     </div>

     <div class="panel-body">
         <h3 class="text-left">name : </h3>
         <input class="text-primary border border-left form-control mr-2" type="text" name="name" value="{{$user->name}}" >
         <h3 class="text-left">e-mail : </h3>
         <input class="text-primary border border-left form-control" type="email" name="email" value="{{$user->email}}" >
         <h3 class="text-left">image : </h3>
         <input type="file" name="image" >
         <br>
         <br><input class="btn btn-success" type="submit" value="update">&nbsp; 
        <a href="/showChangePassword" class="btn btn-primary">Change password</a>
    </div>

    <div class="panel-footer text-center">
        <br>
         All Right Reserved
    </div>


</div>



</form>

@endsection
