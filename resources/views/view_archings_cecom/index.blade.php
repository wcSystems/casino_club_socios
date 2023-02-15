<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> ARQUEO CECOM {!! $fecha !!}  </title>
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
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/autotable/jspdf.js') }}"></script>
    <script src="{{ asset('js/autotable/autotable.js') }}"></script>

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
    </style>
    
</head>
    <body>
        <div class="panel panel-inverse" data-sortable-id="table-basic-1">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title text-center" id="title-schedule">
                ARQUEO CECOM {!! $fecha !!}
                </h4>
            </div>
            <div class="panel-body" id="render-schedule"></div>
        </div>
    </body>
    <script>

        moment.locale('en', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
        });
        
        let global_sumTotalFinal = 0
        let group_archings_casino = {!! $group_archings_casino !!}
        let conteo_archings_cecom_casinos = {!! $conteo_archings_cecom_casinos !!}
        let mesas_casinos = {!! $mesas_casinos !!}
        let billetes_casinos = {!! $fichas_casinos !!}
        let sede_id = {!! $sede_id !!}
        let fecha = {!! $fecha !!}

        let html = ``;
            html += `
            <div class="table-responsive d-flex flex-column">
                <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline m-auto" style="overflow-x: auto;display: block;white-space: nowrap;width:fit-content !important">
                    <thead style="background-color:paleturquoise;"  >
                        <tr>
                            <th class="text-center text-uppercase font-weight-bold" > Mesas / Billetes </th>`
                            billetes_casinos.forEach(billete => {
                                html += `<td class="font-weight-bold text-left" style="background-color:paleturquoise;font-size:12px !important"> $ ${ billete.name } </td>`
                            });
                            html += `
                            <th class="text-center text-uppercase font-weight-bold" > TOTAL </th>
                        </tr>
                    </thead>
                    <tbody>`
                        mesas_casinos.forEach(mesa => {
                            html += `
                            <tr>
                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="${mesa.name}" >
                                </td>`
                                billetes_casinos.forEach(billete => {
                                    let current = conteo_archings_cecom_casinos.find( i => i.mesas_casino_id == mesa.id && i.billetes_casino_id == billete.id )
                                    let id = ( current == undefined ) ? 0 : parseInt(current.id)
                                    let cantidad = ( current == undefined ) ? "" : parseInt(current.cantidad)
                                    html += `
                                    <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                        <input type="hidden" id="id_${mesa.id}_${billete.id}" value="${id}"  > 
                                        <input disabled value="${cantidad}" id="mesa_billete_${mesa.id}_${billete.id}" type="number" min="0"  class="form-control p-0 m-auto text-center font-weight-bold parsley-normal upper" style="min-width:80px !important" > 
                                    </td>`
                                });
                            html += `
                                    <td class="font-weight-bold bg-gris" >
                                        <input id="total_mesa_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:100px !important" value="$ 0 ( 0 )" > 
                                    </td>
                            </tr>
                            `
                        });
                        
                        html += `
                        <tr>
                            <td colspan="${billetes_casinos.length}" class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL" >
                            </td>`
                            
                            billetes_casinos.forEach(billete => {
                                html += `
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="total_billete_${billete.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                </td>`
                            });
                                html += `
                                <td class="font-weight-bold" style="background-color:paleturquoise;"  >
                                    <input id="total_final" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                </td>

                        
                        </tr>
                        <tr>
                            <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                <input  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="GAÑOTA" > 
                            </td>
                            <td colspan="${billetes_casinos.length}" class="font-weight-bold"style="background-color:#EDEDED !important"  >
                                <div class="d-flex align-items-center">
                                    <label for="extra" class="col-6 px-0 text-right pr-1 mb-0"> $ </label>
                                    <input id="extra"  type="number" disabled  class="pl-1 text-left col-6 form-control p-0 m-auto text-center border-0 font-weight-bold" value="${group_archings_casino.extra}" > 
                                </div>
                            </td>
                            <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                <input  id="total_extra"  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-sm-12 text-center mt-3" style="">
                    <button onclick="window.print()" type="submit" class="swal2-confirm swal2-styled bg-primary" aria-label="" style="display: inline-block;"> Imprimir </button>
                </div>
                
            </div>`
                    
            $("#render-schedule").append(html)
            

            mesas_casinos.forEach(mesa => {
                billetes_casinos.forEach(billete => {
                    sumMesaBilleteTotal(mesa.id,billete.id,billete.name,sede_id)
                })
            })

            function sumMesaBilleteTotal(mesa_id,billete_id,billete_name,sede_id) {

                let extra = $(`#extra`).val() == "" ? 0 : parseInt($(`#extra`).val())
                let sumTotalMesas = 0
                let sumTotalBilletes = 0
                let sumTotalFinal = 0

                let cantidad_mesaFinal = 0
                let cantidad_billeteFinal = 0
                let cantidadFinal = 0

                let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
                let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
                    
                billetes_casinos.forEach(element => {
                    let cantidad_billete = $(`#mesa_billete_${mesa_id}_${element.id}`).val() == "" ? 0 : parseInt($(`#mesa_billete_${mesa_id}_${element.id}`).val())
                    let precio_billete = parseInt(element.name)
                    let subtotal_billete = precio_billete*cantidad_billete
                    sumTotalMesas = sumTotalMesas+subtotal_billete
                    cantidad_mesaFinal = cantidad_mesaFinal+cantidad_billete
                });

                mesas_casinos.forEach(element => {
                    let cantidad_mesa = $(`#mesa_billete_${element.id}_${billete_id}`).val() == "" ? 0 : parseInt($(`#mesa_billete_${element.id}_${billete_id}`).val())
                    let precio_mesa = parseInt(billete_name)
                    let subtotal_mesa = precio_mesa*cantidad_mesa
                    sumTotalBilletes = sumTotalBilletes+subtotal_mesa
                    cantidad_billeteFinal = cantidad_billeteFinal+cantidad_mesa
                });


                $(`#total_mesa_${mesa_id}`).val(`$ ${sumTotalMesas} ( ${cantidad_mesaFinal} )`)
                $(`#total_billete_${billete_id}`).val(`$ ${sumTotalBilletes} ( ${cantidad_billeteFinal} )`)

                if( $(`#total_billete_${billete_id}`).val() == "$ 0 ( 0 )" ){
                    $(`#total_billete_${billete_id}`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
                }else{
                    $(`#total_billete_${billete_id}`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
                }
                
                if( $(`#total_mesa_${mesa_id}`).val() == "$ 0 ( 0 )" ){
                    $(`#total_mesa_${mesa_id}`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
                }else{
                    $(`#total_mesa_${mesa_id}`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
                }

                if( $(`#mesa_billete_${mesa_id}_${billete_id}`).val() == "" || $(`#mesa_billete_${mesa_id}_${billete_id}`).val() == 0 ){
                    $(`#mesa_billete_${mesa_id}_${billete_id}`).removeClass("bg-verde").addClass("bg-rojo")
                }else{
                    $(`#mesa_billete_${mesa_id}_${billete_id}`).removeClass("bg-rojo").addClass("bg-verde")
                }

                mesas_casinos.forEach(element => {
                    let dividir = $(`#total_mesa_${element.id}`).val() == "" ? 0 : $(`#total_mesa_${element.id}`).val().slice(1).split("(")
                        sumTotalFinal = sumTotalFinal+parseInt(dividir[0])
                        cantidadFinal = cantidadFinal+parseInt(dividir[1])
                });

                global_sumTotalFinal = sumTotalFinal
                $(`#total_final`).val(`$ ${sumTotalFinal} ( ${cantidadFinal} )`)
                $(`#total_extra`).val(`$ ${sumTotalFinal+extra}`)


                
                    
            }


    </script>
    
</html>