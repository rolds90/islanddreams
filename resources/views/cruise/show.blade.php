<x-guest-layout>
  <x-slot name="css">
    <link rel="stylesheet" href="{{ asset('js/preetycheble/prettyCheckable.css') }}"/>
    {!! htmlScriptTagJsApi() !!}
  </x-slot>

  <!-- breadcrumb start here -->
  <div class="bread-crumb">
    <div class="container">
      <h2>Cruise</h2>
      <ul class="list-inline">
        <li><a href="/">home</a></li>
        <li><a href="/cruise">Cruise</a></li>
        <li><a href="#">{{ $cruise->name }}</a></li>
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
            <h6>TALK TO US</h6>
            <div class="talk">
              <ul class="list-unstyled">
                <li>
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <h4>PHONE</h4>
                  <P>{{ $contact_no }}</P>
                </li>
                <li>
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <h4>EMAIL</h4>
                  <P>{{ $email }}</P>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-9 mainpage">
          <div class="row">
            <div class="col-sm-12">
              <h2>{{ $cruise->name }}</h2>

              @if($cruise->images->count())
              <div class="thumb">
                <div id="big" class="owl-carousel owl-theme">
                  @foreach ($cruise->images as $image)
                  <div class="item">
                    <img src="{{ $image->image_url }}" alt="image1" title="image1" class="img-fluid" />
                  </div>
                  @endforeach
                </div>

                <div id="additional" class="owl-carousel">
                  @foreach ($cruise->images as $image)
                  <div class="item">
                    <div class="product-thumb">
                      <div class="image">
                        <img src="{{ $image->image_thumb_url }}" class="img-fluid" alt="thb1" title="thb1" />
                        <div class="hoverbox"></div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
              @endif
            </div>
          
            <div class="tour-detail col-sm-12">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="info-tab" data-toggle="pill" href="#info" role="tab"
                    aria-controls="info" aria-selected="true">Information</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="itinerary-tab" data-toggle="pill" href="#itinerary" role="tab"
                    aria-controls="itinerary" aria-selected="true">Itinerary</a>
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane col-sm-12 active" id="info">
                  <p> {!! $cruise->description_html !!} </p>
                  <table>
                    <body>
                      <tr height="30">
                        <td width="30" class="text-center"><i class="fa fa-refresh"></i></td>
                        <td>{{ $cruise->trip_type }}</td>
                      </tr>
                      <tr height="30">
                        <td width="30" class="text-center"><i class="fa fa-calendar"></i></td>
                        <td>Depart on <span class="font-weight-bold">{{ $cruise->depart_at->format('M. j, Y') }}</span></td>
                      </tr>
                      <tr height="30">
                        <td width="30" class="text-center"><i class="fa fa-map-marker"></i></td>
                        <td>Depart from <span class="font-weight-bold">{{ $cruise->origin }}</span></td>
                      </tr>
                      <tr height="30">
                        <td width="30" class="text-center"><i class="fa fa-ship"></i></td>
                        <td>Onboard <span class="font-weight-bold">{{ $cruise->vessel }}</span></td>
                      </tr>
                    </body>
                  </table>
                </div>
                <div class="tab-pane fade show" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                  <div class="row">
                    @foreach ($cruise->itineraries as $itinerary)
                    <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12">
                      <div class="product-thumb">
                        <div class="image">
                          <img src="{{ $itinerary->image_url }}" alt="h1" title="h1" class="img-responsive">
                        </div>
                        <div class="caption">
                          <div class="inner">
                            <h3 class="mt-0">DAY {{ $itinerary->day }}</h3>
                            <h4><i class="fa fa-map-marker mr-1"></i> {{ $itinerary->location }}</h4>
                  
                            <p class="mb-3">{{ $itinerary->itinerary_date->format('D, M. j, Y') }}</p>
                            @if ($itinerary->arrive_at)
                                <p class="mb-2">Arrival: {{ $itinerary->arrive_at->format('h:i A') }}</p>
                            @endif

                            @if ($itinerary->depart_at)
                              <p>Departs: {{ $itinerary->depart_at->format('h:i A') }}</p>
                            @endif
                          </div>
                  
                        </div>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="book-now col-sm-12">
            <div class="row">
              <h1>INQUIRE NOW</h1>
              <hr>
            </div>
            
            <form action="{{ route('cruise.mail', $cruise->slug) }}" class="form-horizontal" method="post">
              @csrf
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="firstname">FIRST NAME*</label>
                  <input name="firstname" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname') }}"
                    type="text" required autofocus />
                  @error('firstname')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group col-sm-6">
                  <label for="lastname">LAST NAME*</label>
                  <input name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname') }}"
                    type="text" required />
                  @error('lastname')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group col-sm-6">
                  <label for="email">EMAIL*</label>
                  <input name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email"
                    required />
                  @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group col-sm-6">
                  <label for="contact_no">CONTACT NO.*</label>
                  <input name="contact_no" class="form-control @error('contact_no') is-invalid @enderror"
                    value="{{ old('contact_no') }}" type="text" required />
                  @error('contact_no')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group col-12">
                  <label for="message">MESSAGE</label>
                  <textarea class="form-control" id="message" name="message" rows="3" placeholder="">{{ old('message') }}</textarea>
                </div>
                <div class="form-group col-12">
                  {!! htmlFormSnippet() !!}
                  <div class="invalid-feedback">
                    {{ $errors->first('g-recaptcha-response') }}
                  </div>
                </div>
                <div class="col-sm-12">
                  <button class="btn-primary" type="submit">Confirm Inquiry</button>
                </div>
              </div>
            </form>
          </div>
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