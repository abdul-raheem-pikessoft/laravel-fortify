<x-mail::message>
# Recovery Code

Use any of the recovery code in the list.


        @foreach($recoveryCode as $code)
            {{ $code }}
        @endforeach


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
