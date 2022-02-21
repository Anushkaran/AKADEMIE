@extends('user.layouts.app')

@push('css')

    @if($resource->type === 3)
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vuexy/app-assets/vendors/css/extensions/plyr.min.css')}}">
    @endif

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
                @if($resource->type === 3)
                    <section id="media-player-wrapper " style="width: 100%">
                        <div class="row d-flex justify-content-center">
                            <!-- VIDEO -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Video</h4>
                                        <div class="video-player" id="plyr-video-player">
                                            <video width="100%" src="{{$resource->full_link}}" controls></video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ VIDEO -->

                            <!--/ AUDIO -->
                        </div>
                    </section>
                @endif
                <div id="viewer2" style="height: 1000px">

                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('assets/pdf-assets/lib/webviewer.min.js')}}"></script>


    @if($resource->type === 3)

        <!-- BEGIN: Page Vendor JS-->
        <script src="{{asset('assets/vuexy/app-assets/vendors/js/extensions/plyr.min.js')}}"></script>
        <script src="{{asset('assets/vuexy/app-assets/vendors/js/extensions/plyr.polyfilled.min.js')}}"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Page JS-->
        <script src="{{asset('assets/vuexy/app-assets/js/scripts/extensions/ext-component-media-player.js')}}"></script>
        <!-- END: Page JS-->
    @endif

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
                licenseKey: 'frdyg8TwT77cCwYrs6sO',
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
                            fontSize: 150 ,// or even smaller size
                            fontFamily: 'sans-serif',
                            color: '#FECC1F',
                            opacity: 10, // from 0 to 100
                            text: 'Lakademie'
                        }});

                });

        }).catch(err => console.error())

    </script>


@endpush
