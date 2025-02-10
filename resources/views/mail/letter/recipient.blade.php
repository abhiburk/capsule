<x-mail::message>
# {{ $title }}

{{$message}}

<x-mail::button :url="$url">
    View Letter
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
