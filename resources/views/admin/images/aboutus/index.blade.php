<x-app-layout>
  <x-slot name="css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">About Us Background Image</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">About Us Image</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  <div class="card">
    <form action="{{ route('admin.images.backgrounds.aboutus.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card-header">
        <div class="row mt-4">
          <div class="col-8 col-md-11">
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
                  <input type="file" name="image" accept=".jpg,.jpeg,.png" required>
                </span>
              </span>
            </div>
          </div>
          <div class="col-4 col-md-1">
            <input type="submit" value="Replace" class="btn btn-success float-right mr-2">
          </div>
        </div>
      </form>
    </div>
    <div class="card-body">
      <div class="row mt-4">
        <img src="{{ asset($image) }}" class="img-fluid" />
      </div>
    </div>
    <!-- /.card-body -->
  </div>

  <x-slot name="script">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <script>
      $('.delete').on('click', function(event) {
          event.preventDefault();
          swal.fire({
            title: 'Proceed to delete this record?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              const form = '#delete-' + $(this).attr("data-id");
              $(form).submit();
            }
          });
    
          return false;
        });
    </script>
  </x-slot>
</x-app-layout>