<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

    <title>Labason Safe Haven - Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/font_awesome_5_free.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontawesome-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">

    <script src="{{ asset('dist/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('dist/js/tooltip.js') }}"></script>
    <script src="{{ asset('dist/js/popper.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('dist/js/moment.min.js') }}"></script>
    <script src="{{ asset('dist/js/stisla.js') }}"></script>
    <script src="{{ asset('dist/js/jscolor.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dist/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('dist/js/fontawesome-iconpicker.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap4-toggle.min.js') }}"></script>
</head>

<body>
<div id="app">
    <div class="main-wrapper">

        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="nav-link">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-warning">Visit Website</a>
                </li>
                <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('uploads/user.jpg') }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">John Doe</div></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Edit Profile
                        </a>
                        <a href="login.html" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>



        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">Admin Panel</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html"></a>
                </div>

                <ul class="sidebar-menu">

                    <li class="active"><a class="nav-link" href="index.html"><i class="fas fa-hand-point-right"></i> <span>Dashboard</span></a></li>

                    <li class="nav-item dropdown active">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-hand-point-right"></i><span>Dropdown Items</span></a>
                        <ul class="dropdown-menu">
                            <li class="active"><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 1</a></li>
                            <li class=""><a class="nav-link" href=""><i class="fas fa-angle-right"></i> Item 2</a></li>
                        </ul>
                    </li>

                    <li class=""><a class="nav-link" href="setting.html"><i class="fas fa-hand-point-right"></i> <span>Setting</span></a></li>

                    <li class=""><a class="nav-link" href="form.html"><i class="fas fa-hand-point-right"></i> <span>Form</span></a></li>

                    <li class=""><a class="nav-link" href="table.html"><i class="fas fa-hand-point-right"></i> <span>Table</span></a></li>

                    <li class=""><a class="nav-link" href="invoice.html"><i class="fas fa-hand-point-right"></i> <span>Invoice</span></a></li>

                </ul>
            </aside>
        </div>

        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('heading')</h1>
                    <div class="ml-auto">
                        <a href="" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total News Categories</h4>
                                </div>
                                <div class="card-body">
                                    12
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total News</h4>
                                </div>
                                <div class="card-body">
                                    122
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Users</h4>
                                </div>
                                <div class="card-body">
                                    45
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>

<script src="{{ asset('dist/js/scripts.js') }}"></script>
<script src="{{ asset('dist/js/custom.js') }}"></script>

</body>
</html>