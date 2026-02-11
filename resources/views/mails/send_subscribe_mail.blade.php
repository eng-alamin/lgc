@component('mail::message')
# Welcome 🎉

Thanks for subscribing with  
**{{ $maildata->email }}**

You will receive updates from us.

@component('mail::button', ['url' => url('/')])
Visit Website
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
