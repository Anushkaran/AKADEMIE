<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content=" une application permettant de gérer les formations dispensées aux collaborateurs et de piloter les compétences et les ressources .">
    <meta name="keywords" content=" une application permettant de gérer les formations dispensées aux collaborateurs et de piloter les compétences et les ressources .">
    <meta name="author" content="DEVELOP/IT">
    <title>@yield('title',config('app.name'). " Panneau d'administration" )</title>
    <link rel="apple-touch-icon" href="{{asset('assets/vuexy/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/vuexy/app-assets/images/ico/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
    <script src="{{asset('assets/vuexy/app-assets/vendors/css/extensions/sweetalert2.min.css')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/plugins/extensions/ext-component-toastr.min.css')}}">

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/css/style.css')}}">
    <!-- END: Custom CSS-->
    @stack('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu    " >

<!-- BEGIN: Header-->
@include('user.layouts.partials.header')
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
@include('user.layouts.partials.menu')
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->

<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2022</span></p>
</footer>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/vuexy/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/vuexy/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/vuexy/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/vuexy/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
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
        toastr['error']('{{session("error")}}', '{{__("labels.error")}}', {
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
