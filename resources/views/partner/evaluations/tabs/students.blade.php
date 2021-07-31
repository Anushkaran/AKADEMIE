@extends('shop.evaluations.tab-layout')

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
                                    <form action="{{route('admin.evaluations.students.attach',$ev->id)}}" id="attach-students-form" method="post">
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
                                    <button type="button" disabled  class="btn btn-success" id="students-attach-btn"
                                            onclick="document.getElementById('attach-students-form').submit()">
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
                <div class="form-group">
                    <input type="text" id="search" class="form-control" >
                </div>
            </div>
            <div class="table-responsive">

                <table class="table" id="myList">
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
                    @foreach($ev->students as $key => $s)
                    <tr>
                        <td>{{$key + 1 }}</td>
                        <td>{{$s->name}}</td>
                        <td>
                            <strong>
                                <a href="tel:{{$s->phone}}" class="text-decoration-none">
                                    <i data-feather="phone"></i>
                                    {{$s->phone}}
                                </a>
                            </strong>
                        </td>
                        <td>
                            <strong>
                                <a href="mailto:{{$s->email}}" class="text-decoration-none">
                                    <i data-feather="mail"></i>
                                    {{$s->email}}
                                </a>
                            </strong>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger"
                                    onclick="removeStudent({{$ev->id}},{{$s->id}})">
                                <i data-feather="trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach

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

            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList td").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#students').change(function (){

                if ($('#students').select2('val').length > 0)
                {
                    $('#students-attach-btn').removeAttr('disabled')
                }else {
                    $('#students-attach-btn').attr('disabled',true)
                }
            })

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
                    processResults: function ({students}, params) {
                        params.page = params.page || 1;

                        let fData = $.map(students.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < students.total
                            }
                        };
                    }
                }
            });
            $('.select2-selection__arrow').style.display = 'node'
        });

        const removeStudent = (id,student) => {
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
                    f.setAttribute('action',`/admin/evaluations/${id}/students/${student}`);

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
