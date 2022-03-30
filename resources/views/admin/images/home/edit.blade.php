<x-app-layout>
  <x-slot name="css">
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Update Slider Sorting</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.images.home.index') }}">Slider</a></li>
          <li class="breadcrumb-item active">Update Slider</li>
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

  <form action="{{ route('admin.images.home.update', $image->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-3">
        <!-- Custom Tabs -->
        <div class="card">
          <div class="card-body">
            <img src="{{ $image->image_url }}" alt="" class="img-fluid pb-2">

            <div class="form-group">
              <label>Sort</label>
              <input name="sort" type="number" value="{{ old('sort') ?? $image->sort }}" class="form-control" placeholder="Sort" min="1"/>
              
            </div>
          </div><!-- /.card-body -->
        </div>
        <!-- ./card -->
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-12">
        <a href="{{ route('admin.images.home.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Update Slider" class="btn btn-success float-right mr-2">
      </div>
    </div>
  </form>

  <x-slot name="script">
  </x-slot>
</x-app-layout>