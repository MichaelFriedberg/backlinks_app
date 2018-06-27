<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BloggerBucks Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700,300italic,400italic,600italic' rel='stylesheet' type='text/css'>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/vendor/admin-lte/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/vendor/admin-lte/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="/vendor/admin-lte/dist/css/skins/skin-blue.css">

    <link rel="stylesheet" href="/css/admin.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('admin.partials.header')

        @include('admin.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">

                @yield('content-header')

                <ol class="breadcrumb">
                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>

                    @stack('breadcrumbs')
                </ol>
            </section>

            @include('partials.messages')

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('admin.partials.footer')
    </div>
    <!-- ./wrapper -->

    <script src="/vendor/admin-lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="/vendor/admin-lte/bootstrap/js/bootstrap.js"></script>
    <script src="/vendor/admin-lte/dist/js/app.js"></script>
    <script src="/js/admin.js"></script>

    @stack('scripts')
</body>
</html>
