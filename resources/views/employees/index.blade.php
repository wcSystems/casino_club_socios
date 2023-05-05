@extends('layouts.app')
@section('css')
<style>
    input[type="file"] {
    display: none;
}

#horarioTitle > br {
    display: none !important;
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
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Cedula</th>
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
            let html = `
            <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                <div class="row">`

                    if(id){
                        html+=`
                        <div class="mx-auto">
                            <label class="d-flex m-0">
                                <img id="imgUser" class="rounded-circle"  src='public/users/null.jpg' onerror="this.onerror=null;this.src='public/users/null.jpg';" width="200" height="200" />
                                <input require onchange="viewImg(this)" type="file" id="image" name="image" style="display:none" >
                            </label>
                        </div>
                        `
                    }
                    


                    html+=`
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
                        <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar Datos </button>
                        `

                    if(id){
                        html+=`
                        <button onclick="guardarIMG(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar Imagen </button>
                        `
                    }
                        html+=`
                    </div>
                </div>
            </form>`

            Swal.fire({
                title: `${type} Registro`,
                showConfirmButton: false,
                html: html
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
                $("#imgUser").attr("src",`public/employees/${current.employeeNo}.jpg`)
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
        
        function viewImg(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgUser').attr('src', e.target.result).width(200).height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        async function guardar(id) {

            let validity = document.getElementById('form-all').checkValidity()
            if(validity){
            
                let payload = new FormData();   
                    payload.append('id',id ? id : "")
                    payload.append('employeeNo',$('#employeeNo').val())
                    payload.append('name',$('#name').val())
                    payload.append('nacimiento',$('#nacimiento').val())
                    payload.append('sex_id',$('#sex_id').val())
                    payload.append('sede_id',$('#sede_id').val())
                    payload.append('department_id',$('#department_id').val())
                    payload.append('position_id',$('#position_id').val())
                
                    $.ajax({
                        url: "{{ route('isapi.addOrUpdateEmployee') }}",
                        type: "POST",
                        data: payload,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                        success: function (res) {
                            if(res.type === 'success'){
                                location.reload();
                            }
                        }   
                    });  
            }
        }
        async function guardarIMG(id) {

            let validity = document.getElementById('form-all').checkValidity()
            if(validity){
            
       

                let payloadIMG = new FormData(); 
                        payloadIMG.append('employeeNo',$('#employeeNo').val())
                        payloadIMG.append('name',$('#name').val())
                        payloadIMG.append('originIMG',window.location.origin+"/public/employees/"+$('#employeeNo').val()+".jpg")

                       
                            if($('#image').prop('files')[0]){
                                payloadIMG.append('image',await resizeImage({ file: $('#image').prop('files')[0],maxSize: 500 }))
                            }
                     

                            $.ajax({
                                url: "{{ route('isapi.sendImg') }}",
                                type: "POST",
                                data: payloadIMG,
                                processData: false,
                                contentType: false,
                                enctype: 'multipart/form-data',
                                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                                success: function (res) {
                                    if(res.type === 'success'){
                                        location.reload();
                                    }
                                }
                            });

                        
                        

                   
                

            }
        }
        function elim(id) {
            let current={!! $employees !!}.find(i=>i.id===id)
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
                                employeeNo: current.employeeNo
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
            fetch("https://api.ipify.org/?format=json").then(r => r.json()).then(res => {
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
                                            <th>Foto ( INTERNO )</th>
                                            <th>Foto ( EXTERNO ) </th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
                                    
                                        res.forEach(element => {
                                            htmlTemplate +=`
                                            <tr>
                                                <td>${element.date}</td>
                                                <td>${moment(element.time).format('h:mm:ss a')}</td>
                                                <td>`
                                                    htmlTemplate +=`<a href='http://admin:Cas1n01234@192.168.5.181${element.pictureURL.slice(27)}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>
                                                </td>
                                                <td>`
                                                    htmlTemplate +=`<a href='http://admin:Cas1n01234@${element.pictureURL.slice(7)}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>
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
            });
        }

        function viewSchedule(employeeNo,schedule_template_id,year,month) {
            let timerInterval 
            setLoading(timerInterval)
            $.ajax({
                url: "{{ route('schedule_templates.viewSchedule') }}",
                type: "POST",
                data: { employeeNo: employeeNo, schedule_template_id: schedule_template_id, year_month: `${year}-${month}` },
                success: function (res) {

                    let horarios = {!! $horario !!}
                    let horarioUniqueCurrent = res.employee_schedule.horario.split(',')
                        horarioUniqueCurrent = new Set(horarioUniqueCurrent);
                        horarioUniqueCurrent = [...horarioUniqueCurrent];
                    
                    
                    
                    clearInterval(timerInterval)
                    if(res.type == "success" ){

                        let days_in_month = (res.employee_schedule.marcajes).length;

                        let htmlTitle = ``;
                            htmlTitle += `
                                <div id="horarioTitle" class="table-responsive">
                                    <div class="col-12 mx-auto">
                                        <img id="imgUser" class="rounded-circle"  src='public/employees/${employeeNo}.jpg' onerror="this.onerror=null;this.src='public/users/null.jpg';" width="200" height="200" />
                                    </div>
                                    <div class="col-12 my-3"> Horario ${moment(res.employee_schedule.month).format('MMMM')} ${res.employee_schedule.year}
                                        ${ res.employee_schedule.name }
                                        ${ res.employee_schedule.positions_name }, ${ res.employee_schedule.departments_name }
                                    </div>
                                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle  d-inline mx-auto" style="overflow-x: auto;display: block;white-space: nowrap;width:fit-content !important">
                                        <thead style="background-color:paleturquoise;">
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
                                                        htmlTitle += `
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
                                                            htmlTitle += `
                                                        </tr>`
                                                    }
                                                }
                                                
                                            });
                                            htmlTitle +=`
                                        </tbody>
                                    </table>
                                </div>`;
                        let html = ``;
                            html += `
                            <div class="table-responsive d-flex flex-column">
                                <table id="data-table-default-schedule-${res.employee_schedule.year}-${res.employee_schedule.month}" class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline mx-auto" style="overflow-x: auto;display: block;white-space: nowrap;width:fit-content !important">
                                    
                                    <thead style="background-color:paleturquoise;" >
                                        <tr>
                                            <th class="text-center text-uppercase font-weight-bold">Dia</th>`;
                                            (res.employee_schedule.marcajes).forEach(elementMarcaje => {
                                                html += `<th class="text-center text-uppercase font-weight-bold"> ${ moment(res.employee_schedule.year+"-"+res.employee_schedule.month+"-"+elementMarcaje.dia).format('dd') }(${moment(res.employee_schedule.year+"-"+res.employee_schedule.month+"-"+elementMarcaje.dia).format('DD')}) </th>`;
                                            });
                                            html += `
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise;">Horario</td>`;
                                            (res.employee_schedule.marcajes).forEach(elementMarcaje => {
                                                html += `<td style="color:#6C7FC7 !important" class="font-weight-bold" > ${elementMarcaje.turno} </td>`;
                                            });
                                            html += `
                                        </tr>

                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise;">Entrada</td>`;
                                            (res.employee_schedule.marcajes).forEach(elementMarcaje => {

                                                if( elementMarcaje.leyenda == "T1" ){
                                                    let validMarcajeFirstT1 = ( elementMarcaje.status == "NO MARCO" ) ? "- - -" : moment(elementMarcaje.first).format('h:mm:ss a')
                                                    html += `<td class="text-uppercase font-weight-bold"> ${ validMarcajeFirstT1 }</td>`;
                                                }
                                                if( elementMarcaje.leyenda == "T2" ){
                                                    let validMarcajeFirstT2 = ( elementMarcaje.status == "NO MARCO" ) ? "- - -" : moment(elementMarcaje.last).format('h:mm:ss a')
                                                    
                                                    let validMarcajeFirstT2E = (res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ) ? moment((res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ).first).format('h:mm:ss a') : "- - -"
                                                        validMarcajeFirstT2E = ( validMarcajeFirstT2E == "Invalid date" ) ? "- - -" : validMarcajeFirstT2
                                                    html += `<td class="text-uppercase font-weight-bold"> ${ validMarcajeFirstT2E }</td>`;
                                                    
                                                }
                                                if( elementMarcaje.leyenda == "L" ){
                                                    html += `<td class="text-uppercase font-weight-bold"> ${ elementMarcaje.turno }</td>`;
                                                }

                                            });
                                            html += `
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise;">Salida</td>`;
                                            (res.employee_schedule.marcajes).forEach( (elementMarcaje, index) => {
                                            

                                                if( elementMarcaje.leyenda == "T1" ){
                                                    let validMarcajeFirstT1 = ( elementMarcaje.first == elementMarcaje.last ) ? "- - -" : moment(elementMarcaje.last).format('h:mm:ss a')
                                                    html += `<td class="text-uppercase font-weight-bold"> ${ validMarcajeFirstT1 }</td>`;
                                                }
                                                if( elementMarcaje.leyenda == "T2" ){

                                                    let validMarcajeFirstT2 = (res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ) ? moment((res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ).first).format('h:mm:ss a') : "- - -"
                                                        validMarcajeFirstT2 = ( validMarcajeFirstT2 == "Invalid date" ) ? "- - -" : validMarcajeFirstT2
                                                    
                                                    html += `<td class="text-uppercase font-weight-bold"> ${ validMarcajeFirstT2 }</td>`;
                                                    
                                                }
                                                if( elementMarcaje.leyenda == "L" ){
                                                    html += `<td class="text-uppercase font-weight-bold"> ${ elementMarcaje.turno }</td>`;
                                                }


                                            });
                                            html += `
                                        </tr>


                                        <tr>
                                            <td class="font-weight-bold" style="background-color:paleturquoise"> Diferencia </td>`;
                                
                                            (res.employee_schedule.marcajes).forEach( (elementMarcaje, index) => {
                                                if( elementMarcaje.leyenda == "T1" ){
                                                    if( elementMarcaje.status == "NO MARCO" || elementMarcaje.first == elementMarcaje.last ){
                                                        html += `<td class="text-uppercase font-weight-bold"> - - - </td>`;
                                                    }else{

                                                        let hora_marcada_entrada = moment(elementMarcaje.first)
                                                        let hora_marcada_salida = moment(elementMarcaje.last)
                                                        let duration_marcada = moment.duration(hora_marcada_entrada.diff(hora_marcada_salida))
                                                        let horas_marcada = ( duration_marcada._data.hours < 0 )  ? (duration_marcada._data.hours*-1) * 3600 : (duration_marcada._data.hours) * 3600
                                                        let minutos_marcada = ( duration_marcada._data.minutes < 0 )  ? (duration_marcada._data.minutes*-1) * 60 : (duration_marcada._data.minutes) * 60
                                                        let segundos_marcada = ( duration_marcada._data.seconds < 0 )  ? (duration_marcada._data.seconds*-1) : (duration_marcada._data.seconds)
                                                        let total_segundo_marcada = horas_marcada+minutos_marcada+segundos_marcada
                                                        let total_plantilla = elementMarcaje.hora_trabajo*3600

                                                        if( total_segundo_marcada > total_plantilla ){
                                                            html += `<td style="color:#6CC773 !important" class="text-uppercase font-weight-bold"> +${ Math.floor((total_segundo_marcada-total_plantilla) / 3600)+":"+Math.floor(((total_segundo_marcada-total_plantilla) / 60) % 60)+":"+(total_segundo_marcada-total_plantilla) % 60 }H</td>`;
                                                        }
                                                        if( total_segundo_marcada < total_plantilla ){
                                                            html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${ Math.floor((total_plantilla-total_segundo_marcada) / 3600)+":"+Math.floor(((total_plantilla-total_segundo_marcada) / 60) % 60)+":"+(total_plantilla-total_segundo_marcada) % 60 }H</td>`;
                                                        }

                                                    }
                                                }

                                                if( elementMarcaje.leyenda == "T2" ){
                                                    let validMarcajeFirstT2 = (res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ) ? moment((res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ).first).format('h:mm:ss a') : "- - -"
                                                     
                                                    if( elementMarcaje.status == "NO MARCO" || validMarcajeFirstT2 == "Invalid date" ){
                                                        html += `<td class="text-uppercase font-weight-bold"> - - - </td>`;
                                                    }else{

                                                        let hora_marcada_entrada = moment(elementMarcaje.last)
                                                        let hora_marcada_salida =   moment((res.employee_schedule.marcajes).find( i => i.date == moment(elementMarcaje.date).add('days', 1).format('YYYY-MM-DD') ).first)
                                                        let duration_marcada = moment.duration(hora_marcada_entrada.diff(hora_marcada_salida))
                                                        let horas_marcada = ( duration_marcada._data.hours < 0 )  ? (duration_marcada._data.hours*-1) * 3600 : (duration_marcada._data.hours) * 3600
                                                        let minutos_marcada = ( duration_marcada._data.minutes < 0 )  ? (duration_marcada._data.minutes*-1) * 60 : (duration_marcada._data.minutes) * 60
                                                        let segundos_marcada = ( duration_marcada._data.seconds < 0 )  ? (duration_marcada._data.seconds*-1) : (duration_marcada._data.seconds)
                                                        let total_segundo_marcada = horas_marcada+minutos_marcada+segundos_marcada
                                                        let total_plantilla = elementMarcaje.hora_trabajo*3600

                                                        if( total_segundo_marcada > total_plantilla ){
                                                            html += `<td style="color:#6CC773 !important" class="text-uppercase font-weight-bold"> +${ Math.floor((total_segundo_marcada-total_plantilla) / 3600)+":"+Math.floor(((total_segundo_marcada-total_plantilla) / 60) % 60)+":"+(total_segundo_marcada-total_plantilla) % 60 }H</td>`;
                                                        }
                                                        if( total_segundo_marcada < total_plantilla ){
                                                            html += `<td style="color:#ff4040 !important" class="text-uppercase font-weight-bold"> -${ Math.floor((total_plantilla-total_segundo_marcada) / 3600)+":"+Math.floor(((total_plantilla-total_segundo_marcada) / 60) % 60)+":"+(total_plantilla-total_segundo_marcada) % 60 }H</td>`;
                                                        }

                                                    }
                                                }
                                                
                                                if( elementMarcaje.leyenda == "L" ){
                                                    if( elementMarcaje.status == "MARCO" ){
                                                        html += `<td class="text-uppercase font-weight-bold"> M </td>`;
                                                    }else{
                                                        html += `<td class="text-uppercase font-weight-bold"> ${ elementMarcaje.turno }</td>`;
                                                    }
                                                    
                                                }        
                                            });
                                        html += `
                                        </tr>



                                    </tbody>
                                </table>

                                


                            </div>`;
                        
                        Swal.fire({
                            title: htmlTitle.trim(),
                            showConfirmButton: true,
                            showCloseButton: true,
                            width: "95%",
                            confirmButtonText: 'Ok',
                            html: html
                        }) 
                    }

                    if(res.type == "error" ){
                        Swal.fire({
                            showConfirmButton: true,
                            showCloseButton: true,
                            confirmButtonText: 'CERRAR',
                            title: 'ERROR',
                            text: 'Este empleado no tiene registros de marcajes en este mes',
                        })
                    }
                }
            });
        }

        function ViewYearMonthGroup(employee_id,employeeNo) {
            let timerInterval 
            setLoading(timerInterval)
            $.ajax({
                url: "{{ route('schedule_templates.viewYearMonthGroup') }}",
                type: "POST",
                data: { employee_id: employee_id },
                success: function (res) {
                    clearInterval(timerInterval)
                    if(res.schedules.length > 0){
                        let html = ``;
                            html += `<div class="col-sm-12" style="margin-top:20px">`;

                            res.schedules.forEach(element => {
                                html += `<button onclick="viewSchedule('${employeeNo}',${element.id},'${element.year}','${element.month}')" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> ${ moment(element.month).format('MMMM')} ${element.year} </button>` 
                            });

                            html += `</div>`;
                        Swal.fire({
                            title: 'Horario',
                            showConfirmButton: false,
                            showCloseButton: false,
                            html: html
                        })
                    }else{
                        Swal.fire({
                            showConfirmButton: true,
                            showCloseButton: true,
                            confirmButtonText: 'CERRAR',
                            title: 'ERROR',
                            text: 'Este empleado no tiene registros de horarios creados',
                        })
                    }
                }
            });
        }

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

        dataTable("{{route('employees.service')}}",[
            {
                render: function ( data,type, row,all  ) {
                    return row.id;
                }
            },
            {
                render: function ( data,type, row,all  ) {
                    return `<img onclick="previewIMG(${row.id})" src='public/employees/${row.employeeNo}.jpg' onerror="this.onerror=null;this.src='public/users/null.jpg';" class="btn  btn-icon btn-circle m-2" />`;
                        
                }
            },
            { data: 'name' },
            { data: 'employeeNo' },
            {
                render: function ( data,type, row  ) {
                    return `
                        <a onclick="elim(${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle m-2"><i class="fa fa-times"></i></a>
                        <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle m-2"><i class="fas fa-pen"></i></a>
                        <a onclick="ViewYearMonthGroup(${row.id},'${row.employeeNo}')" style="color: var(--global-2)" class="btn btn-dark btn-icon btn-circle m-2"><i class="fas fa-calendar"></i></a>
                    `;
                }
            },
        ])

        function previewIMG(employee_id) {
            let current={!! $employees !!}.find(i=>i.id===employee_id)
            Swal.fire({
                        showConfirmButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'CERRAR',
                        html: `<div>
                            <div class="py-3 font-weight-bold">${current.name}</div>
                            <img  src='public/employees/${current.employeeNo}.jpg' width="100%" onerror="this.onerror=null;this.src='public/users/null.jpg';" />
                        </div>`
                    })
        }

        function resizeImage(settings) {
                var file = settings.file;
                var maxSize = settings.maxSize;
                var reader = new FileReader();
                var image = new Image();
                var canvas = document.createElement('canvas');
                var dataURItoBlob = function (dataURI) {
                    var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
                        atob(dataURI.split(',')[1]) :
                        unescape(dataURI.split(',')[1]);
                    var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
                    var max = bytes.length;
                    var ia = new Uint8Array(max);
                    for (var i = 0; i < max; i++)
                        ia[i] = bytes.charCodeAt(i);
                    return new Blob([ia], { type: mime });
                };
                var resize = function () {
                    var width = image.width;
                    var height = image.height;
                    if (width > height) {
                        if (width > maxSize) {
                            height *= maxSize / width;
                            width = maxSize;
                        }
                    } else {
                        if (height > maxSize) {
                            width *= maxSize / height;
                            height = maxSize;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                    var dataUrl = canvas.toDataURL('image/jpeg');
                    return dataURItoBlob(dataUrl);
                };
                return new Promise(function (ok, no) {
                    if (!file.type.match(/image.*/)) {
                        no(new Error("Not an image"));
                        return;
                    }
                    reader.onload = function (readerEvent) {
                        image.onload = function () { return ok(resize()); };
                        image.src = readerEvent.target.result;
                    };
                    reader.readAsDataURL(file);
                });
        };

</script>
@endsection