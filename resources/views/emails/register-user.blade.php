<x-mail::message>
# Register New User

Hi, you are register to the laravel app. your login credentials is.

    Email: {{$user->email}}.
    Password: {{$password}}.
<x-mail::button :url="$url">
Activate your account
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
