@extends('partner.layouts.app')

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('partner.dashboard')}}">accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active">Statistiques
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
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
                                        <h1 class="mb-1 text-white">Bienvenue Au Panneau d'administration Collaborateurs lakadémie,</h1>
                                        <p class="card-text m-auto w-75">
                                            @if($sessions_count !=0 &&$week_sessions!=0)
                                            <strong>{{round($sessions_count/$week_sessions*100)}}%</strong>
                                            @else
                                                <strong>--%</strong>
                                            @endif
                                                des sessions se derouleront pendant cette semaine .

                                        </p>

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
                                    <h2 class="font-weight-bolder mt-1">{{$new_students}}</h2>
                                    <p class="card-text">Nouveaux Etudiants</p>
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
                                    <p class="card-text">Nouvelles session</p>
                                </div>
                                <div id="order-chart"></div>
                            </div>
                        </div>
                        <!-- Orders Chart Card ends -->
                    </div>

                    <div class="row match-height">
                        <!-- Avg Sessions Chart Card starts -->
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row pb-50">
                                        <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                            <div class="mb-1 mb-sm-0">
                                                <h2 class="font-weight-bolder mb-25">{{$new_students}}</h2>
                                                <p class="card-text font-weight-bold mb-2">Nouveaux Etudiants</p>
                                                <div class="font-medium-2">
                                                    <span class="text-success mr-25">+
                                                        @if($students_count !=0 &&$new_students!=0)
                                                            {{round($students_count/$new_students*100)}}%
                                                        @else
                                                        --%
                                                        @endif
                                                            </span>
                                                    <span>par rapport aux 7 derniers Jours</span>
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
                                            <p class="mb-50">{{$sessions_count}} Sessions </p>
                                            <div class="progress progress-bar-primary" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="60" aria-valuemax="100" style="width: {{$sessions_count*100}}%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <p class="mb-50">{{$students_count}} Etudiants</p>
                                            <div class="progress progress-bar-warning" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="120" aria-valuemin="120" aria-valuemax="{{$students_count}}" style="width: {{$students_count*100}}%"></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-50">{{round($sessions_count/$week_sessions*100)}}  % sessions par rapport au total se déroulerons cette semaine</p>
                                             </p>
                                            <div class="progress progress-bar-danger" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$week_sessions}}" aria-valuemin="0" aria-valuemax="{{$sessions_count}}" style="width:
                                                @if($sessions_count !=0 &&$week_sessions!=0)
                                                {{round($sessions_count/$week_sessions*100)}}%
                                                @else
                                                0
                                                @endif
                                                    "></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-50">{{$new_students}} Nouveaux Etudiants</p>
                                            <div class="progress progress-bar-success" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="{{$new_students}}" aria-valuemin="0" aria-valuemax="{{$students_count}}" style="width: {{$new_students*100}}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Avg Sessions Chart Card ends -->

                        <!-- Support Tracker Chart Card starts -->
                        <!-- Support Tracker Chart Card ends -->
                    </div>

                    <div class="row match-height">




                    </div>

                    <!-- List DataTable -->
                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->


            </div>
        </div>
    </div>

@endsection
