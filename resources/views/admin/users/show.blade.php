@extends('admin.layouts.app')

@push('css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">

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
                                    <li class="breadcrumb-item"><a href="{{route('admin.admins.index')}}">
                                            {{__('labels.list',['name' => trans_choice('labels.user',2)])}}</a>
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
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-avatar-section">
                                                <div class="d-flex justify-content-start">
                                                    <img class="img-fluid rounded" src="{{$user->image_url}}" height="104" width="104" alt="User avatar" />
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="user-info mb-1">
                                                            <h4 class="mb-0">{{$user->name}}</h4>
                                                            <span class="card-text">{{$user->email}}</span>
                                                        </div>
                                                        <div class="d-flex flex-wrap">
                                                            <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-primary">{{__('actions.edit')}}</a>
                                                            <a href="{{route('admin.users.password.edit',$user->id)}}" class="mx-2 btn btn-primary">{{__('actions.edit-password')}}</a>
                                                            <button onclick="deleteForm({{$user->id}})" class="btn btn-outline-danger ml-1">{{__('actions.delete')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 mt-2 ">
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.name')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$user->name}}</p>
                                                </div>


                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="mail" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.email')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$user->email}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.phone')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$user->phone}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.organism')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$user->organization}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.user_type')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{__('labels.user_types.'.$user->type)}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.department')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$user->department}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{trans_choice('labels.thematic',3)}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">
                                                        @foreach($user->thematics as $th)

                                                            <span class="badge badge-info">
                                                                {{$th->name}}
                                                            </span>
                                                        @endforeach
                                                    </p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="flag" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$user->created_at->format("d-m-Y")}}</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /User Card Ends-->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                    </h4>
                                </div>
                                <div class="card-body">

{{--                                    <div class=" search-input">--}}
{{--                                        <form>--}}
{{--                                            <div class="row">--}}
{{--                                                <input class="form-control input col-6"  name="search" type="text" placeholder="{{__('labels.search')}}" tabindex="0" data-search="search">--}}

{{--                                                <button  type="submit" class="btn btn-primary mr-1 col-2"><i data-feather="search"></i></button>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}

                                </div>
                                <div class="table-responsive">
                                    @php
                                        /** @var \Illuminate\Database\Eloquent\Collection $evaluations */
                                        $count = $evaluations->count();
                                    @endphp
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('labels.name')}}</th>
                                            <th>{{trans_choice('labels.partner',1)}}</th>
                                            <th>{{trans_choice('labels.center',1)}}</th>

                                            <th>{{__('labels.state')}}</th>
                                            <th>{{__('labels.start_date')}}</th>
                                            <th>{{__('labels.end_date')}}</th>
                                            <th>{{__('labels.date_exam')}}</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($evaluations as $key => $e)
                                            <tr>
                                                <td>
                                                    {{$key + 1}}
                                                </td>
                                                <td>{{$e->name}}</td>
                                                <td>
                                                    <strong>
                                                        <a href="{{route('admin.partners.show',$e->partner_id)}}" class="text-decoration-none">
                                                            <i data-feather="arrow-up-right"></i>
                                                            {{$e->partner->name}}
                                                        </a>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <strong>
                                                        <a href="{{route('admin.centers.show',$e->center_id)}}" class="text-decoration-none">
                                                            <i data-feather="arrow-up-right"></i>
                                                            {{$e->center->name}}
                                                        </a>
                                                    </strong>
                                                </td>
                                                <td>
                                                    @if($e->state)
                                                        <span class="badge badge-success">{{__('labels.active')}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{__('labels.inactive')}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$e->start_date->format('d-m-Y')}}
                                                </td>
                                                <td>
                                                    {{$e->end_date->format('d-m-Y')}}
                                                </td>
                                                <td>
                                                    {{$e->date_exam->format('d-m-Y')}}
                                                </td>
                                                <td>
                                                    @if($count < 3)

                                                        <a href="{{route('admin.evaluations.sessions.index',$e->id)}}" class="btn btn-sm btn-outline-warning">
                                                            <i data-feather="eye"></i>
                                                        </a>

                                                    @else
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">

                                                                <a class="dropdown-item" href="{{route('admin.evaluations.sessions.index',$e->id)}}">
                                                                    <i data-feather="eye" class="mr-50"></i>
                                                                    <span>{{__('actions.details')}}</span>
                                                                </a>

                                                            </div>
                                                        </div>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{$evaluations->links()}}
                                </div>
                            </div>
                        </div>
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
                    f.setAttribute('action',`/admin/users/${id}`);

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
