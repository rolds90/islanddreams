<x-guest-layout>
  <x-slot name="css">
  </x-slot>

  <!-- slider start here -->
  <div class="slideshow owl-carousel">
    @foreach ($images as $image)
    <div class="item">
      <img src="{{ $image->image_url }}" alt="{{ $image->sort }}" class="img-fluid" />
    </div>
    @endforeach
  </div>

  <!-- slider end here --><!-- slide-detail start here -->
  <div class="slide-detail">
    <div class="container">
      <div class="offset-6 col-md-6">
        <form action="{{ route('search') }}" class="form-horizontal" method="GET">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <h2>Where</h2>
                <label>Destination</label>
                <input name="destination" class="form-control" value="" placeholder="Enter a destination or tour type.."
                  type="text">
              </div>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <h2>When</h2>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label>From</label>
                  <input name="from_date" class="form-control" value="" placeholder="mm/dd/yyyy" type="date" />
                </div>
                <div class="col-sm-12 col-md-6">
                  <label>To</label>
                  <input name="to_date" class="form-control" value="" placeholder="mm/dd/yyyy" type="date" />
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="btn-primary btn-block">Search</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- slide-detail end here -->

  <div class="placetop">
    <div class="container">
      <div class="row">
        <div class="places col-sm-12">
          <div class="float-left">
            <h1>Tour Packages you may like</h1>
            <hr />
            <div class="bor"></div>
          </div>
          <p>Explore your options to our available tour packages that catches your interest. Inquire now for more information.</p>
        </div>
      </div>
      <div class="row tour">
        @forelse ($tours as $tour)
        <div class="product-layout product-grid col-lg-3 col-md-6 col-sm-12">
          <div class="product-thumb">
            <a href="{{ route('tour.show', $tour->slug) }}">
              <div class="image">
                <img src="{{ $tour->image_thumb_url }}" alt="t1" title="t1" class="img-fluid" />
                <div class="hoverbox">
                  <div class="icon_plus" aria-hidden="true"></div>
                </div>
                <div class="matter">
                  <p>Duration: {{ $tour->duration }}</p>
                </div>
              </div>
            </a>
            <div class="caption">
              <div class="main-box">
                <h2>{{ $tour->name }}</h2>
              </div>
              <div class="inner">
                <div class="matter">
                  <p>Duration: {{ $tour->duration }}</p>
                </div>
                <p>{{ $tour->excerpt }}</p>
              </div>
              <div class="text-left">
                <a href="{{ route('tour.inquire', $tour->slug) }}" class="btn">Inquire Now <i class="fa fa-angle-double-right"
                    aria-hidden="true"></i></a>
                <a href="{{ route('tour.show', $tour->slug) }}" class="btn">View More <i class="fa fa-angle-double-right"
                    aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <div class="alert alert-dark" role="alert">
            No Record found.
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <!--Banner code start here-->
  <div class="container-fluid p-0 banner">
    <p class="message">
      Start your adventure with us!
    </p>
    <img src="images/banner.jpg" class="w-100 img-fluid" />
    <p class="shoutout">
      Photo by <a href="https://unsplash.com/@cjtagupa?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Cris Tagupa</a>
      on
      <a href="https://unsplash.com/s/photos/philippines?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
    </p>
  </div>
  <!--Banner code start here-->

  <div class="placetop">
    <div class="container">
      <div class="row">
        <div class="places col-sm-12">
          <div class="float-left">
            <h1>Special Promos</h1>
            <hr />
            <div class="bor"></div>
          </div>
          <p>From time to time special promos are available. Hurry and grab the latest promos available!</p>
        </div>
      </div>
      <div class="row tour">
        @forelse ($promos as $promo)
        <div class="product-layout product-grid col-lg-3 col-md-6 col-sm-12">
          <div class="product-thumb">
            <a href="{{ route('promo.show', $promo->slug) }}">
              <div class="image">
                <img src="{{ $promo->image_thumb_url }}" alt="{{ $promo->title }}" title="{{ $promo->title }}" class="img-fluid" />
                <div class="hoverbox">
                  <div class="icon_plus" aria-hidden="true"></div>
                </div>
              </div>
            </a>
            <div class="caption">
              <div class="main-box">
                <h2>{{ $promo->title }}</h2>
              </div>
              <div class="inner">
                <p>{{ Str::words($promo->description, 15) }}</p>
              </div>
              <div class="text-left">
                <a href="{{ route('promo.inquire', $promo->slug) }}" class="btn">Inquire Now <i
                    class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                <a href="{{ route('promo.show', $promo->slug) }}" class="btn">View More <i class="fa fa-angle-double-right"
                    aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <div class="alert alert-dark" role="alert">
            No Promo available.
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <div class="placetop">
    <div class="container">
      <div class="row">
        <div class="places col-sm-12">
          <div class="float-left">
            <h1>Cruise</h1>
            <hr />
            <div class="bor"></div>
          </div>
          <p>Treat yourself to a sailing adventure with our available cruise packages. Enjoy and have fun on different ports and places!</p>
        </div>
      </div>
      <div class="row tour">
        @forelse ($cruises as $cruise)
        <div class="product-layout product-grid col-lg-3 col-md-6 col-sm-12">
          <div class="product-thumb">
            <a href="{{ route('cruise.show', $cruise->slug) }}">
              <div class="image">
                <img src="{{ $cruise->image_url }}" alt="t1" title="t1" class="img-fluid" />
                <div class="hoverbox">
                  <div class="icon_plus" aria-hidden="true"></div>
                </div>
                <div class="matter">
                  <p>Duration: {{ $cruise->duration }}</p>
                </div>
              </div>
            </a>
            <div class="caption">
              <div class="main-box">
                <h2>{{ $cruise->name }}</h2>
              </div>
              <div class="inner">
                <div class="matter">
                  <p>Duration: {{ $cruise->duration }}</p>
                </div>
                <p><span>Departure:</span> {{ $cruise->depart_at->format('M j, Y') }}</p>
                <p><span>Onboard:</span> {{ $cruise->vessel }}</p>
              </div>
              <div class="text-left">
                <a href="{{ route('cruise.inquire', $cruise->slug) }}" class="btn">Inquire Now <i
                    class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                <a href="{{ route('cruise.show', $cruise->slug) }}" class="btn">View More <i class="fa fa-angle-double-right"
                    aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <div class="alert alert-dark" role="alert">
            No Record found.
          </div>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- testimonail start here -->
  <div class="testimonail">
    <div class="container">
      <div class="row">
        <div class="places col-sm-12">
          <div class="float-left">
            <h1>Testimonials</h1>
            <hr />
            <div class="bor"></div>
          </div>
          <p>Here is what our clients says about us.</p>
        </div>
        <div class="testimonails owl-carousel">
          @foreach ($testimonials as $testimonial)
          <div class="item">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="box">
                <img src="{{ $testimonial->image_url }}" alt="" title="" class="img-fluid rounded-circle">
                <div class="caption">
                  <h4>{{ $testimonial->name }}</h4>
                  <div class="rate">
                    <p>{{ $testimonial->comment_at->format('F Y') }}</p>
                  </div>
                  <p>
                    <i class="fa fa-quote-left" aria-hidden="true"></i>
                    {{ $testimonial->comment }}
                    <i class="fa fa-quote-right" aria-hidden="true"></i>
                  </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- testimonail end here -->
  
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
  </x-slot>
</x-guest-layout>