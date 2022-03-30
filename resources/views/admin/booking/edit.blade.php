<x-app-layout>
  <x-slot name="css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  </x-slot>

  <x-slot name="header">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Update Booking</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.booking.index') }}">Booking</a></li>
          <li class="breadcrumb-item active">Edit Booking</li>
        </ol>
      </div><!-- /.col -->
    </div>
  </x-slot>

  <form action="{{ route('admin.booking.update', $booking->slug) }}" method="POST">
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
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="type">Type</label>
                  <select id="type" name="type" class="form-control {{ ($errors->has('type') ? 'is-invalid' : null) }}" autofocus>
                    <option disabled="">Select one</option>
                    <option value="AIR" {{ $booking->type === 'AIR' ? 'selected' : '' }}>AIR</option>
                    <option value="SEA" {{ $booking->type === 'SEA' ? 'selected' : '' }}>SEA</option>
                    <option value="LAND" {{ $booking->type === 'LAND' ? 'selected' : '' }}>LAND</option>
                  </select>
                  <div class="invalid-feedback">
                    {{ $errors->first('type') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="courier">Courier</label>
                  <select id="courier" name="courier_id" class="form-control {{ ($errors->has('courier_id') ? 'is-invalid' : null) }}" autofocus>
                    <option selected="" disabled="">Select one</option>
                    @foreach ($couriers as $courier)
                    <option value="{{ $courier->id }}" {{ $booking->courier_id === $courier->id ? 'selected' : '' }}>{{ $courier->name }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    {{ $errors->first('courier_id') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="origin">Origin</label>
                  <input type="text" id="origin" name="origin" value="{{ $booking->origin }}" class="form-control {{ ($errors->has('origin') ? 'is-invalid' : null) }}">
                  <div class="invalid-feedback">
                    {{ $errors->first('origin') }}
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-group">
                  <label for="destination">Destination</label>
                  <input type="text" id="destination" name="destination" value="{{ $booking->destination }}" class="form-control {{ ($errors->has('destination') ? 'is-invalid' : null) }}">
                  <div class="invalid-feedback">
                    {{ $errors->first('destination') }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Book Dates</h3>
    
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Departure</label>
              <div class="input-group date" id="departuredatetime" data-target-input="nearest">
                <input type="text" name="travel_date" class="form-control datetimepicker-input {{ ($errors->has('travel_date') ? 'is-invalid' : null) }}" data-target="#departuredatetime" value="" />
                <div class="input-group-append" data-target="#departuredatetime" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <div class="invalid-feedback">
                  {{ $errors->first('travel_date') }}
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Arrival</label>
              <div class="input-group date" id="arrivaldatetime" data-target-input="nearest">
                <input type="text" name="arrival_date" class="form-control datetimepicker-input {{ ($errors->has('arrival_date') ? 'is-invalid' : null) }}" data-target="#arrivaldatetime" value="{{ $booking->arrival_date->format('m/d/Y g:i A') }}" />
                <div class="input-group-append" data-target="#arrivaldatetime" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <div class="invalid-feedback">
                  {{ $errors->first('arrival_date') }}
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
        <a href="{{ route('admin.booking.index') }}" class="btn btn-secondary float-right">Cancel</a>
        <input type="submit" value="Update Booking" class="btn btn-success float-right mr-2">
      </div>
    </div>
  </form>

  <x-slot name="script">
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script>
      $(function(){
        $('#departuredatetime').datetimepicker({ 
          icons: { time: 'far fa-clock' },
          defaultDate: moment(new Date("{{ $booking->travel_date->format('m/d/Y g:i A') }}"), "YYYY-MM-DD h:mm a"),
        });
        $('#arrivaldatetime').datetimepicker({ 
          useCurrent: false,
          defaultDate: moment(new Date("{{ $booking->arrival_date->format('m/d/Y g:i A') }}"), "YYYY-MM-DD h:mm a"),
          icons: { time: 'far fa-clock' } 
        });

        $('#departuredatetime').datetimepicker('maxDate', moment(new Date("{{ $booking->arrival_date->format('m/d/Y g:i A') }}"), "YYYY-MM-DD h:mm a"));
        $('#arrivaldatetime').datetimepicker('minDate', moment(new Date("{{ $booking->travel_date->format('m/d/Y g:i A') }}"), "YYYY-MM-DD h:mm a"));

        $("#departuredatetime").on("change.datetimepicker", function (e) {
          $('#arrivaldatetime').datetimepicker('minDate', e.date);
        });
        $("#arrivaldatetime").on("change.datetimepicker", function (e) {
          $('#departuredatetime').datetimepicker('maxDate', e.date);
        });
      })
    </script>
  </x-slot>
</x-app-layout>