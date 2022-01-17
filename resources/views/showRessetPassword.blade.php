@extends('layouts.app')
@section('content')
<form action="/ressetpass" method="POST" enctype="">

 @csrf
<h2>Reset Your Password: </h2> <br>
<h4>put your email:</h4>
<input class="text-primary border border-left form-control mr-2" type="text" name="email" >
  <br>
  <input class="btn btn-success" type="submit" value="resset password">
</form>

@endsection
