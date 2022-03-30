<x-guest-layout>
  <x-slot name="css">
    {!! htmlScriptTagJsApi() !!}
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Contact Us</h2>
      <ul class="list-inline">
        <li><a href="/">Home</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->

  <!-- main container start here -->
  <div class="contacts">
    <div class="map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1970.5763838259409!2d125.52288507877539!3d8.9580674993577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x25194abb2d61cebd!2zOMKwNTcnMjkuMCJOIDEyNcKwMzEnMjYuMSJF!5e0!3m2!1sen!2ssa!4v1648539937509!5m2!1sen!2ssa"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container">
      @if ($message = Session::get('message'))
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Thank you!</h4>
        <p>{{ $message }}</p>
      </div>
      @endif

      <div class="row">
        <div class="placetop col-sm-12">
          <div class="places">
            <h1>Get in Touch</h1>
            <hr>
          </div>
          <form action="{{ route('contactus.mail') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-6 form-group">
                <input name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}" type="text" placeholder="Firstname*" required autofocus />
                @error('firstname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6 form-group">
                <input name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}" type="text" placeholder="Lastname*" required />
                @error('lastname')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" placeholder="Email" required />
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-sm-6 form-group">
                <input name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="{{ old('contact_no') }}" type="text" placeholder="Contact No.*" required />
                @error('contact_no')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message*" required>{{ old('message') }}</textarea>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  {!! htmlFormSnippet() !!}
                  <div class="invalid-feedback">
                    {{ $errors->first('g-recaptcha-response') }}
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" value="" class="btn btn-primary btn-block"><i class="fa fa-paper-plane" aria-hidden="true"></i>Send Message</button>
                </div>
              </div>
            </div>
          </form>
            
          <div class="row">
            <div class="col-sm-4 matter">
              <div class="caption">	
                <h3><i class="fa fa-home" aria-hidden="true"></i> Address</h3>
                @foreach ($addresses as $address)
                <p>{{ $address->full_address }}</p>
                @endforeach
              </div>	
            </div>
            <div class="col-sm-4 matter">
              <div class="caption">	
                <h3><i class="fa fa-phone" aria-hidden="true"></i> Phone no.</h3>
                @foreach ($contacts as $contact)
                <p>{{ $contact->contact_no }} - {{ $contact->name }}</p>
                @endforeach
              </div>
            </div>
            <div  class="col-sm-4 matter">
              <div class="caption">	
                <h3><i class="fa fa-envelope" aria-hidden="true"></i> Email</h3>
                @foreach ($contacts as $contact)
                <p>{{ $contact->email }}</p>
                @endforeach
              </div>
            </div>
          </div>	
        </div>
      </div>
    </div>
  </div>
  <!-- main container end here -->

  <x-slot name="script">
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