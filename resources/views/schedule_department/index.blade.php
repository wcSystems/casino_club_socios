<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> {!! $department->name !!} / {!! $year_month_group->year !!}  / {!! $year_month_group->month !!}  </title>
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

        
    </style>
    
</head>
    <body>
        <div class="panel panel-inverse" data-sortable-id="table-basic-1">
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title text-center" id="title-schedule">
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
        
            $("#header").remove()
            $("#sidebar").remove()

        
            let schedule = {!! $schedule !!}
            let horarioUniqueCurrent = schedule.map( i => i.horario ).join().split(',')
                horarioUniqueCurrent = new Set(horarioUniqueCurrent);
                horarioUniqueCurrent = [...horarioUniqueCurrent];
            let department = {!! $department !!}
            console.log(department)
            let horarios = {!! $horarios !!}
            let year_month_group = {!! $year_month_group !!} 
            let month = ( year_month_group.month <= 9 ? "0"+year_month_group.month : year_month_group.month )
            let year = year_month_group.year
            let days_in_month=moment(month).daysInMonth();
            let html = ``;
            $("#title-schedule").text( department.name+", "+moment(month).format('MMMM')+ " " + year )

           

            html += `
                <div class="table-responsive d-flex flex-column">
                    <table id="horario" class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline m-auto" style="overflow-x: auto;display: block;white-space: nowrap;width:fit-content !important">
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th class="text-center text-uppercase " > Leyenda </th>
                                <th class="text-center text-uppercase " > H. Entrada </th>
                                <th class="text-center text-uppercase " > H. Salida </th>
                                <th class="text-center text-uppercase " > H. Trabajo </th>
                                
                            </tr>
                        </thead>
                        <tbody>`
                            horarios.forEach(horarioItem => {
                                if( horarioUniqueCurrent.find( i => i == horarioItem.id ) ){
                                    if( horarioItem.leyenda != "L" ){
                                        html += `
                                        <tr>
                                            <td class="text-center" style="${horarioItem.leyenda == 'T1' ? 'background-color:#A9DFBF !important;font-size:12px !important' : horarioItem.leyenda == 'T2' ? 'background-color:#A9CCE3 !important;font-size:12px !important' : horarioItem.leyenda == 'L' ? 'background-color:#454545 !important;font-size:12px !important' : 'background-color:#EDEDED !important;font-size:12px !important' }" >
                                                ${ horarioItem.leyenda }
                                            </td>
                                            <td class="text-center" style="${horarioItem.leyenda == 'T1' ? 'background-color:#A9DFBF !important;font-size:12px !important' : horarioItem.leyenda == 'T2' ? 'background-color:#A9CCE3 !important;font-size:12px !important' : horarioItem.leyenda == 'L' ? 'background-color:#454545 !important;font-size:12px !important' : 'background-color:#EDEDED !important;font-size:12px !important' }" >
                                                ${ moment(year+"-"+month+"-"+'1'+" "+horarioItem.hora_entrada).format('LT') }
                                            </td>
                                            <td class="text-center" style="${horarioItem.leyenda == 'T1' ? 'background-color:#A9DFBF !important;font-size:12px !important' : horarioItem.leyenda == 'T2' ? 'background-color:#A9CCE3 !important;font-size:12px !important' : horarioItem.leyenda == 'L' ? 'background-color:#454545 !important;font-size:12px !important' : 'background-color:#EDEDED !important;font-size:12px !important' }" >
                                            ${ moment(year+"-"+month+"-"+'1'+" "+horarioItem.hora_entrada).add(horarioItem.hora_trabajo, 'h').format('LT') }
                                            </td>
                                            <td class="text-center" style="${horarioItem.leyenda == 'T1' ? 'background-color:#A9DFBF !important;font-size:12px !important' : horarioItem.leyenda == 'T2' ? 'background-color:#A9CCE3 !important;font-size:12px !important' : horarioItem.leyenda == 'L' ? 'background-color:#454545 !important;font-size:12px !important' : 'background-color:#EDEDED !important;font-size:12px !important' }" >
                                                ${ horarioItem.hora_trabajo }
                                            </td>`
                                        html += `
                                        </tr>`
                                    }
                                }
                                
                            });
                            
                            html += `
                        </tbody>
                    </table>
                    <table class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" rowspan="2" > Empleados <br /> ( ${ schedule.length } ) </th>`
                                for (let index = 1; index <= days_in_month; index++) {
                                    html += `<td class="text-center font-weight-bold px-1" style="background-color:paleturquoise;width:150px !important;font-size:10px !important"> ${ moment(year+"-"+month+"-"+index).format('dd') } <br /> ${moment(year+"-"+month+"-"+index).format('DD')} </td>`
                                }
                                html += `
                            </tr>
                        </thead>
                        <tbody>`
                            schedule.forEach(elementEmployee => {
                                let current = elementEmployee ? elementEmployee.horario : ""
                                    current = current.split(',')
                                html += `
                                <tr>
                                    <td class="font-weight-bold" style="background-color:paleturquoise;font-size:11px !important"> 
                                        <img src="/public/employees/${elementEmployee.employeeNo}.jpg" onerror="this.onerror=null;this.src='/public/users/null.jpg';" width="30" height="30" class="rounded-circle mr-1" /> ${elementEmployee.employee_name}
                                    </td>`
                                    for (let index = 1; index <= days_in_month; index++) {
                                        horarios.forEach(element => {
                                            if( current.find( (d,i) => d == element.id && i+1 == index ) ){
                                                html += `<td class="font-weight-bold p-0 text-center" style="${element.leyenda == 'T1' ? 'background-color:#A9DFBF !important' : element.leyenda == 'T2' ? 'background-color:#A9CCE3 !important' : element.leyenda == 'L' ? 'background-color:#EDEDED !important' : 'background-color:#EDEDED !important' }" >${ element.leyenda }</td>`
                                            }
                                        });                                    
                                    }
                                html += `
                                </tr>`
                            });
                            html += `
                        </tbody>
                    </table>
                    <div class="col-sm-12 text-center" style="">
                        <button onclick="window.print()" type="submit" class="swal2-confirm swal2-styled bg-primary" aria-label="" style="display: inline-block;"> Imprimir </button>
                    </div>
                </div>
            `
            
                    
            $("#render-schedule").append(html)
            


        

    
    </script>
    
</html>