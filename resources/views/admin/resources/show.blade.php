@extends('admin.layouts.app')

@push('css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">
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
                            <h2 class="content-header-title float-left mb-0">{{__('actions.details')}}</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('admin.resources.index')}}">{{__('labels.list',['name' => trans_choice('labels.resource',2)])}}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{__('actions.details')}}
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">

                <section class="app-user-view">
                    <!-- User Card & Plan Starts -->
                    <div class="row">
                        <!-- User Card starts-->
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="card user-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                            <div class="user-avatar-section">
                                                <div class="d-flex justify-content-start">
                                                    <div class="d-flex flex-column ml-1">
                                                        <div class="d-flex flex-wrap">
                                                            @if(url()->previous() !== request()->url())
                                                                <a href="{{url()->previous()}}" class="btn btn-outline-danger">
                                                                    <i data-feather='arrow-left'></i>
                                                                </a>
                                                            @endif
                                                            <a href="{{route('admin.resources.edit',$resource->id)}}" class="btn btn-primary ml-1">{{__('actions.edit')}}</a>
                                                            <button onclick="deleteForm({{$resource->id}})" class="btn btn-outline-danger ml-1">{{__('actions.delete')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12 mt-2 ">
                                            <div class="user-info-wrapper">
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.name')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$resource->name}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="book-open" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.access')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">
                                                        <span class="badge badge-info">{{__('labels.access_methods.'.$resource->access)}}</span>
                                                    </p>
                                                </div>

                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="book-open" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.file_type')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">
                                                        <span class="badge badge-success">{{__('labels.file_types.'.$resource->type)}}</span>
                                                    </p>
                                                </div>


                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$resource->created_at->format('d-m-Y')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /User Card Ends-->

                    </div>
                    <!-- User Card & Plan Ends -->
                </section>
                <div id="viewer">

                </div>
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <button class="dt-button create-new btn btn-primary" tabindex="0"
                                            aria-controls="DataTables_Table_0"
                                            type="button" data-toggle="modal" id="create-btn"
                                            data-target="#modals-slide-in">
                                        <i data-feather='plus'></i>
                                        {{trans_choice('actions.add-new',1,['name' => trans_choice('labels.user',1)])}}
                                    </button>
                                </h4>
                            </div>
                            <div class="card-body" >
                                {{--                                filters--}}
                            </div>
                            <div class="table-responsive">
                                @php
                                    /** @var \App\Models\Resource $resource */
                                    $count = $resource->users->count();
                                @endphp
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('labels.name')}}</th>
                                        <th>{{__('labels.email')}}</th>
                                        <th>{{__('labels.phone')}}</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($resource->users as $key => $user)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>

                                            <td>
                                                @if($count < 3)

                                                    <a href="{{route('admin.resources.show',$resource->id)}}" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" onclick="detachUser({{$resource->id}},{{$user->id}})" class="btn btn-sm btn-outline-warning">
                                                        <i data-feather="trash"></i>
                                                    </a>
                                                @else
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">

                                                            <a class="dropdown-item" href="{{route('admin.users.show',$user->id)}}">
                                                                <i data-feather="eye" class="mr-50"></i>
                                                                <span>{{__('actions.details')}}</span>
                                                            </a>
                                                            <a class="dropdown-item" href="javascript:void(0);" onclick="detachUser({{$resource->id}},{{$user->id}})">
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
                        {{--            <div class="d-flex justify-content-center">--}}
                        {{--                {{$tasks->links()}}--}}
                        {{--            </div>--}}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" method="post" action="{{route('admin.resources.users.attach',$resource->id)}}">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{__('actions.add-new',['name' => trans_choice('labels.user',1)])}}
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <div class="form-group">
                        <label class="form-label" for="users">{{trans_choice('labels.user',2)}}</label>
                        <select multiple class="form-control select2-users @error('users') is-invalid @enderror" name="users[]" id="users">
                        </select>
                        @error('users')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary  mr-1">{{__('actions.save')}}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{__('actions.cancel')}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        @if($resource->type === 1)
        let link = `/admin/files/{{$resource->id}}`

        let iframe = document.createElement('iframe');
        iframe.id = 'iframe-viewer'

        axios({
            url: link,
            method: 'GET',
            responseType: 'blob',
        }).then(res => {
            let blob = new Blob([res.data] ,{type:"application/pdf"})

            //let url = 'http://file-examples-com.github.io/uploads/2017/02/file-sample_100kB.docx';

            let url = window.URL.createObjectURL(blob);
            console.log(url);
            @if($resource->access === 1)
                iframe.src = `${url}#toolbar=0`
            @else
                iframe.src = `${url}`
            @endif
            iframe.height = "300px";
            iframe.width = "100%";
            document.getElementById('viewer').append(iframe)
            /*  const url = window.URL.createObjectURL(blob);
             console.log(url)
             const link = document.createElement('a');
             link.href = url;
             link.download = 'test.pdf'; //or any other extension
             document.body.appendChild(link);
             link.click();

             WebViewer({
                 path: '/assets/pdf-assets/lib/', // path to the PDF.js Express'lib' folder on your server
                 licenseKey: 'w8xeg97n9J62TgxqdczO',
             }, document.getElementById('viewer'))
                 .then(instance => {
                     // now you can access APIs through the WebViewer instance
                     const { Core, UI } = instance;
                     const { documentViewer } = Core;
                     UI.loadDocument(blob, { filename: '{{$resource->name}}'+'.pdf' })

                    // adding an event listener for when a document is loaded
                    documentViewer.addEventListener('documentLoaded', () => {
                        console.log('document loaded');
                    });

                    // adding an event listener for when the page number has changed
                    documentViewer.addEventListener('pageNumberUpdated', (pageNumber) => {
                        console.log(`Page number is: ${pageNumber}`);
                    });

                    UI.disableElements([ 'menuOverlay', 'downloadButton' ]);
                    UI.disableElements([ 'menuOverlay', 'printButton' ]);
                });*/
        }).catch(err => console.error())

            @endif



        function base64ToBlob(base64) {
            const binaryString = window.atob(base64);
            const len = binaryString.length;
            const bytes = new Uint8Array(len);
            for (let i = 0; i < len; ++i) {
                bytes[i] = binaryString.charCodeAt(i);
            }

            return new Blob([bytes], { type: 'application/pdf' });
        };





        $('.select2-users').select2({
            cache:true,
            ajax: {
                delay: 250,
                url: '{{route('admin.users.index')}}',
                dataType: 'json',
                data: function (params) {


                    return {
                        search: params.term,
                        page: params.page || 1
                    };

                },
                processResults: function ({users}, params) {
                    params.page = params.page || 1;

                    let fData = $.map(users.data, function (obj) {
                        obj.text = obj.name; // replace name with the property used for the text
                        return obj;
                    });

                    return {
                        results: fData,
                        pagination: {
                            more: (params.page * 10) < users.total
                        }
                    };
                }
            }
        });
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
                    f.setAttribute('action',`/admin/resources/${id}`);

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

        const detachUser = (resource,user) => {
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
                    f.setAttribute('action',`/admin/resources/${resource}/users/${user}`);

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
