@extends('admin.evaluations.tab-layout')



@section('tab-content')
    <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">

                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#success">
                        <i data-feather='plus'></i>
                        {{trans_choice('actions.add-new',2,['name' => trans_choice('labels.skill',1)])}}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade text-left modal-success" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel110">{{trans_choice('actions.add-new',2,['name' => trans_choice('labels.skill',1)])}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.evaluations.skills.attach',$ev->id)}}" id="attach-skills-form" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="skills">{{trans_choice('labels.skill',3)}}</label>
                                            <select
                                                name="skills[]" multiple
                                                id="skills" class="select2 form-control">

                                            </select>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" disabled class="btn btn-success" onclick="document.getElementById('attach-skills-form').submit()" id="skill-attach-btn">
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
                <section id="accordion-with-margin">
                    <div class="row">
                        @foreach($ev->skills as $key => $s)
                        <div class="col-sm-12">
                            <div class="card collapse-icon" id="myList">
                                <div class="card-header">
                                    <h4 class="card-title">{{$s->name}}</h4>
                                    <button class="btn btn-sm btn-gradient-danger"
                                            onclick="removeSkill({{$ev->id}}),{{$s->id}}">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        {{$s->description}}
                                    </p>
                                    <div class="collapse-margin" id="skill-{{$s->id}}">
                                        @foreach($s->tasks as $t)
                                        <div class="card">
                                            <div class="card-header" id="headingOne" data-toggle="collapse" role="button" data-target="#task-{{$t->id}}" aria-expanded="false" aria-controls="task-{{$t->id}}">
                                                <span class="lead collapse-title"> {{$t->name}} </span>
                                                <div class="heading-elements">
                                                    <span class="badge badge-info">
                                                        {{$t->level->name}}
                                                    </span>
                                                </div>
                                            </div>

                                            <div id="task-{{$t->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#skill-{{$s->id}}">
                                                <div class="card-body">
                                                    {{$t->description}}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
        </div>
    </div>


@endsection


@push('tab-js')


    <script>

        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myList ").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#skills').change(function (){

                if ($('#skills').select2('val').length > 0)
                {
                    $('#skill-attach-btn').removeAttr('disabled')
                }else {
                    $('#skill-attach-btn').attr('disabled',true)
                }
            })
            $('.select2').select2({
                cache:true,
                ajax: {
                    delay: 250,
                    url: '{{route('admin.skills.index')}}',
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
                    processResults: function ({skills}, params) {
                        params.page = params.page || 1;
                        let fData = $.map(skills.data, function (obj) {
                            obj.text = obj.name; // replace name with the property used for the text
                            return obj;
                        });

                        return {
                            results: fData,
                            pagination: {
                                more: (params.page * 10) < skills.total
                            }
                        };
                    }
                }
            });
        });

        const removeSkill = (id,skill) => {
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
                    f.setAttribute('action',`/admin/evaluations/${id}/skills/${skill}`);

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
