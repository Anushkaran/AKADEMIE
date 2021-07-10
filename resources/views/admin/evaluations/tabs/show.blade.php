@extends('admin.evaluations.tab-layout')

@push('tab-css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">

@endpush

@section('tab-content')
    <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">

                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#success">
                        <i data-feather='plus'></i>
                        {{__('actions.add-new',['name' => trans_choice('labels.student',1)])}}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade text-left modal-success" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel110">{{__('actions.add-new',['name' => trans_choice('labels.student',1)])}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="attach-students-form" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">{{trans_choice('labels.student',3)}}</label>
                                            <select
                                                name="students[]" multiple
                                                id="students" class="select2 form-control"></select>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-success" onclick="document.getElementById('attach-students-form').submit()" data-dismiss="modal">
                                        {{__('actions.save')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </h4>
            </div>
            <div class="card-body">
                {{--                                filters--}}
            </div>
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('labels.name')}}</th>
                        <th>{{__('labels.phone')}}</th>
                        <th>{{__('labels.email')}}</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Jhon Do</td>
                        <td>123456789</td>
                        <td>student@email.com</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger">
                                <i data-feather="trash"></i>
                            </button>
                        </td>
                    </tr>
                    {{--                                        @foreach($evaluations as $key => $e)--}}
                    {{--                                            <tr>--}}
                    {{--                                                <td>--}}
                    {{--                                                    {{$key + 1}}--}}
                    {{--                                                </td>--}}
                    {{--                                                <td>{{$e->name}}</td>--}}
                    {{--                                                <td>--}}
                    {{--                                                    {{$e->start_date->format('d-m-Y')}}--}}
                    {{--                                                </td>--}}
                    {{--                                                <td>--}}
                    {{--                                                    {{$e->end_date->format('d-m-Y')}}--}}
                    {{--                                                </td>--}}
                    {{--                                                <td>--}}
                    {{--                                                    {{$e->created_at->format('d-m-Y')}}--}}
                    {{--                                                </td>--}}
                    {{--                                                <td>--}}
                    {{--                                                    @if($count < 3)--}}
                    {{--                                                        <a href="{{route('admin.evaluations.edit',$e->id)}}" class="btn btn-sm btn-outline-warning">--}}
                    {{--                                                            <i data-feather="edit"></i>--}}
                    {{--                                                        </a>--}}
                    {{--                                                        <a href="{{route('admin.evaluations.show',$e->id)}}" class="btn btn-sm btn-outline-warning">--}}
                    {{--                                                            <i data-feather="eye"></i>--}}
                    {{--                                                        </a>--}}
                    {{--                                                        <a href="javascript:void(0)" onclick="deleteForm({{$e->id}})" class="btn btn-sm btn-outline-warning">--}}
                    {{--                                                            <i data-feather="trash"></i>--}}
                    {{--                                                        </a>--}}
                    {{--                                                    @else--}}
                    {{--                                                        <div class="dropdown">--}}
                    {{--                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">--}}
                    {{--                                                                <i data-feather="more-vertical"></i>--}}
                    {{--                                                            </button>--}}
                    {{--                                                            <div class="dropdown-menu">--}}
                    {{--                                                                <a class="dropdown-item" href="{{route('admin.evaluations.edit',$e->id)}}">--}}
                    {{--                                                                    <i data-feather="edit-2" class="mr-50"></i>--}}
                    {{--                                                                    <span>{{__('actions.edit')}}</span>--}}
                    {{--                                                                </a>--}}
                    {{--                                                                <a class="dropdown-item" href="{{route('admin.evaluations.show',$e->id)}}">--}}
                    {{--                                                                    <i data-feather="eye" class="mr-50"></i>--}}
                    {{--                                                                    <span>{{__('actions.details')}}</span>--}}
                    {{--                                                                </a>--}}
                    {{--                                                                <a class="dropdown-item" href="javascript:void(0);" onclick="deleteForm({{$e->id}})">--}}
                    {{--                                                                    <i data-feather="trash" class="mr-50"></i>--}}
                    {{--                                                                    <span>{{__('actions.delete')}}</span>--}}
                    {{--                                                                </a>--}}
                    {{--                                                            </div>--}}
                    {{--                                                        </div>--}}
                    {{--                                                    @endif--}}

                    {{--                                                </td>--}}
                    {{--                                            </tr>--}}
                    {{--                                        @endforeach--}}
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{--                                    {{$evaluations->links()}}--}}
            </div>
        </div>
    </div>


@endsection


@push('tab-js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->

    <script>

        $(document).ready(function() {

            $('.select2').select2({
                minimumInputLength:2,
                cache:true,
                ajax: {
                    delay: 250,
                    url: '{{route('admin.students.index')}}',
                    dataType: 'json',
                    data: function (params) {

                        // Query parameters will be ?search=[term]&page=[page]
                        if (params.term && params.term.length > 3)
                        {
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        }

                    },
                    processResults: function ({partners}, params) {
                        params.page = params.page || 1;

                        let fData = $.map(partners.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < partners.total
                            }
                        };
                    }
                }
            });
            $('.select2-selection__arrow').style.display = 'node'
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
                    f.setAttribute('action',`/admin/evaluations/${id}`);

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
