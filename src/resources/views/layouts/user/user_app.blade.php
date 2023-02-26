<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{csrf_token()}}" />

    <link rel="icon" href="{{ displayImage('assets/images/general/favicon/'.$generalSetting->favicon,'16x16') }}" />
    @include('layouts.user.includes.css')
    <title>@yield('user_page_title')</title>
</head>

<body>

    <!--= side bar start ==-->
    @include('layouts.user.includes.left_sidebar')
    <!--= side bar end  ===-->

    <!--= main content start  -->
    <div id="mainContent" class="main_content added">
        <!-- Dash_Board header start  -->
        @include('layouts.user.includes.header')
        <!-- Dash_Board header end  -->

        <!-- Dash_Board body start  ========-->
        <div class="dashboard_container">
            @yield('user_main_content')
        </div>
        <!-- Dash_Board body end  ==========-->
    </div>
    <!--= main content end  -->
    @include('layouts.user.includes.js')
    <script>
        "use strict";
    
        (function($) {
            "use strict";

            // read notification
            $(document).on('click','.notification-read',function(e){
                const route = $(this).attr('data-route')
                const id = $(this).attr('data-id')
                readNotification(route,id)
                e.preventDefault()
            })
         

            //read Notification
            function readNotification(route,id){
                $.ajax({
                    method:'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{route('admin.read.notification')}}",
                    data:{
                      'id':id
                    },
                    dataType: 'json'
                  }).then(response =>{
                    console.log(response)
                    window.location.href = route
                });
            }
    
        })(jQuery);
      </script>
</body>

</html>



























{{--  <!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>@yield('admin_page_title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="BIR it basic project" name="description" />
        <meta content="bir it" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}">

@include('layouts.admin.includes.css')

</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('layouts.admin.includes.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.admin.includes.left_sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('admin_content')
            <!-- End Page-content -->


            @include('layouts.admin.includes.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- Right Sidebar -->
    @include('layouts.admin.includes.right_sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    @include('layouts.admin.includes.js')
</body>

</html> --}}