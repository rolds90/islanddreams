<div class="row padd-b">
  <div class="col-12 col-md-8 contact">
    <h3>Contact us</h3>
    <ul class="list-inline">
      <li>
        <div class="inner"><i class="fa fa-home" aria-hidden="true"></i> Address</div>
        <div class="in"> : &nbsp; {{ $address }}</div>
      </li>
      <li>
        <div class="inner"><i class="fa fa-phone" aria-hidden="true"></i>Phone No.</div>
        <div class="in"> : &nbsp; {{ $contact_no }}</div>
      </li>
      <li>
        <div class="inner"><i class="fa fa-envelope" aria-hidden="true"></i>Email</div>
        <div class="in"> : &nbsp; {{ $email }}</div>
      </li>
    </ul>
  </div>
  <div class="col-sm-12 col-md-4 info">
    <h3>Travel Inquiry</h3>
    <ul class="list-inline">
      <li><a href="{{ route('booking') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Booking</a></li>
      <li><a href="{{ route('tour') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Tour</a></li>
      <li><a href="{{ route('cruise') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Cruise</a></li>
      <li><a href="{{ route('promo') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Promos</a></li>
    </ul>
  </div>
</div>

<div class="row">
  <div class="col-sm-12">
    <div class="powered">
      <div class="col-sm-12">
        <img src="{{ asset('images/logo/foot-logo.png') }}" class="img-fluid" alt="foot-logo" title="foot-logo">
        <div class="social-icon">
          <ul class="list-inline">
            <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
        <p>© Copyright 2021. <span>Island Dreams Travel Services </span></p>
      </div>
    </div>
  </div>
</div>