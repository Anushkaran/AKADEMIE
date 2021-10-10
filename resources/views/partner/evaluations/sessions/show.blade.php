@extends('partner.layouts.app')

@push('css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vuexy/app-assets/vendors/css/forms/select/select2.min.css')}}">

    @stack('tab-css')
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
                                    <li class="breadcrumb-item"><a href="{{route('partner.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('partner.evaluations.index')}}">{{__('labels.list',['name' => trans_choice('labels.evaluation',2)])}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('partner.evaluations.sessions.index',$session->evaluation_id)}}">{{__('labels.list',['name' => trans_choice('labels.evaluation-session',2)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('actions.details')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
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
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="d-flex flex-wrap">
                                                            @if(url()->previous() !== request()->url())
                                                                <a href="{{url()->previous()}}" class="btn btn-outline-danger">
                                                                    <i data-feather='arrow-left'></i>
                                                                </a>
                                                            @endif

                                                            <button onclick="deleteForm({{$session->evaluation_id,$session->id}})" class="btn btn-outline-danger ml-1">{{__('actions.delete')}}</button>
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
                                                    <p class="card-text mb-0">{{$session->name}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.date')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$session->date->format('d/m/Y')}}</p>

                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$session->created_at->format('d-m-Y')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="card user-card">
                                <div class="card-header">
                                    <h4 class="card-title">

                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#success">
                                            <i data-feather='plus'></i>
                                            {{trans_choice('actions.add-new',2,['name' => trans_choice('labels.skill',1)])}}
                                        </button>
                                        <!-- Modal -->

                                    </h4>
                                    <div class="modal fade text-left modal-success" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel110">{{trans_choice('actions.add-new',2,['name' => trans_choice('labels.skill',1)])}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('partner.evaluations.sessions.users.attach',['evaluation' => $session->evaluation_id , 'session' => $session->id])}}" id="attach-users-form" method="post">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="users">{{trans_choice('labels.user',3)}}</label>
                                                            <select
                                                                name="users[]" multiple
                                                                id="users" class="select2 form-control">

                                                            </select>

                                                        </div>
                                                    </form>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"  class="btn btn-success" onclick="document.getElementById('attach-users-form').submit()" id="user-attach-btn">
                                                        {{__('actions.save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>{{__('labels.pic')}}</th>
                                            <th>{{__('labels.name')}}</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($session->users as $key => $user)
                                            <tr>

                                                <td>
                                                <span class="avatar">
                                                    <img width="60" class="round " height="60" src="{{$user->image_url}}" alt="{{$user->name}} image">

                                                </span>
                                                </td>
                                                <td>{{$user->name}}</td>


                                                <td>

                                                    <a href="javascript:void(0)" onclick="detachUser({{$user->id}})" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        {{trans_choice('labels.detail',2)}}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /User Card Ends-->
                        <div class="col-8">

                        </div>
                    </div>
                    <!-- User Card & Plan Ends -->
                </section>
            </div>

        </div>
    </div>


@endsection


@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                cache:true,
                ajax: {
                    delay: 250,
                    url: '{{route('partner.users.index')}}',
                    dataType: 'json',
                    data: function (params) {

                        // Query parameters will be ?search=[term]&page=[page]
                        if (params.term && params.term.length > 3)
                        {
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        }

                    },
                    processResults: function ({users}, params) {
                        params.page = params.page || 1;
                        let fData = $.map(users.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < users.total
                            }
                        };
                    }
                }
            });
        });


        const detachUser = id => {
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
                    f.setAttribute('action',`/partner/evaluations/{{$session->evaluation_id}}/sessions/{{$session->id}}/users/${id}`);
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
    @stack('tab-js')
@endpush
