<x-app-layout>
  <x-slot name="css">
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Home Images</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Home Images</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  <div class="card">
    <div class="card-header">
      <a href="{{ route('admin.images.home.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus-circle"></i>
        Upload More
      </a>
    </div>
    <div class="card-body p-0 table-responsive">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 1%">
              #
            </th>
            <th>
              Image
            </th>
            <th>
              Sorting
            </th>
            <th style="width: 20%">
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($images as $image)
          <tr>
            <td>
              {{ $images->firstItem() + $loop->index }}
            </td>
            <td>
              <img src="{{ $image->image_url }}" width="150" />
            </td>
            <td>
              {{ $image->sort }}
            </td>
            <td class="project-actions text-right">
              <form id="delete-{{ $image->id }}" action="{{ route('admin.images.home.destroy', $image->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-info btn-sm" href="{{ route('admin.images.home.edit', $image->id) }}">
                  <i class="fas fa-pencil-alt"></i>
                  Edit
                </a>
                <button type="submit" class="btn btn-danger btn-sm delete" data-id="{{ $image->id }}">
                  <i class="fas fa-trash"></i>
                  Delete
                </button>
              </form>
            </td>
          </tr>
          @empty
              
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <div role="status" class="text-center text-md-left mb-2 mb-md-0">
            Showing {{ ($images->firstItem() > 0) ? $images->firstItem() : 0 }} to {{ ($images->lastItem() > 0)
            ? $images->lastItem() : 0 }} of {{ $totalImages }} {{ Str::plural('item', $totalImages) }}
          </div>
        </div>
        <div class="col-sm-12 col-md-7">
          {{ $images->appends( Request::query() )->render() }}
        </div>
      </div>
    </div>
  </div>

  <x-slot name="script">
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