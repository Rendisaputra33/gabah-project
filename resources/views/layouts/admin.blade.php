<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Dashboard - Admin</title>
        <link type="text/css" href="{{ asset('') }}document/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link type="text/css" href="{{ asset('') }}document/bootstrap/css/bootstrap-responsive.min.css"
            rel="stylesheet" />
        <link type="text/css" href="{{ asset('') }}document/css/theme.css" rel="stylesheet" />
        <link type="text/css" href="{{ asset('') }}document/images/icons/css/font-awesome.css" rel="stylesheet" />
        <link type="text/css"
            href="{{ asset('') }}document/http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
            rel="stylesheet" />
    </head>

<body>
    <input type="hidden" id="baseurl" value="{{ baseUrl() }}">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse"> <i
                        class="icon-reorder shaded"></i></a><a class="brand" href="index.html">Admin </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3" />
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                    </form>
                    <ul class="nav pull-right">
                        <li class="nav-user dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{ session('username') }}
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active">
                                <a href="/admin"><i class="menu-icon icon-dashboard"></i>Dashboard </a>
                            </li>
                            <li>
                                <a href="/admin/customer"><i class="menu-icon icon-user"></i>Customer </a>
                            </li>
                            <li>
                                <a href="/admin/barang"><i class="menu-icon icon-inbox"></i>Barang</a>
                            </li>
                            <li>
                                <a href="/home"><i class="menu-icon icon-tasks"></i>Produksi</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.sidebar-->
                </div>

                @yield('content')

                <div class="footer">
                </div>
                <script src="{{ asset('') }}document/scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
                <script src="{{ asset('') }}document/scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript">
                </script>
                <script src="{{ asset('') }}document/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="{{ asset('') }}document/scripts/flot/jquery.flot.js" type="text/javascript"></script>
                <script src="{{ asset('') }}document/scripts/flot/jquery.flot.resize.js" type="text/javascript">
                </script>
                <script src="{{ asset('') }}document/scripts/datatables/jquery.dataTables.js"
                    type="text/javascript"></script>
                <script src="{{ asset('') }}document/scripts/common.js" type="text/javascript"></script>

</body>
</head>

</html>
