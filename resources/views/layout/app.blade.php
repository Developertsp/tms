<!DOCTYPE html>
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
            @yield('content')
        </div>

        @include('layout.script')

        @yield('script')

    </body>

</html>
