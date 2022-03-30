<x-guest-layout>
  <x-slot name="css">
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>News</h2>
      <ul class="list-inline">
        <li><a href="/">Home</a></li>
        <li><a href="/news">News</a></li>
        <li><a href="#">{{ $news->title }}</a></li>
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
                    <input name="search" class="form-control"
                      value="{{ request()->has('search') ? request()->get('search') : '' }}" placeholder="" type="text" />
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
          <div class="ourblog">
            <div class="product-thumb">
              <h1>{{ $news->title }}</h1>
              <i class="fa fa-calendar pr-2 mb-2" aria-hidden="true"></i> {{ $news->news_date->format('F d, Y') }}
              @if ($news->image)
                <img src="{{ $news->image_url }}" class="img-fluid" alt="{{ $news->title }}" title="{{ $news->title }}" />
              @endif
              <div class="caption">
                <p>{!! $news->description_html !!}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- main container end here -->

  
  <x-slot name="script">
  </x-slot>
</x-guest-layout>