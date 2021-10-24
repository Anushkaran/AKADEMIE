@extends('user.layouts.auth-app')

@section('title',__('messages.forgot_password'))

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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('assets/vuexy/app-assets/images/pages/forgot-password-v2.svg')}}" alt="Forgot password " /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Forgot password-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                @if(session('status'))
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">{{__('labels.success')}}</h4>
                                        <div class="alert-body">
                                            {{session('status')}}.
                                        </div>
                                    </div>
                                @endif

                                <h2 class="card-title font-weight-bold mb-1">{{__('messages.forgot_password')}} 🔒</h2>
                                <p class="card-text mb-2">{{__('messages.reset_message')}}</p>
                                <form class="auth-forgot-password-form mt-2" action="{{route('forgot.password.send')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label" for="forgot-password-email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" id="forgot-password-email" type="email" name="email" placeholder="john@example.com" aria-describedby="forgot-password-email" autofocus="" tabindex="1" />
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="2">{{__('labels.send_reset_link')}}</button>
                                </form>
                                <p class="text-center mt-2">
                                    <a href="{{route('login.index')}}">
                                        <i data-feather="chevron-left"></i>
                                    {{__('labels.back-to',['name' => __('labels.login')])}}
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Forgot password-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
