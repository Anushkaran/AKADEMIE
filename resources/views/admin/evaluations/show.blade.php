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
                                    <li class="breadcrumb-item"><a href="{{route('admin.evaluations.index')}}">{{__('labels.list',['name' => trans_choice('labels.evaluation',2)])}}</a>
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
                        <div class="col-xl-4 col-lg-4 col-md-4">
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
                                                            <a href="{{route('admin.evaluations.edit',$ev->id)}}" class="btn btn-primary ml-1">{{__('actions.edit')}}</a>
                                                            <button onclick="deleteForm({{$ev->id}})" class="btn btn-outline-danger ml-1">{{__('actions.delete')}}</button>
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
                                                    <p class="card-text mb-0">{{$ev->name}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.end_date')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$ev->start_date->format('d-m-Y')}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.start_date')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$ev->end_date->format('d-m-Y')}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$ev->created_at->format('d-m-Y')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /User Card Ends-->
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">
                                        <button class="dt-button create-new btn btn-primary" tabindex="0"
                                                aria-controls="DataTables_Table_0"
                                                type="button" data-toggle="modal" id="create-btn"
                                                data-target="#modals-slide-in">
                                            <i data-feather='plus'></i>
                                            {{__('actions.add-new',['name' => trans_choice('labels.student',1)])}}
                                        </button>
                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#success">
                                            Success
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade text-left modal-success" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel110">Success Modal</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Tart lemon drops macaroon oat cake chocolate toffee chocolate bar icing. Pudding jelly beans
                                                        carrot cake pastry gummies cheesecake lollipop. I love cookie lollipop cake I love sweet gummi
                                                        bears cupcake dessert.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Accept</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    {{--                                filters--}}
                                </div>
                                <div class="table-responsive">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('labels.name')}}</th>
                                            <th>{{__('labels.phone')}}</th>
                                            <th>{{__('labels.email')}}</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Jhon Do</td>
                                            <td>123456789</td>
                                            <td>student@email.com</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i data-feather="trash"></i>
                                                </button>
                                            </td>
                                        </tr>
{{--                                        @foreach($evaluations as $key => $e)--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    {{$key + 1}}--}}
{{--                                                </td>--}}
{{--                                                <td>{{$e->name}}</td>--}}
{{--                                                <td>--}}
{{--                                                    {{$e->start_date->format('d-m-Y')}}--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    {{$e->end_date->format('d-m-Y')}}--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    {{$e->created_at->format('d-m-Y')}}--}}
{{--                                                </td>--}}
{{--                                                <td>--}}
{{--                                                    @if($count < 3)--}}
{{--                                                        <a href="{{route('admin.evaluations.edit',$e->id)}}" class="btn btn-sm btn-outline-warning">--}}
{{--                                                            <i data-feather="edit"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <a href="{{route('admin.evaluations.show',$e->id)}}" class="btn btn-sm btn-outline-warning">--}}
{{--                                                            <i data-feather="eye"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <a href="javascript:void(0)" onclick="deleteForm({{$e->id}})" class="btn btn-sm btn-outline-warning">--}}
{{--                                                            <i data-feather="trash"></i>--}}
{{--                                                        </a>--}}
{{--                                                    @else--}}
{{--                                                        <div class="dropdown">--}}
{{--                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">--}}
{{--                                                                <i data-feather="more-vertical"></i>--}}
{{--                                                            </button>--}}
{{--                                                            <div class="dropdown-menu">--}}
{{--                                                                <a class="dropdown-item" href="{{route('admin.evaluations.edit',$e->id)}}">--}}
{{--                                                                    <i data-feather="edit-2" class="mr-50"></i>--}}
{{--                                                                    <span>{{__('actions.edit')}}</span>--}}
{{--                                                                </a>--}}
{{--                                                                <a class="dropdown-item" href="{{route('admin.evaluations.show',$e->id)}}">--}}
{{--                                                                    <i data-feather="eye" class="mr-50"></i>--}}
{{--                                                                    <span>{{__('actions.details')}}</span>--}}
{{--                                                                </a>--}}
{{--                                                                <a class="dropdown-item" href="javascript:void(0);" onclick="deleteForm({{$e->id}})">--}}
{{--                                                                    <i data-feather="trash" class="mr-50"></i>--}}
{{--                                                                    <span>{{__('actions.delete')}}</span>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    @endif--}}

{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-center">
{{--                                    {{$evaluations->links()}}--}}
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
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->

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
                    f.setAttribute('action',`/admin/evaluations/${id}`);

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
