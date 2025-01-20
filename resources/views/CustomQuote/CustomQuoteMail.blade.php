<x-mail::message>
# You have a new Massage

<h3>New Massage From :{{$mailData ['email']}}</h3>

<p>Name : {{$mailData ['name']}}</p>
<p>Companey Name : {{$mailData ['companey_name']}}</p>

<p>phone : {{$mailData ['phone']}}</p>

<p>Message : {{$mailData ['massage']}}</p>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
