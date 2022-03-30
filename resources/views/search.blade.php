<x-guest-layout>
  <x-slot name="css">
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Search</h2>
      <ul class="list-inline">
        <li><a href="/">home</a></li>
        <li><a href="#">Search</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->

  <!-- main container start here -->
  <div class="placetop">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="left-box">
            <form action="#" class="form-horizontal" method="GET">
              @csrf
              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Destination</label>
                    <input name="destination" class="form-control" value="{{ request()->get('destination') }}" placeholder="Enter a destination or tour type.." type="text" />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Depart Date</label>
                    <input name="from_date" class="form-control" value="{{ request()->get('from_date') }}" placeholder="mm/dd/yyyy" type="date" />
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group">
                    <label>Return Date</label>
                    <input name="to_date" class="form-control" value="{{ request()->get('to_date') }}" placeholder="mm/dd/yyyy" type="date" />
                  </div>
                </div>
                <div class="col-sm-3">
                  <button type="submit" class="btn-primary pull-right mt-0" type="button">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12 mainpage">
          <div class="row tour packages">
            @forelse ($results as $result)
            @if ($result->search_at == 'BOOKING')
            <div class="product-layout product-grid col-lg-3 col-md-4 col-sm-12">
              <div class="product-thumb">
                <div class="caption">
                  <div class="main-box">
                    <h2>{{ $result->courier }}</h2>
                  </div>
                  <div class="inner1">
          
                    <div class="take clearfix">
                      <div class="takeoff">
                        <img src="images/booking/icons/take-off.png" alt="h1" title="h1" class="img-fluid">
                        <div class="detail">
                          <h5>{{ $result->origin }}</h5>
                        </div>
                        <div class="date1">{{ \Carbon\Carbon::parse($result->travel_date)->format('D M d') }}</div>
                        <div class="time">{{ \Carbon\Carbon::parse($result->travel_date)->format('g:i A') }}</div>
                      </div>
                      <div class="landing">
                        <img src="images/booking/icons/Landing.png" alt="h1" title="h1" class="img-fluid">
                        <div class="detail">
                          <h5>{{ $result->destination }}</h5>
                        </div>
                        <div class="date1">{{ \Carbon\Carbon::parse($result->arrival_date)->format('D M d') }}</div>
                        <div class="time">{{ \Carbon\Carbon::parse($result->arrival_date)->format('g:i A') }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="text-left">
                    <a class="btn w-100 border-right-0" href="{{ route('booking.show', $result->slug) }}">
                      Inquire Now <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @elseif ($result->search_at == 'TOUR')
            <div class="product-layout product-grid col-lg-3 col-md-4 col-sm-12">
              <div class="product-thumb">
          
                <div class="caption">
                  <div class="main-box">
                    <h2>{{ $result->name }}</h2>
                  </div>
                  <div class="inner">
                    <p>{{ $result->description }}</p>
                  </div>
                  <div class="text-left">
                    <a href="{{ route('tour.inquire', $result->slug) }}" class="btn">Inquire Now <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    <a href="{{ route('tour.show', $result->slug) }}" class="btn">View More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="product-layout product-grid col-lg-3 col-md-4 col-sm-12">
              <div class="product-thumb">
          
                <div class="caption">
                  <div class="main-box">
                    <h2>{{ $result->name }}</h2>
                  </div>
                  <div class="inner">
                    <p><span>Departure:</span> {{ \Carbon\Carbon::parse($result->depart_at)->format('M j, Y') }}</p>
                    <p class="text-uppercase"><span class="text-capitalize">Onboard:</span> {{ $result->courier }}</p>
                  </div>
                  <div class="text-left">
                    <a href="{{ route('cruise.inquire', $result->slug) }}" class="btn">Inquire Now <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    <a href="{{ route('cruise.show', $result->slug) }}" class="btn">View More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @empty
            <div class="col-12">
              <div class="alert alert-dark" role="alert">
                No Record found.
              </div>
            </div>
            @endforelse
          </div>
        
          {{ $results->withQueryString()->links('layouts.pagination') }}
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