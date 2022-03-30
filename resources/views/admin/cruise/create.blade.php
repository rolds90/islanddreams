<x-app-layout>
  <x-slot name="css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <style>
      .editor-toolbar {
        background-color: #fff;
      }
    </style>
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add New Cruise</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.cruise.index') }}">Cruise</a></li>
          <li class="breadcrumb-item active">Add Cruise</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('admin.cruise.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-12">
        <!-- Custom Tabs -->
        <div class="card">
          <div class="card-header d-flex p-0">
            <ul class="nav nav-pills p-2">
              <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">General Information</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Images</a></li>
              <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Itinerary</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-3">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title">Main Image</h3>

                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body text-center">
                        <div class="form-group">
                          <div class="fileinput fileinput-new {{ ($errors->has('image') ? 'is-invalid' : null) }}" data-provides="fileinput">
                            <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                              <img src="http://placehold.it/200x150&text=No+Image" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                            <div>
                              <span class="btn btn-outline-secondary btn-file">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input name="image" type="file" />
                              </span>
                              <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                          </div>
                          <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-md-6">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">General Information</h3>
                  
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" id="name" name="name"
                                class="form-control {{ ($errors->has('name') ? 'is-invalid' : null) }}" required autofocus>
                              <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="origin">Origin</label>
                              <input type="text" id="origin" name="origin"
                                class="form-control {{ ($errors->has('origin') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('origin') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="vessel">Vessel</label>
                              <input type="text" id="vessel" name="vessel"
                                class="form-control {{ ($errors->has('vessel') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('vessel') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="trip_type">Trip Type</label>
                              <select id="trip_type" name="trip_type" class="form-control {{ ($errors->has('trip_type') ? 'is-invalid' : null) }}" autofocus>
                                <option selected="" disabled="">Select one</option>
                                <option value="Round Trip">Round Trip</option>
                                <option value="One-way">One-way</option>
                              </select>
                              <div class="invalid-feedback">
                                {{ $errors->first('trip_type') }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- textarea -->
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" id="description" name="description" rows="3" placeholder=""></textarea>
                          <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <div class="col-md-3">
                    <div class="card card-primary">
                      <div class="card-header">
                        <h3 class="card-title">Cruise Dates</h3>
                
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="form-group">
                          <label>Departure Date</label>
                          <div class="input-group date" id="departuredatetime" data-target-input="nearest">
                            <input type="text" name="depart_at" class="form-control datetimepicker-input {{ ($errors->has('depart_at') ? 'is-invalid' : null) }}" data-target="#departuredatetime" required />
                            <div class="input-group-append" data-target="#departuredatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <div class="invalid-feedback">
                              {{ $errors->first('depart_at') }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="days">Days</label>
                              <input type="number" id="days" name="days" min="1" class="form-control {{ ($errors->has('days') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('days') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="nights">Nights</label>
                              <input type="number" id="nights" name="nights" min="0" class="form-control {{ ($errors->has('nights') ? 'is-invalid' : null) }}"
                                required>
                              <div class="invalid-feedback">
                                {{ $errors->first('nights') }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-12">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <h3 class="card-title">Images</h3>
                  
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body text-center">
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                          <div class="form-control" data-trigger="fileinput">
                            <span class="fileinput-filename"></span>
                          </div>
                          <span class="input-group-append">
                            <span class="input-group-text fileinput-exists" data-dismiss="fileinput">
                              Remove
                            </span>
                  
                            <span class="input-group-text btn-file">
                              <span class="fileinput-new">Select file</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" name="images[]" multiple>
                            </span>
                          </span>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="row">
                  <div class="col-12">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <button type="button" name="add" id="dynamic-itinerary" class="btn btn-primary">Add Itinerary</button>
                      </div>
                      <div class="card-body" id="dynamicAddItinerary">
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- ./card -->
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <a href="{{ route('admin.cruise.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Create new Cruise" class="btn btn-success float-right mr-2">
      </div>
    </div>
  </form>

  <x-slot name="script">
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <script>
      $(function(){
        $('#departuredatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

        var simplemde = new SimpleMDE({ element: $("#description")[0] });
        
        $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
        });

        var iCnt = 0;
        $("#dynamic-itinerary").click(function () {
          ++iCnt;
          $("#dynamicAddItinerary").append(`
            <div class="row py-2 border-top">
              <div class="col-12 col-md-2">
                <div class="form-group text-center">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                      <img src="http://placehold.it/200x150&text=No+Image" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;">
                    </div>
                    <div>
                      <span class="btn btn-outline-secondary btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input name="ItineraryFields[${iCnt}][image]" type="file" />
                      </span>
                      <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-10">
                <div class="row">
                  <div class="col-12 col-md-2">
                    <div class="form-group">
                      <label>Day</label>
                      <input type="number" name="ItineraryFields[${iCnt}][day]" value="${iCnt}" class="form-control" min="1" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Location</label>
                      <input type="text" name="ItineraryFields[${iCnt}][location]" value="" class="form-control" min="1" required />
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Itinerary Date</label>
                      <div class="input-group date" id="itinerarydate${iCnt}" data-target-input="nearest">
                        <input type="text" name="ItineraryFields[${iCnt}][itinerary_date]"
                          class="form-control datetimepicker-input"
                          data-target="#itinerarydate${iCnt}" required />
                        <div class="input-group-append" data-target="#itinerarydate${iCnt}" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Arrival Date and Time</label>
                      <div class="input-group date" id="arrivedatetime${iCnt}" data-target-input="nearest">
                        <input type="text" name="ItineraryFields[${iCnt}][arrive_at]"
                          class="form-control datetimepicker-input"
                          data-target="#arrivedatetime${iCnt}" />
                        <div class="input-group-append" data-target="#arrivedatetime${iCnt}" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Departure Date and Time</label>
                      <div class="input-group date" id="departdatetime${iCnt}" data-target-input="nearest">
                        <input type="text" name="ItineraryFields[${iCnt}][depart_at]"
                          class="form-control datetimepicker-input departdatetime"
                          data-target="#departdatetime${iCnt}" />
                        <div class="input-group-append" data-target="#departdatetime${iCnt}" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-outline-danger remove-itinerary">Remove</button>
              </div>
            </div>
          `);
          $('#dynamicAddItinerary input[type=text]').first().focus()
          $(`#itinerarydate${iCnt}`).datetimepicker({ format: 'L' });
          $(`#arrivedatetime${iCnt}`).datetimepicker({ icons: { time: 'far fa-clock' } });
          $(`#departdatetime${iCnt}`).datetimepicker({ icons: { time: 'far fa-clock' } });      

          $(`#itinerarydate${iCnt}`).on("change.datetimepicker", function (e) {
            $(`#arrivedatetime${iCnt}`).datetimepicker('minDate', e.date);
          });
          $(`#departdatetime${iCnt}`).on("change.datetimepicker", function (e) {
            $(`#arrivedatetime${iCnt}`).datetimepicker('maxDate', e.date);
          });
          $(`#arrivedatetime${iCnt}`).on("change.datetimepicker", function (e) {
            $(`#departdatetime${iCnt}`).datetimepicker('minDate', e.date);
          });    
        });
        $(document).on('click', '.remove-itinerary', function () {
          $(this).parent('div').remove();
        });
      })
    </script>
  </x-slot>
</x-app-layout>