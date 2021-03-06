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
                                    <li class="breadcrumb-item"><a href="{{route('admin.resources.index')}}">{{__('labels.list',['name' => trans_choice('labels.resource',2)])}}</a>
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
                        <div class="col-md-8 card">
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
                                <form class="add-new-record  pt-0" method="post" action="{{route('admin.resources.update',$resource->id)}}">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-body flex-grow-1">
                                        <div class="modal-body flex-grow-1">
                                            <div class="form-group">
                                                <label class="form-label" for="name">{{__('labels.name')}}</label>
                                                <input type="text" required name="name" value="{{old('name',$resource->name)}}" class="form-control @error('name') is-invalid @enderror dt-full-name" id="name" placeholder="{{__('labels.name')}} ..."  aria-label="{{__('labels.name')}} ..." />
                                                @error('name')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="resource_category_id">{{trans_choice('labels.resource-category',1)}}</label>
                                                <select name="resource_category_id" required id="resource_category_id" class=" form-control">
                                                    @foreach($resource->categories as $category)
                                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('resource_category_id')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            @if($resource->type === 1)
                                            <div class="form-group">
                                                <label class="form-label" for="access">{{__('labels.access')}}</label>
                                                <select name="access" required id="access" class="form-control">
                                                    @foreach(__('labels.access_methods') as $key => $a)
                                                        <option value="{{$key}}" @if((int)old('access',$resource->access) === $key) selected @endif>
                                                            {{__('labels.access_methods.'.$key)}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('access')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            @endif


                                        <button type="submit" class="btn btn-primary  mr-1">{{__('actions.save')}}</button>
                                        <a href="{{route('admin.resources.index')}}"  class="btn btn-outline-secondary">{{__('actions.cancel')}}</a>
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
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>

    <!-- END: Page JS-->

    <script>
        $('#resource_category_id').select2({
            cache:true,
            ajax: {
                delay: 250,
                url: '{{route('admin.resource-categories.index')}}',
                dataType: 'json',
                data: function (params) {

                    // Query parameters will be ?search=[term]&page=[page]

                    return {
                        search: params.term,
                        page: params.page || 1
                    };

                },
                processResults: function ({resource_categories}, params) {
                    params.page = params.page || 1;

                    let fData = $.map(resource_categories.data, function (obj) {
                        obj.text = obj.name; // replace name with the property used for the text
                        return obj;
                    });

                    return {
                        results: fData,
                        pagination: {
                            more: (params.page * 10) < resource_categories.total
                        }
                    };
                }
            }
        });
    </script>
@endpush
