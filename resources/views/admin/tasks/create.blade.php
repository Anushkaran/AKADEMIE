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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.create')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('admin.tasks.index')}}">{{__('labels.list',['name' => trans_choice('labels.task',2)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('actions.add-new',['name' => trans_choice('labels.task',1)])}}
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
                                        {{__('actions.add-new',['name' => trans_choice('labels.task',1)])}}
                                    </h5>
                                @if(url()->previous() !== request()->url())
                                    <a href="{{url()->previous()}}" class="btn btn-outline-danger">
                                        <i data-feather='arrow-left'></i>
                                    </a>
                                @endif
                            </div>
                            <div class="card-body">
                                <form class="add-new-record  pt-0" method="post" action="{{route('admin.tasks.store')}}">
                                    @csrf

                                    <div class="modal-body flex-grow-1">
                                        <div class="form-group">
                                            <label class="form-label" for="name">{{__('labels.name')}}</label>
                                            <input type="text" required name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror dt-full-name" id="name" placeholder="{{__('labels.name')}} ..."  aria-label="{{__('labels.name')}} ..." />
                                            @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="skill_id">{{trans_choice('labels.skill',1)}}</label>
                                            <select class="form-control select2 @error('skill_id') is-invalid @enderror" name="skill_id" id="skill_id">
                                                @foreach($skills as $s)
                                                    <option value="{{$s->id}}" {{$s->id === (int)old('skill_id') ? 'selected' : ''}}>
                                                        {{$s->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('skill_id')name
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="description">{{__('labels.description')}} ({{__('labels.optional')}})</label>
                                            <textarea  name="description"
                                                       class="form-control @error('description') is-invalid @enderror"
                                                       id="description" placeholder="..."
                                                       cols="30" rows="3">{{old('description')}}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary  mr-1">{{__('actions.save')}}</button>
                                        <a href="{{route('admin.tasks.index')}}"  class="btn btn-outline-secondary">{{__('actions.cancel')}}</a>
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

    <script src="{{asset('assets/vuexy/app-assets/js/scripts/forms/form-select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
