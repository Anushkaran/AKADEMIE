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
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name' => trans_choice('labels.student',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('labels.list',['name' => trans_choice('labels.student',2)])}}
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
                                        {{trans_choice('actions.add-new',1,['name' => trans_choice('labels.student',1)])}}
                                    </button>

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
                                        <div class="row">

                                            <button  type="submit" class="btn btn-primary mr-1 col-2"><i data-feather="search"></i></button>
                                            <a  href="{{route('admin.users.index')}}" class="btn btn-primary mr-1 col-2">{{__('actions.clear')}}</a>
                                        </div>
                                    </form>
                                </div>

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
                                        <th>{{__('labels.contract_date')}}</th>
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

                                                <a href="{{route('admin.students.show',$s->id)}}" class="btn btn-sm btn-outline-warning">
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

                                                        <a class="dropdown-item" href="{{route('admin.students.show',$s->id)}}">
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
    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" method="post" action="{{route('admin.students.store')}}">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{trans_choice('actions.add-new',1,['name' => trans_choice('labels.student',1)])}}
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="first_name">{{__('labels.first_name')}}</label>
                        <input type="text" required name="first_name" value="{{old('first_name')}}" class="form-control @error('first_name') is-invalid @enderror dt-full-name" id="first_name" placeholder="{{__('labels.first_name')}} ..."  aria-label="{{__('labels.first_name')}} ..." />
                        @error('first_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="last_name">{{__('labels.last_name')}}</label>
                        <input type="text" required name="last_name" value="{{old('last_name')}}" class="form-control @error('last_name') is-invalid @enderror dt-full-name" id="last_name" placeholder="{{__('labels.last_name')}} ..."  aria-label="{{__('labels.first_name')}} ..." />
                        @error('last_name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">{{__('labels.email')}}</label>
                        <input type="email" required name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror dt-full-name" id="email" placeholder="{{__('labels.email')}} ..."  aria-label="{{__('labels.email')}} ..." />
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="partner_id">{{trans_choice('labels.partner',2)}}</label>
                        <select name="partner_id" id="partner_id" class="form-control select2">
{{--                            @foreach($partners as $p)--}}
{{--                                <option value="{{$p->id}}" {{(int)old('partner_id') === $p->id ? 'selected' : ''}}>{{$p->name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        @error('partner_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">{{__('labels.phone')}}</label>
                        <input type="text" required name="phone" value="{{old('phone')}}" class="form-control @error('phone') is-invalid @enderror dt-full-name" id="phone" placeholder="xxx xx xx xx"  aria-label="xxx xx xx xx" />
                        @error('phone')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label class="form-label" for="address">{{__('labels.address')}}</label>
                        <textarea required  name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="..." cols="30" rows="3">{{old('address')}}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary  mr-1">{{__('actions.save')}}</button>
                    <a href="{{route('admin.centers.index')}}"  class="btn btn-outline-secondary">{{__('actions.cancel')}}</a>
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
                minimumInputLength:1,
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
            $('#partners-filter').select2({
                minimumInputLength:1,
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
                    f.setAttribute('action',`/admin/students/${id}`);

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
