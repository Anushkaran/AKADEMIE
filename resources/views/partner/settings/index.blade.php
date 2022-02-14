@extends('partner.layouts.app')
@push('css')


    <link rel="stylesheet" href="{{asset('assets/vuexy/app-assets/vendors/css/forms/select/select2.min.css')}}">

@endpush
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="customFile">Header Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" />
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img  class="img-fluid" src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}" alt="header image"/>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="form-group">
                        <label for="customFile">Footer Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" />
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <img  class="img-fluid" src="{{asset('assets/vuexy/app-assets/images/logo/logo.png')}}" alt="footer image"/>
                </div>
            </div>
            <div class="row text-center">
                <button  class="btn btn-primary btn-block btn-lg" type="submit">{{__('actions.save')}}</button>
            </div>
        </div>

    </div>
@endsection
