@component('mail::message')
# Job has been created

@component('mail::button', ['url' => ''])
View the job
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
