<x-mail::message>

<p>Hai {{ $nama }}</p>
<p>Ini merupakan username dan password kamu untuk masuk ke website PEMIRA PNC</p>

<x-mail::panel>
    <p>Username: <span class="font-semibold">{{ $username }}</span></p>
    <p>Password: <span class="font-semibold">{{ $password }}</span></p>
</x-mail::panel>

<x-mail::button :url="config('app.url')">
PEMIRA PNC
</x-mail::button>

Butuh bantuan? <a href="{{ route('contact') }}">Klik Disini</a>

Trima Kasih,<br>
{{ config('app.name') }}
</x-mail::message>