<!DOCTYPE html>
<html lang="en">
@yield('head')
<style>
    .custom-control {
    position: relative;
    display: block;
    min-height: 1.5rem;
    padding-left: 2.5rem;
}
.fc-content, .fc-title, .fc-time {
    color: orange !important;
    font-weight: 400;
    font-size: 14px !important;
    font-family: Sans-serif;
}
.fc-day-grid-event .fc-content {
    white-space: normal;
}
</style>
<body>
    <!--Page loader-->
    @yield('loader')
    <!--Page loader-->
    <!--Page Wrapper-->
    <div class="container-fluid">
        <!--Header-->
        <div class="row header shadow-sm">
            <!--Logo-->
            @yield('logo')
            <!--Logo-->
            <!--Header Menu-->
            @yield('header')
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->
        <div class="row main-content">
            <!--Sidebar left-->
            @yield('sidebar')
            <!--Sidebar left-->
            <!--Content right-->
            <div class="col-sm-9 col-xs-12 content pt-3 pl-0">
                @yield('main-content')
                <!--Footer-->
                @yield('footer')
                <!--Footer-->
            </div>
        </div>
        <!--Main Content-->
    </div>
    <!--Page Wrapper-->
    @yield('bottom')
</body>

</html>