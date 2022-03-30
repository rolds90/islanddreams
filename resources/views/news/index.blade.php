<x-guest-layout>
  <x-slot name="css">
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>News</h2>
      <ul class="list-inline">
        <li><a href="/">Home</a></li>
        <li><a href="#">News</a></li>
      </ul>
    </div>
  </div>
  <!-- breadcrumb end here -->

  <!-- main container start here -->
  <div class="placetop">
    <div class="container">

      <div class="row">
        <div class="col-12 col-md-3">
          <div class="left-box">
            <h6>Search</h6>
            <div class="book">
              <div class="tab-content">
                <form action="{{ route('news') }}" class="form-horizontal" method="GET">
                  <div class="form-group">
                    <label>Search</label>
                    <input name="search" class="form-control" value="{{ request()->has('search') ? request()->get('search') : '' }}" placeholder="" type="text" />
                  </div>
                  <div class="text-center">
                    <button class="btn-primary" type="submit">Proceed</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-9 ourblog">
          @forelse ($news as $cur_news)
          <div class="product-thumb">
            <a href="{{ route('news.show', $cur_news->slug) }}">
              <img src="{{ $cur_news->image_thumb_url }}" class="img-fluid" alt="{{ $cur_news->title }}" title="{{ $cur_news->title }}" />
            </a>
            <div class="caption">
              <div class="admin">
                <ul class="list-inline">
                  <li>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{ $cur_news->news_date->format('F d, Y') }}
                  </li>
                </ul>
              </div>
              <a href="{{ route('news.show', $cur_news->slug) }}"><h4>{{ $cur_news->title }}</h4></a>
              <p class="des">{!! $cur_news->excerpt !!}</p>
            </div>
          </div>
          @empty
          <div class="col-12">
            <div class="alert alert-dark" role="alert">
              No News available.
            </div>
          </div>
          @endforelse
          
          {{ $news->withQueryString()->links('layouts.pagination') }}
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
  </x-slot>
</x-guest-layout>