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
                                    <li class="breadcrumb-item"><a href="{{route('admin.students.index')}}">{{__('labels.list',['name' => trans_choice('labels.student',2)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('actions.edit')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">

                    <div class="row">
                        <div class="col-md-6 card">
                            <div class="card-header">
                                    <h5 class="card-text">
                                        {{__('actions.update')}}
                                    </h5>
                                @if(url()->previous() !== request()->url())
                                    <a href="{{url()->previous()}}" class="btn btn-outline-danger">
                                        <i data-feather='arrow-left'></i>
                                    </a>
                                @endif
                            </div>
                            <div class="card-body">
                                <form class="add-new-record  pt-0" method="post" action="{{route('admin.students.update',$student->id)}}">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body flex-grow-1">
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">{{__('labels.first_name')}}</label>
                                            <input type="text" required name="first_name" value="{{old('first_name',$student->first_name)}}" class="form-control @error('first_name') is-invalid @enderror dt-full-name" id="first_name" placeholder="{{__('labels.first_name')}} ..."  aria-label="{{__('labels.first_name')}} ..." />
                                            @error('first_name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="last_name">{{__('labels.last_name')}}</label>
                                            <input type="text" required name="last_name" value="{{old('last_name',$student->last_name)}}" class="form-control @error('last_name') is-invalid @enderror dt-full-name" id="last_name" placeholder="{{__('labels.last_name')}} ..."  aria-label="{{__('labels.first_name')}} ..." />
                                            @error('last_name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="email">{{__('labels.email')}}</label>
                                            <input type="email" required name="email" value="{{old('email',$student->email)}}" class="form-control @error('email') is-invalid @enderror dt-full-name" id="email" placeholder="{{__('labels.email')}} ..."  aria-label="{{__('labels.email')}} ..." />
                                            @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="phone">{{__('labels.phone')}}</label>
                                            <input type="text" required name="phone" value="{{old('phone',$student->phone)}}" class="form-control @error('phone') is-invalid @enderror dt-full-name" id="phone" placeholder="xxx xx xx xx"  aria-label="xxx xx xx xx" />
                                            @error('phone')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label" for="address">{{__('labels.address')}}</label>
                                            <textarea required  name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="..." cols="30" rows="3">{{old('address',$student->address)}}</textarea>
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
                    </div>

            </div>

        </div>
    </div>


@endsection

@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        @if($errors->any())
        document.getElementById('create-btn').click();
        @endif
    </script>

@endpush
