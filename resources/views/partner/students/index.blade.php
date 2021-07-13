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
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name' => trans_choice('labels.partner',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('partner.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('labels.list',['name' => trans_choice('labels.partner',2)])}}
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
                                    <a class="dt-button create-new btn btn-primary" tabindex="0"
                                       href="{{route('partner.students.create')}}"
                                    >
                                        <i data-feather='plus'></i>
                                        {{__('actions.add-new',['name' => trans_choice('labels.student',1)])}}
                                    </a>

                                </h4>
                            </div>
                            <div class="card-body">
                                {{--                                filters--}}
                            </div>
                            <div class="table-responsive">
                                @php
                                    /** @var \Illuminate\Database\Eloquent\Collection $students */
                                    $count = $students->count();
                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('labels.first_name')}}</th>
                                        <th>{{__('labels.last_name')}}</th>
                                        <th>{{__('labels.phone')}}</th>
                                        <th>{{__('labels.email')}}</th>
                                        <th>{{__('labels.created_at')}}</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $key => $s)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>{{$s->first_name}}</td>
                                            <td>{{$s->last_name}}</td>
                                            <td>
                                                {{$s->phone}}
                                            </td>
                                            <td>
                                                {{$s->email}}
                                            </td>
                                            <td>
                                                {{$s->created_at->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                @if($count < 3)
                                                    <a href="{{route('partner.students.edit',$s->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <a href="{{route('partner.students.show',$s->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="deleteForm({{$s->id}})" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="trash"></i>
                                                    </a>
                                                @else
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('partner.students.edit',$s->id)}}">
                                                                <i data-feather="edit-2" class="mr-50"></i>
                                                                <span>{{__('actions.edit')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('partner.students.show',$s->id)}}">
                                                                <i data-feather="eye" class="mr-50"></i>
                                                                <span>{{__('actions.details')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="deleteForm({{$s->id}})">
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
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            {{$students->links()}}
                        </div>
                    </div>
                </div>
            </div>

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
                    f.setAttribute('action',`/partner/students/${id}`);

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
