@extends('partner.layouts.app')

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
                                    <li class="breadcrumb-item"><a href="{{route('partner.dashboard')}}">{{__('labels.dashboard')}}</a>
                                    <li class="breadcrumb-item"><a href="{{route('partner.evaluations.students.index',$id)}}">{{trans_choice('labels.evaluation',1)}}</a>
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
                                    <div class="card-body">

                                        <div class=" search-input">
                                            <form>
                                                <div class="row">
                                                    <input class="form-control input col-6"  name="search" type="text" placeholder="{{__('labels.search')}}" tabindex="0" data-search="search">

                                                    <button  type="submit" class="btn btn-primary mr-1 col-2"><i data-feather="search"></i></button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
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
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.first_name')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$student->first_name}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap">
                                                    <div class="user-info-title">
                                                        <i data-feather="user" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.last_name')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$student->last_name}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="map-pin" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.address')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$student->address}}</p>
                                                </div>
                                                <div class="d-flex flex-wrap my-50">
                                                    <div class="user-info-title">
                                                        <i data-feather="phone" class="mr-1"></i>
                                                        <span class="card-text user-info-title font-weight-bold mb-0">{{__('labels.phone')}}</span>
                                                    </div>
                                                    <p class="card-text mb-0">{{$student->phone}}</p>
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
                <section id="accordion-with-margin">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card collapse-icon">
                                <div class="card-header">
                                    <h4 class="card-title">Liste des sessions</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="table-hover-animation">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">{{trans_choice('labels.detail',1)}} de la session</h4>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover-animation">
                                                        <thead>
                                                        <tr>
                                                            <th>{{trans_choice('labels.task',1)}}</th>
                                                            @foreach($evaluation->sessions as $session)
                                                                <th>{{$session->date->format('d/m/Y')}}</th>
                                                            @endforeach
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($tasks as $t)
                                                            <tr>
                                                                <td>
                                                                    <span class="font-weight-bold">{{$t->name}}</span>
                                                                </td>

                                                                @foreach($evaluation->sessions as $session)
                                                                    @php
                                                                        $tasks = $session->sessionStudents->first() ? $session->sessionStudents->first()->tasks : collect([]);
                                                                    @endphp

                                                                    <td>
                                                                        @if($tasks->contains($t->id))
                                                                            @if($tasks->where('id',$t->id)->first()->pivot->state)
                                                                                <span class="badge badge-success">{{__('labels.validated')}}</span>
                                                                            @else
                                                                                <span class="badge badge-danger">{{__('labels.failed')}}</span>
                                                                            @endif

                                                                        @else
                                                                            <span class="badge badge-light-dark">{{__('labels.not_evaluated')}}</span>
                                                                        @endif

                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    f.setAttribute('action',`/partner/students/${id}`);

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
