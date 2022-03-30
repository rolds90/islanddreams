<div class="col-sm-3 col-md-3 col-xs-12">
  <div id="logo">
    <a href="/">
      <img class="img-fluid" src="{{ asset('images/logo/IDTS-logo.png') }}" alt="logo" title="IDTS">
    </a>
  </div>
</div>

<div class="col-sm-9 col-md-9 col-xs-12 paddleft">
  <!-- menu start here -->
  <div id="menu">
    <nav class="navbar navbar-expand-lg">
      <span class="menutext visible-xs">Menu</span>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

      <div class="collapse navbar-collapse navbar-ex1-collapse padd0" id="navbarmain">
        <ul class="nav navbar-nav">
          <li><a href="/">HOME</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Travel</a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('booking') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Booking</a></li>
              <li><a href="{{ route('tour') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Tour</a></li>
              <li><a href="{{ route('cruise') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>Cruise</a></li>
            </ul>
          </li>
          <li><a href="{{ route('promo') }}">Promos</a></li>
          <li><a href="{{ route('news') }}">News</a></li>
          <li><a href="/about-us">About Us</a></li>
          <li><a href="/contact-us">Contact Us</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <!-- menu end here -->

  <a class="btn booking" href="{{ route('contactus') }}">
    Travel Quotation
  </a>
</div>