<x-guest-layout>
  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('js/preetycheble/prettyCheckable.css') }}"/>
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Promos</h2>
      <ul class="list-inline">
        <li><a href="/">home</a></li>
        <li><a href="#">Promos</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->

  <!-- main container start here -->
  <div class="placetop">
    <div class="container">
      @if ($message = Session::get('message'))
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h4 class="alert-heading">Thank you!</h4>
        <p>{{ $message }}</p>
        <hr>
        <p class="mb-0">For the meantime, you may browse for more promos.</p>
      </div>
      @endif

      <div class="row">
        <div class="col-12 col-md-3">
          <div class="left-box">
            <h6>Search Available Promos</h6>
            <div class="book">
              <div class="tab-content">
                <form action="{{ route('tour') }}" class="form-horizontal" method="GET">
                  <div class="form-group">
                    <label>Search</label>
                    <input name="location" class="form-control" value="{{ request()->has('location') ? request()->get('location') : '' }}" placeholder="" type="text" />
                  </div>
                  <div class="form-group">
                    <h2>When</h2>
                    <label>Promo Date</label>
                    <div class="input-group date">
                      <input name="tour_date" class="form-control" value="{{ request()->has('tour_date') ? request()->get('tour_date') : '' }}" placeholder="YYYY-MM-DD HH:MM" type="text">
                      <span class="input-group-addon calender">
                        <span class="fa fa-calendar"></span>
                      </span>
                    </div>
                  </div>
                  <div class="text-center">
                    <button class="btn-primary" type="submit">Proceed</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-9 mainpage">
          <div class="row tour">
            @forelse ($promos as $promo)
            <div class="product-layout product-grid col-lg-4 col-md-6 col-sm-12">
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
                    <p>{{ $promo->excerpt }}</p>
                  </div>
                  <div class="text-left">
                    <a href="{{ route('promo.inquire', $promo->slug) }}" class="btn">Inquire Now <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    <a href="{{ route('promo.show', $promo->slug) }}" class="btn">View More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
          
          {{ $promos->withQueryString()->links('layouts.pagination') }}
        </div>
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
  </x-slot>
</x-guest-layout>