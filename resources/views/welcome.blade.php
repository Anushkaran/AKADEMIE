@extends('admin.layouts.auth-app')


@section('content')
    <style>
        .feather{
            width: 100px;
            height: 100px;}
    </style>
    <section id="pricing-plan">
        <!-- Brand logo-->

        <!-- /Brand logo-->
    <!-- title text and switch button -->
    <div class="text-center">
        <a class="brand-logo " href="javascript:void(0);">
            <img  width="20%" src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}"/>

        </a>
        <h1 class="my-4">{{__('messages.welcome_to',['name' => config('app.name')])}}</h1>
    </div>
    <!--/ title text and switch button -->

    <!-- pricing plan cards -->
    <div class="row pricing-card">
        <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
            <div class="row">


                <!-- standard plan -->
                <div class="col-12 col-md-4">
                    <div class="card standard-pricing popular text-center">

                        <div class="card-body">

                            <i  class="feather" data-feather='user-plus'></i>

                            <h3>{{__('messages.connect_as_admin')}}<br> </h3>

                            <a href="{{route('admin.login')}}" class="btn btn-block btn-primary mt-2">{{__('labels.login')}}</a>
                        </div>
                    </div>
                </div>
                <!-- standard plan -->
                <div class="col-12 col-md-4">
                    <div class="card standard-pricing popular text-center">

                        <div class="card-body">

                            <i class="feather" data-feather='codepen'></i>
                            <h3>{{__('messages.connect_as_partner')}}</h3>

                            <a  href="{{route('partner.login')}}" class="btn btn-block btn-primary mt-2">{{__('labels.login')}}</a>
                        </div>
                    </div>
                </div>
                <!-- standard plan -->
                <div class="col-12 col-md-4">
                    <div class="card standard-pricing popular text-center">

                        <div class="card-body">

                            <i  class="feather" data-feather='users'></i>
                            <h3 >{{__('messages.connect_as_user')}}</h3>

                            <a href="{{route('login')}}" class="btn btn-block btn-primary mt-2">{{__('labels.login')}}</a>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>
    <!--/ pricing plan cards -->



</section>

@endsection
