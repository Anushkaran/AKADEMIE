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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.edit')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('admin.partners.index')}}">
                                            {{__('labels.list',['name' => trans_choice('labels.partner',2)])}}</a>
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
                                    <a href="{{route('admin.partners.password.edit',$partner->id)}}" class="mx-2 btn btn-primary">{{__('actions.edit-password')}}</a>

                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{route('admin.partners.update',$partner->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">{{__('labels.name')}}</label>
                                                    <input type="text" value="{{old('name',$partner->name)}}" id="first-name-vertical"
                                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                                           placeholder="{{__('labels.name')}}" />
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
                                                            <option value="{{$s}}" @if(old('state',$partner->state) === $s) selected @endif>{{__('labels.account_states.'.$s)}}</option>
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
                                                    <input type="text" value="{{old('legal_referent',$partner->legal_referent)}}" id="legal_referent"
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
                                                    <input type="text" value="{{old('legal_referent_phone',$partner->legal_referent_phone)}}" id="legal_referent_phone"
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
                                                    <input type="text" value="{{old('administrative_referent',$partner->administrative_referent)}}" id="first-name-vertical"
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
                                                    <input type="text" value="{{old('administrative_referent_phone',$partner->administrative_referent_phone)}}" id="administrative_referent_phone"
                                                           class="form-control @error('administrative_referent_phone') is-invalid @enderror" name="administrative_referent_phone"
                                                           placeholder="{{__('labels.administrative_referent_phone')}}"  required/>
                                                    @error('administrative_referent_phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="email-id-vertical">{{__('labels.email')}}</label>
                                                    <input type="email" value="{{old('email',$partner->email)}}" id="email-id-vertical" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{__('labels.email')}}" />
                                                    @error('email')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="department">{{__('labels.department')}}</label>
                                                    <select name="department" id="department" class="form-control select2-department">
                                                        @foreach(config('departments') as $d)
                                                            <option value="{{$d['dep_name']}}" @if(old('department',$partner->department) === $d['dep_name']) selected @endif>{{$d['dep_name']}}</option>
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
                                                    <input type="text" value="{{old('leader',$partner->leader)}}" id="leader-vertical"
                                                           class="form-control @error('leader') is-invalid @enderror" name="leader"
                                                           placeholder="{{__('labels.leader')}}" />
                                                    @error('leader')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="leader-vertical">{{__('labels.leader_phone')}}</label>
                                                    <input type="text" value="{{old('leader_phone',$partner->leader_phone)}}" id="leader-vertical"
                                                           class="form-control @error('leader_phone') is-invalid @enderror" name="leader_phone"
                                                           placeholder="{{__('labels.leader_phone')}}" />
                                                    @error('leader_phone')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="pedagogical_referent-vertical">{{__('labels.pedagogical_referent')}}</label>
                                                    <input type="text" value="{{old('pedagogical_referent',$partner->pedagogical_referent)}}" id="pedagogical_referent-vertical"
                                                           class="form-control @error('pedagogical_referent') is-invalid @enderror" name="pedagogical_referent"
                                                           placeholder="{{__('labels.pedagogical_referent')}}" />
                                                    @error('pedagogical_referent')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="phone-vertical">{{__('labels.phone')}}</label>
                                                    <input type="text" id="phone-vertical" value="{{old('phone',$partner->phone)}}" class="form-control @error('password') is-invalid @enderror" required name="phone" placeholder="{{__('labels.phone')}}" />
                                                    @error('phone')
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
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <script>

        $(document).ready(function() {
            $('.select2-department').select2();
        });

    </script>

@endpush
