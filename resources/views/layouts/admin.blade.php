<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NUPI Admin | Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Custom Admin Overrides -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @auth
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #6cc0b8;">
                <!-- Brand Logo -->
                <a href="{{ route('admin.dashboard') }}" class="brand-link text-center"
                    style="background-color: #6cc0b8; border-bottom: 1px solid rgba(12, 46, 129, 0.1);">
                    <img src="{{ asset('images/logo.png') }}" alt="NUPI Logo" class="brand-image"
                        style="max-width: 120px; opacity: 1;">
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"
                                style="color: #0c2e81; font-weight: 600;">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">

                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Users</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>Products</p>
                                </a>
                            </li> --}}

                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>Orders</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.partners.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-handshake"></i>
                                    <p>Partners</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.contacts.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-envelope"></i>
                                    <p>Contacts</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="background-color: #fcf3e9;">
                @yield('content')
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <strong>Copyright &copy; {{ date('Y') }} <a href="#">NUPI Ecommerce</a>.</strong>
                All rights reserved.
            </footer>

        </div>
        <!-- ./wrapper -->
    @else
        @yield('content')
    @endauth

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    @yield('scripts')
</body>

</html>