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
                                    <li class="breadcrumb-item"><a href="{{route('admin.centers.index')}}">{{__('labels.list',['name' => trans_choice('labels.center',2)])}}</a>
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
                                <form class="add-new-record  pt-0" method="post" action="{{route('admin.centers.update',$center->id)}}">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body flex-grow-1">
                                        <div class="form-group">
                                            <label class="form-label" for="center">{{__('labels.name')}}</label>
                                            <input type="text" required name="name" value="{{old('name',$center->name)}}" class="form-control @error('name') is-invalid @enderror dt-full-name" id="center" placeholder="{{trans_choice('labels.center',1)}} ..."  aria-label="{{trans_choice('labels.center',1)}} ..." />
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="center">{{__('labels.phone')}}</label>
                                            <input type="text" required name="phone" value="{{old('phone',$center->phone)}}" class="form-control @error('phone') is-invalid @enderror dt-full-name" id="phone" placeholder="xxx xx xx xx"  aria-label="xxx xx xx xx" />
                                            @error('phone')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="address">{{__('labels.address')}}</label>
                                            <textarea required  name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="..." cols="30" rows="3">{{old('address',$center->address)}}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="note">{{__('labels.note')}} ({{__('labels.optional')}})</label>
                                            <textarea required  name="note" class="form-control @error('note') is-invalid @enderror" id="note" placeholder="..." cols="30" rows="3">{{old('note',$center->note)}}</textarea>
                                            @error('note')
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
