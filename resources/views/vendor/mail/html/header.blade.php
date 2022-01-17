<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('storage/logo/logo.png')}}" class="logo" alt="">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
