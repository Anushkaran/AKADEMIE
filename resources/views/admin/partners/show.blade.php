@extends('admin.layouts.app')

@push('css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">
    <style>
        .user-wide{
            width: 25rem!important;
        }
    </style>

@endpush

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('actions.details')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('admin.partners.index')}}">
                                            {{__('labels.list',['name' => trans_choice('labels.partner',2)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('actions.details')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    {{--                    <div class="form-group breadcrumb-right">--}}
                    {{--                        <div class="dropdown">--}}
                    {{--                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>--}}
                    {{--                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="javascript:void(0);"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <div class="content-body">
                <section class="app-user-view">
                    <!-- User Card & Plan Starts -->
                    <div class="row">
                        <!-- User Card starts-->
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-xl-12 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-avatar-section">
                                                <div class="d-flex justify-content-start">
{{--                                                    <img class="img-fluid rounded" src="{{$partner->image_url}}" height="104" width="104" alt="User avatar" />--}}
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="user-info mb-1">
                                                            <h4 class="mb-0">{{$partner->name}}</h4>
                                                            <span class="card-text">{{$partner->email}}</span>
                                                        </div>
                                                        <div class="d-flex flex-wrap">
                                                            <a href="{{route('admin.partners.edit',$partner->id)}}" class="btn btn-primary">{{__('actions.edit')}}</a>
                                                            <a href="{{route('admin.partners.password.edit',$partner->id)}}" class="mx-2 btn btn-primary">{{__('actions.edit-password')}}</a>

                                                            <button onclick="deleteForm({{$partner->id}})" class="btn btn-outline-danger ml-1">{{__('actions.delete')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 mt-2 ">
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title user-wide">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.name')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->name}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title user-wide">
                                                        <i data-feather="mail" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.email')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->email}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title user-wide">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.phone')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->phone}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title user-wide">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.department')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->department}}</p>
                                                </div>


                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title user-wide">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->created_at->format('d-m-Y')}}</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">

                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row my-auto">

                                        <div class="col-xl-12 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-avatar-section">
                                                <div class="d-flex justify-content-start">
                                                    {{--                                                    <img class="img-fluid rounded" src="{{$partner->image_url}}" height="104" width="104" alt="User avatar" />--}}
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="user-info mb-1">
                                                            <h4 class="mb-0">Contact</h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 mt-2 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-info-wrapper">
                                                <div class="card user-card border-2 bg-gradient-danger">
                                                    <div class="card-body">
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.leader')}}</span>

                                                        <div class="d-flex flex-wrap my-50">
                                                            <div class="">
                                                                <i data-feather="user-plus" class="mr-1"></i>
                                                            </div>
                                                            <p class="card-text mb-0">{{$partner->leader}}</p>
                                                        </div>
                                                        <div class="d-flex flex-wrap my-50">
                                                            <div class="">
                                                                <i data-feather="phone" class="mr-1"></i>
                                                            </div>
                                                            <p class="card-text mb-0">{{$partner->leader_phone}}</p>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card user-card border-2 bg-gradient-info">
                                                    <div class="card-body">
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">
                                                            {{__('labels.legal_referent')}}
                                                        </span>



                                                <div class="d-flex flex-wrap">
                                                    <div class="">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0"></span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->legal_referent}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0"></span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->legal_referent_phone}}</p>
                                                </div>
                                                    </div>
                                                </div>
                                                <div class="card user-card border-2 bg-gradient-success">
                                                    <div class="card-body">
                                                        <span class="card-text user-info-title user-wide font-weight-bold mb-0">{{__('labels.administrative_referent')}}</span>

                                                        <div class="d-flex flex-wrap my-50">
                                                    <div class="">
                                                        <i data-feather="user-plus" class="mr-1"></i>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->administrative_referent}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                    </div>
                                                    <p class="card-text mb-0">{{$partner->administrative_referent_phone}}</p>

                                                </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /User Card Ends-->

                    </div>
                    <!-- User Card & Plan Ends -->


                </section>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        const deleteForm = id => {
            Swal.fire({
                title: '{{__('actions.delete_confirm_title')}}',
                text: "{{__('actions.delete_confirm_text')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{__('actions.delete_btn_yes')}}',
                cancelButtonText: '{{__('actions.delete_btn_cancel')}}'
            }).then((result) => {
                if (result.value) {
                    let f = document.createElement("form");
                    f.setAttribute('method',"post");
                    f.setAttribute('action',`/admin/partners/${id}`);

                    let i1 = document.createElement("input"); //input element, text
                    i1.setAttribute('type',"hidden");
                    i1.setAttribute('name','_token');
                    i1.setAttribute('value','{{csrf_token()}}');

                    let i2 = document.createElement("input"); //input element, text
                    i2.setAttribute('type',"hidden");
                    i2.setAttribute('name','_method');
                    i2.setAttribute('value','DELETE');

                    f.appendChild(i1);
                    f.appendChild(i2);
                    document.body.appendChild(f);
                    f.submit()
                }
            });
        }
    </script>

@endpush
