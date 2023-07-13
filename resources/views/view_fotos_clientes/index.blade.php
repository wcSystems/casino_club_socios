<!DOCTYPE html>
<html lang="en">
    <style>
        :root {

            /* COLORES DEFAULT */
            /*   --global-1: none !important;        Fondo Template        */
            /*   --global-2: #fff !important;        Fondo Tablas          */
            /*   --global-4: #000 !important;        Color textos tabla    */
            /*   --global-6: #7ef067 !important;     Color primario        */

            --global-2: #000 !important;
            --global-4: #000 !important;
            --global-6: #2986cc !important;
            --global-7: #000 !important;
        }
    </style>
    <style>
        ::placeholder { color: var(--global-2) !important; opacity: 1; }
        :-ms-input-placeholder {  color: var(--global-2) !important; }
        ::-ms-input-placeholder { color: var(--global-2) !important; }
        .btn-1{
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex !important;
            justify-content: space-around;
        }
        .banner-icons{
            justify-content: space-between !important
        }
        .parsley-normal{
            border-color: var(--global-2) !important
        }
        .right-content{
            background-color: var(--global-6) !important
        }
        .navbar-brand:hover{
            color: var(--global-6) !important
        }
        .sidebar{
            background-color: var(--global-7) !important
        }

        /* NEW COLORS */
        /* NEW COLORS */
        /* NEW COLORS */
        /* NEW COLORS */
        /* NEW COLORS */
        /* NEW COLORS */
        .form-control, .form-check-input, input, select {
            background-color: transparent !important;
            border-color: var(--global-6) !important;
            color: #000 !important;
        }
        input[type="checkbox"]{
            border-color: var(--global-6) !important;
        }
        option{
            color: #000 !important;  
        }
        .panel-body{
            background-color: #fff !important;
        }
        i{
            color: #fff !important
        }
        #data-table-default_processing{
            background-color: var(--global-6) !important;
        }

        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }

        input[type=number] { -moz-appearance:textfield;padding:0;text-align: center }
        .swal2-content {
            padding: 0px;
        }

        #data-table-default-stadistic > thead > tr > th:nth-child(n),
        #data-table-default-stadistic > tbody > tr:nth-child(n) > th:nth-child(n),
        #data-table-default-stadistic > tbody > tr:nth-child(n) > td:nth-child(n)
        {
            padding: .12rem !important;
            font-size: 1rem !important;
        }

        .data-table-default-schedule > thead > tr > th:nth-child(n),
        .data-table-default-schedule > tbody > tr:nth-child(n) > th:nth-child(n),
        .data-table-default-schedule > tbody > tr:nth-child(n) > td:nth-child(n)
        {   
            font-size: 0.7rem !important;
        }
        
        .dataTables_wrapper.dt-bootstrap4 .dataTables_paginate .pagination .paginate_button.active a{
            background-color: #000 !important;
        }
        .page-link{
            color: #fff !important;
            background-color: var(--global-6) !important
        }
        .page-link:hover{
            background-color: #000 !important;
        }
        
        .page-item.disabled .page-link{
            opacity: 0.7 !important;
        }
        .header .navbar-user img{float:left;width:30px;height:30px;margin:-5px 0px -5px 0;-webkit-border-radius:30px;border-radius:30px}

        .bg-verde{
            background-color: rgba(0, 255, 0, 0.06) !important
        }
        .bg-rojo{
            background-color: rgba(255, 0, 0, 0.06) !important
        }
        .bg-verde-oscuro{
            background-color: rgba(0, 255, 0, 0.2) !important
        }
        .bg-rojo-oscuro{
            background-color: rgba(255, 0, 0, 0.2) !important
        }
        .bg-gris{
            background-color: rgba(0, 0, 0, 0.1) !important
        }

        #centro{
            height: calc( 100vh - 40px ) !important;
            width: calc( 100vw ) !important
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> {!! $clasificacion_cliente_casino->name !!}   </title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" integrity="sha512-42PE0rd+wZ2hNXftlM78BSehIGzezNeQuzihiBCvUEB3CVxHvsShF86wBWwQORNxNINlBPuq7rG4WWhNiTVHFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link href="{{ asset('css/filepond/filepond.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/transparent/app.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('plugins/sweetalert/dist/sweetalert.min.css') }}" rel="stylesheet">
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/autotable/jspdf.js') }}"></script>
        <script src="{{ asset('js/autotable/autotable.js') }}"></script>
        <meta name="description" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}, Sede: {!! $sede->name !!}">
        <!-- Google / Search Engine Tags -->
        <meta itemprop="name" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}">
        <meta itemprop="description" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}, Sede: {!! $sede->name !!}">
        <meta itemprop="image" content="{{asset('img/logo_wisi.png')}}">
        <!-- Facebook Meta Tags -->
        <meta property="og:url" content="www.casinosroraima.com">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}">
        <meta property="og:description" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}, Sede: {!! $sede->name !!}">
        <meta property="og:image" content="{{asset('img/logo_wisi.png')}}">
        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}">
        <meta name="twitter:description" content="Carpeta: {!! $clasificacion_cliente_casino->name !!}, Sede: {!! $sede->name !!}">
        <meta name="twitter:image" content="{{asset('img/logo_wisi.png')}}">
    </head>
    <body>
        <div class="panel panel-inverse" data-sortable-id="table-basic-1">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title text-center" id="title-schedule">
                {!! $clasificacion_cliente_casino->name !!}, Sede: {!! $sede->name !!}
                </h4>
            </div>
            <div id="centro" class="panel-body p-0 d-flex align-self-center" >
                <div  class="row d-flex justify-content-center m-auto container">
                    @foreach( $clientes_casinos as $item )
                    <div class="m-auto text-center p-5">
                        <img onclick="previewIMG({!! $item->id !!})" class="rounded-circle" src='/public/clientes_casinos/{!! $item->id !!}.jpg' width="150" height="150" onerror="this.onerror=null;this.src='public/users/null.jpg';" />
                        <div class="font-weight-bold mt-1">{!! $item->name !!}</div>
                        <div>Carpeta: {!! $item->clasificacion_cliente_casino_name !!}, Sexo: {!! $item->sex_name !!}</div>
                        <div class="font-weight-bold">Sede: {!! $item->sede_name !!}</div>
                        <div class="my-2"> <span class="font-weight-bold" > Noveda:</span> {!! $item->description !!} </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
    <script>
        function previewIMG(id) {
            let current={!! $clientes_casinos !!}.find(i=>i.id==id)
            Swal.fire({
                showConfirmButton: true,
                showCloseButton: true,
                confirmButtonText: 'CERRAR',
                html: `<div class="col-xs-12" >
                    <img class="rounded-circle" src='/public/clientes_casinos/${current.id}.jpg' width="200" height="200" onerror="this.onerror=null;this.src='public/users/null.jpg';" />
                    <div class="font-weight-bold">${current.name}</div>
                    <div>Carpeta: ${ current.clasificacion_cliente_casino_name }</div>
                    <div>Sexo: ${ current.sex_name }</div>
                    <div class="font-weight-bold">Sede: ${current.sede_name}</div>
                    <div class="my-2"> <span class="font-weight-bold" > Noveda:</span>  ${current.description} </div>
                </div>`
            })
        }
    </script>
</html>