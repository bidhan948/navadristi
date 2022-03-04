<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- this is a cdn of ck editor --}}
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    {{-- this is our own custom css --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/spinner.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/icons.min.css') }}"> --}}
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
    {{-- @include('sweetalert::alert')
    @livewireStyles --}}
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i> <span
                            class="px-2">{{ auth()->user() == null ? 'ADMIN' : auth()->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <span
                                class="px-3">{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link" target="_blank">
                <img src="{{ asset('dist/img/neuro-logo.png') }}" alt="Neuro Hospital, Logo "
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span style="color:#fff; letter-spacing:1px;     text-transform: uppercase;"
                    class="brand-text font-weight-bold ">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link @yield('is_active_home')">
                                <i class='bx bx-home-circle nav-icon'></i>

                                <p>
                                    {{ __('Home') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page.index') }}" class="nav-link @yield('is_active_page')">
                                <i class='bx bx-file nav-icon'></i>
                                <p>
                                    {{ __('Page') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gallery.index') }}" class="nav-link @yield('is_active_gallery')">
                                <i class='bx bx-images nav-icon'></i>
                                <p>
                                    {{ __('Gallery') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('page_feature.index') }}"
                                class="nav-link @yield('is_active_page_feature')">
                                <i class='bx bxs-badge-check nav-icon'></i>
                                <p>
                                    {{ __('Page feature') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('news-events.index') }}"
                                class="nav-link @yield('is_active_news_events')">
                                <i class="fa-solid fa-newspaper nav-icon"></i>
                                <p>
                                    {{ __('News & events') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('side_banner') }}"
                                class="nav-link @yield('is_active_side_banner_image')">
                                <i class='bx bx-image-alt nav-icon'></i>
                                <p>
                                    {{ __('Side banner image') }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview @yield('menu_show_slider') ">
                            <a href="#" class="nav-link">
                                <i class='bx bx-carousel nav-icon'></i>
                                <p class="px-2">
                                    {{ __('Slider') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview " style="display: @yield('s_child_slider')">

                                <li class="nav-item">
                                    <a href="{{ route('carousel.index') }}"
                                        class="nav-link @yield('setting_carousel')">
                                        <i class='bx bxs-carousel nav-icon'></i>
                                        <p class="px-2">{{ __('Carousel') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('equipment.index') }}"
                                        class="nav-link @yield('setting_equipment')">
                                        <i class="fa-solid fa-gear nav-icon"></i>
                                        <p class="px-2">{{ __('Equipments') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('testimonial.index') }}"
                                        class="nav-link @yield('setting_testimonial')">
                                        <i class="fa-solid fa-message nav-icon"></i>
                                        <p class="px-2">{{ __('Testimonial') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview @yield('menu_show_speciality') ">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-award nav-icon"></i>
                                <p class="px-2">
                                    {{ __('Speciality') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview " style="display: @yield('s_child_speciality')">
                                <li class="nav-item">
                                    <a href="{{ route('speciality.create') }}"
                                        class="nav-link @yield('setting_speciality_add')">
                                        <i class="fa-solid fa-plus nav-icon"></i>
                                        <p class="px-2">{{ __('Add new') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('speciality.index') }}"
                                        class="nav-link @yield('setting_speciality')">
                                        <i class="fa-solid fa-list nav-icon"></i>
                                        <p class="px-2">{{ __('Speciality List') }}</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview @yield('menu_show') ">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-user-doctor nav-icon"></i>
                                <p class="px-2">
                                    {{ __('Doctor') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview " style="display: @yield('s_child')">

                                <li class="nav-item">
                                    <a href="{{ route('doctor.create') }}"
                                        class="nav-link @yield('setting_doctor_add')">
                                        <i class="fa-solid fa-plus nav-icon"></i>
                                        <p class="px-2">{{ __('Add doctor') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('doctor.index') }}" class="nav-link @yield('setting_doctor')">

                                        <i class="fa-solid fa-list nav-icon"></i>
                                        <p class="px-2">{{ __('Doctors List') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (auth()->user()->is_admin)
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link @yield('is_active_user')">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        {{ __('User') }}
                                    </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="https://farm.sarathitechnosoft.com.np/backup.php" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    {{ __('Backup Database') }}
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content" style="position: relative;">
                <div class="container-fluid" id="content" style="display: none;">
                    {{-- breadcrum --}}

                    <div class="row">
                        <div class="col-md-12">
                            @yield('main_content')
                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="loader" style="    position: absolute;
                top: 60px;
                max-height:100vh;
                background: #fff;">
                    <div class="col-12">
                        <div align="center" class="fond">
                            <div class="contener_general">
                                <div class="contener_mixte">
                                    <div class="ballcolor ball_1">&nbsp;</div>
                                </div>
                                <div class="contener_mixte">
                                    <div class="ballcolor ball_2">&nbsp;</div>
                                </div>
                                <div class="contener_mixte">
                                    <div class="ballcolor ball_3">&nbsp;</div>
                                </div>
                                <div class="contener_mixte">
                                    <div class="ballcolor ball_4">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        </section>
        <!-- Main content -->
        <!-- /.content -->
    </div>
    </div>
    </div>
    <!-- ./wrapper -->
    {{-- @livewireScripts --}}
    <script>
        document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector("#loader").style.display = "block";
                document.querySelector("#content").style.display = "none";
            } else {
                document.querySelector("#loader").style.display = "none";
                document.querySelector("#content").style.display = "block";
            }
        };
    </script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <!-- JQVMap -->
    {{-- <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <!-- jQuery Knob Chart -->
    {{-- <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/land.js') }}"></script>
    @yield('scripts')
</body>

</html>
