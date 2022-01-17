@component('mail::message')
# Introduction

<h3>name:</h3> {{$name}} <br>
<h3>email:</h3>{{$email}} <br>
<h3>messege:</h3><br>
{{$messege}}



Thanks,<br>
{{ config('app.name') }}
@endcomponent
