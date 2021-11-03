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

                <div id="viewer2" style="height: 1000px">

                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



    <script src='/assets/pdf-assets/lib/webviewer.min.js'></script>



    <script>





        let link = `/files/{{$resource->id}}`

        //let iframe = document.createElement('iframe');
        let body = document.get;

        //iframe.id = 'iframe-viewer'

        axios({
            url: link,
            method: 'GET',
            responseType: 'blob',
        }).then(res => {
            let blob = new Blob([res.data] ,{type:"application/pdf"})
            let url = window.URL.createObjectURL(blob);

            //testing

            WebViewer({
                path: '/assets/pdf-assets/lib/', // path to the PDF.js Express'lib' folder on your server
                licenseKey: 'vxvCk7m9x1xTEKn7nfo1',
                initialDoc: url,


                // initialDoc: '/path/to/my/file.pdf',  // You can also use documents on your server
            }, document.getElementById('viewer2'))
                .then(instance => {
                    // now you can access APIs through the WebViewer instance
                    const { Core, UI } = instance;

                    // adding an event listener for when a document is loaded
                    Core.documentViewer.addEventListener('documentLoaded', () => {
                        console.log('document loaded');
                    });

                    // adding an event listener for when the page number has changed
                    Core.documentViewer.addEventListener('pageNumberUpdated', (pageNumber) => {
                        console.log(`Page number is: ${pageNumber}`);
                    });
                    @if($resource->access === 2)
                        UI.enableElements([  'downloadButton' ]);
                        UI.enableElements([  'printButton' ]);
                        @else
                        UI.disableElements([  'printButton' ]);
                        UI.disableElements([  'downloadButton' ]);

                    @endif

                    Core.documentViewer.setWatermark({
                        // Draw diagonal watermark in middle of the document
                        diagonal: {
                            fontSize: 200, // or even smaller size
                            fontFamily: 'sans-serif',
                            color: 'yellow',
                            opacity: 10, // from 0 to 100
                            text: 'Lakademie'
                        }});

                });



        }).catch(err => console.error())






    </script>


@endpush
