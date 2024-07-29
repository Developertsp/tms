<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
    <head>
        <title>@yield('title')</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="" />
        <meta name="keywords" content="">
        <meta name="author" content="Phoenixcoded" />

        @include('layout.style')

        <!-- one signal for notification -->
=======
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        @include('layout.style')

>>>>>>> f822cf6 (updation in the)
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" defer></script>
        <script>
            window.OneSignal = window.OneSignal || [];
            OneSignal.push(function() {
                OneSignal.init({
                    appId: "e9b83ff2-2902-42b7-8701-ebf07ea3d682",
                });

                var userId = '{{ auth()->user()->id }}';
                OneSignal.sendTag("userId", userId);
            });
        </script>
    </head>

    <body>
<<<<<<< HEAD
        <!-- [ Pre-loader ] start -->
        <div class="loader-bg">
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
        </div>

        <!-- Left Sidebar -->
        @include('layout.sidebar')

        <!-- Topbar -->
        @include('layout.navbar')

        <!-- [ Main Content ] start -->
        <div class="pcoded-main-container">
            <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5 class="m-b-10">@yield('pageTitle')</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                                    <li class="breadcrumb-item"><a href="#!">@yield('breadcrumTitle')</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                @yield('content')
            </div>
            
        </div>

        @include('layout.script')

        @yield('script')
        @stack('scripts')
=======
        <!-- Begin page -->
        <div class="layout-wrapper">

            <!-- Left Sidebar -->
            @include('layout.sidebar')

            <!-- Start Page Content here -->
            <div class="page-content">

                <!-- Topbar -->
                @include('layout.navbar')

                <!-- Content Start -->
                <div class="px-3">

                    <!-- Container Start -->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="py-3 py-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title mb-0">@yield('pageTitle')</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @yield('content')

                    </div><!-- Container End -->

                </div> <!-- Content End -->

                @include('layout.footer')
            </div> <!-- End Page Content -->

        </div>

        @include('layout.script')
        @yield('script')

>>>>>>> f822cf6 (updation in the)
    </body>

</html>
