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
                            <h2 class="content-header-title float-left mb-0">{{__('labels.list',['name' => trans_choice('labels.partner',2)])}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('admin.partners.index')}}">{{trans_choice('labels.admin',2)}}</a>
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
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{trans_choice('actions.add-new',1,['name' => trans_choice('labels.partner',1)])}}</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{route('admin.partners.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
{{--                                            <div class="col-12">--}}
{{--                                                <div class="form-group text-center">--}}
{{--                                                    <label for="pic">{{__('labels.pic')}}</label>--}}
{{--                                                    <input type="file" style="visibility: hidden"  id="pic-input"--}}
{{--                                                           class="form-control @error('image') is-invalid @enderror" name="image"--}}
{{--                                                           />--}}
{{--                                                    <img onclick="document.getElementById('pic-input').click()" src="{{asset('assets/vuexy/app-assets/images/defaults/user-default.jpg')}}"--}}
{{--                                                         class="img-thumbnail img-fluid" id="image_preview" width="150" height="150" alt="default pic">--}}
{{--                                                    @error('image')--}}
{{--                                                    <div class="invalid-feedback">{{$message}}</div>--}}
{{--                                                    @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{__('labels.name')}}</label>
                                                    <input type="text" value="{{old('name')}}" id="first-name-vertical"
                                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                                           placeholder="{{__('labels.name')}}"  required/>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="state">{{__('labels.account_state')}}</label>
                                                    <select name="state" id="state" class="form-control">
                                                        @foreach(config('settings.account_states') as $s)
                                                            <option value="{{$s}}" @if(old('state') === $s) selected @endif>{{__('labels.account_states.'.$s)}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('state')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="legal_referent">{{__('labels.legal_referent')}}</label>
                                                    <input type="text" value="{{old('legal_referent')}}" id="legal_referent"
                                                           class="form-control @error('legal_referent') is-invalid @enderror" name="legal_referent"
                                                           placeholder="{{__('labels.legal_referent')}}"  required/>
                                                    @error('legal_referent')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="legal_referent_phone">{{__('labels.legal_referent_phone')}}</label>
                                                    <input type="text" value="{{old('legal_referent_phone')}}" id="legal_referent_phone"
                                                           class="form-control @error('legal_referent_phone') is-invalid @enderror" name="legal_referent_phone"
                                                           placeholder="{{__('labels.legal_referent_phone')}}"  required/>
                                                    @error('legal_referent_phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="administrative_referent">{{__('labels.administrative_referent')}}</label>
                                                    <input type="text" value="{{old('administrative_referent')}}" id="first-name-vertical"
                                                           class="form-control @error('administrative_referent') is-invalid @enderror" name="administrative_referent"
                                                           placeholder="{{__('labels.administrative_referent')}}"  required/>
                                                    @error('administrative_referent')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="administrative_referent_phone">{{__('labels.administrative_referent_phone')}}</label>
                                                    <input type="text" value="{{old('administrative_referent_phone')}}" id="administrative_referent_phone"
                                                           class="form-control @error('administrative_referent_phone') is-invalid @enderror" name="administrative_referent_phone"
                                                           placeholder="{{__('labels.administrative_referent_phone')}}"  required/>
                                                    @error('administrative_referent_phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="department">{{__('labels.department')}}</label>
                                                    <select name="department" id="department" class="form-control select2-department">
                                                        @foreach(config('departments') as $d)
                                                            <option value="{{$d['dep_name']}}" @if(old('department') === $d['dep_name']) selected @endif>{{$d['dep_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="leader-vertical">{{__('labels.leader')}}</label>
                                                    <input type="text" value="{{old('leader')}}" id="leader-vertical"
                                                           class="form-control @error('leader') is-invalid @enderror" name="leader"
                                                           placeholder="{{__('labels.leader')}}" />
                                                    @error('leader')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone-vertical">{{__('labels.phone')}}</label>
                                                    <input type="text"  value="{{old('phone')}}" id="phone-vertical" class="form-control @error('phone') is-invalid @enderror" required name="phone" placeholder="{{__('labels.phone')}}" />
                                                    @error('phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">{{__('labels.email')}}</label>
                                                    <input type="email" required value="{{old('email')}}" id="email-id-vertical" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{__('labels.email')}}" />
                                                    @error('email')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-vertical">{{__('labels.password')}}</label>
                                                    <input type="password" required id="password-vertical" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{__('labels.password')}}" />
                                                    @error('password')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="password-confirm">{{__('labels.password_confirmation')}}</label>
                                                    <input type="password" required id="password-confirm" class="form-control" name="password_confirmation" placeholder="{{__('labels.password_confirmation')}}" />
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
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <script>


        $(document).ready(function() {
            $('.select2-department').select2();
        });

    </script>

@endpush
