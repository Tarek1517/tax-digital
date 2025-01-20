<x-mail::message>
<h2>Hello, {{ $name }}</h2>
<p>You have requested to reset your password. Use the OTP below to proceed:</p>
<h2 class="otp">{{ $otp }}</h2>
<p>If you did not request this, please ignore this email.</p>
<p>Thank you,</p>
{{ config('app.name') }}
</x-mail::message>
