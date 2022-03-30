<nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user pr-2"></i>
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- Menu Footer-->
                <li class="user-footer">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Sign Out') }}
                        </x-dropdown-link>
                    </form>
                    @endauth
                </li>
            </ul>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">Island Dreams Travel Services</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{ (request()->is('admin/images*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/images*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Website Images
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.images.home.index') }}" class="nav-link {{ (request()->is('admin/images/home*')) ? 'active' : '' }}">
                                <i class="far fa-images nav-icon"></i>
                                <p>Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.images.legitimacy.index') }}" class="nav-link {{ (request()->is('admin/images/legitimacy*')) ? 'active' : '' }}">
                                <i class="fas fa-images nav-icon"></i>
                                <p>Proof of Legitimacy</p>
                            </a>
                        </li>
                        <li class="nav-item {{ (request()->is('admin/images/backgrounds*')) ? 'menu-is-opening menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Backgrounds
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ (request()->is('admin/images/backgrounds*')) ? 'display: block;' : '' }}">
                                <li class="nav-item">
                                    <a href="{{ route('admin.images.backgrounds.header.index') }}" class="nav-link {{ (request()->is('admin/images/backgrounds/header*')) ? 'active' : '' }}">
                                        <i class="fas fa-image nav-icon"></i>
                                        <p>Header</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.images.backgrounds.aboutus.index') }}" class="nav-link {{ (request()->is('admin/images/backgrounds/aboutus*')) ? 'active' : '' }}">
                                        <i class="fas fa-image nav-icon"></i>
                                        <p>About Us</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ (request()->is('admin/company*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ (request()->is('admin/company*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>
                            Company Information
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.address.index') }}" class="nav-link {{ (request()->is('admin/company/address*')) ? 'active' : '' }}">
                                <i class="fas fa-map-marked nav-icon"></i>
                                <p>Address</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.contact.index') }}" class="nav-link {{ (request()->is('admin/company/contact*')) ? 'active' : '' }}">
                                <i class="far fa-address-book nav-icon"></i>
                                <p>Contact</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.booking.index') }}" class="nav-link {{ (request()->is('admin/booking*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Booking
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.tour.index') }}" class="nav-link {{ (request()->is('admin/tour*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-suitcase-rolling"></i>
                        <p>
                            Tour
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cruise.index') }}" class="nav-link {{ (request()->is('admin/cruise*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ship"></i>
                        <p>
                            Cruise
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.promo.index') }}" class="nav-link {{ (request()->is('admin/promo*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Promos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ (request()->is('admin/news*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            News
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.testimonial.index') }}" class="nav-link {{ (request()->is('admin/testimonial*')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comment"></i>
                        <p>
                            Testimonial
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>