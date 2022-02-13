<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/vuexy/app-assets/css/bootstrap.css')}}">

    <title>Document</title>
    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            margin: 36pt;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }
        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }
        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }
        .text-right {
            text-align: right !important;

        }
        .text-left {
            text-align: left !important;

        }
        .text-center {
            text-align: center !important;
        }
        .text-uppercase {
            text-transform: uppercase !important;
        }


        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }
        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }
        .border-0 {
            border: none !important;
        }
        .cool-gray {
            color: #6B7280;
        }
        .align-content-end {
            -webkit-align-content: flex-end !important;
            -ms-flex-line-pack: end !important;
            align-content: flex-end !important;
        }

        .align-content-center {
            -webkit-align-content: center !important;
            -ms-flex-line-pack: center !important;
            align-content: center !important;
        }

    </style>
</head>
<header>
    <img width="100%" src="{{asset('assets/app-assets/images/logo/logo.png')}}" alt="Invoice logo">

</header>
<body>

<div class="container bootdey">
    <div class="row invoice row-printable">

        <div class="col-md-10">
            <!-- col-lg-12 start here -->
            <div class="panel panel-default plain" id="dash_0">
                <!-- Start .panel -->
                <div class="panel-body ">
                    <div class="row">
                        <!-- Start .row -->

                    </div>


                    <div class="row">
                        <!-- col-lg-6 end here -->
                        <div class="col-lg-12">
                            <!-- col-lg-12 start here -->
                            <div class="invoice-details mt25">
                                <div class="text-center">

                                    <ul class="list-unstyled mb-4 ">
                                        <li>
                                            <h4> <strong>FEUILLE D'EMARGEMENT</strong></h4>
                                            <hr>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <ul class="list-unstyled mb-4 ">
                                        <li><strong>{{__('labels.center')}} </strong> .........</li>
                                        <li><strong>{{__('labels.formation_name')}} </strong>  ..........</li>
                                        <li><strong>{{__('labels.date')}} </strong>  .../.../....</li>
                                        <li><strong>{{__('labels.duration')}} </strong>  .../.../.... </li>
                                        <li><strong>Sur </strong> ... <strong> Jours </strong> </li>

                                    </ul>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <ul class="list-unstyled mb-4 ">

                                    </ul>
                                </div>
                            </div>

                            <div class="invoice-items">
                                <div class="table-responsive" style="overflow: hidden; outline: none;" tabindex="0">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="per5 text-center">{{__('labels.name')}} </th>
                                            <th class="per70 text-center">8H30 à 12h</th>
                                            <th class="per70 text-center">12H45 à 16h15</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td class="per70 text-center"></td>
                                                <td class="per70 text-center"></td>
                                                <td class="per70 text-center"></td>

                                            </tr>


                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                    <h3>Animateur(s)</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="per5 text-center">{{__('labels.name')}} </th>
                                            <th class="per70 text-center">8H30 à 12h</th>
                                            <th class="per70 text-center">12H45 à 16h15</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>

                                            <td class="per70 text-center"></td>
                                            <td class="per70 text-center"></td>
                                            <td class="per70 text-center"></td>

                                        </tr>


                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End .row -->
                </div>
            </div>
            <!-- End .panel -->
        </div>


        <!-- col-lg-12 end here -->
    </div>
</div>
<div class="col-md-12" style="margin-top: 40px!important; ">

</div>
<footer style="margin-bottom: 0px!important;">
    <img width="100%" src="{{asset('assets/app-assets/images/logo/logo.png')}}" alt="Invoice logo">

</footer>
<script src="{{asset('assets/app-assets/vendors/js/bootstrap.min.js')}}">
</script>

</body>
</html>
