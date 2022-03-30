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
        <h1 class="m-0">Update Promo</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.promo.index') }}">Promos</a></li>
          <li class="breadcrumb-item active">Update Promo</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  <form action="{{ route('admin.promo.update', $promo->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-md-8">
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
              <div class="col-12">
                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" id="title" name="title" value="{{ old('title') ?? $promo->title }}" class="form-control {{ ($errors->has('title') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="">{{ old('description') ?? $promo->description }}</textarea>
              <div class="invalid-feedback">
                {{ $errors->first('description') }}
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-4">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Promo Dates</h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Start</label>
              <div class="input-group date" id="startdate" data-target-input="nearest">
                <input type="text" name="date_start" value="{{ old('date_start') ?? $promo->date_start }}" class="form-control datetimepicker-input {{ ($errors->has('date_start') ? 'is-invalid' : null) }}" data-target="#startdate" required />
                <div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <div class="invalid-feedback">
                  {{ $errors->first('date_start') }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>End</label>
              <div class="input-group date" id="enddate" data-target-input="nearest">
                <input type="text" name="date_end" value="{{ old('date_end') ?? $promo->date_end }}" class="form-control datetimepicker-input {{ ($errors->has('date_end') ? 'is-invalid' : null) }}" data-target="#enddate" required />
                <div class="input-group-append" data-target="#enddate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <div class="invalid-feedback">
                  {{ $errors->first('date_end') }}
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

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
                  <img src="{{ $promo->image_url ?? 'http://placehold.it/200x150&text=No+Image'}}" alt="...">
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
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <a href="{{ route('admin.promo.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Update Promo" class="btn btn-success float-right mr-2">
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
        $('#startdate').datetimepicker({ 
          format: 'L',
          date: "{{ $promo->date_start }}"
        });
        $('#enddate').datetimepicker({ 
          useCurrent: false,
          format: 'L',
          date: "{{ $promo->date_end }}"
        });

        var simplemde = new SimpleMDE({ element: $("#description")[0] });

        $("#startdate").on("change.datetimepicker", function (e) {
          $('#enddate').datetimepicker('minDate', e.date);
        });
        $("#enddate").on("change.datetimepicker", function (e) {
            $('#startdate').datetimepicker('maxDate', e.date);
        });
      })
    </script>
  </x-slot>
</x-app-layout>