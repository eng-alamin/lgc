<x-mail::message>
# {{ $maildata['greeting'] }}

{{ $maildata['title'] }}<br>
{!! $maildata['body'] !!}<br>

{{ $maildata['thanks'] }}<br>

{{ config('app.name') }}
</x-mail::message>
