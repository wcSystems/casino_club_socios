@extends('layouts.app')

@section('css')
<style>
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
        }
</style>
@endsection

@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle d-flex justify-content-between">
        @if( $dataUser->level_id == 1 )
        <a class="d-flex btn btn-danger" onclick="viewGroup()"  >
                BORRAR
            </a>
        @else
            <a class="d-flex btn btn-secondary"  >
                BORRAR
            </a>
        @endif
           
            <button onclick="modal('Crear')" class="d-flex btn btn-1 btn-success">
                <i class="m-auto fa fa-lg fa-plus"></i>
            </button>
       
    </div>
    <div class="panel-body">
    <div class="row">
           
        </div>
        <div class="table-responsive">
            <table id="data-table-default" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Departamento</th>
                        <th>Horarios</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#year_month_groups_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Titulo <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="month"  id="year_month" name="year_month" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el año aca" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        </div>
                    </div>
                </form>`
        })
        if(id){
            let current={!! $year_month_groups !!}.find(i=>i.id===id)
            $("#year_month").val(`${current.year}-${current.month}`)
        }
        validateForm()
    }
    function guardar(id) {
        let timerInterval 
        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    year: $("#year_month").val().slice(0,4),
                    month: $("#year_month").val().slice(5)
                }
            }
            setLoading(timerInterval)
            $.ajax({
                url: "{{ route('year_month_groups.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {
                    if(res.type === 'success'){
                        clearInterval(timerInterval)
                        location.reload();
                    }
                }
            });
        }
    }
    function viewGroup() {
        let year_month_groups = {!! $year_month_groups !!}
        let html = ``
            html += `<div class="row">`
            year_month_groups.forEach(element => {
                html += `
                    <div class="col-md-12 col-sm-12 my-2">
                        <div class="form-group row m-b-0">
                            <div class="col-lg-11">
                                <input readonly required type="month" value="${element.year}-${element.month}" class="form-control parsley-normal upper" style="color: var(--global-2) !important" >
                            </div>
                            <div class="col-lg-1">
                                <a onclick="elim('year_month_groups',${element.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </div>
                `
            });
            html += `</div>`
        Swal.fire({
            title: `Grupos de Horarios`,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            html: html
        })
        
    }
    dataTable("{{route('year_month_groups.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'name' },
        {
            render: function ( data,type, row  ) {
                let btns = ``;
                    btns +=`<a class="btn btn-blue m-5" onclick="viewYearMonth(${row.id})" > VER </a>`
                return btns;
            }
        },
    ])

    function viewSQM(id,department_id,year,month,day_end) {
        let html = ``
            html +=`<a class="btn btn-blue m-5" onclick="viewModeHorario(${id},${department_id},${year},${month},${day_end},'Semanal')"  > Semanal </a>`
            html +=`<a class="btn btn-info m-5" onclick="viewModeHorario(${id},${department_id},${year},${month},${day_end},'Quincenal')" > Quincenal </a>`
            html +=`<a class="btn btn-blue m-5" onclick="viewModeHorario(${id},${department_id},${year},${month},${day_end},'Mensual')" > Mensual </a>`
    
        
        Swal.fire({
            title: `Seleccione el tipo de Horario`,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            width: "95%",
            html: html
        })  
    }
    function viewYearMonth(department_id) {
        let html = ``
        let year_month_groups = {!! $year_month_groups !!}

        year_month_groups.forEach(element => {
            let month = element.month = ( element.month <= 9 ? "0"+element.month : element.month )
            let day_end=moment(month).daysInMonth();
            html +=`<a class="btn btn-info m-5" onclick="viewSQM(${element.id},${department_id},${element.year},${month},${day_end})" > ${element.year} ${ moment(element.month).format('MMMM')} </a>`
        });
        
        Swal.fire({
            title: `Seleccione Año y Mes`,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            width: "95%",
            html: html
        })  
    }


    function viewModeHorario(year_month_group_id,department_id,year,month,day_end,mode) {
        
        let html = ``
        if( mode == "Semanal" ){
            html +=`<a class="btn btn-blue m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'1','7')"  > Primera Semana ( del dia 1 al dia 7 ) </a>`
            html +=`<a class="btn btn-info m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'8','14')"  > Segunda Semana ( del dia 8 al dia 14 ) </a>`
            html +=`<a class="btn btn-blue m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'15','21')"  > Tercera Semana ( del dia 15 al dia 21 ) </a>`
            html +=`<a class="btn btn-info m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'22',${day_end})"  > Cuarta Semana ( del dia 22 al dia ${day_end} ) </a>`
        }
        if( mode == "Quincenal" ){
            html +=`<a class="btn btn-blue m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'1','15')"  > Primera Quincena ( del dia 1 al dia 15 ) </a>`
            html +=`<a class="btn btn-info m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'16',${day_end})"  > Segunda Quincena ( del dia 16 al dia ${day_end} ) </a>`
        }
        if( mode == "Mensual" ){
            html +=`<a class="btn btn-info m-5" onclick="addHorario(${year_month_group_id},${department_id},${year},${month},'1',${day_end})"  > Mes Completo ( del dia 1 al dia ${day_end} ) </a>`
        }

        Swal.fire({
            title: `Horario ${mode}`,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            width: "95%",
            html: html
        })  
    }
    function addHorario(year_month_group_id,department_id,year,month,day_init,day_end) {
            month = ( month <= 9 ) ? "0"+month : month
        let timerInterval 
        let payload = { 
            _token: $("meta[name='csrf-token']").attr("content"), 
            year_month_group_id: year_month_group_id, 
            department_id: department_id
        }
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('schedule_templates.viewScheduleAll') }}",
            type: "POST",
            data: payload,
            success: function (res) {
                clearInterval(timerInterval)
                let schedules = res.schedules
                let department_name = res.employees.name
                let horarios = {!! $horarios !!}
                let dataUser = {!! $dataUser !!}
                res.employees = ( dataUser.level_id > 1 ) ? res.employees.employees.filter( i => i.sede_id == dataUser.sede_id ) : res.employees.employees
                console.log("ddd", res.employees )

                let html = ``;
                    html += `
                        <div class="table-responsive my-3">
                            <table id="horario" class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
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
                                        if( horarioItem.leyenda != "L" ){
                                            html += `
                                            <tr>
                                                <td class="text-center" style="${horarioItem.leyenda == 'T1' ? 'background-color:#A9DFBF !important;font-size:12px !important' : horarioItem.leyenda == 'T2' ? 'background-color:#A9CCE3 !important;font-size:12px !important' : horarioItem.leyenda == 'L' ? 'background-color:#454545 !important;font-size:12px !important' : 'background-color:#EDEDED !important;font-size:12px !important' }" >
                                                    ${ horarioItem.name }
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
                                    });
                                    
                                    html += `
                                </tbody>
                            </table>
                        </div>
                    `
                    html += `
                        <div class="table-responsive">
                            <table id="schedule-${year}-${month}" class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                                <thead style="background-color:paleturquoise;"  >
                                    <tr>
                                        <th class="text-center text-uppercase font-weight-bold" > Trabajador </th>`
                                        for (let index = day_init; index <= day_end; index++) {
                                            html += `<td class="font-weight-bold text-left" style="background-color:paleturquoise;width:150px !important;font-size:12px !important"> ${ moment(year+"-"+month+"-"+index).format('dd') }(${moment(year+"-"+month+"-"+index).format('DD')}) </td>`
                                        }
                                        html += `
                                    </tr>
                                </thead>
                                <tbody>`
                                    res.employees.forEach(elementEmployee => {
                                        let currentEmployeeId = schedules.find( i => i.employee_id == elementEmployee.id )
                                        let current = schedules.find( i => i.employee_id == elementEmployee.id )
                                            current = current ? current.horario : ""
                                            current = current.split(',')
                                        html += `
                                        <tr>
                                            <input type="hidden" id="schedule_id_${elementEmployee.id}" value="${currentEmployeeId ? currentEmployeeId.id : '' }" >
                                            <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                                <div id="done_style_${elementEmployee.id}" style="width:40px !important;height:40px !important;" class="mr-3" >
                                                    <img   src="/public/employees/${elementEmployee.employeeNo}.jpg" onerror="this.onerror=null;this.src='/public/users/null.jpg';" width="100%" height="100%" class="rounded-circle" />
                                                </div>
                                                <div>
                                                    ${elementEmployee.name}
                                                </div>
                                                
                                            </td>`
                                            for (let index = day_init; index <= day_end; index++) {
                                                html += `
                                                <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                                    <div class="done_style_${elementEmployee.id}"  >
                                                        
                                                        <select id="${index}_${elementEmployee.id}" class="form-control p-0 m-auto text-center" onchange="checkColor(this)"   >`
                                                            horarios.forEach(element => {
                                                               if( current.find( (d,i) => d == element.id && i+1 == index ) ){
                                                                    html += `<option value="${ element.id }" selected   } > ${ element.name } </option>`
                                                               }else{
                                                                    html += `<option value="${ element.id }"  > ${ element.name } </option>`
                                                               }
                                                                
                                                                
                                                            });
                                                        html += `
                                                        </select>
                                                        <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                                    </div>
                                                </td>`
                                            }
                                        html += `
                                        </tr>`
                                    });
                                    
                                    html += `
                                </tbody>
                            </table>
                            <div class="col-sm-12" style="margin-top:20px">
                                <a href="https://api.whatsapp.com/send?text=${window.location.origin}/schedule_department/${department_id}/${year_month_group_id}/${day_init}/${day_end}" class="swal2-confirm swal2-styled bg-green text-decoration-none" >
                                    Whatsapp
                                </a>
                                <a  target="_blank" href="${window.location.origin}/schedule_department/${department_id}/${year_month_group_id}/${day_init}/${day_end}" class="swal2-confirm swal2-styled bg-info text-decoration-none" >
                                    Ver
                                </a>
                                <button onclick="newSchedule(${year_month_group_id},${day_init},${day_end},${year},${month},${department_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                                <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                            </div>
                                    

                        </div>
                    `

                    



             
                Swal.fire({
                    title: `${department_name}, Horario ${moment(month).format('MMMM')} ${year}`,
                    showConfirmButton: false,
                    showCloseButton: true,
				    allowOutsideClick: false,
                    width: "95%",
                    html: html
                })  

                res.employees.forEach(elementEmployee => {
                    for (let index = day_init; index <= day_end; index++) {
                        checkColor(`#${index}_${elementEmployee.id}`)
                    }
                });

            }
        }); 
    }

    function checkColor(params) {
        let horarios = {!! $horarios !!}
        let id = $(params).attr("id")
        let select_id = $(`#${id}`).val()
        let horario_one = {!! $horarios !!}.find( i => i.id == select_id )
        let leyenda = ( horario_one ) ? horario_one.leyenda : ""
        
        if( leyenda == "T1" ){
            $(`#${id}`).css("background-color","#A9DFBF !important")
        }
        if( leyenda == "T2" ){
            $(`#${id}`).css("background-color","#A9CCE3 !important")
        }
        if( leyenda == "L" ){
            $(`#${id}`).css("background-color","#999999 !important")
        }
    }

    function newSchedule(year_month_group_id,day_init,day_end,year,month,department_id) {
        
        let department = {!! $departments !!}.find( i => i.id == department_id )
        let employees = department.employees
        let countReset = 0
        employees.forEach( element =>  {

            let horarioEmployee = $(`#schedule_id_${element.id}`).val() ?   {!! $schedule_templates !!}.find( i => i.id == $(`#schedule_id_${element.id}`).val() ).horario.split(",")     : []

            

            for (let index = day_init; index <= day_end; index++) {
                if( $(`#${index}_${element.id}`).val() ){
                    horarioEmployee[index-1] = parseInt($(`#${index}_${element.id}`).val()) 
                }
            }
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: $(`#schedule_id_${element.id}`).val() ? $(`#schedule_id_${element.id}`).val() : "" },
                data: {
                    horario: horarioEmployee.toString(),
                    year_month_group_id: year_month_group_id,
                    employee_id: element.id,
                }
            }
            $.ajax({
                url: "{{ route('schedule_templates.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {
                    if(res.type === 'success'){
                        countReset = countReset+1
                        $(`#done_style_${element.id}`).replaceWith(`<div id="done_style_${element.id}"  style="width:40px !important;height:40px !important;" class="mr-3 d-flex align-items-center justify-content-center"  ><i class="fas fa-check-circle text-success fa-lg"></i> </div>`)
                        $(`.done_style_${element.id}`).replaceWith(`<div class="done_style_${element.id}"><i class="fas fa-check-circle text-success fa-lg"></i></div>`)
                        if( countReset == employees.length ){
                            location.reload();
                        }
                    }

                }
            });
        });
        
                

            
            
    }

    function setLoading(timerInterval) {
        Swal.fire({
            title: 'Cargando datos!',
            text: 'porfavor espere...',
            timer: 300000,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => { }, 100)
            },
        })
    }
    
    function salir() {
        $(".swal2-close").click()
    }

   

</script>
@endsection