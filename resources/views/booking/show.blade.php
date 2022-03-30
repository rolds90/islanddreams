<x-guest-layout>
  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('js/preetycheble/prettyCheckable.css') }}"/>
    {!! htmlScriptTagJsApi() !!}
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Bookings</h2>
      <ul class="list-inline">
        <li><a href="/">Home</a></li>
        <li><a href="/booking">Bookings</a></li>
        <li><a href="#">Detail</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->

  <!-- main container start here -->
  <div class="placetop mar-top">
    <div class="container">
      <div class="booking-form">
        <div class="row">
          <div class="col-12">
            <div class="astro">
              <img src="{{ $booking->courier->image_url }}" class="img-fluid" alt="image1" title="image1" />
              <div class="caption">
                <h3>{{ $booking->origin }} - {{ $booking->destination }}</h3>
                <p class="des">Total time: {{ $booking->total_time }}</p>
                <ul class="list-inline">
                  <li>
                    <span style="font-weight: bold;">Departure</span>
                    <p class="mt-2">{{ $booking->travel_date->format('M d Y') }}</p>
                    <p class="font-weight-bold">{{ $booking->travel_date->format('g:i A') }}</p>
                  </li>
                  <li>
                    <span style="font-weight: bold;">Arrival</span>
                    <p class="mt-2">{{ $booking->arrival_date->format('M d Y') }}</p>
                    <p class="font-weight-bold">{{ $booking->arrival_date->format('g:i A') }}</p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <form class="form-horizontal" action="{{ route('booking.inquire', $booking->slug) }}" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-12">
              <h4>YOUR PERSONAL INFORMATION</h4>
            </div>
            <div class="form-group col-sm-6">
              <label for="firstname">FIRST NAME*</label>
              <input name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" type="text" required autofocus />
              @error('firstname')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-sm-6">
              <label for="lastname">LAST NAME*</label>
              <input name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" type="text" required />
              @error('lastname')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-sm-6">
              <label for="email">EMAIL*</label>
              <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" required />
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-sm-6">
              <label for="contact_no">CONTACT NO.*</label>
              <input name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="{{ old('contact_no') }}" type="text" required />
              @error('contact_no')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-12">
              <label for="message">MESSAGE</label>
              <textarea class="form-control" id="message" name="message" rows="3" placeholder="">{{ old('message') }}</textarea>
            </div>
            <div class="form-group col-12">
              {!! htmlFormSnippet() !!}
              <div class="invalid-feedback">
                {{ $errors->first('g-recaptcha-response') }}
              </div>
            </div>
            <div class="col-sm-12">
              <button class="btn-primary" type="submit">Send Inquiry</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- main container end here -->

  
  <x-slot name="script">
    <!--bootstrap select-->
    <script src="{{ asset('js/dist/js/bootstrap-select.js') }}"></script>
    <script>
      @if ($errors->any())
        window.location.hash = "#contactus-form";
        @if ($errors->has(recaptchaFieldName()))
          $('.g-recaptcha').addClass('is-invalid');
        @endif
      @endif
    </script>
  </x-slot>
</x-guest-layout>