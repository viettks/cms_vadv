<!DOCTYPE html>
<html lang="en">

<head>
    @include('fragment.head')

    @yield('style')
    <style>
    .page-container {
        padding-left: 0px;
    }
    .header-desktop {
        left: 0 !important;
    }
    </style>
</head>

<body>
    <div class="page-wrapper">

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
    <script>
        $(document).ajaxError(function myErrorHandler(event, xhr, ajaxOptions, thrownError) {
            if(xhr.status == 403){
                window.location.reload();
            }
        });
    </script>
</body>
</html>
<!-- end document-->
