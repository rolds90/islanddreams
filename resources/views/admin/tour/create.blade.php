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
        <h1 class="m-0">Add New Tour</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.tour.index') }}">Tour</a></li>
          <li class="breadcrumb-item active">Add Tour</li>
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

  <form action="{{ route('admin.tour.store') }}" method="POST" enctype="multipart/form-data">
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
              <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Inclusions</a></li>
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
                          <div class="fileinput fileinput-new {{ ($errors->has('image') ? 'is-invalid' : null) }}"
                            data-provides="fileinput">
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
                              <label for="location">Location</label>
                              <input type="text" id="location" name="location"
                                class="form-control {{ ($errors->has('location') ? 'is-invalid' : null) }}" required>
                              <div class="invalid-feedback">
                                {{ $errors->first('location') }}
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
                        <h3 class="card-title">Tour Dates</h3>
                
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="form-group">
                          <label>Expire</label>
                          <div class="input-group date" id="departuredatetime" data-target-input="nearest">
                            <input type="text" name="expire_at" class="form-control datetimepicker-input {{ ($errors->has('expire_at') ? 'is-invalid' : null) }}" data-target="#departuredatetime" required />
                            <div class="input-group-append" data-target="#departuredatetime" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            <div class="invalid-feedback">
                              {{ $errors->first('expire_at') }}
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
              <div class="tab-pane" id="tab_4">
                <div class="row">
                  <div class="col-12">
                    <div class="card card-secondary">
                      <div class="card-header">
                        <button type="button" name="add" id="dynamic-inclusion" class="btn btn-primary">Add Inclusion</button>
                      </div>
                      <div class="card-body" id="dynamicAddInclusion">
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
        <a href="{{ route('admin.tour.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Create new Tour" class="btn btn-success float-right mr-2">
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

        $(".btn-image").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
        });
        
        $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
        });

        var i = 0;
        $("#dynamic-itinerary").click(function () {
          ++i;
          $("#dynamicAddItinerary").append(`
            <div class="row py-2 border-top">
              <div class="col-12 col-md-3">
                <div class="form-group">
                  <label>Day</label>
                  <input type="number" name="ItineraryFields[${i}][day]" value="${i}" class="form-control" min="1" />
                </div>
              </div>
              <div class="col-12 col-md-9">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="ItineraryFields[${i}][title]" value="" class="form-control" min="1" />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="ItineraryFields[${i}][description]" rows="3" placeholder=""></textarea>
                </div>
              </div>
              <button type="button" class="btn btn-outline-danger remove-itinerary">Remove</button>
            </div>
          `);
          $('#dynamicAddItinerary input').last().focus()
        });
        $(document).on('click', '.remove-itinerary', function () {
          $(this).parent('div').remove();
        });

        var ii = 0;
        $("#dynamic-inclusion").click(function () {
          ++ii;
          $("#dynamicAddInclusion").append(`
            <div class="row py-2 border-top">
              <div class="col-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="InclusionFields[${ii}][description]" rows="3" placeholder=""></textarea>
                </div>
              </div>
              <button type="button" class="btn btn-outline-danger remove-inclusion">Remove</button>
            </div>
          `);
          $('#dynamicAddInclusion textarea').last().focus()
        });
        $(document).on('click', '.remove-inclusion', function () {
          $(this).parent('div').remove();
        });
      })
    </script>
  </x-slot>
</x-app-layout>