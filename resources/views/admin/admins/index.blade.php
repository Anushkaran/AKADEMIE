@extends('admin.layouts.app')

@section('content')

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name' => trans_choice('labels.admin',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('labels.list',['name' => trans_choice('labels.admin',2)])}}
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
                                    <a href="{{route('admin.admins.create')}}" class="dt-button create-new btn btn-primary" tabindex="0"
                                             id="create-btn">
                                        <i data-feather='plus'></i>
                                        {{trans_choice('actions.add-new',1,['name' => trans_choice('labels.admin',1)])}}
                                    </a>

                                </h4>
                            </div>
                            <div class="card-body">

                                        <div class=" search-input">
                                            <form>
                                                <div class="row">
                                                <input class="form-control input col-6"  name="search" type="text" placeholder="{{__('labels.search')}}" tabindex="0" data-search="search">

                                                <button  type="submit" class="btn btn-primary mr-1 col-2"><i data-feather="search"></i></button>
                                                </div>
                                            </form>
                                        </div>

                            </div>
                            <div class="table-responsive">
                                @php
                                    /** @var \Illuminate\Database\Eloquent\Collection $admins */
                                    $count = $admins->count();
                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('labels.pic')}}</th>
                                        <th>{{__('labels.name')}}</th>
                                        <th>{{__('labels.email')}}</th>
                                        <th>{{__('labels.role')}}</th>
                                        <th>{{__('labels.created_at')}}</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($admins as $key => $admin)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>
                                                <span class="avatar">
                                                    <img width="60" class="round " height="60" src="{{$admin->image_url}}" alt="{{$admin->name}} image">

                                                </span>
                                            </td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->email}}</td>
                                            <td>
                                                {{$admin->role}}
                                            </td>
                                            <td>
                                                {{$admin->created_at->format('d-m-Y')}}
                                            </td>
                                            <td>
                                                @if($count < 3)
                                                    <a href="{{route('admin.admins.edit',$admin->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="edit"></i>
                                                    </a>
                                                    <a href="{{route('admin.admins.show',$admin->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="deleteForm({{$admin->id}})" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="trash"></i>
                                                    </a>
                                                @else
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('admin.admins.edit',$admin->id)}}">
                                                                <i data-feather="edit-2" class="mr-50"></i>
                                                                <span>{{__('actions.edit')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('admin.admins.show',$admin->id)}}">
                                                                <i data-feather="eye" class="mr-50"></i>
                                                                <span>{{__('actions.details')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="deleteForm({{$admin->id}})">
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
                            {{$admins->links()}}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')

    <script>
        @if($errors->any())
        document.getElementById('create-btn').click();
        @endif

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
                    f.setAttribute('action',`/admin/admins/${id}`);

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
