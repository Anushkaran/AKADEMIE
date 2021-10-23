@extends('partner.layouts.auth-app')

@section('title',__('labels.login'))

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v2">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                            <a class="brand-logo" href="javascript:void(0);">
                                <img  width="20%" src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}"/>

                            </a>

                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('assets/vuexy/app-assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">{{__('messages.welcome_to',['name' => config('app.name')])}}</h2>
                                <p class="card-text mb-2">
                                    {{__('messages.login_message')}}
                                </p>
                                @if(session()->has('error'))
                                <div class="alert alert-danger">
                                    <p class="alert-body">
                                        {{session('error')}}
                                    </p>
                                </div>
                                @endif
                                <form class="auth-login-form mt-2" action="{{route('partner.login')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="login-email">{{__('labels.email')}}</label>
                                        <input class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="login-email" type="email" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">{{__('labels.password')}}</label><a href="{{route('partner.forgot.password.email')}}"><small>{{__('messages.forgot_password')}}</small></a>
                                        </div>
                                        <div class="input-group input-group-merge @error('password') is-invalid @enderror form-password-toggle">
                                            <input class="form-control @error('password') error @enderror   form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />

                                            <div class="input-group-append error"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>

                                        </div>
                                        @error('password')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" value="on" id="remember-me" type="checkbox" tabindex="3" name="remember_me" />
                                            <label class="custom-control-label" for="remember-me"> {{__('labels.remember_me')}}</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="4">{{__('labels.login')}}</button>
                                </form>
                                <div class="divider my-2">
                                    <div class="divider-text"><small>{{__('messages.forgot_password')}}</small></div>
                                </div>
                                <a href="{{route('partner.forgot.password.email')}}"><small>{{__('messages.reset_password_text')}} </small></a>                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
