<x-app-layout>
  <x-slot name="css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
    <style>
      .editor-toolbar {
        background-color: #fff;
      }
    </style>
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add New Testimonial</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.testimonial.index') }}">Testimonials</a></li>
          <li class="breadcrumb-item active">Add Testimonial</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
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
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control {{ ($errors->has('name') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label>Comment Date</label>
                  <div class="input-group date" id="commentdate" data-target-input="nearest">
                    <input type="text" name="comment_at" value="{{ old('comment_at') }}"
                      class="form-control datetimepicker-input {{ ($errors->has('comment_at') ? 'is-invalid' : null) }}"
                      data-target="#commentdate" required />
                    <div class="input-group-append" data-target="#commentdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                    <div class="invalid-feedback">
                      {{ $errors->first('comment_at') }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="comment">Comment</label>
              <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="">{{ old('comment') }}</textarea>
              <div class="invalid-feedback">
                {{ $errors->first('comment') }}
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
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <a href="{{ route('admin.testimonial.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Create new Testimonial" class="btn btn-success float-right mr-2">
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

    <script>
      $(function(){
        $('#commentdate').datetimepicker({ format: 'L' });
      })
    </script>
  </x-slot>
</x-app-layout>