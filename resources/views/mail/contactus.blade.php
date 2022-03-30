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

## Webiste - Contact Us

{{ $name }} has sent you this email from the Contact Us page of the website, see below information.

## Personal Information

**Name**: {{ $name }} <br />
**Email**: {{ $email }} <br />
**Contact No**: {{ $contactno }} <br />
**Message**: <br />
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