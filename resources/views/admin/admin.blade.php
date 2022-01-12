<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - @yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css')}}">
    <link href="{{ asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/admin.css')}}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('main')}}" class="nav-link">Главная</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('posters')}}" class="nav-link">Афиша</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('cinemas')}}" class="nav-link">Кинотеатры</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('discounts')}}" class="nav-link">Акции</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('events')}}" class="nav-link">Новости</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('page_contacts')}}" class="nav-link">Контакты</a>
            </li>
        </ul>
        <div style="width: 80%; text-align: right">
            <a href="{{route('logout')}}" style="color:black;">Log out</a>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('statistic')}}" class="brand-link">
            <span class="brand-text font-weight-light" style="margin-left: 10px">CinemaCMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" style="margin-left: 10px" class="d-block">{{Illuminate\Support\Facades\Auth::guard('admin')->user()->admin_name}}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Статистика' ? document.write('<a href="{{route('statistic')}}" class="nav-link active">') : document.write('<a href="{{route('statistic')}}" class="nav-link">');
                        </script>
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Статистика
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Баннеры' ? document.write('<a href="{{route('admin-banners')}}" class="nav-link active">') : document.write('<a href="{{route('admin-banners')}}" class="nav-link">');
                        </script>
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Баннеры
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Фильмы' ? document.write('<a href="{{route('admin-posters')}}" class="nav-link active">') : document.write('<a href="{{route('admin-posters')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-archive"></i>
                        <p>Фильмы</p>
                        </a>
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <script type="text/javascript">--}}
{{--                                    document.title === 'Admin - Фильмы' ? document.write('<a href="{{route('admin-posters')}}" class="nav-link active">') : document.write('<a href="{{route('admin-posters')}}" class="nav-link">');--}}
{{--                                </script>--}}
{{--                                <i class="nav-icon fas fa-archive"></i>--}}
{{--                                <p>Фильмы</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            <li class="nav-item">--}}
{{--                                <script type="text/javascript">--}}
{{--                                    document.title === 'Admin - Новый фильм' ? document.write('<a href="#" class="nav-link active">') : document.write('<a href="#" class="nav-link">');--}}
{{--                                </script>--}}
{{--                                    <i class="far fa-circle nav-icon"></i>--}}
{{--                                    <p>Новый фильм</p>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Кинотеатры' ?
                                document.write('<a href="{{route('admin-cinemas')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-cinemas')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Кинотеатры
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Акции' ?
                                document.write('<a href="{{route('admin-discounts')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-discounts')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Акции
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Новости' ?
                                document.write('<a href="{{route('admin-events')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-events')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Новости
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Расписание' ?
                                document.write('<a href="{{route('admin-timetables')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-timetables')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Расписание
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Страницы' ?
                                document.write('<a href="{{route('admin-pages')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-pages')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Страницы
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Пользователи' ?
                                document.write('<a href="{{route('admin-users')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-users')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Пользователи
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.title === 'Admin - Рассылка' ?
                                document.write('<a href="{{route('admin-send_methods')}}" class="nav-link active">') :
                                document.write('<a href="{{route('admin-send_methods')}}" class="nav-link">');
                        </script>
                        <i class="nav-icon fas fa-archive"></i>
                        <p>
                            Рассылка
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
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

{{--    <!-- Main Footer -->--}}
{{--    <footer class="main-footer">--}}
{{--        <!-- To the right -->--}}
{{--        <div class="float-right d-none d-sm-inline">--}}
{{--            Anything you want--}}
{{--        </div>--}}
{{--        <!-- Default to the left -->--}}
{{--        <strong>Copyright &copy; 2021 <a href="https://cinema.com">Cinema.com</a>.</strong> All rights reserved.--}}
{{--    </footer>--}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
