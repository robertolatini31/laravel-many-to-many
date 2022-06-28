@component('mail::message')
# Introduction

Ciao Admin, il post: {{$postSlug}} è stato modificato.

@component('mail::button', ['url' => $postUrl])
Show Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
