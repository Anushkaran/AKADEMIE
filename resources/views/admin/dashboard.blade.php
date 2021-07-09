@extends('admin.layouts.app')


@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Home</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active">Index
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <!-- Kick start -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">#Akademie 🚀</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <p>
                                une application permettant de gérer
                                les formations dispensées aux collaborateurs et de piloter
                                les compétences et les ressources .                             </p>
                        </div>
                    </div>
                </div>
                <!--/ Kick start -->


            </div>
        </div>
    </div>
@endsection
