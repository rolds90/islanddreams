<x-guest-layout>
  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('js/preetycheble/prettyCheckable.css') }}"/>
    {!! htmlScriptTagJsApi() !!}
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Promos</h2>
      <ul class="list-inline">
        <li><a href="/">home</a></li>
        <li><a href="/promo">Promos</a></li>
        <li><a href="#">{{ $promo->title }}</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->

  <!-- main container start here -->
  <div class="placetop mar-top">
    <div class="container">
      <div class="booking-form">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-sm-8 col-xs-12">
            <div class="astro">
              <img src="{{ $promo->image_thumb_url }}" class="img-fluid" alt="image1" title="image1" />
              <div class="caption">
                <h3>{{ $promo->title }}</h3>
                <h5>Validity Period:</h5>
                <p class="pt-2">{{ $promo->date_start->format('m/d/Y') . ' - ' . $promo->date_end->format('m/d/Y')  }}</p>
              </div>
              <p>{{ $promo->excerpt }}</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-sm-4 col-xs-12">
            <div class="detail">
              <h3>TALK TO US</h3>
              <ul class="list-unstyled">
                <li>
                  <p>Phone<span>{{ $contact_no }}</span></p>
                </li>
                <li>
                  <p>Email<span>{{ $email }}</span></p>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <form action="{{ route('promo.mail', $promo->slug) }}" class="form-horizontal" method="post">
          @csrf
          <div class="row">
            <div class="col-sm-12">
              <h4>YOUR PERSONAL INFORMATION</h4>
            </div>
            <div class="form-group col-sm-6">
              <label for="firstname">FIRST NAME*</label>
              <input name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}"
                type="text" required autofocus />
              @error('firstname')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-sm-6">
              <label for="lastname">LAST NAME*</label>
              <input name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}"
                type="text" required />
              @error('lastname')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-sm-6">
              <label for="email">EMAIL*</label>
              <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email"
                required />
              @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group col-sm-6">
              <label for="contact_no">CONTACT NO.*</label>
              <input name="contact_no" class="form-control @error('contact_no') is-invalid @enderror"
                value="{{ old('contact_no') }}" type="text" required />
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
              <button class="btn-primary" type="submit">Confirm Inquiry</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- main container end here -->

  
  <x-slot name="script">
    <!-- owlcarousel js -->
    <script src="{{ asset('js/holder.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/owl-carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
    <!--internal js-->
    <script src="{{ asset('js/owlinternal.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/internal.js') }}" type="text/javascript"></script>
    <!--date js-->
    <script src="{{ asset('js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker/bootstrap-datetimepicker.min.js') }}"></script>
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