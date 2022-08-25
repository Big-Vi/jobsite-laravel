@component('mail::message')

@foreach ($jobs as $job)
    {{$job->title}}
@endforeach

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
