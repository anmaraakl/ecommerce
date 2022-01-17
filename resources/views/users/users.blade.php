@extends('layouts.app')
@section('content')
<table class="container table table-bordered table-hover">
       <tr>
        <th class="col-3 p-0" colspan="4">
            <a class="btn btn-primary w-100" href="/showadduser">Add User</a>    
        </th> 
       </tr>
      <tr>
        <th>Image:</th>
          <th>Name:</th>
          <th>Email:</th>
          <th>Actions:</th>
      </tr>
@foreach ($AllUsers as $user)
   <tr>
       <td class="w-25">
        <img class="w-25" src="{{asset('storage/users_images/'.$user->image)}}">
       </td>
      <td>{{ $user->name }}</td> 
      <td>{{ $user->email }}</td> 
      <td>
          <a class="btn btn-danger" href="/deleteUser/{{$user->id}}">Delete</a>
          <a class="btn btn-success" href="/upgradeUser/{{$user->id}}">Upgrade</a>
          <a class="btn btn-primary" href="/showUpdateUser/{{$user->id}}">Update</a>
    </td> 
   </tr> 
@endforeach
</table>

@endsection
