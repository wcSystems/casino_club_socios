@extends('layouts.app')
@section('css')
<style>
    input[type="file"] {
    display: none;
}
</style>
@endsection
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <label  class="d-flex btn btn-1 btn-info m-0">
                <input id="file_upload" type="file"/>
                <i class="m-auto fa fa-lg fa-file"></i>
            </label>
        </div>
        <div class="panel-heading-btn mx-2">
            <label onclick="uploadFile()" class="d-flex btn btn-1 btn-info m-0">
                <i class="m-auto fa fa-lg fa-arrow-up"></i>
            </label>
        </div>
        <div class="panel-heading-btn">
            <button onclick="modal('Crear')" class="d-flex btn btn-1 btn-success">
                <i class="m-auto fa fa-lg fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sede_employees" class="form-control w-100">
                            <option value="" selected >Todos las sedes</option>
                            @foreach( $sedes as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_department_employees" class="form-control w-100">
                            <option value="" selected >Todos los departamentos</option>
                            @foreach( $departments as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_position_employees" class="form-control w-100">
                            <option value="" selected >Todos los cargos</option>
                            @foreach( $positions as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sex_employees" class="form-control w-100">
                            <option value="" selected >Todos los sexos</option>
                            @foreach( $sexs as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.min.js"></script>  
<script>
    $('#employees_nav').removeClass("closed").addClass("active").addClass("expand")
    function uploadFile() {
        let files = document.getElementById('file_upload').files;
        if(files.length==0){
          alert("Archivo no valido");
          return;
        }
        let filename = files[0].name;
        let extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
        if (extension == '.XLS' || extension == '.XLSX') {
            excelFileToJSON(files[0]);
        }else{
            alert("Seleccione un archivode excel valido");
        }
    }
    function excelFileToJSON(file){
        try {
            let reader = new FileReader();
            reader.readAsBinaryString(file);
            reader.onload = function(e) {
                let data = e.target.result;
                let workbook = XLSX.read(data, {
                    type : 'binary'
                });
                let result = {};
                workbook.SheetNames.forEach(function(sheetName) {
                    let roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                    if (roa.length > 0) { result[sheetName] = roa; }
                });
                uploadEmployees(result)
            }
        }catch(e){
            console.error(e);
        }
      }
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="row">
                        <div class="panel-heading-btn mx-2">
                            <label onclick="viewImg()" class="d-flex btn btn-1 btn-info m-0">
                                <i class="m-auto fa fa-lg fa-arrow-up"></i>
                                <img id="imgISAPI" />
                            </label>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Cedula <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="employeeNo" name="employeeNo" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese Su Numero de Cedula" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nombre y Apellido <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Nombre y Apellido porfavor" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Fecha de Nacimiento <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="date" id="nacimiento" name="nacimiento" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Su fecha de nacimiento" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Sexos <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="sex_id" class="form-control w-100">
                                        <option value="" selected >Todos los Sexos</option>
                                        @foreach( $sexs as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Sedes <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="sede_id" class="form-control w-100">
                                        <option value="" selected >Todos las Sedes</option>
                                        @foreach( $sedes as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Departamentos <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="department_id" class="form-control w-100">
                                        <option value="" selected >Todos los Departamentos</option>
                                        @foreach( $departments as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Cargos <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="position_id" class="form-control w-100">
                                        <option value="" selected >Todos los Cargos</option>
                                        @foreach( $positions as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
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
            let current={!! $employees !!}.find(i=>i.id===id)
            $("#employeeNo").attr("disabled", true)
            $("#employeeNo").val(current.employeeNo)
            $("#name").val(current.name)
            $("#nacimiento").val(current.nacimiento)
            $("#sede_id").val(current.sede_id)
            $("#department_id").val(current.department_id)
            $("#sex_id").val(current.sex_id)
            $("#position_id").val(current.position_id)
        }
        validateForm()
    }
    function uploadEmployees(params) {
        $.ajax({
            url: "{{ route('isapi.uploadEmployees') }}",
            type: "POST",
            data: params,
            success: function (res) {
                if(res.type === 'success'){
                    location.reload();
                }
            }
        });
    }
    function viewImg() {
        $.ajax({
            url: "{{ route('isapi.captureImgEmployee') }}",
            success: function (res) {
                let add = ` <xmp>
                                <catalog>
                                    <cd>
                                        <title>Empire Burlesque</title>
                                        <artist>Bob Dylan</artist>
                                        <country>USA</country>
                                        <country>Columbia</country>
                                        <price>10.90</price>
                                        <year>1985</year>
                                    </cd>
                                </catalog>
                            </xmp>`;
                //$("#imgISAPI").replaceWith(res)
                let imgXml = res
                console.log(imgXml)
               /*  if(res.type === 'success'){
                    location.reload();
                } */
            }
        });
    }
    function guardar(id) {
        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    employeeNo: $("#employeeNo").val(),
                    name: $("#name").val(),
                    nacimiento: $("#nacimiento").val(),
                    sex_id: $("#sex_id").val(),
                    department_id: $("#department_id").val(),
                    position_id: $("#position_id").val(),
                    sede_id: $("#sede_id").val(),
                }
            }
            $.ajax({
                url: "{{ route('isapi.addOrUpdateEmployee') }}",
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
    function elim(id,employeeNo) {
            Swal.fire({
                title: 'Estás seguro?',
                text: 'No serás capaz de recuperar el registro a borrar!',
                icon: 'error',
                showCancelButton: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('isapi.elimEmployee') }}`,
                        type: "POST",
                        data: {
                            _token: $("meta[name='csrf-token']").attr("content"),
                            id: id,
                            employeeNo: employeeNo
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

    function view(params) {
            $.ajax({
                url: "{{ route('employees.history') }}",
                type: "POST",
                data: { id: params },
                success: function (res) {
                    let htmlTemplate = `
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="data-table-default-view" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora de Marcaje</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>`;
                                    res.forEach(element => {

                                        let pictureURL = element.pictureURL.slice(7);
                                       
                                        pictureURL = `http://admin:Cas1n01234@${pictureURL}`;

                                        htmlTemplate +=`
                                        <tr>
                                            <td>${element.date}</td>
                                            <td>${moment(element.time).format('h:mm:ss a')}</td>
                                            <td>
                                                <a href='${pictureURL}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>
                                            </td>
                                        </tr>
                                        `;
                                    });
                                htmlTemplate+=
                                `</tbody>
                            </table>
                        </div>
                    </div>`;
                    Swal.fire({
                        title: `Registros`,
                        showConfirmButton: false,
                        html: htmlTemplate,
                        width: '80em',
                    })

                    dataTableView()
                }
            });
        
    }

    function createSchedule(id) {
        let html = ``;
            html +=`
            <form id="form-all-schedule" class="needs-validation" action="javascript:void(0);" novalidate>
                <div class="row">
                    <div class="col-12 m-auto">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label font-weight-bold"> Horas de trabajo <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12 my-1">
                                    <select required id="horas_trabajo" class="form-control w-100">
                                        <option value="" selected >Seleccione</option>
                                        <option value="8" > 08 Horas </option>
                                        <option value="12" > 12 Horas </option>
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
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
        Swal.fire({ title: {!! $employees !!}.find(i=>i.id===id).name, showConfirmButton: false, width: '80em', html:html })
        monthYearChange(id)
        validateForm()
    }

    function monthYearChange(employee_id) {
        let current={!! $schedule_templates !!}.filter(i=>i.employee_id==employee_id).filter(i=>i.year==$("#month_year").val().slice(0,4)).filter(i=>i.month==$("#month_year").val().slice(5))
        let days_in_month=moment( $("#month_year").val().slice(5) ).daysInMonth();
        let html = ``
            html +=`
            <div id="daysOfMonth" class="row">
                <div class="col-12 m-auto"><label class=" text-lg-right col-form-label font-weight-bold"> Horario ${ moment($("#month_year").val().slice(5)).format('MMMM') } ${ $("#month_year").val().slice(0,4) }</span> </label></div>`;
                for (let index = 1; index <= days_in_month; index++) {
                    let current_data= ( current.find(i=>i.day==index) != undefined ) ? current.find(i=>i.day==index)  : {} ;
                    html +=`
                    <div class="col-md-2 col-sm-2">
                        <div class="form-group row m-b-0 m-2">
                            <label class=" text-lg-right col-form-label font-weight-bold"> ${ moment($("#month_year").val().slice(0,4)+"-"+$("#month_year").val().slice(5)+"-"+index).format('dd') }(${moment($("#month_year").val().slice(0,4)+"-"+$("#month_year").val().slice(5)+"-"+index).format('DD')}) <span class="text-danger"> *</span> </label>
                            <input type="hidden" id="${index}_id" name="${index}_id" value="${current_data.id}" >
                            <div class="col-lg-12 my-1">
                                <select id="${index}_hora_entrada" class="form-control w-100" >
                                    <option value="00:00-L" class="font-weight-bold"  >LIBRE</option>
                                    <optgroup label="Diurno">
                                        <option value="06:00-D" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "06:00-D" ? "selected" : "" } > 06:00 AM </option>
                                        <option value="08:00-D" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "08:00-D" ? "selected" : "" } > 08:00 AM </option>
                                        <option value="09:00-D" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "09:00-D" ? "selected" : "" } > 09:00 AM </option>
                                        <option value="11:30-D" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "11:30-D" ? "selected" : "" } > 11:30 AM </option>
                                    </optgroup>
                                    <optgroup label="Nocturno">
                                        <option value="12:00-N" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "12:00-N" ? "selected" : "" } > 12:00 PM</option>
                                        <option value="13:00-N" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "13:00-N" ? "selected" : "" } > 01:00 PM</option>
                                        <option value="16:00-N" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "16:00-N" ? "selected" : "" } > 04:00 PM</option>
                                        <option value="18:00-N" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "18:00-N" ? "selected" : "" } > 06:00 PM</option>
                                        <option value="20:00-N" ${ ((current_data.hora_entrada)+"-"+(current_data.turno)) == "20:00-N" ? "selected" : "" } > 08:00 PM</option>
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

    function guardarSchedule(employee_id) {
        let newArr = []
        let days_in_month=moment( $("#month_year").val().slice(5) ).daysInMonth();
        for (let index = 1; index <= days_in_month; index++) {
            newArr.push({
                id: { id: $(`#${index}_id`).val() != "undefined" ? $(`#${index}_id`).val() : "" },
                schedule: {
                    employee_id: employee_id,
                    hora_entrada: $(`#${index}_hora_entrada`).val().slice(0,5),
                    horas_trabajo: $("#horas_trabajo").val(),
                    turno: $(`#${index}_hora_entrada`).val().slice(6),
                    year: $("#month_year").val().slice(0,4),
                    month: $("#month_year").val().slice(5),
                    day: index,
                    date: moment(`${$("#month_year").val().slice(0,4)}-${$("#month_year").val().slice(5)}-${index}`).format('YYYY-MM-DD'),
                }
            })
        }
        let validity = document.getElementById('form-all-schedule').checkValidity()
        if(validity){
            let payload = { _token: $("meta[name='csrf-token']").attr("content"), data: newArr  }
            $.ajax({
                url: "{{ route('schedule_templates.store') }}",
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

    function viewSchedule(employee_id) {
        let timerInterval 
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('schedule_templates.viewSchedule') }}",
            type: "POST",
            data: { employee_id: employee_id },
            success: function (res) {

                let current={!! $employees !!}.find(i=>i.id===employee_id)
                let current_data_filter=res.query.filter(i=>i.employee_id==employee_id)
                let html = ``;
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
                                                        html += `<td style="color:#6CC773 !important" class="font-weight-bold" >( ${element2.turno} ) ${moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).format('LT')} - ${ moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).add(element2.horas_trabajo, 'h').format('LT') }</td>`
                                                    }
                                                    if( element2.turno == "N" ){
                                                        html += `<td style="color:#6C7FC7 !important" class="font-weight-bold" >( ${element2.turno} ) ${moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).format('LT')} - ${ moment(element2.year+"-"+element2.month+"-"+index+" "+element2.hora_entrada).add(element2.horas_trabajo, 'h').format('LT') }</td>`
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
                                                                html += `<td class="text-uppercase font-weight-bold"> NO MARCO </td>`
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
                                                                html += `<td class="text-uppercase font-weight-bold"> NO TRABAJO </td>`
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
                                                                html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${element2.horas_trabajo}H </td>`
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
                                                                html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${element2.horas_trabajo}H </td>`
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
                                            let sobretiempoP = 0
                                            let sobretiempoN = 0
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
                                                                if( total_segundo_marcada ==  0 ){ sobretiempoN = sobretiempoN + ( element2.horas_trabajo*3600 ) }else{
                                                                    if( total_segundo_marcada > total_plantilla ){ sobretiempoP = ( sobretiempoP + (total_segundo_marcada-total_plantilla) ) }
                                                                    if( total_segundo_marcada < total_plantilla ){ sobretiempoN = ( sobretiempoN + (total_plantilla-total_segundo_marcada) ) }
                                                                }
                                                            }else{ sobretiempoN = sobretiempoN + ( element2.horas_trabajo*3600 ) }
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
                                                                if( total_segundo_marcada ==  0 ){ sobretiempoN = sobretiempoN + ( element2.horas_trabajo*3600 ) }else{
                                                                    if( total_segundo_marcada > total_plantilla ){ sobretiempoP = ( sobretiempoP + (total_segundo_marcada-total_plantilla) ) }
                                                                    if( total_segundo_marcada < total_plantilla ){ sobretiempoN = ( sobretiempoN + (total_plantilla-total_segundo_marcada) ) }
                                                                }
                                                            }else{ sobretiempoN = sobretiempoN + ( element2.horas_trabajo*3600 ) }
                                                        }
                                                        if( element2.turno == "L" ){  current_turno_l = current_turno_l+1  }
                                                    }
                                                });
                                            }
                                            if(sobretiempoP > sobretiempoN ){
                                                sobretiempoT = `+${ Math.floor((sobretiempoP-sobretiempoN) / 3600) +":"+Math.floor(((sobretiempoP-sobretiempoN) / 60) % 60)+":"+(sobretiempoP-sobretiempoN) % 60 }H`
                                            }
                                            if(sobretiempoN > sobretiempoP ){
                                                sobretiempoT = `-${ Math.floor((sobretiempoN-sobretiempoP) / 3600) +":"+Math.floor(((sobretiempoN-sobretiempoP) / 60) % 60)+":"+(sobretiempoN-sobretiempoP) % 60 }H`
                                            }
                                            html += ` 
                                            ${current.name} - Diurnos: ( ${current_turno_d} ) - Nocturnos: ( ${current_turno_n} ) - Libres: ( ${current_turno_l} ) - Sobretiempo: ${sobretiempoT}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    `
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
        });
    }

    dataTable("{{route('employees.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim(${row.id},${row.employeeNo})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                    <a onclick="view(${row.id})" style="color: var(--global-2)" class="btn btn-green btn-icon btn-circle"><i class="fas fa-eye"></i></a>
                    <a onclick="createSchedule(${row.id})" style="color: var(--global-2)" class="btn btn-info btn-icon btn-circle"><i class="fas fa-calendar"></i></a>
                    <a onclick="viewSchedule(${row.id})" style="color: var(--global-2)" class="btn btn-dark btn-icon btn-circle"><i class="fas fa-calendar"></i></a>
                `;
            }
        },
    ])

        function excelExport(title,dl,fn) {
            let user = {!! Auth::user() !!}
            var elt = document.getElementById('data-table-default-schedule');
            var wb = XLSX.utils.table_to_book(elt, { sheet: "Horarios" });
            return dl ?
            XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
            XLSX.writeFile(wb, fn || ( user.name+'-'+title+'-'+moment().format('MMMM Do YYYY, h:mm:ss a')+'.'+('xlsx' || 'xlsx')));
        }
        function pdfExport(title) {
                let user = {!! Auth::user() !!}
                var doc = new jsPDF({
                    orientation: 'l', 
                    unit: 'cm', 
                    format: [240, 5000]
                })
                doc.autoTable({ html: '#data-table-default-schedule' })
                doc.save(`${user.name}-${title}-${moment().format('MMMM Do YYYY, h:mm:ss a')}.pdf`)
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
    
        function dataScheduleView(year,month) {
            $(document).ready(function() {
                let table = $(`#data-table-default-schedule-${year}-${month}`).DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    //responsive: true,
                    processing: true,
                    lengthChange: true,
                    scrollX: true,
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
                $("#search").keyup( () =>{ $('#data-table-default-schedule').DataTable().ajax.reload() });
            });
        }

        function dataTableView() {
            $(document).ready(function() {
                let table = $('#data-table-default-view').DataTable({
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    responsive: true,
                    processing: true,
                    lengthChange: true,
                    order: [[0, 'desc']],
                    drawCallback: function (settings) {
                            var api = this.api();
                            var rows = api.rows({ page: 'current' }).nodes();
                            var last = null;
                            api.rows({ page: 'current' }).data().each(function (data, i) {
                                if (last !== data[0]) {
                                    $(rows).eq(i).before('<tr class="authDate"><td colspan="5">FECHA: ' + data[0] + "<span class='font-weight-bold'> ( "+ moment(data[0]).format('dddd') +" ) </span>"+ '</td></tr>');
                                    last = data[0];
                                }
                            });
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
                $("#search").keyup( () =>{ $('#data-table-default-view').DataTable().ajax.reload() });
            });
        }

</script>
@endsection