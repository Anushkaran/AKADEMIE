@extends('partner.layouts.app')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/vuexy/app-assets/vendors/css/forms/select/select2.min.css')}}">
@endpush
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <form action="{{route('partner.settings.absence-sheet.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="customFile">Header Image</label>
                            <div class="custom-file">
                                <input type="file" name="header_image" onchange="imagePreview(this,'header_image_preview')" class="custom-file-input @error('footer_image') is-invalid @enderror" id="header_image" />
                                <label class="custom-file-label" for="header_image">Choose file</label>
                                @error('header_image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>


                        </div>
                        <img  class="img-fluid" id="header_image_preview" src="{{isset($setting)? $setting->header_image_url :asset('assets/vuexy/app-assets/images/logo/logo.png')}}" alt="header image"/>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="customFile">Footer Image</label>
                            <div class="custom-file">
                                <input type="file" name="footer_image" onchange="imagePreview(this,'footer_image_preview')" class="custom-file-input @error('footer_image') is-invalid @enderror" id="footer_image" />
                                <label class="custom-file-label" for="footer_image">Choose file</label>
                                @error('footer_image')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <img  class="img-fluid" id="footer_image_preview" src="{{isset($setting)? $setting->footer_image_url :asset('assets/vuexy/app-assets/images/logo/logo.png')}}" alt="footer image"/>
                    </div>
                </div>
                <div class="row text-center">
                    <button  class="btn btn-primary btn-block btn-lg" type="submit">{{__('actions.save')}}</button>
                </div>
            </form>

        </div>

    </div>
@endsection

@push('js')
    <script>

        const imagePreview = (evt,previewId) => {
            const [file] = evt.files
            if (file) {
                document.getElementById(previewId).src = URL.createObjectURL(file)
            }
        }

    </script>
@endpush
