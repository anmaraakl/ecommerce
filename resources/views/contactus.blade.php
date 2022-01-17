@extends('layouts.app')
@section('content')



<form action="/send" method="POST">
    @csrf
<h3 class="text-left">name:</h3>
<input class="text-primary border border-left form-control mr-2" type="text" name="name" id="">
<h3 class="text-left">email:</h3>
<input class="text-primary border border-left form-control mr-2" type="text" name="email" id="">
<h3 class="text-left">messege:</h3>
<textarea class="text-primary border border-left form-control mr-2" name="messege" id="" cols="30" rows="10"></textarea><br>

<input  class="btn btn-success" type="submit" value="send">

</form>
@endsection