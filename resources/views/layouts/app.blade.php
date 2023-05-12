<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>WISI</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <link rel="apple-touch-icon" href="{{asset('img/logo_wisi.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo_wisi.png')}}">


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
            --global-8: #EDEDED !important;
        }
    </style>
    <link href="{{ asset('css/filepond/filepond.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/transparent/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/sweetalert/dist/sweetalert.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/autotable/jspdf.js') }}"></script>
    <script src="{{ asset('js/autotable/autotable.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/solid.min.css" integrity="sha512-qzgHTQ60z8RJitD5a28/c47in6WlHGuyRvMusdnuWWBB6fZ0DWG/KyfchGSBlLVeqAz+1LzNq+gGZkCSHnSd3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')

    {{-- ESTILOS DE CONFIGURACION GLOBAL - SEPARAR EN ARCHIVO- --}}
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
        /* .form-control, .form-check-input, input, select {
            background-color: transparent !important;
            border-color: var(--global-6) !important;
            color: #000 !important;
        } */
        input[type="checkbox"]{
            border-color: var(--global-6) !important;
        }
        option{
            color: #000 !important;  
        }
        .panel-body{
            background-color: #FFFFFFF2 !important;
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
            font-size: 0.8rem !important;
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

        
    </style>

</head>
<body>
    <div class="page-cover" style="background-image: url('{{ asset('img/login-bg/login-bg-11.jpg') }}');"></div>
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <div id="page-container" class="fade page-sidebar-fixed ">
        <div id="header" class="header navbar-default d-flex">
            
            <div class="navbar-header">
                
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <b class="navbar-brand font-weight-bold">CASINO</b>
            </div>

            <ul class="navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="image image-icon bg-black text-grey-darker">
                            <img class="rounded-circle" src="{{ url('public/users/'.Auth::user()->id.'.jpg') }}" onerror="this.onerror=null;this.src='public/users/null.jpg';"  />
                        </div>
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                       
                    </div>
                </li>
            </ul>

        </div>
        <div id="sidebar" class="sidebar">

            <div data-scrollbar="true" data-height="100%" class="banner-icons">

                    <!-- TODOS -->
                    <ul class="nav " data-click="pr-0">
                    <li class="nav-header" style="color: #fff !important">GRAFICOS</li>
                    <li id="graphics_nav" class="has-sub closed">
                        <a href="{{ route('graphics') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">QR</span>
                        </a>
                    </li>

                    <!-- DESARROLLADOR / ADMINISTRADOR -->
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 2 )
                        <li class="nav-header" style="color: #fff !important">MODULO CUMPLIMIENTO</li>
                        <li id="clients_nav" class="has-sub closed">
                            <a href="{{ route('clients') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">CLIENTES</span>
                            </a>
                        </li>
                        <li class="nav-header" style="color: #fff !important">MODULO ESTADISTICA</li>
                        <li id="counting_table_stadistics_nav" class="has-sub closed">
                            <a href="{{ route('counting_table_stadistics') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">CONTEO DE MESAS</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / ADMINISTRADOR / MAQUINAS -->
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 11 )
                        <li class="nav-header" style="color: #fff !important">MODULO MAQUINAS</li>
                        <li id="global_warehouses_nav" class="has-sub closed">
                            <a href="{{ route('global_warehouses') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">ALMACEN GLOBAL</span>
                            </a>
                        </li>
                        <li id="all_machines_nav" class="has-sub closed">
                            <a href="{{ route('all_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">NOVEDADES</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / ADMINISTRADOR -->
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 2 )
                        <li class="nav-header" style="color: #fff !important">MODULO A&B</li>
                        <li id="ayb_commands_nav" class="has-sub closed">
                            <a href="{{ route('ayb_commands') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">COMANDAS</span>
                            </a>
                        </li>
                        <li id="ayb_items_nav" class="has-sub closed">
                            <a href="{{ route('ayb_items') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">MENÚS</span>
                            </a>
                        </li>
                        <li id="ayb_records_nav" class="has-sub closed">
                            <a href="{{ route('ayb_records') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">HISTORICO</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / ADMINISTRADOR / RRHH -->
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 12 )
                        <li class="nav-header" style="color: #fff !important">MODULO RRHH</li>
                        <li id="attlogs_nav" class="has-sub closed">
                            <a href="{{ route('attlogs') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">MARCAJES</span>
                            </a>
                        </li>
                        <li id="employees_nav" class="has-sub closed">
                            <a href="{{ route('employees') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">EMPLEADOS</span>
                            </a>
                        </li>
                        <li id="year_month_groups_nav" class="has-sub closed">
                            <a href="{{ route('year_month_groups') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">HORARIOS</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / ADMINISTRADOR / CECOM -->
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 6 )
                        <li class="nav-header" style="color: #fff !important">MODULO CECOM</li>
                        <li id="group_drops_casinos_nav" class="has-sub closed">
                            <a href="{{ route('group_drops_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">DROP</span>
                            </a>
                        </li>
                        <li id="group_archings_casinos_nav" class="has-sub closed">
                            <a href="{{ route('group_archings_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">ARQUEO</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / ADMINISTRADOR / BOVEDA -->
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 15 )
                        <li class="nav-header" style="color: #fff !important">MODULO BOVEDA</li>
                        <li id="cierre_mesas_nav" class="has-sub closed">
                            <a href="{{ route('cierre_mesas') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">CIERRE MESAS</span>
                            </a>
                        </li>
                        <li class="nav-header" style="color: #fff !important">CONFIGURACION BOVEDA</li>
                        <li id="mes2as_casinos_nav" class="has-sub closed">
                            <a href="{{ route('mesas_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">VENTANILLA INICIAL</span>
                            </a>
                        </li>
                        
                        <li id="metodo_pago_nav" class="has-sub closed">
                            <a href="{{ route('metodo_pagos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">METODOS DE PAGO</span>
                            </a>
                        </li>
                        <li id="bancada_casino_nav" class="has-sub closed">
                            <a href="{{ route('bancada_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">BANCADA SEDE</span>
                            </a>
                        </li>
                        <li id="mesas_casinos_nav" class="has-sub closed">
                            <a href="{{ route('mesas_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">MESAS CON BANCA</span>
                            </a>
                        </li>
                        <li id="fichas_casinos_nav" class="has-sub closed">
                            <a href="{{ route('fichas_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">FICHAS</span>
                            </a>
                        </li>
                        <li id="billetes_casinos_nav" class="has-sub closed">
                            <a href="{{ route('billetes_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">BILLETES</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR -->                    
                    @if( Auth::user()->level_id == 1 )
                        <li class="nav-header" style="color: #fff !important">CONFIGURACIONES A&B</li>
                        <li id="group_menus_nav" class="has-sub closed">
                            <a href="{{ route('group_menus') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">GRUPO DE MENUS</span>
                            </a>
                        </li>
                        <li id="type_commands_nav" class="has-sub closed">
                            <a href="{{ route('type_commands') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">TIPOS DE COMANDAS</span>
                            </a>
                        </li>
                        <li id="tables_nav" class="has-sub closed">
                            <a href="{{ route('tables') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">DESTINOS</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / MAQUINAS -->  
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 11 )
                        <li class="nav-header" style="color: #fff !important">CONFIGURACION MAQUINAS</li>
                        <li id="rooms_nav" class="has-sub closed">
                            <a href="{{ route('rooms') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">SALAS / GALPONES</span>
                            </a>
                        </li>
                        <li id="condicion_groups_nav" class="has-sub closed">
                            <a href="{{ route('condicion_groups') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">CONDICIONES</span>
                            </a>
                        </li>
                        <li id="novedades_types_nav" class="has-sub closed">
                            <a href="{{ route('novedades_types') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">TIPOS DE NOVEDADES</span>
                            </a>
                        </li>
                        <li id="brand_machines_nav" class="has-sub closed">
                            <a href="{{ route('brand_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">MARCAS</span>
                            </a>
                        </li>
                        <li id="model_machines_nav" class="has-sub closed">
                            <a href="{{ route('model_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">MODELOS</span>
                            </a>
                        </li>
                        <li id="range_machines_nav" class="has-sub closed">
                            <a href="{{ route('range_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">RANGOS</span>
                            </a>
                        </li>
                        <li id="associated_machines_nav" class="has-sub closed">
                            <a href="{{ route('associated_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">ASOCIADOS / INVITADOS</span>
                            </a>
                        </li>
                        <li id="value_machines_nav" class="has-sub closed">
                            <a href="{{ route('value_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">DENOMINACIONES</span>
                            </a>
                        </li>
                        <li id="play_machines_nav" class="has-sub closed">
                            <a href="{{ route('play_machines') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">JUEGOS</span>
                            </a>
                        </li>
                    @endif

                    <!-- DESARROLLADOR / RRHH -->  
                    @if( Auth::user()->level_id == 1 || Auth::user()->level_id == 12 )
                        <li class="nav-header" style="color: #fff !important">CONFIGURACIONES RRHH</li>
                        <li id="departments_nav" class="has-sub closed">
                            <a href="{{ route('departments') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">DEPARTAMENTOS</span>
                            </a>
                        </li>
                        <li id="positions_nav" class="has-sub closed">
                            <a href="{{ route('positions') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">CARGOS</span>
                            </a>
                        </li>
                        <li id="horarios_nav" class="has-sub closed">
                            <a href="{{ route('horarios') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">HORAS DE ENTRADA</span>
                            </a>
                        </li>
                    @endif

                    @if( Auth::user()->level_id == 1 )
                        <li class="nav-header" style="color: #fff !important">CONFIGURACIONES CASINO</li>
                        
                        <li id="horas_casinos_nav" class="has-sub closed">
                            <a href="{{ route('horas_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">HORAS CONTEO</span>
                            </a>
                        </li>
                        <li class="nav-header" style="color: #fff !important">CONFIGURACIONES OTROS</li>
                        <li id="users_nav" class="has-sub closed">
                            <a href="{{ route('users') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">USUARIOS</span>
                            </a>
                        </li>
                        <li id="device_hikvision_facial_casinos_nav" class="has-sub closed">
                            <a href="{{ route('device_hikvision_facial_casinos') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">FACIALES HIKVISION</span>
                            </a>
                        </li>
                        <li id="levels_nav" class="has-sub closed">
                            <a href="{{ route('levels') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">NIVELES</span>
                            </a>
                        </li>
                        <li id="domains_nav" class="has-sub closed">
                            <a href="{{ route('domains') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">DOMINIOS</span>
                            </a>
                        </li>
                        <li id="sedes_nav" class="has-sub closed">
                            <a href="{{ route('sedes') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">SEDES</span>
                            </a>
                        </li>
                        <li id="sexs_nav" class="has-sub closed">
                            <a href="{{ route('sexs') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">SEXOS</span>
                            </a>
                        </li>
                        <li id="emails_nav" class="has-sub closed">
                            <a href="{{ route('emails') }}">
                                <i class="fas fa-circle text-white"></i>
                                <span class="text-white">CORREOS</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
        <div class="sidebar-bg"></div>
        <div id="content" class="content">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/theme/transparent.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/min/moment.min.js') }}"></script>


    <script src="{{ asset('js/chart.js/chart.js') }}"></script>
    <script src="{{ asset('js/xlsx/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('js/filepond/filepond.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.2/axios.min.js" integrity="sha512-bHeT+z+n8rh9CKrSrbyfbINxu7gsBmSHlDCb3gUF1BjmjDzKhoKspyB71k0CIRBSjE5IVQiMMVBgCWjF60qsvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    




    {{-- pasar estos script aparte para que sean globales --}}
    <script>



        moment.locale('en', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
        });

        
        function dataTable(url,columns,group_name_all, order_by) {
            $(document).ready(function() {
                let table = $('#data-table-default').DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    responsive: true,
                    processing: true,
                    lengthChange: true,
                    columns: columns,
                    order: (order_by) ? order_by : [],
                    drawCallback: function (settings) {
                        ajaxReloadDatatablesFN(settings.aoData.map( i => i._aData ))
                        if(group_name_all){
                            var api = this.api();
                            var rows = api.rows({ page: 'current' }).nodes();
                            var last = null;
                            api.rows({ page: 'current' }).data().each(function (data, i) {
                                if (last !== data.group_name) {
                                    $(rows).eq(i).before(`<tr class="group_name font-weight-bold"><td colspan="${columns.length}">` + data.group_name + `</td></tr>`);
                                    last = data.group_name;
                                }
                            });
                        }
                    },







                    ajax: {
                        "url": url,
                        "data": function (d) {[
                            d.search = $('#search').val(),

                            d.user_data = {!! Auth::user() !!},

                            d.search_transportation = $('#search_transportation').val(),
                            d.search_brands = $('#search_brands').val(),
                            d.search_sede_all = $('#search_sede_all').val(),
                            d.search_sede_machines = $('#search_sede_machines').val(),
                            d.search_brand_machines = $('#search_brand_machines').val(),
                            d.search_model_machines = $('#search_model_machines').val(),
                            d.search_range_machines = $('#search_range_machines').val(),
                            d.search_associated_machines = $('#search_associated_machines').val(),
                            d.search_value_machines = $('#search_value_machines').val(),
                            d.search_play_machines = $('#search_play_machines').val(),

                            d.search_sede_employees = $('#search_sede_employees').val(),
                            d.search_department_employees = $('#search_department_employees').val(),
                            d.search_position_employees = $('#search_position_employees').val(),
                            d.search_sex_employees = $('#search_sex_employees').val(),
                            d.search_rooms = $('#search_rooms').val(),
                            d.search_rooms_selects = $('#search_rooms_selects').val(),
                            d.search_asocciates_selects = $('#search_asocciates_selects').val(),
                            d.search_room_select = $('#search_room_select').val(),
                            d.search_condicion_select = $('#search_condicion_select').val(),

                            d.search_type_group_associated = $('#search_type_group_associated').val(),
                            d.search_type_group_room = $('#search_type_group_room').val(),
                            d.search_associated_select = $('#search_associated_select').val(),
                            d.search_brand_machines_select = $('#search_brand_machines_select').val(),
                            d.search_model_machines_select = $('#search_model_machines_select').val(),
                            d.search_novedad_select = $('#search_novedad_select').val(),

                            d.search_club_vip = $("#search_club_vip:checked").val() ? "1" : undefined,
                            d.search_referido = $("#search_referido:checked").val() ? "1" : undefined,
                            d.search_vive_cerca = $("#search_vive_cerca:checked").val() ? "1" : undefined,
                            d.search_trabaja_cerca = $("#search_trabaja_cerca:checked").val() ? "1" : undefined,
                            d.search_solo_de_paso = $("#search_solo_de_paso:checked").val() ? "1" : undefined,
                            d.search_descuento = $("#search_descuento:checked").val() ? "1" : undefined,
                            d.search_puntos_por_canje = $("#search_puntos_por_canje:checked").val() ? "1" : undefined,
                            d.search_ticket_souvenirs = $("#search_ticket_souvenirs:checked").val() ? "1" : undefined,
                            d.search_machine = $("#search_machine:checked").val() ? "1" : undefined,
                            d.search_table = $("#search_table:checked").val() ? "1" : undefined,
                        ]},
                        /* success: function (res) {
                            console.log(res)
                        } */
                    },
                    language: {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "emptyTable":  "Sin datos disponibles",
                        "zeroRecords": "Ningun resultado encontrado",
                        "info": "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                        "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "infoEmpty": "Ningun valor disponible",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":     "Buscar",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                    }
                }).on( 'processing.dt', function ( e, settings, processing ) {
                    
                    if(processing){ console.log() }else{ }
                });

                $("#search").keyup( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_transportation").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                $("#search_sede_all").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_sede_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_brand_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_model_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_range_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_associated_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_value_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_play_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                


                $("#search_sede_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_department_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_position_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_sex_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_rooms").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_rooms_selects").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_asocciates_selects").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_condicion_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                $("#search_type_group_associated").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_type_group_room").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_associated_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_room_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_brand_machines_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_model_machines_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_novedad_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                



                $("#search_brands").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_club_vip").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_referido").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_vive_cerca").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_trabaja_cerca").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_solo_de_paso").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_descuento").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_puntos_por_canje").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_souvenirs").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_machine").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_table").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });

            });
            
        }
        function dataTableDinamic(url,columns,group_name_all,id_data, order_by) {
            $(document).ready(function() {
                let table = $(`#${id_data}`).DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    responsive: true,
                    processing: true,
                    lengthChange: true,
                    columns: columns,
                    order: (order_by) ? order_by : [],
                    drawCallback: function (settings) {
                        ajaxReloadDatatablesFN(settings.aoData.map( i => i._aData ))
                        if(group_name_all){
                            var api = this.api();
                            var rows = api.rows({ page: 'current' }).nodes();
                            var last = null;
                            api.rows({ page: 'current' }).data().each(function (data, i) {
                                if (last !== data.group_name) {
                                    $(rows).eq(i).before(`<tr class="group_name font-weight-bold"><td colspan="${columns.length}">` + data.group_name + `</td></tr>`);
                                    last = data.group_name;
                                }
                            });
                        }
                    },







                    ajax: {
                        "url": url,
                        "data": function (d) {[
                            d.search = $('#search').val(),
                            d.search_transportation = $('#search_transportation').val(),
                            d.search_brands = $('#search_brands').val(),
                            d.search_sede_all = $('#search_sede_all').val(),
                            d.search_sede_machines = $('#search_sede_machines').val(),
                            d.search_brand_machines = $('#search_brand_machines').val(),
                            d.search_model_machines = $('#search_model_machines').val(),
                            d.search_range_machines = $('#search_range_machines').val(),
                            d.search_associated_machines = $('#search_associated_machines').val(),
                            d.search_value_machines = $('#search_value_machines').val(),
                            d.search_play_machines = $('#search_play_machines').val(),

                            d.search_sede_employees = $('#search_sede_employees').val(),
                            d.search_department_employees = $('#search_department_employees').val(),
                            d.search_position_employees = $('#search_position_employees').val(),
                            d.search_sex_employees = $('#search_sex_employees').val(),
                            d.search_rooms = $('#search_rooms').val(),
                            d.search_rooms_selects = $('#search_rooms_selects').val(),
                            d.search_asocciates_selects = $('#search_asocciates_selects').val(),
                            d.search_room_select = $('#search_room_select').val(),
                            d.search_condicion_select = $('#search_condicion_select').val(),

                            d.search_type_group_associated = $('#search_type_group_associated').val(),
                            d.search_type_group_room = $('#search_type_group_room').val(),
                            d.search_associated_select = $('#search_associated_select').val(),
                            d.search_brand_machines_select = $('#search_brand_machines_select').val(),
                            d.search_model_machines_select = $('#search_model_machines_select').val(),
                            d.search_novedad_select = $('#search_novedad_select').val(),

                            d.search_club_vip = $("#search_club_vip:checked").val() ? "1" : undefined,
                            d.search_referido = $("#search_referido:checked").val() ? "1" : undefined,
                            d.search_vive_cerca = $("#search_vive_cerca:checked").val() ? "1" : undefined,
                            d.search_trabaja_cerca = $("#search_trabaja_cerca:checked").val() ? "1" : undefined,
                            d.search_solo_de_paso = $("#search_solo_de_paso:checked").val() ? "1" : undefined,
                            d.search_descuento = $("#search_descuento:checked").val() ? "1" : undefined,
                            d.search_puntos_por_canje = $("#search_puntos_por_canje:checked").val() ? "1" : undefined,
                            d.search_ticket_souvenirs = $("#search_ticket_souvenirs:checked").val() ? "1" : undefined,
                            d.search_machine = $("#search_machine:checked").val() ? "1" : undefined,
                            d.search_table = $("#search_table:checked").val() ? "1" : undefined,
                        ]},
                        /* success: function (res) {
                            console.log(res)
                        } */
                    },
                    language: {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "emptyTable":  "Sin datos disponibles",
                        "zeroRecords": "Ningun resultado encontrado",
                        "info": "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                        "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "infoEmpty": "Ningun valor disponible",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":     "Buscar",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                    }
                }).on( 'processing.dt', function ( e, settings, processing ) {
                    
                    if(processing){ console.log() }else{ }
                });

                $("#search").keyup( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_transportation").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                $("#search_sede_all").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_sede_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_brand_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_model_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_range_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_associated_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_value_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_play_machines").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                


                $("#search_sede_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_department_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_position_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_sex_employees").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_rooms").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_rooms_selects").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_asocciates_selects").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_condicion_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                $("#search_type_group_associated").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_type_group_room").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_associated_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_room_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_brand_machines_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_model_machines_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_novedad_select").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                



                $("#search_brands").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_club_vip").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_referido").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_vive_cerca").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_trabaja_cerca").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_solo_de_paso").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_descuento").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_puntos_por_canje").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_souvenirs").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_machine").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_table").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });

            });
            
        }
        
        function validateForm(){
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        }
        function ajaxReloadDatatablesFN(all){ }  
        function elim(route,id) {
            let timerInterval 
            Swal.fire({
                title: 'Estás seguro?',
                text: 'No serás capaz de recuperar el registro a borrar!',
                icon: 'error',
                showCancelButton: false
            }).then((result) => {
                
                if (result.isConfirmed) {
                    setLoading(timerInterval)
                    $.ajax({
                        url: `${location.origin}/${route}/${id}`,
                        type: "DELETE",
                        data: {
                            "_token": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (res) {
                            if(res.type === 'success'){
                                clearInterval(timerInterval)
                                location.reload();
                            }
                        }
                    });
                }
            });
        };

        function excelExport(title,dl,fn) {
            let user = {!! Auth::user() !!}
            var elt = document.getElementById('data-table-default');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "listado" });
                wb["Sheets"]["listado"]["!cols"] = [{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 },{ wpx : 150 }];

            return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ( user.name+'-'+title+'-'+moment().format('MMMM Do YYYY, h:mm:ss a')+'.'+('xlsx' || 'xlsx')));
        }
        function pdfExport(title,quitar) {
                let user = {!! Auth::user() !!}
                var doc = new jsPDF()

                let jsonTabla = doc.autoTableHtmlToJson(document.getElementById("data-table-default"));
                   
                    
                    if( !quitar ){
                        jsonTabla.columns = jsonTabla.columns.splice(0,jsonTabla.columns.length-1)
                        jsonTabla.data.map( i => ( i.length > 1 ) ? i.splice(i.length-1) : i )
                    }else{
                        jsonTabla.columns = jsonTabla.columns
                    }

                let tabla = doc.autoTable(jsonTabla.columns,jsonTabla.data,{})

                doc.save(`${user.name}-${title}-${moment().format('MMMM Do YYYY, h:mm:ss a')}.pdf`)

                
        }

        function alertas(title,text,mode) {
            Swal.fire({
                title: title,
                text: text,
                icon: mode,
                showCancelButton: false
            })
        }
        
      
        
        /* View in fullscreen */
        function openFullscreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.webkitRequestFullscreen) { /* Safari */
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) { /* IE11 */
                document.documentElement.msRequestFullscreen();
            }
        }

        /* Close fullscreen */
        function closeFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) { /* Safari */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE11 */
                document.msExitFullscreen();
            }
        }

        function dataTableAttlog(url,columns,group_name_all) {
            $(document).ready(function() {
                let table = $('#data-table-default').DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    responsive: true,
                    processing: true,
                    lengthChange: true,
                    order: [[0, 'desc']],
                    columns: columns,
                    drawCallback: function (settings) {
                        if(group_name_all){
                            var api = this.api();
                            var rows = api.rows({ page: 'current' }).nodes();
                            var last = null;
                            api.rows({ page: 'current' }).data().each(function (data, i) {
                                if (last !== data.date) {
                                    $(rows).eq(i).before(`<tr class="authDate"><td colspan="${columns.length}">FECHA: ` + data.date + "<span class='font-weight-bold'> ( "+ moment(data.date).format('dd') +" ) </span>"+ '</td></tr>');
                                    last = data.date;
                                }
                            });
                        }
                    },







                    ajax: {
                        "url": url,
                        "data": function (d) {[
                            d.search = $('#search').val(),
                            d.start = $('#start').val(),
                            d.end = $('#end').val(),
                            d.search_transportation = $('#search_transportation').val(),
                            d.search_club_vip = $("#search_club_vip:checked").val() ? "1" : undefined,
                            d.search_referido = $("#search_referido:checked").val() ? "1" : undefined,
                            d.search_vive_cerca = $("#search_vive_cerca:checked").val() ? "1" : undefined,
                            d.search_trabaja_cerca = $("#search_trabaja_cerca:checked").val() ? "1" : undefined,
                            d.search_solo_de_paso = $("#search_solo_de_paso:checked").val() ? "1" : undefined,
                            d.search_descuento = $("#search_descuento:checked").val() ? "1" : undefined,
                            d.search_puntos_por_canje = $("#search_puntos_por_canje:checked").val() ? "1" : undefined,
                            d.search_ticket_souvenirs = $("#search_ticket_souvenirs:checked").val() ? "1" : undefined,
                            d.search_machine = $("#search_machine:checked").val() ? "1" : undefined,
                            d.search_table = $("#search_table:checked").val() ? "1" : undefined,

                            d.search_sede_attlogs = $('#search_sede_attlogs').val(),
                            d.search_department_attlogs = $('#search_department_attlogs').val(),
                            d.search_position_attlogs = $('#search_position_attlogs').val(),
                            d.search_sex_attlogs = $('#search_sex_attlogs').val(),
                        ]}
                    },
                    language: {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "emptyTable":  "Sin datos disponibles",
                        "zeroRecords": "Ningun resultado encontrado",
                        "info": "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                        "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "infoEmpty": "Ningun valor disponible",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":     "Buscar",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                    }
                }).on( 'processing.dt', function ( e, settings, processing ) {
                    if(processing){ console.log() }else{ }
                });

                $("#search").keyup( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#start").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#end").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_transportation").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_club_vip").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_referido").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_vive_cerca").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_trabaja_cerca").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_solo_de_paso").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_descuento").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_puntos_por_canje").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_souvenirs").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_machine").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_ticket_table").click( () =>{ $('#data-table-default').DataTable().ajax.reload() });

                $("#search_sede_attlogs").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_department_attlogs").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_position_attlogs").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
                $("#search_sex_attlogs").change( () =>{ $('#data-table-default').DataTable().ajax.reload() });
            });
            
        }

        function dataTableSimple(id) {
            $(document).ready(function() {
                let table = $(`#${id}`).DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    responsive: true,
                    processing: true,
                    lengthChange: true,
                    language: {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "emptyTable":  "Sin datos disponibles",
                        "zeroRecords": "Ningun resultado encontrado",
                        "info": "Mostrando de _START_ a _END_ de un total de _TOTAL_ registros",
                        "infoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "infoEmpty": "Ningun valor disponible",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":     "Buscar",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                    }
                }).on( 'processing.dt', function ( e, settings, processing ) { if(processing){ console.log() }else{ } });
                $("#search").keyup( () =>{ $('#data-table-default').DataTable().ajax.reload() });
            });
            
        }

        function setLoading(timerInterval) {
            Swal.fire({
                title: 'Cargando datos!',
                text: 'porfavor espere...',
                timer: 300000,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => { }, 100)
                },
            })
        }
        
    </script>
    @yield('js')
</body>
</html>
