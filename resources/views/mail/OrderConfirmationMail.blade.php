<x-mail::message>
    <h2>Hello, {{ $name }}</h2>
    <p>Thank You for Purchasing the Package:</p>
    <h2 class="packageName">{{ $packageName }}</h2>
    <p>This is Confirmation Mail For your Purchase.</p>
    <p>Thank you,</p>
    {{ config('app.name') }}
</x-mail::message>
