@extends('admin.evaluations.tab-layout')

@push('tab-css')

    <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/css/pages/app-user.css')}}">

@endpush

@section('tab-content')
    <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">

                    <button class="dt-button create-new btn btn-primary" tabindex="0"
                            aria-controls="DataTables_Table_0"
                            type="button" data-toggle="modal" id="create-btn"
                            data-target="#modals-slide-in">
                        <i data-feather='plus'></i>
                        {{__('actions.add-new',['name' => trans_choice('labels.evaluation-session',1)])}}
                    </button>
                    <!-- Modal -->

                </h4>
            </div>
            <div class="card-body">
                {{--filters--}}
            </div>
            <div class="table-responsive">

                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{__('labels.name')}}</th>
                        <th>{{__('labels.date')}}</th>
                        <th>{{trans_choice('labels.user',1)}}</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ev->sessions as $key => $s)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$s->name}}</td>
                        <td><span class="badge badge-info">{{$s->date->format('d-m-Y')}}</span></td>
                        <td>
                            <strong>
                                {{$s->user->name}}
                                <a href="{{route('admin.users.show',$s->user_id)}}" class="text-decoration-none">
                                    <i data-feather="arrow-up-right"></i>
                                </a>
                            </strong><br>
                            <small>
                                <a href="tel:{{$s->user->phone}}" class="text-decoration-none">
                                    {{$s->user->phone}}
                                    <i data-feather="phone"></i>
                                </a><br>
                                <a href="mailTo:{{$s->user->email}}" class="text-decoration-none">
                                    {{$s->user->email}}
                                    <i data-feather="mail"></i>
                                </a>
                            </small>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteSession({{$ev->id}},{{$s->id}})">
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

    <!-- Modal to add new record -->
    <div class="modal modal-slide-in fade" id="modals-slide-in">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0" method="post"
                  action="{{route('admin.evaluations.sessions.store',$ev->id)}}">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{__('actions.add-new',['name' => trans_choice('labels.evaluation-session',1)])}}
                    </h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="name">{{__('labels.name')}}</label>
                        <input type="text" required name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror dt-full-name" id="name" placeholder="{{__('labels.name')}}  ..."  aria-label="{{__('labels.name')}} ..." />
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="center_id">{{trans_choice('labels.user',2)}}</label>
                        <select name="user_id"
                                id="user_id"
                                class="form-control select2-user @error('user_id') is-invalid @enderror"></select>
                        @error('user_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="start_date">{{__('labels.date')}}</label>
                        <input type="date" required name="date"
                               value="{{old('start_date')}}"
                               class="form-control @error('date') is-invalid @enderror"
                               id="date" placeholder="{{__('labels.start_date')}}
                            ..."  aria-label="{{__('labels.start_date')}} ..." />
                        @error('date')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="note">{{__('labels.note')}} ({{__('labels.optional')}})</label>
                        <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{old('note')}}</textarea>
                        @error('note')
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


@push('tab-js')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/vuexy/app-assets/js/scripts/pages/app-user-view.js')}}"></script>
    <!-- END: Page JS-->

    <script>

        $(document).ready(function() {
            $('.select2-user').select2({
                minimumInputLength:2,
                cache:true,
                ajax: {
                    delay: 250,
                    url: '{{route('admin.users.index')}}',
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
        });

        const deleteSession = (id,sessionID) => {
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
                    f.setAttribute('action',`/admin/evaluations/${id}/sessions/${sessionID}`);

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
