@extends('user.layouts.app')
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
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('labels.dashboard')}}</a>
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


                                </h4>
                            </div>
                            <div class="card-body">

                            </div>
                            <div class="table-responsive">
                                @php
                                    /** @var Collection $sessions */
                                    use Illuminate\Database\Eloquent\Collection;$count = $sessions->count();
                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
{{--                                        <th>#</th>--}}
                                        <th>{{__('labels.name')}}</th>
                                        <th>{{trans_choice('labels.evaluation',1)}}</th>
                                        <th>{{__('labels.nb_of',['name'=>trait_exists('student',3)])}}</th>


                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sessions as $key => $session)
                                        <tr>

                                            <td>{{$session->name}}</td>
                                            <td>{{$session->evaluation->name}}</td>

                                            <td><span class="badge badge-info">{{$session->evaluation->students_count}}</span></td>

                                            <td>
                                                <a href="javascript:void(0)" onclick="deleteForm({{$session->id}})" class="btn btn-sm btn-outline-warning">
                                                    <i data-feather="download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{$sessions->links()}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal to add new record -->
@endsection

@push('js')
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

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
                    f.setAttribute('action',`/user/evaluations/${id}`);

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
