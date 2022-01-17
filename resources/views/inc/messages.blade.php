@if(count($errors)>0)
@foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
@endforeach
@endif

@if (session('error'))
     <div class="alert alert-danger">
         <strong>
             {{session('error')}}
        </strong>
    </div>
@endif

@if (session('success'))
     <div class="alert alert-success bg-success">
         <strong>
             {{session('success')}}
        </strong>
        </div>
@endif