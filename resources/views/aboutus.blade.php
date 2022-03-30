<x-guest-layout>

  <x-slot name="css">
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>About Us</h2>
      <ul class="list-inline">
        <li><a href="/">Home</a></li>
        <li><a href="#">About Us</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->
  <div class="about">
    <!-- bg start here -->
    <div class="bg">
      <img src="images/about/bg.jpg" class="img-fluid" alt="bg" title="bg"  />
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="places">
              <h1 class="text-center mr-0" style="margin-bottom: 60px">Start your adventure with us</h1>
              <p class="text-center">We aim to provide our clients with personalize services for travel related arrangements including international and domestic air ticketing, worldwide hotel booking, package tours like international and domestic to a various destination.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- bg end here-->

    <!-- main container start here -->
    <div class="placetop">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 mx-auto">
            <div class="matter">
              <div class="imgs">
                <img src="images/about/icon1.png" alt="icon1" title="icon1"  class="img-fluid" />
              </div>
              <h1>Book Tickets</h1>
              <p>We provide assistance to book your tickets with any mode of transportation to anywhere around the globe.</p>
              <a href="{{ route('booking') }}">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="col-sm-3 mx-auto">
            <div class="matter">
              <div class="imgs">
                <img src="images/about/icon4.png" alt="icon4" title="icon4"  class="img-fluid" />
              </div>
              <h1>Tour Packages</h1>
              <p>Plan your holiday trips with the wide variety of Tour packages available.</p>
              <a href="{{ route('tour') }}">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="col-sm-3 mx-auto">
            <div class="matter">
              <div class="imgs">
                <img src="images/about/icon5.png" alt="icon4" title="icon4"  class="img-fluid" />
              </div>
              <h1>Cruise</h1>
              <p>Explore different places and enjoy sailing the seas with our Cruise packages.</p>
              <a href="{{ route('cruise') }}">Read More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- main container end here -->
  </div>

  <div class="placetop">
    <div class="container">
      <div class="row">
        <div class="places col-sm-12">
          <div class="float-left">
            <h1>Proof of Legitimacy</h1>
            <hr>
            <div class="bor"></div>
          </div>
        </div>
        <div class="col-12 gallery1 galleryview">
          <ul class="list-inline">
            @foreach ($proofs as $proof)
            <li class="padd0">
              <div class="product-thumb">
                <div class="image">
                  <a href="#"><img src="{{ asset($proof->getPathname()) }}" alt="" title="" class="img-responsive"></a>
                  <div class="hoverbox">
                    <div class="show">
                      <i class="fa fa-link" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            @endforeach
          </ul>
  
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-slot name="script">
    <script src="{{ asset('js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('js/photo-gallery.js') }}"></script>
  </x-slot>
</x-guest-layout>