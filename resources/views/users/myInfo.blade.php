@extends('layouts.app')
@section('content')
<h2>
    Your Information :
</h2>
<br>
<img class="w-50" src="\storage\users_images\{{$user->image}}"><br>
  <h4>
      Name : {{$user ->name}}
  </h4> 
  <br> 
  <h4>
      Email : {{$user ->email}}
  </h4>
  <a href="/showUpdateInfo" class="btn btn-primary">Update information</a>


@endsection
