<x-app-layout>
  <x-slot name="css">
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Booking</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Booking</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  <div class="card">
    <div class="card-header">
      <a href="{{ route('admin.booking.create') }}" class="btn btn-success btn-sm">
        <i class="fas fa-plus-circle"></i>
        Create New
      </a>
      <div class="card-tools">
        <a href="{{ route('admin.booking.upload') }}" class="btn btn-info">
          <i class="fas fa-file-import"></i>
          Upload
        </a>
      </div>
    </div>
    <div class="card-body p-0 table-responsive">
      <table class="table table-striped projects">
        <thead>
          <tr>
            <th style="width: 1%">
              #
            </th>
            <th style="width: 10%">
              Type
            </th>
            <th style="width: 12%">
              Origin
            </th>
            <th style="width: 12%">
              Destination
            </th>
            <th>
              Courier
            </th>
            <th>
              Travel Date
            </th>
            <th>
              Departure Time
            </th>
            <th>
              Arrival Time
            </th>
            <th style="width: 20%">
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($bookings as $booking)
          <tr>
            <td>
              {{ $bookings->firstItem() + $loop->index }}
            </td>
            <td>
              {{ $booking->type }}
            </td>
            <td>
              {{ $booking->origin }}
            </td>
            <td>
              {{ $booking->destination }}
            </td>
            <td>
              {{ $booking->courier->name }}
            </td>
            <td>
              {{ $booking->travel_date->format('F d, Y') }}
            </td>
            <td>
              {{ $booking->travel_date->format('g:i A') }}
            </td>
            <td>
              {{ $booking->arrival_date->format('g:i A') }}
            </td>
            <td class="project-actions text-right">
              <form id="delete-{{ $booking->id }}" action="{{ route('admin.booking.destroy', $booking->slug) }}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-info btn-sm" href="{{ route('admin.booking.edit', $booking->slug) }}">
                  <i class="fas fa-pencil-alt"></i>
                  Edit
                </a>
                <button type="submit" class="btn btn-danger btn-sm delete" data-id="{{ $booking->id }}">
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
            Showing {{ ($bookings->firstItem() > 0) ? $bookings->firstItem() : 0 }} to {{ ($bookings->lastItem() > 0)
            ? $bookings->lastItem() : 0 }} of {{ $totalBookings }} {{ Str::plural('item', $totalBookings) }}
          </div>
        </div>
        <div class="col-sm-12 col-md-7">
          {{ $bookings->appends( Request::query() )->render() }}
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