@component('mail::message')
{{$jobseeker}}
<a target='_blank' href='/jobseeker/jobs/{{$id}}'>See job</a>
@component('mail::button', ['url' => ''])
See job
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
