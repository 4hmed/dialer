
<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
    @yield('styles')
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        @include('layouts.partials.header')
        <!-- /.navbar-top-links -->

@include('layouts.partials.sidebar')        <!-- /.navbar-static-side -->
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
        @yield('content')
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@include('layouts.partials.foot')
@yield('scripts')

</body>

</html>



