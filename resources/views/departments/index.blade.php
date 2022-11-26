@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="modal('Crear')" class="d-flex btn btn-1 btn-success">
                <i class="m-auto fa fa-lg fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="data-table-default" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#departments_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Titulo <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el titulo aqui..." >
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
            let current={!! $departments !!}.find(i=>i.id===id)
            $("#name").val(current.name)
        }
        validateForm()
    }
    function guardar(id) {
        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    name: $('#name').val()
                }
            }
            $.ajax({
                url: "{{ route('departments.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {
                    if(res.type === 'success'){
                        location.reload();
                    }
                }
            });
        }
    }
    dataTable("{{route('departments.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('departments',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                    <a onclick="createSchedule(${row.id})" style="color: var(--global-2)" class="btn btn-info btn-icon btn-circle"><i class="fas fa-calendar"></i></a>
                    <a onclick="viewSchedule(${row.id})" style="color: var(--global-2)" class="btn btn-dark btn-icon btn-circle"><i class="fas fa-calendar"></i></a>
                `;
            }
        },
    ])

    function createSchedule(id) {
        let html = ``;
            html +=`
            <form id="form-all-schedule" class="needs-validation" action="javascript:void(0);" novalidate>
                <div class="row">
                    <div class="col-12 m-auto">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Año y mes <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="month" id="month_year" value="${moment().format("YYYY")}-${moment().format("MM")}" name="month_year" onchange="monthYearChange(${id})" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="daysOfMonth" class="row"></div>`
                    html +=`
                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="guardarSchedule(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                    </div>
                </div>
            </form>`;
        Swal.fire({ title: {!! $departments !!}.find(i=>i.id===id).name, showConfirmButton: false, width: '80em', html:html })
        monthYearChange(id)
        validateForm()
    }

    function monthYearChange(id) {
        let days_in_month=moment( $("#month_year").val().slice(5) ).daysInMonth();
        let current_department={!! $departments !!}.find(i=>i.id===id)
        let html = ``
            html +=`
            <div id="daysOfMonth" class="row">
                <div class="col-12 m-auto"><label class=" text-lg-right col-form-label font-weight-bold"> Horario ${ moment($("#month_year").val().slice(5)).format('MMMM') } ${ $("#month_year").val().slice(0,4) }</span> </label></div>`;
                for (let index = 1; index <= days_in_month; index++) {
                    
                    (current_department.employees).forEach(element => {
                        let current={!! $schedule_templates !!}.filter(i=>i.employee_id==element.id).filter(i=>i.year==$("#month_year").val().slice(0,4)).filter(i=>i.month==$("#month_year").val().slice(5))
                        let current_data= ( current.find(i=>i.day==index) != undefined ) ? current.find(i=>i.day==index)  : {} ;
                        html +=`<input type="hidden" id="${element.id}_${index}_id" name="${element.id}_${index}_id" value="${current_data.id}" >`
                    });
                    
                    
                    html +=`
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group row m-b-0 m-2">
                            <label class=" text-lg-right col-form-label font-weight-bold"> ${ moment($("#month_year").val().slice(0,4)+"-"+$("#month_year").val().slice(5)+"-"+index).format('dd') }(${moment($("#month_year").val().slice(0,4)+"-"+$("#month_year").val().slice(5)+"-"+index).format('DD')}) <span class="text-danger"> *</span> </label>
                            
                            <div class="col-lg-12 my-1">
                                <select id="${index}_hora_entrada" class="form-control w-100" >
                                    <option value="00:00-L-0" selected class="font-weight-bold"  >LIBRE</option>
                                    <optgroup label="Diurno 7H">
                                        <option value="14:00-D-7"> 02:00 PM </option>
                                        <option value="15:00-D-7"> 03:00 PM </option>
                                        <option value="16:00-D-7"> 04:00 PM </option>
                                    </optgroup>
                                    <optgroup label="Diurno 8H">
                                        <option value="07:00-D-8"> 07:00 AM </option>
                                        <option value="08:00-D-8"> 08:00 AM </option>
                                        <option value="09:00-D-8"> 09:00 AM </option>
                                        <option value="11:00-D-8"> 11:00 AM </option>
                                        <option value="12:00-D-8"> 12:00 PM </option>
                                    </optgroup>
                                    <optgroup label="Diurno 12H">
                                        <option value="06:00-D-12"> 06:00 AM </option>
                                    </optgroup>
                                    <optgroup label="Nocturno 7H">
                                        <option value="17:00-N-7"> 05:00 PM</option>
                                        <option value="18:00-N-7"> 06:00 PM</option>
                                        <option value="19:00-N-7"> 07:00 PM</option>
                                        <option value="20:00-N-7"> 08:00 PM</option>
                                        <option value="21:00-N-7"> 09:00 PM</option>
                                    </optgroup>
                                    <optgroup label="Nocturno 12H">
                                        <option value="18:00-N-12"> 06:00 PM</option>
                                    </optgroup>

                                </select>
                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                            </div>
                        </div>
                    </div>`; 
                }
                html +=`
            </div>`
        $("#daysOfMonth").replaceWith(html)
    }

    function guardarSchedule(id) {
        let newArr = []
        let days_in_month=moment( $("#month_year").val().slice(5) ).daysInMonth();
        for (let index = 1; index <= days_in_month; index++) {
            newArr.push({
                schedule: {
                    hora_entrada: $(`#${index}_hora_entrada`).val().slice(0,5),
                    horas_trabajo: $(`#${index}_hora_entrada`).val().slice(8),
                    turno: $(`#${index}_hora_entrada`).val().slice(6,7),
                    year: $("#month_year").val().slice(0,4),
                    month: $("#month_year").val().slice(5),
                    day: index,
                    date: moment(`${$("#month_year").val().slice(0,4)}-${$("#month_year").val().slice(5)}-${index}`).format('YYYY-MM-DD'),
                }
            })
        }
        
      
      
        let validity = document.getElementById('form-all-schedule').checkValidity()
        if(validity){
            let payload = { _token: $("meta[name='csrf-token']").attr("content"), data: newArr, type: "department" , department: id, year: $("#month_year").val().slice(0,4), month: $("#month_year").val().slice(5)  }
            $.ajax({
                url: "{{ route('schedule_templates.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {
                    console.log("aca_data",res)
                    if(res.type === 'success'){
                        location.reload();
                    }
                }
            });
        }


    }

    function viewSchedule(department_id) {
        
        let timerInterval 
        setLoading(timerInterval)

        
        let html = ``;
        let current_department={!! $departments !!}.find(i=>i.id===department_id)
        current_department.employees.forEach(elementEmp => {
            let employee_id = elementEmp.id
            let current=elementEmp
            $.ajax({
                url: "{{ route('schedule_templates.viewSchedule') }}",
                type: "POST",
                data: { employee_id: employee_id },
                success: function (res) {
                    
                    let current_data_filter=res.query.filter(i=>i.employee_id==employee_id)
                    res.data.forEach(element => {
                        
                        let days_in_month=moment(element.month).daysInMonth();
                        html += `
                            <div class="table-responsive">
                                <table id="data-table-default-schedule-${element.year}-${element.month}" class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                                    <thead style="background-color:paleturquoise;" >
                                        <tr>
                                            <th class="text-center text-uppercase font-weight-bold" colspan=${days_in_month+1}>${moment(element.month).format('MMMM')} ${element.year}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise;">Dia</td>`
                                            for (let index = 1; index <= days_in_month; index++) {
                                                html += `<td class="font-weight-bold" style="background-color:paleturquoise;width:150px !important"> ${ moment(element.year+"-"+element.month+"-"+index).format('dd') }(${moment(element.year+"-"+element.month+"-"+index).format('DD')}) </td>`
                                            }
                                            html += `
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise"> Horario </td>`
                                            for (let index = 1; index <= days_in_month; index++) {
                                                res.all_data.forEach(element2 => {
                                                    if( employee_id == element2.employee_id && element.year == element2.year &&  element.month == element2.month && index == element2.day ){
                                                        if( element2.turno == "L" ){
                                                            html += `<td rowspan="4" class="font-weight-bold" style="background-color:#EDEDED !important" >L</td>`
                                                        }
                                                        if( element2.turno == "D" ){
                                                            html += `<td style="color:#6CC773 !important" class="font-weight-bold" >( ${element2.horas_trabajo}H ${element2.turno} ) ${moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).format('LT')} - ${ moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).add(element2.horas_trabajo, 'h').format('LT') }</td>`
                                                        }
                                                        if( element2.turno == "N" ){
                                                            html += `<td style="color:#6C7FC7 !important" class="font-weight-bold" >( ${element2.horas_trabajo}H ${element2.turno} ) ${moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).format('LT')} - ${ moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).add(element2.horas_trabajo, 'h').format('LT') }</td>`
                                                        }
                                                    }
                                                });
                                            }
                                            
                                            html += `
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold"  style="background-color:paleturquoise"> Marcajes </td>`
                                            for (let index = 1; index <= days_in_month; index++) {
                                                res.all_data.forEach(element2 => {
                                                    let current_find = current_data_filter.find(i=>i.date==moment(element2.year+"-"+element2.month+"-"+element2.day).format('YYYY-MM-DD'))
                                                    let current_find_plus = current_data_filter.find(i=>i.date== moment(element2.year+"-"+element2.month+"-"+element2.day).add('days', 1).format('YYYY-MM-DD'))
                                                    
                                                    if( employee_id == element2.employee_id && element.year == element2.year &&  element.month == element2.month && index == element2.day ){
                                                        
                                                            if( element2.turno == "D" ){
                                                                if(current_find != undefined){
                                                                    if(current_find.last !== current_find.first ){
                                                                        html += `<td class="text-uppercase font-weight-bold">${ moment(current_find.first).format('h:mm:ss a') } - ${ moment(current_find.last).format('h:mm:ss a') }</td>`
                                                                    }
                                                                    if(current_find.last == current_find.first ){
                                                                        html += `<td class="text-uppercase font-weight-bold">${ moment(current_find.first).format('h:mm:ss a') } </td>`
                                                                    }
                                                                }else{
                                                                    html += `<td class="text-uppercase font-weight-bold"> NO MARCO </td>`
                                                                }
                                                            }
                                                            if( element2.turno == "N" ){
                                                                if(current_find_plus != undefined && current_find != undefined){
                                                                    if(current_find_plus.first !== current_find.last ){
                                                                        html += `<td class="text-uppercase font-weight-bold"> ${ moment(current_find.last).format('h:mm:ss a') } - ${ moment(current_find_plus.first).format('h:mm:ss a') }</td>`
                                                                    }
                                                                    if(current_find_plus.first == current_find.last ){
                                                                        html += `<td class="text-uppercase font-weight-bold"> ${ moment(current_find.last).format('h:mm:ss a') } </td>`
                                                                    }
                                                                }else{
                                                                    if(current_find != undefined){
                                                                            html += `<td class="text-uppercase font-weight-bold"> ${ moment(current_find.last).format('h:mm:ss a') } </td>`
                                                                    }else{
                                                                        html += `<td class="text-uppercase font-weight-bold"> NO MARCO </td>`
                                                                    }
                                                                }
                                                            }
                                                            if( element2.turno == "L" ){
                                                                html += ``
                                                            }
                                                        
                                                        
                                                    }
                                                });
                                            }
                                            html += `
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise"> Trabajado </td>`
                                            for (let index = 1; index <= days_in_month; index++) {
                                                res.all_data.forEach(element2 => {
                                                    let current_find = current_data_filter.find(i=>i.date==moment(element2.year+"-"+element2.month+"-"+element2.day).format('YYYY-MM-DD'))
                                                    let current_find_plus = current_data_filter.find(i=>i.date== moment(element2.year+"-"+element2.month+"-"+element2.day).add('days', 1).format('YYYY-MM-DD'))
                                                    
                                                    if( employee_id == element2.employee_id && element.year == element2.year &&  element.month == element2.month && index == element2.day ){
                                                        
                                                            if( element2.turno == "D" ){
                                                                if(current_find != undefined){
                                                                    let hora_entrada = moment(current_find.first)
                                                                    let hora_salida = moment(current_find.last)
                                                                    let duration = moment.duration(hora_entrada.diff(hora_salida))
                                                                    if( hora_entrada<hora_salida ){
                                                                        html += `<td class="text-uppercase font-weight-bold"> ${duration._data.hours*-1}:${duration._data.minutes*-1}:${duration._data.seconds*-1}H  </td>`
                                                                    }else{
                                                                        html += `<td class="text-uppercase font-weight-bold"> SALIDA NO MARCADA  </td>`
                                                                    }
                                                                }else{
                                                                    html += `<td class="text-uppercase font-weight-bold"> NO TRABAJO </td>`
                                                                }
                                                            }
                                                            if( element2.turno == "N" ){
                                                                if(current_find_plus != undefined && current_find != undefined){
                                                                    let hora_entrada = moment(current_find.last)
                                                                    let hora_salida = moment(current_find_plus.first)
                                                                    let duration = moment.duration(hora_entrada.diff(hora_salida))
                                                                    if( hora_entrada<hora_salida ){
                                                                        html += `<td class="text-uppercase font-weight-bold"> ${duration._data.hours*-1}:${duration._data.minutes*-1}:${duration._data.seconds*-1}H  </td>`
                                                                    }else{
                                                                        html += `<td class="text-uppercase font-weight-bold"> SALIDA NO MARCADA  </td>`
                                                                    }
                                                                }else{
                                                                    if(current_find != undefined){
                                                                            html += `<td class="text-uppercase font-weight-bold"> SALIDA NO MARCADA  </td>`
                                                                    }else{
                                                                        html += `<td class="text-uppercase font-weight-bold"> NO TRABAJO </td>`
                                                                    }
                                                                }
                                                            }
                                                            if( element2.turno == "L" ){
                                                                html += ``
                                                            }
                                                        
                                                        
                                                    }
                                                });
                                            }
                                            html += `
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise"> Sobretiempo </td>`
                                            for (let index = 1; index <= days_in_month; index++) {
                                                res.all_data.forEach(element2 => {
                                                    let current_find = current_data_filter.find(i=>i.date==moment(element2.year+"-"+element2.month+"-"+element2.day).format('YYYY-MM-DD'))
                                                    let current_find_plus = current_data_filter.find(i=>i.date== moment(element2.year+"-"+element2.month+"-"+element2.day).add('days', 1).format('YYYY-MM-DD'))
                                                    
                                                    if( employee_id == element2.employee_id && element.year == element2.year &&  element.month == element2.month && index == element2.day ){
                                                        
                                                            if( element2.turno == "D" ){
                                                                if(current_find != undefined){

                                                                    let hora_marcada_entrada = moment(current_find.first)
                                                                    let hora_marcada_salida = moment(current_find.last)
                                                                    let duration_marcada = moment.duration(hora_marcada_entrada.diff(hora_marcada_salida))
                                                                    let horas_marcada = ( duration_marcada._data.hours < 0 )  ? (duration_marcada._data.hours*-1) * 3600 : (duration_marcada._data.hours) * 3600
                                                                    let minutos_marcada = ( duration_marcada._data.minutes < 0 )  ? (duration_marcada._data.minutes*-1) * 60 : (duration_marcada._data.minutes) * 60
                                                                    let segundos_marcada = ( duration_marcada._data.seconds < 0 )  ? (duration_marcada._data.seconds*-1) : (duration_marcada._data.seconds)
                                                                    
                                                                    //trabajado
                                                                    let total_segundo_marcada = horas_marcada+minutos_marcada+segundos_marcada
                                                                    let total_plantilla = element2.horas_trabajo*3600

                                                                    if( total_segundo_marcada ==  0 ){
                                                                        html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${element2.horas_trabajo}H </td>`
                                                                    }else{
                                                                        if( total_segundo_marcada > total_plantilla ){
                                                                            html += `<td style="color:#6CC773 !important" class="text-uppercase font-weight-bold"> +${ Math.floor((total_segundo_marcada-total_plantilla) / 3600)+":"+Math.floor(((total_segundo_marcada-total_plantilla) / 60) % 60)+":"+(total_segundo_marcada-total_plantilla) % 60 }H</td>`
                                                                        }
                                                                        if( total_segundo_marcada < total_plantilla ){
                                                                            html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${ Math.floor((total_plantilla-total_segundo_marcada) / 3600)+":"+Math.floor(((total_plantilla-total_segundo_marcada) / 60) % 60)+":"+(total_plantilla-total_segundo_marcada) % 60 }H</td>`
                                                                        }
                                                                    }

                                                                }else{
                                                                    if( moment(element2.year+"-"+element2.month+"-"+element2.day).format("YYYY-MM-DD") <=  moment().format("YYYY-MM-DD") ){
                                                                        html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${element2.horas_trabajo}H </td>`
                                                                    }else{
                                                                        html += `<td class="text-uppercase font-weight-bold"> 0H </td>`
                                                                    }
                                                                }
                                                            }
                                                            if( element2.turno == "N" ){
                                                                if(current_find_plus != undefined && current_find != undefined){

                                                                    let hora_marcada_entrada = moment(current_find.last)
                                                                    let hora_marcada_salida = moment(current_find_plus.first)
                                                                    let duration_marcada = moment.duration(hora_marcada_entrada.diff(hora_marcada_salida))
                                                                    let horas_marcada = ( duration_marcada._data.hours < 0 )  ? (duration_marcada._data.hours*-1) * 3600 : (duration_marcada._data.hours) * 3600
                                                                    let minutos_marcada = ( duration_marcada._data.minutes < 0 )  ? (duration_marcada._data.minutes*-1) * 60 : (duration_marcada._data.minutes) * 60
                                                                    let segundos_marcada = ( duration_marcada._data.seconds < 0 )  ? (duration_marcada._data.seconds*-1) : (duration_marcada._data.seconds)
                                                                    
                                                                    //trabajado
                                                                    let total_segundo_marcada = horas_marcada+minutos_marcada+segundos_marcada
                                                                    let total_plantilla = element2.horas_trabajo*3600

                                                                    if( total_segundo_marcada ==  0 ){
                                                                        html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${element2.horas_trabajo}H </td>`
                                                                    }else{
                                                                        if( total_segundo_marcada > total_plantilla ){
                                                                            html += `<td style="color:#6CC773 !important" class="text-uppercase font-weight-bold"> +${ Math.floor((total_segundo_marcada-total_plantilla) / 3600)+":"+Math.floor(((total_segundo_marcada-total_plantilla) / 60) % 60)+":"+(total_segundo_marcada-total_plantilla) % 60 }H</td>`
                                                                        }
                                                                        if( total_segundo_marcada < total_plantilla ){
                                                                            html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${ Math.floor((total_plantilla-total_segundo_marcada) / 3600)+":"+Math.floor(((total_plantilla-total_segundo_marcada) / 60) % 60)+":"+(total_plantilla-total_segundo_marcada) % 60 }H</td>`
                                                                        }
                                                                    }
                                                                }else{
                                                                    if( moment(element2.year+"-"+element2.month+"-"+element2.day).format("YYYY-MM-DD") <=  moment().format("YYYY-MM-DD") ){
                                                                        html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${element2.horas_trabajo}H </td>`
                                                                    }else{
                                                                        html += `<td class="text-uppercase font-weight-bold"> 0H </td>`
                                                                    }
                                                                }
                                                            }
                                                            if( element2.turno == "L" ){
                                                                html += ``
                                                            }
                                                        
                                                        
                                                    }
                                                });
                                            }
                                            html += `
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise"> Trabajador </td>
                                            <td colspan=${days_in_month} class="text-left font-weight-bold">
                                                <button onclick="excelExport('schedule_templates')" class="btn btn-secondary rounded-circle mx-1" style="width:40px;height:40px"> <i class="m-auto fas fa-lg fa-file-excel"></i> </button>
                                                <button onclick="pdfExport('schedule_templates')" class="btn btn-secondary rounded-circle mx-1" style="width:40px;height:40px"> <i class="m-auto fas fa-lg fa-file-pdf"></i> </button>`
                                                let current_turno_d = 0
                                                let current_turno_n = 0
                                                let current_turno_l = 0

                                                let sobretiempoPD = 0
                                                let sobretiempoND = 0
                                                let sobretiempoPN = 0
                                                let sobretiempoNN = 0

                                                let sobretiempoPG = 0
                                                let sobretiempoNG = 0

                                                let sobretiempoTD = "0H"
                                                let sobretiempoTN = "0H"
                                                let sobretiempoTG = "0H"

                                                
                                                let sobretiempoT = ""
                                                for (let index = 1; index <= days_in_month; index++) {
                                                    res.all_data.forEach(element2 => {
                                                        let current_find = current_data_filter.find(i=>i.date==moment(element2.year+"-"+element2.month+"-"+element2.day).format('YYYY-MM-DD'))
                                                        let current_find_plus = current_data_filter.find(i=>i.date== moment(element2.year+"-"+element2.month+"-"+element2.day).add('days', 1).format('YYYY-MM-DD'))
                                                        if( employee_id == element2.employee_id && element.year == element2.year &&  element.month == element2.month && index == element2.day ){
                                                            if( element2.turno == "D" ){
                                                                current_turno_d = current_turno_d+1
                                                                if(current_find != undefined){
                                                                    let hora_marcada_entrada = moment(current_find.first)
                                                                    let hora_marcada_salida = moment(current_find.last)
                                                                    let duration_marcada = moment.duration(hora_marcada_entrada.diff(hora_marcada_salida))
                                                                    let horas_marcada = ( duration_marcada._data.hours < 0 )  ? (duration_marcada._data.hours*-1) * 3600 : (duration_marcada._data.hours) * 3600
                                                                    let minutos_marcada = ( duration_marcada._data.minutes < 0 )  ? (duration_marcada._data.minutes*-1) * 60 : (duration_marcada._data.minutes) * 60
                                                                    let segundos_marcada = ( duration_marcada._data.seconds < 0 )  ? (duration_marcada._data.seconds*-1) : (duration_marcada._data.seconds)
                                                                    let total_segundo_marcada = horas_marcada+minutos_marcada+segundos_marcada
                                                                    let total_plantilla = element2.horas_trabajo*3600
                                                                    if( total_segundo_marcada ==  0 ){ 
                                                                        sobretiempoNG = sobretiempoNG + ( element2.horas_trabajo*3600 ) 
                                                                        sobretiempoND = sobretiempoND + ( element2.horas_trabajo*3600 ) 
                                                                    }else{
                                                                        if( total_segundo_marcada > total_plantilla ){ 
                                                                            sobretiempoPG = ( sobretiempoPG + (total_segundo_marcada-total_plantilla) ) 
                                                                            sobretiempoPD = ( sobretiempoPD + (total_segundo_marcada-total_plantilla) ) 
                                                                        }
                                                                        if( total_segundo_marcada < total_plantilla ){ 
                                                                            sobretiempoNG = ( sobretiempoNG + (total_plantilla-total_segundo_marcada) ) 
                                                                            sobretiempoND = ( sobretiempoND + (total_plantilla-total_segundo_marcada) ) 
                                                                        }
                                                                    }
                                                                }else{ 
                                                                    if( moment(element2.year+"-"+element2.month+"-"+element2.day).format("YYYY-MM-DD") <=  moment().format("YYYY-MM-DD") ){
                                                                        sobretiempoNG = sobretiempoNG + ( element2.horas_trabajo*3600 ) 
                                                                        sobretiempoND = sobretiempoND + ( element2.horas_trabajo*3600 ) 
                                                                    }
                                                                }
                                                            }
                                                            if( element2.turno == "N" ){
                                                                current_turno_n = current_turno_n+1
                                                                if(current_find_plus != undefined && current_find != undefined){
                                                                    let hora_marcada_entrada = moment(current_find.last)
                                                                    let hora_marcada_salida = moment(current_find_plus.first)
                                                                    let duration_marcada = moment.duration(hora_marcada_entrada.diff(hora_marcada_salida))
                                                                    let horas_marcada = ( duration_marcada._data.hours < 0 )  ? (duration_marcada._data.hours*-1) * 3600 : (duration_marcada._data.hours) * 3600
                                                                    let minutos_marcada = ( duration_marcada._data.minutes < 0 )  ? (duration_marcada._data.minutes*-1) * 60 : (duration_marcada._data.minutes) * 60
                                                                    let segundos_marcada = ( duration_marcada._data.seconds < 0 )  ? (duration_marcada._data.seconds*-1) : (duration_marcada._data.seconds)
                                                                    let total_segundo_marcada = horas_marcada+minutos_marcada+segundos_marcada
                                                                    let total_plantilla = element2.horas_trabajo*3600
                                                                    if( total_segundo_marcada ==  0 ){ 
                                                                        sobretiempoNG = sobretiempoNG + ( element2.horas_trabajo*3600 ) 
                                                                        sobretiempoNN = sobretiempoNN + ( element2.horas_trabajo*3600 ) 
                                                                    }else{
                                                                        if( total_segundo_marcada > total_plantilla ){ 
                                                                            sobretiempoPG = ( sobretiempoPG + (total_segundo_marcada-total_plantilla) ) 
                                                                            sobretiempoPN = ( sobretiempoPN + (total_segundo_marcada-total_plantilla) ) 
                                                                        }
                                                                        if( total_segundo_marcada < total_plantilla ){ 
                                                                            sobretiempoNG = ( sobretiempoNG + (total_plantilla-total_segundo_marcada) ) 
                                                                            sobretiempoNN = ( sobretiempoNN + (total_plantilla-total_segundo_marcada) ) 
                                                                        }
                                                                    }
                                                                }else{ 
                                                                    if( moment(element2.year+"-"+element2.month+"-"+element2.day).format("YYYY-MM-DD") <=  moment().format("YYYY-MM-DD") ){
                                                                        sobretiempoNG = sobretiempoNG + ( element2.horas_trabajo*3600 ) 
                                                                        sobretiempoNN = sobretiempoNN + ( element2.horas_trabajo*3600 ) 
                                                                    }
                                                                }
                                                            }
                                                            if( element2.turno == "L" ){  current_turno_l = current_turno_l+1  }
                                                        }
                                                    });
                                                }

                                                if(sobretiempoPD > sobretiempoND ){ 
                                                    sobretiempoTD = `+${ Math.floor((sobretiempoPD-sobretiempoND) / 3600) +":"+Math.floor(((sobretiempoPD-sobretiempoND) / 60) % 60)+":"+(sobretiempoPD-sobretiempoND) % 60 }H` 
                                                }
                                                if(sobretiempoND > sobretiempoPD ){ 
                                                    sobretiempoTD = `-${ Math.floor((sobretiempoND-sobretiempoPD) / 3600) +":"+Math.floor(((sobretiempoND-sobretiempoPD) / 60) % 60)+":"+(sobretiempoND-sobretiempoPD) % 60 }H` 
                                                }

                                                if(sobretiempoPN > sobretiempoNN ){ 
                                                    sobretiempoTN = `+${ Math.floor((sobretiempoPN-sobretiempoNN) / 3600) +":"+Math.floor(((sobretiempoPN-sobretiempoNN) / 60) % 60)+":"+(sobretiempoPN-sobretiempoNN) % 60 }H` 
                                                }
                                                if(sobretiempoNN > sobretiempoPN ){ 
                                                    sobretiempoTN = `-${ Math.floor((sobretiempoNN-sobretiempoPN) / 3600) +":"+Math.floor(((sobretiempoNN-sobretiempoPN) / 60) % 60)+":"+(sobretiempoNN-sobretiempoPN) % 60 }H` 
                                                }

                                                if(sobretiempoPG > sobretiempoNG ){ 
                                                    sobretiempoTG = `+${ Math.floor((sobretiempoPG-sobretiempoNG) / 3600) +":"+Math.floor(((sobretiempoPG-sobretiempoNG) / 60) % 60)+":"+(sobretiempoPG-sobretiempoNG) % 60 }H` 
                                                }
                                                if(sobretiempoNG > sobretiempoPG ){ 
                                                    sobretiempoTG = `-${ Math.floor((sobretiempoNG-sobretiempoPG) / 3600) +":"+Math.floor(((sobretiempoNG-sobretiempoPG) / 60) % 60)+":"+(sobretiempoNG-sobretiempoPG) % 60 }H` 
                                                }

                                                html += ` 
                                                ${current.name} - Diurnos: ( ${current_turno_d} ) - Nocturnos: ( ${current_turno_n} ) - Libres: ( ${current_turno_l} ) - Sobretiempo Diurno: ( ${sobretiempoTD} ) - Sobretiempo Nocturno: ( ${sobretiempoTN} ) - Sobretiempo Global: ( ${sobretiempoTG} )
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        `
                    });

                 
                }
            });


           

            

        });

        clearInterval(timerInterval)
            
            Swal.fire({
                title: `Horarios`,
                showConfirmButton: true,
                showCloseButton: true,
                width: "95%",
                confirmButtonText: 'Ok',
                html: html
            })
    }

    function setLoading(timerInterval) {
            Swal.fire({
                title: 'Procesando datos!',
                text: 'porfavor espere',
                timer: 300000,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => { }, 100)
                },
            })
        }

</script>
@endsection