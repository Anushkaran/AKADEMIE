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
                <div class="row">

                    <iframe id="viewer" src="http://www.africau.edu/images/default/sample.pdf" height="100%" width="100%"></iframe>
                </div>
            </div>
        </div>






    </div>


@endsection
