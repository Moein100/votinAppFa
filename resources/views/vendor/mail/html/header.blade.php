<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://localhost:8000/img/logo.svg" class="logo" alt="Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
