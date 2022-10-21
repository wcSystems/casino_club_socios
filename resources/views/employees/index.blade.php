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
                `;
            }
        },
    ])
</script>
@endsection