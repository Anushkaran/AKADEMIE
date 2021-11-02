@extends('user.layouts.app')

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">accueil</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gestionnaire de fichiers
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div id="viewer">
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>




    <script>





        let link = `/files/{{$resource->id}}`

        let iframe = document.createElement('iframe');
        iframe.id = 'iframe-viewer'

        axios({
            url: link,
            method: 'GET',
            responseType: 'blob',
        }).then(res => {
            let blob = new Blob([res.data] ,{type:"application/pdf"})
            let url = window.URL.createObjectURL(blob);
            @if($resource->access === 1)
                iframe.src = `${url}#toolbar=0`
            @else
                iframe.src = `${url}`
            @endif
            iframe.height = "500px";
            iframe.width = "100%";
            document.getElementById('viewer').append(iframe)

        }).catch(err => console.error())

    

    </script>


@endpush
