<x-app-layout>
  <x-slot name="css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
      rel="stylesheet">

    <style>
      .toggle-on {
        right: unset;
      }
      .toggle-off {
        left: unset;
      }
    </style>
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Add New Address</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.address.index') }}">Addresses</a></li>
          <li class="breadcrumb-item active">Add Address</li>
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

  <form action="{{ route('admin.address.store') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-12">
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
              <div class="col-12 col-md-2">
                <label>Main Address</label>
                <div class="form-group">
                  <input name="main" value="{{ old('main') }}" id="main" @if (old('main') == '1') checked @endif type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                </div>
              </div>
              <div class="col-12 col-md-10">
                <div class="form-group">
                  <label for="street">Street</label>
                  <input type="text" id="street" name="street" value="{{ old('street') }}" class="form-control {{ ($errors->has('street') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('street') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="barangay">Barangay</label>
                  <input type="text" id="barangay" name="barangay" value="{{ old('barangay') }}" class="form-control {{ ($errors->has('barangay') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('barangay') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control {{ ($errors->has('city') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('city') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="zip_code">Zip Code</label>
                  <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" class="form-control {{ ($errors->has('zip_code') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('zip_code') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" id="country" name="country" value="{{ old('country') }}" class="form-control {{ ($errors->has('country') ? 'is-invalid' : null) }}" required />
                  <div class="invalid-feedback">
                    {{ $errors->first('country') }}
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
    <div class="row mb-4">
      <div class="col-12">
        <a href="{{ route('admin.address.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Create new Address" class="btn btn-success float-right mr-2">
      </div>
    </div>
  </form>

  <x-slot name="script">
    <!-- Bootstrap Switch -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
      $("#main").on('change', function() {
        if ($(this).is(':checked')) {
          $(this).attr('value', '1');
        } else {
          $(this).attr('value', '');
        }
      });
    </script>
  </x-slot>
</x-app-layout>