<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Casinos Roraima</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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


        
    </style>

</head>
<body>
    <div class="page-cover" style="background-image: url('{{ asset('img/login-bg/login-bg-11.jpg') }}');"></div>
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <div id="header" class="header navbar-default">
            <div class="navbar-header">
                <a class="navbar-brand"><b>CASINO</b></a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <div class="image image-icon bg-black text-grey-darker">
                            <i class="fa fa-user"></i>
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
                <ul class="nav " data-click="pr-0">
                    <!-- <li class="nav-header" style="color: #fff !important">DASBOARD</li> -->

                    
                    <li class="nav-header" style="color: #fff !important">MODULOS</li>
                    <li id="graphics_nav" class="has-sub closed">
                        <a href="{{ route('graphics') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">GRAFICOS</span>
                        </a>
                    </li>
                    <li id="clients_nav" class="has-sub closed">
                        <a href="{{ route('clients') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">CLIENTES</span>
                        </a>
                    </li>
                    <li id="counting_table_stadistics_nav" class="has-sub closed">
                        <a href="{{ route('counting_table_stadistics') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">CONTEO DE MESAS</span>
                        </a>
                    </li>
                    <li id="ayb_commands_nav" class="has-sub closed">
                        <a href="{{ route('ayb_commands') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">A&B</span>
                        </a>
                    </li>
                    <li id="users_nav" class="has-sub closed">
                        <a href="{{ route('users') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">USUARIOS</span>
                        </a>
                    </li>
                    <li id="attlogs_nav" class="has-sub closed">
                        <a href="{{ route('attlogs') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">ASISTENCIA</span>
                        </a>
                    </li>

                    <li class="nav-header" style="color: #fff !important">CONFIGURACIONES</li>
                    <li id="levels_nav" class="has-sub closed">
                        <a href="{{ route('levels') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">NIVELES</span>
                        </a>
                    </li>
                    
                    <li id="transportations_nav" class="has-sub closed">
                        <a href="{{ route('transportations') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">TRANSPORTES</span>
                        </a>
                    </li>
                    <li id="juices_nav" class="has-sub closed">
                        <a href="{{ route('juices') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">JUGOS</span>
                        </a>
                    </li>
                    <li id="foods_nav" class="has-sub closed">
                        <a href="{{ route('foods') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">COMIDAS</span>
                        </a>
                    </li>
                    <li id="drinks_nav" class="has-sub closed">
                        <a href="{{ route('drinks') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">TRAGOS</span>
                        </a>
                    </li>
                    <li id="machines_nav" class="has-sub closed">
                        <a href="{{ route('machines') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">MAQUINAS</span>
                        </a>
                    </li>
                    <li id="tables_nav" class="has-sub closed">
                        <a href="{{ route('tables') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">MESAS EN VIVO</span>
                        </a>
                    </li>
                    <li id="domains_nav" class="has-sub closed">
                        <a href="{{ route('domains') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">DOMINIOS</span>
                        </a>
                    </li>
                    <li id="emails_nav" class="has-sub closed">
                        <a href="{{ route('emails') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">CORREOS</span>
                        </a>
                    </li>
                    <li id="ayb_items_nav" class="has-sub closed">
                        <a href="{{ route('ayb_items') }}">
                            <i class="fas fa-circle text-white"></i>
                            <span class="text-white">ITEMS A&B</span>
                        </a>
                    </li>
                    



                   

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

    




    {{-- pasar estos script aparte para que sean globales --}}
    <script>



        moment.locale('en', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
        });

        
        function dataTable(url,columns,group_name_all) {
            $(document).ready(function() {
                let table = $('#data-table-default').DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    responsive: true,
                    processing: true,
                    lengthChange: true,
                    columns: columns,
                    drawCallback: function (settings) {
                        if(group_name_all){
                            var api = this.api();
                            var rows = api.rows({ page: 'current' }).nodes();
                            var last = null;
                            api.rows({ page: 'current' }).data().each(function (data, i) {
                                if (last !== data.group_name) {
                                    $(rows).eq(i).before('<tr class="group_name"><td colspan="3">' + data.group_name + '</td></tr>');
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

        function elim(route,id) {
            Swal.fire({
                title: 'Estás seguro?',
                text: 'No serás capaz de recuperar el registro a borrar!',
                icon: 'error',
                showCancelButton: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${location.origin}/${route}/${id}`,
                        type: "DELETE",
                        data: {
                            "_token": $("meta[name='csrf-token']").attr("content")
                        },
                        success: function (res) {
                            if(res.type === 'success'){
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
            var wb = XLSX.utils.table_to_book(elt, { sheet: "listado de Correos" });
            return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ( user.name+'-'+title+'-'+moment().format('MMMM Do YYYY, h:mm:ss a')+'.'+('xlsx' || 'xlsx')));
        }
        function pdfExport(title) {
                let user = {!! Auth::user() !!}
                var doc = new jsPDF()
                doc.autoTable({ html: '#data-table-default' })
                doc.save(`${user.name}-${title}-${moment().format('MMMM Do YYYY, h:mm:ss a')}.pdf`)
        }
        
      
    </script>
    @yield('js')
</body>
</html>
