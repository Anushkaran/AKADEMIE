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
                                    <li class="breadcrumb-item"><a href="{{route('admin.resources.index')}}">{{__('labels.list',['name' => trans_choice('labels.resources',1)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{trans_choice('actions.add-new',2,['name' => trans_choice('labels.resources',1)])}}
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
                                        {{trans_choice('actions.add-new',2,['name' => trans_choice('labels.resource',1)])}}
                                    </h5>
                                @if(url()->previous() !== request()->url())
                                    <a href="{{url()->previous()}}" class="btn btn-outline-danger">
                                        <i data-feather='arrow-left'></i>
                                    </a>
                                @endif
                            </div>
                            <div class="card-body">
                                <form class="add-new-record  pt-0" method="post" action="{{route('admin.resources.store')}}" enctype="multipart/form-data">
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
                                            <label class="form-label" for="type">{{__('labels.file_type')}}</label>
                                            <select name="type" required id="type" class=" form-control">
                                                @foreach(__('labels.file_types') as $key => $a)
                                                    <option value="{{$key}}" @if((int)old('type') === $key) selected @endif>
                                                        {{__('labels.file_types.'.$key)}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="resource_category_id">{{trans_choice('labels.resource-category',1)}}</label>
                                            <select name="resource_category_id" required id="resource_category_id" class=" form-control">

                                            </select>
                                            @error('resource_category_id')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="access">{{__('labels.access')}}</label>
                                            <select name="access" required id="access" class=" form-control">
                                                <option value="1" @if((int)old('access') === 1) selected @endif id="access-option-read-only">
                                                    {{__('labels.access_methods.1')}}
                                                </option>
                                                <option value="{{2}}" @if((int)old('access') === 2) selected @endif id="access-option-download" >
                                                    {{__('labels.access_methods.2')}}
                                                </option>
                                            </select>
                                            @error('access')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label class="form-label" for="file">{{__('labels.file')}}</label>
                                            <input type="file" required name="file" value="{{old('file')}}" class="form-control @error('file') is-invalid @enderror dt-full-name" id="file" placeholder="{{__('labels.file')}} ..."  aria-label="{{__('labels.file')}} ..." />
                                            @error('file')
                                            <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>

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

    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function() {

            $('.select2').select2();

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
        });
        let fileType = document.getElementById('type');

        if (parseInt(fileType.value) === 2)
        {
            document.getElementById('access-option-read-only').style.display = 'none';
            document.getElementById('access-option-download').selected = true;
        }


        fileType.addEventListener('change',function (e){

            if (parseInt(e.target.value) === 1)
            {
                document.getElementById('access-option-read-only').style.display = '';

            }

            if (parseInt(e.target.value) === 2)
            {
                document.getElementById('access-option-read-only').style.display = 'none';
                document.getElementById('access-option-download').selected = true;
            }
        })

    </script>
@endpush
