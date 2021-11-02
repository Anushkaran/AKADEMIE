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
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('labels.dashboard')}}</a>
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
                            <form action="">
                                <div class="input-group input-group-merge shadow-none m-0 flex-grow-1">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text border-0">
                                                <i data-feather="search"></i>
                                            </span>
                                    </div>
                                    <input type="text" name="search" value="{{request('search')}}" class="form-control files-filter border-0 bg-accent-1" placeholder="Search" />
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- search area ends here -->
                </div>
                <div class="card">

                    <div class="row mx-1 my-4">
                        @foreach($resources as $key => $resource)

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card shadow-none border cursor-pointer">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        @if($resource->type === 1)
                                            <i class="fa-solid fa-file-pdf text-danger fa-10x"></i>
                                        @else
                                            <i class="fa-solid fa-file-word text-info fa-10x"></i>
                                        @endif
                                        <div class="dropdown-items-wrapper">
                                            <i data-feather="more-vertical" id="dropdownMenuLink1" role="button" data-toggle="dropdown" aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink1">
                                                @if($resource->access === 2)
                                                    <a class="dropdown-item" href="{{route('resources.fileDownload',$resource->id)}}">
                                                        <i data-feather="download" class="mr-25"></i>
                                                        <span class="align-middle">Telecharger</span>

                                                    </a>
                                                @endif

                                                @if($resource->access === 1 || $resource->type === 1)
                                                    <a class="dropdown-item" href="{{route('resources.preview',$resource->id)}}">
                                                        <i data-feather="eye" class="mr-25"></i>
                                                        <span class="align-middle">Consulter</span>

                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-1">
                                        <h5>{{$resource->name}}</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-50">

                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>                             <!-- drives area ends-->
                                            <!-- /Files Container Ends -->
            </div>
        </div>

@endsection
