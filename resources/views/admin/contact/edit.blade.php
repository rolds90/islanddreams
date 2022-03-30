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
        <h1 class="m-0">Update Contact</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">Contact</a></li>
          <li class="breadcrumb-item active">Update Contact</li>
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

  <form action="{{ route('admin.contact.update', $contact->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
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
              <div class="col-12 col-md-4">
                <label>Main Contact No.</label>
                <div class="form-group">
                  <input name="main_contact" value="{{ old('main_contact') ?? $contact->main_contact }}" id="main_contact" @if (old('main_contact') == '1' || (empty(old()) && $contact->main_contact == 1)) checked @endif type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                </div>
              </div>
              <div class="col-12 col-md-4">
                <label>Main Email</label>
                <div class="form-group">
                  <input name="main_email" value="{{ old('main_email') ?? $contact->main_email }}" id="main_email" @if (old('main_email') == '1' || (empty(old()) && $contact->main_email == 1)) checked @endif type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" name="name" value="{{ old('name') ?? $contact->name }}" class="form-control {{ ($errors->has('name') ? 'is-invalid' : null) }}" required autofocus/>
                  <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="contact_no">Contact No.</label>
                  <input type="text" id="contact_no" name="contact_no" value="{{ old('contact_no') ?? $contact->contact_no }}" class="form-control {{ ($errors->has('contact_no') ? 'is-invalid' : null) }}" />
                  <div class="invalid-feedback">
                    {{ $errors->first('contact_no') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" value="{{ old('email') ?? $contact->email }}" class="form-control {{ ($errors->has('email') ? 'is-invalid' : null) }}" />
                  <div class="invalid-feedback">
                    {{ $errors->first('email') }}
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
        <a href="{{ route('admin.contact.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Update Contact" class="btn btn-success float-right mr-2">
      </div>
    </div>
  </form>

  <x-slot name="script">
    <!-- Bootstrap Switch -->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
      $("#main_contact").on('change', function() {
        if ($(this).is(':checked')) {
          $(this).attr('value', '1');
        } else {
          $(this).attr('value', '');
        }
      });
      $("#main_email").on('change', function() {
        if ($(this).is(':checked')) {
          $(this).attr('value', '1');
        } else {
          $(this).attr('value', '');
        }
      });
    </script>
  </x-slot>
</x-app-layout>