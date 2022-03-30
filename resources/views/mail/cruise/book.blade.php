@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{ asset('images/logo/IDTS-logo.png') }}" class="logo" alt="" style="height: unset; max-height: unset; width: unset;" />
@endcomponent
@endslot

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@endif

## Cruise Inquiry

{{-- Intro Lines --}}
{{ $name }} has inquire for the booking of the followng cruise information:

@component('mail::table')
| Name | Depart Date |
| ------ | ----------- |
| {{ $cruise->name }} | {{ $cruise->depart_at->format('M. j, Y') }} |
@endcomponent

## Personal Information

**Name**: {{ $name }} <br/>
**Email**: {{ $email }} <br/>
**Contact No**: {{ $contactno }} <br/>
**Message**: <br/>
{{ $message }}


@lang('Regards'),<br>
{{ $name }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent