<x-guest-layout>
  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('js/preetycheble/prettyCheckable.css') }}"/>
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Bookings</h2>
      <ul class="list-inline">
        <li><a href="/">home</a></li>
        <li><a href="#">Bookings</a></li>
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
        <p class="mb-0">For the meantime, you may browse for more trips.</p>
      </div>
      @endif

      <div class="row">
        <div class="col-md-3">
          <div class="left-box">
            <h6>BOOK NOW</h6>
            <div class="book">
              <div class="tab-content">
                <form action="{{ route('booking') }}" class="form-horizontal" method="GET">
                  <div class="form-group">
                    <label>Trip Type</label>
                    <select class="selectpicker form-control" name="type">
                      <option value="AIR" @if($type === 'AIR') selected @endif>Air Travel</option>
                      <option value="SEA" @if($type === 'SEA') selected @endif>Sea Travel</option>
                      <option value="LAND" @if($type === 'LAND') selected @endif>Land Travel</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <h2>Where</h2>
                    <label>Leaving from</label>
                    <input name="origin" class="form-control" value="{{ request()->has('origin') ? request()->get('origin') : '' }}" placeholder="" type="text">
                  </div>
                  <div class="form-group">
                    <label>Going to</label>
                    <input name="destination" class="form-control" value="{{ request()->has('destination') ? request()->get('destination') : '' }}" placeholder="" type="text">
                  </div>
                  <div class="form-group">
                    <h2>When</h2>
                    <label>Departing 0n</label>
                    <div class="input-group date">
                      <input name="depart_date" class="form-control" value="{{ request()->has('depart_date') ? request()->get('depart_date') : '' }}" placeholder="YYYY-MM-DD HH:MM" type="text">
                      <span class="input-group-addon calender">
                        <span class="fa fa-calendar"></span>
                      </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Arriving on</label>
                    <div class="input-group date">
                      <input name="arrive_date" class="form-control" value="{{ request()->has('arrive_date') ? request()->get('arrive_date') : '' }}" placeholder="YYYY-MM-DD HH:MM" type="text">
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
        <div class="col-md-9 mainpage">
          <div class="row tour flights">
            @forelse ($bookings as $booking)
            <div class="product-layout product-grid col-lg-4 col-md-6 col-sm-12">
              <div class="product-thumb">
                <a href="{{ route('booking.show', $booking->slug) }}">
                  <div class="image">
                    <img src="{{ $booking->courier->image_url }}" alt="h1" title="h1" class="img-fluid" />
                    <div class="hoverbox">
                      <div class="icon_plus" aria-hidden="true"></div>
                    </div>
                    <div class="flight-bottom">
                      <p>Total time: {{ $booking->total_time }}</p>
                    </div>
                  </div>
                </a>
                <div class="caption">
                  <div class="main-box">
                    <h2>{{ $booking->courier->name }}</h2>
                  </div>
                  <div class="inner1">
                    <div class="main-box1">
                      <div>
                        <p>Total time: {{ $booking->total_time }}</p>
                      </div>
                    </div>
                    <div class="take clearfix">
                      <div class="takeoff">
                        <img src="images/booking/icons/take-off.png" alt="h1" title="h1" class="img-fluid" />
                        <div class="detail">
                          <h5>{{ $booking->origin }}</h5>
                        </div>
                        <div class="date1">{{ $booking->travel_date->format('D M d') }}</div>
                        <div class="time">{{ $booking->travel_date->format('g:i A') }}</div>
                      </div>
                      <div class="landing">
                        <img src="images/booking/icons/Landing.png" alt="h1" title="h1" class="img-fluid" />
                        <div class="detail">
                          <h5>{{ $booking->destination }}</h5>
                        </div>
                        <div class="date1">{{ $booking->arrival_date->format('D M d') }}</div>
                        <div class="time">{{ $booking->arrival_date->format('g:i A') }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="text-left">
                    <a class="btn w-100 border-right-0" href="{{ route('booking.show', $booking->slug) }}" >Inquire Now <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
          
          {{ $bookings->withQueryString()->links('layouts.pagination') }}
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