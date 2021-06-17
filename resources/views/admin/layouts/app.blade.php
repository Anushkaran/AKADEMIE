<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title',config('app.name'). ' Admin Panel' )</title>
    <link rel="apple-touch-icon" href="{{asset('assets/vuexy/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/vuexy/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/vendors/css/vendors.min.css')}}">
    <script src="{{asset('assets/vuexy/app-assets/vendors/css/extensions/sweetalert2.min.css')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/plugins/extensions/ext-component-toastr.min.css')}}">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/css/style.css')}}">
    <!-- END: Custom CSS-->

    @stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
@include('admin.layouts.partials.header')
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
@include('admin.layouts.partials.menu')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
    @yield('content')
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/vuexy/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/vuexy/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/vuexy/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<script src="{{asset('assets/vuexy/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/vuexy/app-assets/vendors/js/extensions/toastr.min.js')}}"></script><!-- BEGIN: Page JS-->
<!-- END: Page JS-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })

    // Success Type
    @if(session()->has('success'))
        toastr['success']('{{session("success")}}', '{{__('labels.success')}}', {
        closeButton: true,
        tapToDismiss: false,
        rtl: false
    });
    @endif

        @if(session()->has('error'))
        toastr['error']('{{session("error")}}', '{{__('labels.error')}}', {
        closeButton: true,
        tapToDismiss: false,
        rtl: true
    });
    @endif

    let mode = localStorage.getItem('mode');

    $('#switch-mode').on('click',function (){
        if (mode === 'dark-layout')
        {
            mode = 'light-layout';
            localStorage.setItem('mode',mode);
        }else {

            mode = 'dark-layout';
            localStorage.setItem('mode',mode);
        }
        setLayout(mode)
    })
    if (!mode){
        mode = 'light-layout';
    }
    function setLayout(currentLocalStorageLayout) {
        var navLinkStyle = $('.nav-link-style'),
            currentLayout = currentLocalStorageLayout,
            mainMenu = $('.main-menu'),
            navbar = $('.header-navbar');

        var $html = $('html');
        $html.removeClass('semi-dark-layout dark-layout bordered-layout');

        if (currentLocalStorageLayout === 'dark-layout') {
            $html.addClass('dark-layout');
            mainMenu.removeClass('menu-light').addClass('menu-dark');
            navbar.removeClass('navbar-light').addClass('navbar-dark');
            navLinkStyle.find('.ficon').replaceWith(feather.icons['sun'].toSvg({ class: 'ficon' }));
        } else {
            $html.addClass('light-layout');
            mainMenu.removeClass('menu-dark').addClass('menu-light');
            navbar.removeClass('navbar-dark').addClass('navbar-light');
            navLinkStyle.find('.ficon').replaceWith(feather.icons['moon'].toSvg({ class: 'ficon' }));
        }
        // Set radio in customizer if we have
        if ($('input:radio[data-layout=' + currentLocalStorageLayout.split('-')[0] + ']').length > 0) {
            setTimeout(function () {
                $('input:radio[data-layout=' + currentLocalStorageLayout.split('-')[0] + ']').prop('checked', true);
            });
        }
    }

    setLayout(mode)
</script>

@stack('js')
</body>
<!-- END: Body-->

</html>
