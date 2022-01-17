@extends('layouts.app')
@section('content')
<form action="/changePassword" method="POST">
    
    @csrf {{-- تشفير --}}
<div class="panel panel-default container">
     <div class="panel-heading">
           <h1>Change your password:</h1>
     </div>

     <div class="panel-body">
         <h4 class="text-left">Old password : </h4>
         <input class="text-primary border border-left form-control mr-2" type="password" name="oldPassword" value="" >
         <h4 class="text-left">New password : </h4>
         <input class="text-primary border border-left form-control" type="password" name="newPassword" value="" >
         <br><input class="btn btn-success" type="submit" value="change"> 
       
    </div>

    <div class="panel-footer">
        <br>
         All Right Reserved
    </div>


</div>



</form>

@endsection
