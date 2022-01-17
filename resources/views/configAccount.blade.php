@extends('layouts.app')
@section('content')
<form action="" method="POST">
<h2>config your account: </h2>
<br>
<h3 class="text-left">your email:</h3>
<input class="text-primary border border-left form-control mr-2" type="text" name="email" >
<h3 class="text-left">config: </h3>
<input  class="text-primary border border-left form-control mr-2" type="text" name="config"><br>
<input class="btn btn-success container" type="submit" value="config">
</form>


@endsection