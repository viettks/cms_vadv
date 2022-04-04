<!DOCTYPE html>
<html lang="en">

<head>
    @include('fragment.head')

    @yield('style')
</head>

<body class="animsition">
    <div class="page-wrapper">
        @include('fragment.header-moblie')
        @include('fragment.sider-bar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('fragment.header-main')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('modal')
        <!-- END PAGE CONTAINER-->
    </div>
    @include('fragment.script')
    @yield('extend_script')
</body>
</html>
<!-- end document-->
