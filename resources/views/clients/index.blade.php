
@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="pdfExport('Clients')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-pdf"></i>
            </button>
            <button onclick="excelExport('Clients')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-excel"></i>
            </button>
            <button onclick="modal('Crear')" class="d-flex btn btn-1 btn-success mx-1">
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
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Sede</th>
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
    $('#clients_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) { 
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form_user_create" class="needs-validation" action="javascript:void(0);" novalidate >
                @csrf
                    <div class="row">
                        {{-- Inputs --}}
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nombre <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su nombre" >
                                    <div class="invalid-feedback text-left">Ingrese un nombre porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Apellido <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="last_name" name="last_name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su apellido" >
                                    <div class="invalid-feedback text-left">Ingrese un Apellido porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Cedula <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="cedula" name="cedula" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su numero de cedula" >
                                    <div class="invalid-feedback text-left">Ingrese un numero de Cedula porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nacimiento <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="date" id="f_nac" name="f_nac" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese fecha de nacimiento" >
                                    <div class="invalid-feedback text-left">Ingrese una fecha de Cumpleaños porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Telefono <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="phone" name="phone" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su numero de telefono" >
                                    <div class="invalid-feedback text-left">Ingrese un numero de telefono porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Email <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="mail" id="email" name="email" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su email" >
                                    <div class="invalid-feedback text-left">Ingrese un email porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Direccion <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <textarea required type="text" id="address" name="address" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su dirección" ></textarea>
                                    <div class="invalid-feedback text-left">Ingrese una direccion porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Sede <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="sede_id" class="form-control w-100" >
                                        <option value="" selected >Todas las sedes</option>
                                        @foreach( $sedes as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;">Guardar</button>
                        </div>
                    </div>
                </form>`
        })
        if(id){
            let current={!! $clients !!}.find(i=>i.id===id)
            $("#name").val(current.name)
            $("#last_name").val(current.last_name)
            $("#cedula").val(current.cedula)
            $("#f_nac").val(current.f_nac)
            $("#phone").val(current.phone)
            $("#email").val(current.email)
            $("#address").val(current.address)
            $("#sede_id").val(current.sede_id)
        }
        validateForm()
    }

    function guardar(id) {
        let validity = document.getElementById('form_user_create').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    name: $("#name").val(),
                    last_name: $("#last_name").val(),
                    cedula: $("#cedula").val(),
                    f_nac: $("#f_nac").val(),
                    phone: $("#phone").val(),
                    email: $("#email").val(),
                    address: $("#address").val(),
                    sede_id: $("#sede_id").val(),
                }
            }
            $.ajax({
                url: "{{ route('clients.store') }}",
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


    dataTable("{{route('clients.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'name' },
        { data: 'last_name' },
        { data: 'cedula' },
        { data: 'phone' },
        { data: 'email' },
        { data: 'sede_name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <div class="d-flex justify-content-between">
                        <div>
                            <a onclick="elim('clients',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                            <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                        </div>
                    </div>
                `;
            }
        },
    ])

    
</script>
@endsection




