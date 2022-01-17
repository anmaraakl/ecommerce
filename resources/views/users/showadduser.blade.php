@extends('layouts.app')
@section('content')
<form action="/adduser" method="POST" enctype="multipart/form-data">
    
    @csrf
<div class="panel panel-default container">
     <div class="panel-heading">
           <h1>Add A User:</h1>
     </div>

     <div class="panel-body">
         <h3 class="text-left">name : </h3>
         <input class="text-primary border border-left form-control mr-2" type="text" name="name" " >
         <h3 class="text-left">e-mail : </h3>
         <input class="text-primary border border-left form-control" type="email" name="email" >
         <h3 class="text-left">password : </h3>
         <input class="text-primary border border-left form-control" type="password" name="passowrd" >
         <h3 class="text-left">Confirm Password : </h3>
         <input class="text-primary border border-left form-control" type="password" name="Confirm_Password" >
         <input class="form-control" type="file" name="image" > 
         
         <br>
         <br><input class="btn btn-success container" type="submit" value="add"> &nbsp; 
    </div>

    <div class="panel-footer text-center">
        <br>
         All Right Reserved
    </div>


</div>



</form>

@endsection
