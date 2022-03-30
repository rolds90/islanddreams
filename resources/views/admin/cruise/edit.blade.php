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
        <h1 class="m-0">Update Cruise</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.cruise.index') }}">Cruise</a></li>
          <li class="breadcrumb-item active">Update Cruise</li>
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

  <form action="{{ route('admin.cruise.update', $cruise->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                              <img src="{{ $cruise->image_url ?? 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
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
                              <input type="text" id="name" name="name" value="{{ old('name') ?? $cruise->name }}" class="form-control {{ ($errors->has('name') ? 'is-invalid' : null) }}" required autofocus>
                              <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="origin">Origin</label>
                              <input type="text" id="origin" name="origin" value="{{ old('origin') ?? $cruise->origin }}" class="form-control {{ ($errors->has('origin') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('origin') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="vessel">Vessel</label>
                              <input type="text" id="vessel" name="vessel" value="{{ old('vessel') ?? $cruise->vessel }}" class="form-control {{ ($errors->has('vessel') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('vessel') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="trip_type">Trip Type</label>
                              <select id="trip_type" name="trip_type" class="form-control {{ ($errors->has('trip_type') ? 'is-invalid' : null) }}" autofocus>
                                <option disabled="">Select one</option>
                                <option value="Round Trip" {{ (old('trip_type') ?? $cruise->trip_type) === "Round Trip" ? 'selected' : null }}>Round Trip</option>
                                <option value="One-way" {{ (old('trip_type') ?? $cruise->trip_type) === "One-way" ? 'selected' : null }}>One-way</option>
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
                          <textarea class="form-control" id="description" name="description" rows="3" placeholder="">{{ old('description') ?? $cruise->description }}</textarea>
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
                            <input type="text" name="depart_at" value="{{ old('depart_at') ?? $cruise->depart_at->format('m/d/Y') }}" class="form-control datetimepicker-input {{ ($errors->has('depart_at') ? 'is-invalid' : null) }}" data-target="#departuredatetime" required />
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
                              <input type="number" id="days" name="days" value="{{ old('days') ?? $cruise->days }}" min="1" class="form-control {{ ($errors->has('days') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('days') }}
                              </div>
                            </div>
                          </div>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label for="nights">Nights</label>
                              <input type="number" id="nights" name="nights" value="{{ old('nights') ?? $cruise->nights }}" min="0" class="form-control {{ ($errors->has('nights') ? 'is-invalid' : null) }}" required>
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

                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th width="5%">Preview</th>
                                <th>File Name</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($cruise->images as $image)
                              <tr>
                                <td><img src="{{ $image->image_url }}" alt="{{ $image->image }}" width="100"></td>
                                <td>
                                  {{ $image->image }}
                                  <input type="hidden" name="current_images[]" value="{{ $image->image }}">
                                </td>
                                <td class="text-right py-0 align-middle">
                                  <a href="#" class="btn btn-danger delete-image"><i class="fas fa-trash"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
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
                        @foreach ($cruise->itineraries as $itinerary)
                        <input type="hidden" name="ItineraryFields[{{ $loop->iteration }}][id]" value="{{ $itinerary->id }}">
                        <div class="row py-2 border-top">
                          <div class="col-12 col-md-2">
                            <div class="form-group text-center">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                  <img src="{{ $itinerary->image_url ?? 'http://placehold.it/200x150&text=No+Image' }}" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;">
                                </div>
                                <div>
                                  <span class="btn btn-outline-secondary btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input name="ItineraryFields[{{ $loop->iteration }}][image]" type="file" />
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
                                  <input type="number" id="itineraryday{{ $loop->iteration }}" name="ItineraryFields[{{ $loop->iteration }}][day]" value="{{ $itinerary->day }}" class="form-control" min="1" />
                                </div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="form-group">
                                  <label>Location</label>
                                  <input type="text" name="ItineraryFields[{{ $loop->iteration }}][location]" value="{{ $itinerary->location }}" class="form-control" min="1" required />
                                </div>
                              </div>
                              <div class="col-12 col-md-4">
                                <div class="form-group">
                                  <label>Itinerary Date</label>
                                  <div class="input-group date" id="itinerarydate{{ $loop->iteration }}" data-target-input="nearest">
                                    <input type="text" name="ItineraryFields[{{ $loop->iteration }}][itinerary_date]" class="form-control datetimepicker-input"
                                      data-target="#itinerarydate{{ $loop->iteration }}" value="{{ $itinerary->itinerary_date ? $itinerary->itinerary_date->format('m/d/Y') : '' }}" required />
                                    <div class="input-group-append" data-target="#itinerarydate{{ $loop->iteration }}" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 col-md-4">
                                <div class="form-group">
                                  <label>Arrival Date and Time</label>
                                  <div class="input-group date" id="arrivedatetime{{ $loop->iteration }}" data-target-input="nearest">
                                    <input type="text" name="ItineraryFields[{{ $loop->iteration }}][arrive_at]" class="form-control datetimepicker-input"
                                      data-target="#arrivedatetime{{ $loop->iteration }}" value="{{ $itinerary->arrive_at ? $itinerary->arrive_at->format('m/d/Y g:i A') : '' }}" />
                                    <div class="input-group-append" data-target="#arrivedatetime{{ $loop->iteration }}" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 col-md-4">
                                <div class="form-group">
                                  <label>Departure Date and Time</label>
                                  <div class="input-group date" id="departdatetime{{ $loop->iteration }}" data-target-input="nearest">
                                    <input type="text" name="ItineraryFields[{{ $loop->iteration }}][depart_at]" value="{{ $itinerary->depart_at ? $itinerary->depart_at->format('m/d/Y g:i A') : '' }}"
                                      class="form-control datetimepicker-input departdatetime" data-target="#departdatetime{{ $loop->iteration }}" />
                                    <div class="input-group-append" data-target="#departdatetime{{ $loop->iteration }}" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <button type="button" class="btn btn-outline-danger remove-itinerary">Remove</button>
                          </div>
                        </div>
                        @endforeach
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
        <input type="submit" value="Update Cruise" class="btn btn-success float-right mr-2">
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
      $(function() {
        $('#departuredatetime').datetimepicker({
          icons: {
            time: 'far fa-clock'
          }
        });

        var simplemde = new SimpleMDE({
          element: $("#description")[0]
        });

        $("body").on("click", ".btn-danger", function() {
          $(this).parents(".control-group").remove();
        });

        $("#dynamic-itinerary").click(function() {
          var lastDay = $("[id^=itineraryday]").last().val();
          var iCnt = (lastDay === undefined ? 1 : parseInt(lastDay) + 1);
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
          $(`#itinerarydate${iCnt}`).datetimepicker({
            format: 'L'
          });
          $(`#arrivedatetime${iCnt}`).datetimepicker({
            icons: {
              time: 'far fa-clock'
            }
          });
          $(`#departdatetime${iCnt}`).datetimepicker({
            icons: {
              time: 'far fa-clock'
            }
          });

          $(`#itinerarydate${iCnt}`).on("change.datetimepicker", function(e) {
            $(`#arrivedatetime${iCnt}`).datetimepicker('minDate', e.date);
          });
          $(`#departdatetime${iCnt}`).on("change.datetimepicker", function(e) {
            $(`#arrivedatetime${iCnt}`).datetimepicker('maxDate', e.date);
          });
          $(`#arrivedatetime${iCnt}`).on("change.datetimepicker", function(e) {
            $(`#departdatetime${iCnt}`).datetimepicker('minDate', e.date);
          });
        });
        $(document).on('click', '.remove-itinerary', function() {
          $(this).parent('div').parent('div').remove();
        });

        $(document).on('click', '.delete-image', function () {
          $(this).parents('tr').remove();
        });

        @foreach ($cruise->itineraries as $itinerary)
        $(`#itinerarydate{{ $loop->iteration }}`).datetimepicker({
          format: 'L'
        });
        $(`#arrivedatetime{{ $loop->iteration }}`).datetimepicker({
          icons: {
            time: 'far fa-clock'
          },
          // minDate: "{{ $itinerary->itinerary_date->format('m/d/Y g:i A') }}",
          maxDate: "{{ $itinerary->depart_at ? $itinerary->depart_at->format('m/d/Y g:i A') : '' }}",
          format: 'MM/DD/YYYY hh:ss A',
        });
        $(`#departdatetime{{ $loop->iteration }}`).datetimepicker({
          icons: {
            time: 'far fa-clock'
          },
          // minDate: "{{ $itinerary->arrive_at ? $itinerary->arrive_at->format('m/d/Y g:i A') : '' }}",
          format: 'MM/DD/YYYY hh:ss A',
        });
        
        // $(`#itinerarydate{{ $loop->iteration }}`).on("change.datetimepicker", function(e) {
        //   $(`#arrivedatetime{{ $loop->iteration }}`).datetimepicker('minDate', e.date);
        // });
        // $(`#departdatetime{{ $loop->iteration }}`).on("change.datetimepicker", function(e) {
        //   $(`#arrivedatetime{{ $loop->iteration }}`).datetimepicker('maxDate', e.date);
        // });
        // $(`#arrivedatetime{{ $loop->iteration }}`).on("change.datetimepicker", function(e) {
        //   $(`#departdatetime{{ $loop->iteration }}`).datetimepicker('minDate', e.date);
        // });
        @endforeach
      })
    </script>
  </x-slot>
</x-app-layout>