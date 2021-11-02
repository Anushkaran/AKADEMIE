@extends('user.layouts.app')

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
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestionnaire de fichiers
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="card">
                    <!-- search area start -->
                    <div class="file-manager-content-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-toggle d-block d-xl-none float-left align-middle ml-1">
                                <i data-feather="menu" class="font-medium-5"></i>
                            </div>
                            <div class="input-group input-group-merge shadow-none m-0 flex-grow-1">
                                <div class="input-group-prepend">
                                            <span class="input-group-text border-0">
                                                <i data-feather="search"></i>
                                            </span>
                                </div>
                                <input type="text" class="form-control files-filter border-0 bg-accent-1" placeholder="Search" />
                            </div>
                        </div>

                    </div>
                    <!-- search area ends here -->
                </div>
                <div class="card">

                                                <div class="row mx-1 my-4">

                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="card shadow-none border cursor-pointer">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <i class="fa-solid fa-file-word fa-7x text-info"></i>
                                                                    <div class="dropdown-items-wrapper">
                                                                        <i data-feather="more-vertical" id="dropdownMenuLink1" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1">
                                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                                <i data-feather="download" class="mr-25"></i>
                                                                                <span class="align-middle">Telecharger</span>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="my-1">
                                                                    <h5>FORMATEURS.DOCX</h5>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="card shadow-none border cursor-pointer">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <i class="fa-solid fa-file-pdf text-danger fa-7x"></i>
                                                                    <div class="dropdown-items-wrapper">
                                                                        <i data-feather="more-vertical" id="dropdownMenuLink1" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1">
                                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                                <i data-feather="download" class="mr-25"></i>
                                                                                <span class="align-middle">Telecharger</span>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="my-1">
                                                                    <h5>FORMULAIRE.PDF</h5>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="card shadow-none border cursor-pointer">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <i class="fa-solid fa-file-powerpoint text-warning fa-7x"></i>
                                                                    <div class="dropdown-items-wrapper">
                                                                        <i data-feather="more-vertical" id="dropdownMenuLink1" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1">
                                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                                <i data-feather="download" class="mr-25"></i>
                                                                                <span class="align-middle">Telecharger</span>

                                                                            </a>
                                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                                <i data-feather="eye" class="mr-25"></i>
                                                                                <span class="align-middle">Consulter</span>

                                                                            </a>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="my-1">
                                                                    <h5>COMPETENCES A EVALUER.PPTX</h5>
                                                                </div>
                                                                <div class="d-flex justify-content-between mb-50">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-12">
                                                        <div class="card shadow-none border cursor-pointer">
                                                            <div class="card-body">
                                                                <div class="d-flex justify-content-between">
                                                                    <i class="fa-solid fa-file-powerpoint text-warning fa-7x"></i>
                                                                    <div class="dropdown-items-wrapper">
                                                                        <i data-feather="more-vertical" id="dropdownMenuLink1" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1">
                                                                            <a class="dropdown-item" href="javascript:void(0)">
                                                                                <i data-feather="download" class="mr-25"></i>
                                                                                <span class="align-middle">Telecharger</span>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="my-1">
                                                                    <h5>Liste de missions.ppt</h5>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                </div>
            </div>                             <!-- drives area ends-->
                                            <!-- /Files Container Ends -->
            </div>
        </div>

@endsection
