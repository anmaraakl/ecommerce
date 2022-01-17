@extends('layouts.app')
@section('content')
<form action="/reset" method="POST" >

 @csrf
<h2>Reset Your Password: </h2> <br>
<h4>Email :</h4>
<input class="text-primary border border-left form-control mr-2" type="email" name="email" value="{{$_GET['email']}}" >
<h4>new password :</h4>
<input class="text-primary border border-left form-control mr-2" type="password" name="newPass" >
  <br>
  <input class="btn btn-success" type="submit" value="resset your password">
</form>

@endsection
