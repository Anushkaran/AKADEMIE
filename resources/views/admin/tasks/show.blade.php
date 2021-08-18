@extends('admin.layouts.app')

@push('css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">

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
                                    <li class="breadcrumb-item"><a href="{{route('admin.tasks.index')}}">{{__('labels.list',['name' => trans_choice('labels.task',2)])}}</a>
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
                                                            <a href="{{route('admin.tasks.edit',$t->id)}}" class="btn btn-primary ml-1">{{__('actions.edit')}}</a>
                                                            <button onclick="deleteForm({{$t->id}})" class="btn btn-outline-danger ml-1">{{__('actions.delete')}}</button>
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
                                                    <p class="card-text mb-0">{{$t->name}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="check" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{trans_choice('labels.level',1)}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$t->level->name}}</p>
                                                </div>

                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="check-circle" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{trans_choice('labels.skill',1)}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$t->skill->name}}</p>
                                                </div>



                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="book-open" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.description')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$t->description}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="calendar" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.created_at')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$t->created_at->format('d-m-Y')}}</p>
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
            </div>

        </div>
    </div>


@endsection


@push('js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->

    <script>
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
                    f.setAttribute('action',`/admin/tasks/${id}`);

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
