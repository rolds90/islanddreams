<x-app-layout>
    <x-slot name="css">
    </x-slot>

    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            
                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Company Information</h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong>
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <a href="{{ route('admin.address.index') }}" title="Address">
                                Address
                            </a>
                        </strong>
            
                        <p class="text-muted">
                            
                            @foreach ($addresses as $address)
                                {{ $address->full_address }} @if($address->main) <i class="fas fa-check-circle" title="main"></i> @endif <br />
                            @endforeach
                            asdfsdfasdf <br/>
                            asdfadf asdfas dfasdf sdfa sdfa sdf <br/>
                        </p>
            
                        <hr>
            
                        <strong>
                            <i class="fas fa-phone mr-1"></i>
                            <a href="{{ route('admin.contact.index') }}" title="Address">
                                Contact Nos.
                            </a>
                        </strong>
            
                        <p class="text-muted">
                            @foreach ($contact_nos as $contact_no)
                                {{ $contact_no->contact_no }} <br/>
                            @endforeach
                        </p>
            
                        <hr>
            
                        <strong>
                            <i class="fas fa-envelope mr-1"></i>
                            <a href="{{ route('admin.contact.index') }}" title="Address">
                                Emails
                            </a>
                        </strong>
            
                        <p class="text-muted">
                            @foreach ($emails as $email)
                                {{ $email->email }} @if($email->main_email) <i class="fas fa-check-circle" title="main"></i> @endif <br />
                            @endforeach
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    <x-slot name="script">
    </x-slot>
</x-app-layout>