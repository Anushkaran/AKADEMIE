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
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name' => trans_choice('labels.evaluation',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('labels.list',['name' => trans_choice('labels.evaluation',2)])}}
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
                                    <button class="dt-button create-new btn btn-primary" tabindex="0"
                                            aria-controls="DataTables_Table_0"
                                            type="button" data-toggle="modal" id="create-btn"
                                            data-target="#modals-slide-in">
                                        <i data-feather='plus'></i>
                                        {{__('actions.add-new',['name' => trans_choice('labels.evaluation',1)])}}
                                    </button>

                                </h4>
                            </div>
                            <div class="card-body">
                                {{--                                filters--}}
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
                                        <th>{{__('labels.start_date')}}</th>
                                        <th>{{__('labels.end_date')}}</th>
                                        <th>{{__('labels.created_at')}}</th>
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
                                                {{$e->start_date->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                {{$e->end_date->format('d-m-Y')}}
                                            </td>
                                        <td>
                                            {{$e->created_at->format('d-m-Y')}}
                                        </td>
                                        <td>
                                            @if($count < 3)
                                            <a href="{{route('admin.evaluations.edit',$e->id)}}" class="btn btn-sm btn-outline-warning">
                                                <i data-feather="edit"></i>
                                            </a>
                                                <a href="{{route('admin.evaluations.show',$e->id)}}" class="btn btn-sm btn-outline-warning">
                                                    <i data-feather="eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" onclick="deleteForm({{$e->id}})" class="btn btn-sm btn-outline-warning">
                                                    <i data-feather="trash"></i>
                                                </a>
                                            @else
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{route('admin.evaluations.edit',$e->id)}}">
                                                            <i data-feather="edit-2" class="mr-50"></i>
                                                            <span>{{__('actions.edit')}}</span>
                                                        </a>
                                                        <a class="dropdown-item" href="{{route('admin.evaluations.show',$e->id)}}">
                                                            <i data-feather="eye" class="mr-50"></i>
                                                            <span>{{__('actions.details')}}</span>
                                                        </a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="deleteForm({{$e->id}})">
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
                            <div class="d-flex justify-content-center">
                                {{$evaluations->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" method="post" action="{{route('admin.evaluations.store')}}">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{__('actions.add-new',['name' => trans_choice('labels.evaluation',1)])}}
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="name">{{__('labels.name')}}</label>
                        <input type="text" required name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror dt-full-name" id="name" placeholder="{{__('labels.name')}}  ..."  aria-label="{{__('labels.name')}} ..." />
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="partner_id">{{trans_choice('labels.partner',2)}}</label>
                        <select name="partner_id" id="partner_id" class="form-control select2 @error('partner_id') is-invalid @enderror">
                            {{--                            @foreach($partners as $p)--}}
                            {{--                                <option value="{{$p->id}}" {{(int)old('partner_id') === $p->id ? 'selected' : ''}}>{{$p->name}}</option>--}}
                            {{--                            @endforeach--}}
                        </select>
                        @error('partner_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="start_date">{{__('labels.start_date')}}</label>
                        <input type="date" required name="start_date"
                               value="{{old('start_date')}}"
                               class="form-control @error('start_date') is-invalid @enderror"
                               id="name" placeholder="{{__('labels.start_date')}}
                            ..."  aria-label="{{__('labels.start_date')}} ..." />
                        @error('start_date')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="end_date">{{__('labels.end_date')}}</label>
                        <input type="date" required name="end_date"
                               value="{{old('end_date')}}"
                               class="form-control @error('end_date') is-invalid @enderror"
                               id="name" placeholder="{{__('labels.end_date')}}..."  aria-label="{{__('labels.end_date')}} ..." />
                        @error('end_date')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary  mr-1">{{__('actions.save')}}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{__('actions.cancel')}}</button>
                </div>
            </form>
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
            $('.select2').select2({
                minimumInputLength:2,
                cache:true,
                ajax: {
                    delay: 250,
                    url: '{{route('admin.partners.index')}}',
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
            $('.select2-selection__arrow').style.display = 'node'
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
