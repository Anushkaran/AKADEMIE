@extends('admin.layouts.app')
@push('css')

    <link rel="stylesheet" href="{{asset('assets/vuexy/app-assets/vendors/css/forms/select/select2.min.css')}}">

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
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name' => trans_choice('labels.user',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('labels.list',['name' => trans_choice('labels.user',2)])}}
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
                <!-- Kick start -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a href="{{route('admin.users.create')}}" class="dt-button create-new btn btn-primary" tabindex="0"
                                             id="create-btn">
                                        <i data-feather='plus'></i>
                                        {{trans_choice('actions.add-new',1,['name' => trans_choice('labels.user',1)])}}
                                    </a>

                                </h4>
                            </div>
                            <div class="card-body">

                                <div class=" search-input row">
                                    <form class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control input"  name="search" type="text" placeholder="{{__('labels.search')}}" tabindex="0" data-search="search">

                                        </div>
                                        <div class="form-group">
                                            <label for="partners-filter"> {{trans_choice('labels.partner',1)}}</label>
                                            <select name="partner_id" id="partners-filter">
                                                @isset($partner)
                                                    <option value="{{$partner->id}}" selected>{{$partner->name}}</option>
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="state"> {{__('labels.account_state')}}</label>
                                            <select name="state" id="state" class="form-control">
                                                <option value="all" disabled selected>...</option>
                                                @foreach(config('settings.account_states') as $state)
                                                    <option value="{{$state}}" @if((int)request('state') === $state) selected @endif>{{__('labels.account_states'.$state)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">

                                            <button  type="submit" class="btn btn-primary mr-1 col-2"><i data-feather="search"></i></button>
                                            <a  href="{{route('admin.users.index')}}" class="btn btn-primary mr-1 col-2">{{__('actions.clear')}}</a>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="table-responsive">
                                @php
                                    /** @var \Illuminate\Database\Eloquent\Collection $users */
                                    $count = $users->count();
                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{__('labels.pic')}}</th>
                                        <th>{{trans_choice('labels.user',1)}}</th>
                                        <th>{{__('labels.account_state')}}</th>
                                        <th>{{__('labels.last_item',['name' => trans_choice('labels.evaluation-session',1)])}}</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $key => $user)
                                        <tr>

                                            <td>
                                                <span class="avatar">
                                                    <img width="60" class="round " height="60" src="{{$user->image_url}}" alt="{{$user->name}} image">

                                                </span>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>{{$user->name}}</li>
                                                    <li>
                                                        <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                                    </li>
                                                    <li>
                                                        <a href="tel:{{$user->phone}}">{{$user->phone}}}</a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>
                                                @if($user->isActive())
                                                    <span class="badge badge-success">{{__('labels.account_states.'.$user->state)}}</span>

                                                @else

                                                    <span class="badge badge-danger">{{__('labels.account_states.'.$user->state)}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach($user->evaluationSessions as $session)
                                                        <li>
                                                            <span>{{trans_choice('labels.evaluation-session',1)}}: </span>
                                                            <a href="{{route('admin.evaluations.sessions.show',['evaluation' => $session->evaluation_id,'session' => $session->id])}}">{{$session->name}}</a>
                                                        </li>
                                                        <li>
                                                            <span>{{trans_choice('labels.evaluation',1)}}: </span>
                                                            <a href="{{route('admin.evaluations.sessions.index',$session->evaluation_id)}}">{{$session->evaluation->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                            </td>

                                            <td>
                                                @if($count < 3)
                                                    <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.users.show',$user->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="deleteForm({{$user->id}})" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="trash"></i>
                                                    </a>
                                                @else
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('admin.users.edit',$user->id)}}">
                                                                <i data-feather="edit-2" class="mr-50"></i>
                                                                <span>{{__('actions.edit')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('admin.users.show',$user->id)}}">
                                                                <i data-feather="eye" class="mr-50"></i>
                                                                <span>{{__('actions.details')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="deleteForm({{$user->id}})">
                                                                <i data-feather="trash" class="mr-50"></i>
                                                                <span>{{__('actions.delete')}}</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{$users->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <script>
        @if($errors->any())
        document.getElementById('create-btn').click();
        @endif
        $(document).ready(function() {
            $('#state').select2();
            $('#partners-filter').select2({
                cache:true,
                ajax: {
                    delay: 250,
                    url: '{{route('admin.partners.index')}}',
                    dataType: 'json',
                    data: function (params) {

                        // Query parameters will be ?search=[term]&page=[page]
                        return {
                            search: params.term,
                            page: params.page || 1
                        };

                    },
                    processResults: function ({partners}, params) {
                        params.page = params.page || 1;

                        let fData = $.map(partners.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < partners.total
                            }
                        };
                    }
                }
            });
        });
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
