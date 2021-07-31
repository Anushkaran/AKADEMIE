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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.edit')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('partner.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('partner.evaluations.index')}}">{{__('labels.list',['name' => trans_choice('labels.evaluation',2)])}}</a>
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
                            <form class="add-new-record  pt-0" method="post" action="{{route('partner.evaluations.update',$ev->id)}}">
                                @csrf
                                @method('PUT')

                                <div class="modal-body flex-grow-1">
                                    <div class="form-group">
                                        <label class="form-label" for="name">{{__('labels.name')}}</label>
                                        <input type="text" required name="name" value="{{old('name',$ev->name)}}" class="form-control @error('name') is-invalid @enderror dt-full-name" id="name" placeholder="{{__('labels.name')}}  ..."  aria-label="{{__('labels.name')}} ..." />
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label class="form-label" for="start_date">{{__('labels.start_date')}}</label>
                                        <input type="date" required name="start_date"
                                               value="{{old('start_date',$ev->start_date->format('Y-m-d'))}}"
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
                                               value="{{old('end_date',$ev->end_date->format('Y-m-d'))}}"
                                               class="form-control @error('end_date') is-invalid @enderror"
                                               id="name" placeholder="{{__('labels.end_date')}}
                                            ..."  aria-label="{{__('labels.end_date')}} ..." />
                                        @error('end_date')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>


                                    <button type="submit" class="btn btn-primary  mr-1">{{__('actions.save')}}</button>
                                    <a href="{{route('partner.evaluations.index')}}"  class="btn btn-outline-secondary">{{__('actions.cancel')}}</a>
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
