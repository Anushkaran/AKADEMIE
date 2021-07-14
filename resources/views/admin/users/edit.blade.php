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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.edit')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">
                                            {{__('labels.list',['name' => trans_choice('labels.user',2)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('actions.edit')}}
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
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('actions.edit')}}</h4>
                                    <a href="{{route('admin.users.password.edit',$user->id)}}" class="mx-2 btn btn-primary">{{__('actions.edit-password')}}</a>

                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{route('admin.users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group text-center">
                                                    <label for="pic">{{__('labels.pic')}}</label>
                                                    <input type="file" style="visibility: hidden"  id="pic-input"
                                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                                    />
                                                    <img onclick="document.getElementById('pic-input').click()"
                                                         src="{{$user->image_url}}"
                                                         class="img-thumbnail img-fluid" id="image_preview" width="150" height="150" alt="default pic">
                                                    @error('image')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first_name-vertical">{{__('labels.first_name')}}</label>
                                                    <input type="text" value="{{old('first_name',$user->first_name)}}" id="first_name-vertical"
                                                           class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                                           placeholder="{{__('labels.first_name')}}" />
                                                    @error('first_name')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="last_name-vertical">{{__('labels.last_name')}}</label>
                                                    <input type="text" value="{{old('last_name',$user->last_name)}}" id="last_name-vertical"
                                                           class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                                           placeholder="{{__('labels.last_name')}}" />
                                                    @error('last_name')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone-vertical">{{__('labels.phone')}}</label>
                                                    <input type="text" value="{{old('phone',$user->phone)}}" id="phone-vertical"
                                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                           placeholder="{{__('labels.phone')}}" />
                                                    @error('phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">{{__('labels.email')}}</label>
                                                    <input type="email" value="{{old('email',$user->email)}}" id="email-id-vertical" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{__('labels.email')}}" />
                                                    @error('email')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">

                                                <button type="submit" class="btn btn-primary mr-1">{{__('actions.save')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        let fileInput = document.getElementById('pic-input');
        let img = document.getElementById('image_preview');
        fileInput.onchange = (event) => {
            img.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(img.src) // free memory
            }
        }
    </script>

@endpush
