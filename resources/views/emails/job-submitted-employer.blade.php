@component('mail::message')
# Introduction

You have new submitted application from {{$submittedjob->jobseeker}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
