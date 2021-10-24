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
                            <h2 class="content-header-title float-left mb-0">{{__('labels.dashboard')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Accueil</a>
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
                        <h4 class="card-title">{{__('messages.welcome_to',['name' => config('app.name')])}}</h4>
                    </div>
                </div>
                    <!-- Dashboard Analytics Start -->
                    <section id="dashboard-analytics">
                        <div class="row match-height">
                            <!-- Greetings Card starts -->
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="card card-congratulations">
                                    <div class="card-body text-center">
                                        <img src="{{@asset('assets/vuexy/app-assets/images/elements/decore-left.png')}}" class="congratulations-img-left" alt="card-img-left" />
                                        <img src="{{@asset('assets/vuexy/app-assets/images/elements/decore-right.png')}}" class="congratulations-img-right" alt="card-img-right" />
                                        <div class="avatar avatar-xl bg-primary shadow">
                                            <div class="avatar-content">
                                                <i data-feather="award" class="font-large-1"></i>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <h1 class="mb-1 text-white">{{__('messages.welcome_to',['name' => config('app.name')])}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Greetings Card ends -->

                            <!-- Subscribers Chart Card starts -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start pb-0">
                                        <div class="avatar bg-light-primary p-50 m-0">
                                            <div class="avatar-content">
                                                <i data-feather="users" class="font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="font-weight-bolder mt-1">{{$students_count}}</h2>
                                        <p class="card-text">Etudiants</p>
                                    </div>
                                    <div id="gained-chart"></div>
                                </div>
                            </div>
                            <!-- Subscribers Chart Card ends -->

                            <!-- Orders Chart Card starts -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start pb-0">
                                        <div class="avatar bg-light-warning p-50 m-0">
                                            <div class="avatar-content">
                                                <i data-feather="package" class="font-medium-5"></i>
                                            </div>
                                        </div>
                                        <h2 class="font-weight-bolder mt-1">{{$sessions_count}}</h2>
                                        <p class="card-text">sessions</p>
                                    </div>
                                    <div id="order-chart"></div>
                                </div>
                            </div>
                            <!-- Orders Chart Card ends -->
                        </div>

                        <div class="row match-height">
                            <!-- Avg Sessions Chart Card starts -->
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row pb-50">
                                            <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                                <div class="mb-1 mb-sm-0">
                                                    <h2 class="font-weight-bolder mb-25">{{$new_students}}</h2>
                                                    <p class="card-text font-weight-bold mb-2">Nouveaux Etudiants</p>
                                                    <div class="font-medium-2">

                                                        @if($students_count !=0 &&$new_students!=0)
                                                            <span class="text-success mr-25">+{{$new_students/$students_count*100}}%</span>
                                                        @else
                                                            <span class="text-success mr-25">+ --%</span>
                                                        @endif
                                                            <span>par rapport au nombre total d'étudiants</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-right order-sm-2 order-1">

                                                <div id="avg-sessions-chart"></div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row avg-sessions pt-50">
                                            <div class="col-6 mb-2">
                                                <p class="mb-50">{{$sessions_count}} Session terminé</p>
                                                <div class="progress progress-bar-primary" style="height: 6px">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="60" aria-valuemax="100" style="width: 50%"></div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <p class="mb-50">{{$new_students}} Nouveaux Etudiants</p>
                                                <div class="progress progress-bar-warning" style="height: 6px">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$new_students}}" aria-valuemin="0" aria-valuemax="{{$students_count}}" style="width:
                                                    @if($students_count !=0 &&$new_students!=0)
                                                    {{$new_students/$students_count*100}}%
                                                    @else
                                                    0%
                                                    @endif

                                                        "></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-50">{{$users_count}} enseignants</p>
                                                <div class="progress progress-bar-danger" style="height: 6px">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$users_count}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$users_count}}%"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-50">{{$centers_count}} Centres</p>
                                                <div class="progress progress-bar-success" style="height: 6px">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{{$centers_count}}" aria-valuemin="0" aria-valuemax="{{$centers_count}}" style="width:
                                                    {{$centers_count*100}}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Avg Sessions Chart Card ends -->

                            <!-- Support Tracker Chart Card starts -->
                            <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between pb-0">
                                        <h4 class="card-title">Partenaires</h4>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-2 col-12 d-flex flex-column flex-wrap text-center">
                                                <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">{{$partner_count}}</h1>
                                                <p class="card-text">Partenaire</p>
                                            </div>
                                            <div class="col-sm-10 col-12 d-flex justify-content-center">
                                                <div id="support-trackers-chart"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-1">
                                            <div class="text-center">
                                                <p class="card-text mb-50">Nouveaux Centres</p>
                                                <span class="font-large-1 font-weight-bold">{{$centers_count}}</span>
                                            </div>
                                            <div class="text-center">
                                                <p class="card-text mb-50">Centres Actifs</p>
                                                <span class="font-large-1 font-weight-bold">{{$centers_count}}</span>
                                            </div>
                                            <div class="text-center">
                                                <p class="card-text mb-50">Sessions de la semaine </p>
                                                <span class="font-large-1 font-weight-bold">{{$week_sessions}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Support Tracker Chart Card ends -->
                        </div>

                        <div class="row match-height">




                        </div>

                        <!-- List DataTable -->
                        <!--/ List DataTable -->
                    </section>
                    <!-- Dashboard Analytics end -->

                </div>
                <!--/ Kick start -->


            </div>
        </div>
@endsection
