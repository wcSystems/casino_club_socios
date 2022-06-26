
@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="excelExport('xlsx')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-arrow-alt-circle-down"></i>
            </button>
            <button onclick="create()" class="d-flex btn btn-1 btn-success mx-1">
                <i class="m-auto fa fa-lg fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <input id="search" type="text" placeholder="Buscar"  class="form-control w-100">
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_transportation" class="form-control w-100">
                            <option value="" selected >Todos los Transporte</option>
                            @foreach( $transportations as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="club_vip" id="search_club_vip" >
                            <label class="form-check-label" for="search_club_vip">
                                Club VIP
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="referido" id="search_referido" >
                            <label class="form-check-label" for="search_referido">
                                Referido
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="vive_cerca" id="search_vive_cerca" >
                            <label class="form-check-label" for="search_vive_cerca">
                                Vive Cerca
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="trabaja_cerca" id="search_trabaja_cerca" >
                            <label class="form-check-label" for="search_trabaja_cerca">
                                Trabaja Cerca
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="solo_de_paso" id="search_solo_de_paso" >
                            <label class="form-check-label" for="search_solo_de_paso">
                                Solo de Paso
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="descuento" id="search_descuento" >
                            <label class="form-check-label" for="search_descuento">
                                Descuento
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="puntos_por_canje" id="search_puntos_por_canje" >
                            <label class="form-check-label" for="search_puntos_por_canje">
                                Puntos por Canje
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="ticket_souvenirs" id="search_ticket_souvenirs" >
                            <label class="form-check-label" for="search_ticket_souvenirs">
                                Ticket Souvenirs
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="ticket_machine" id="search_ticket_machine" >
                            <label class="form-check-label" for="search_ticket_machine">
                                Maquinas
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-check-input" type="checkbox" name="ticket_table" id="search_ticket_table" >
                            <label class="form-check-label" for="search_ticket_table">
                                Mesas en Vivo
                            </label>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
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
    let data_modal_current = []

    function excelExport(type, fn, dl) {
        let user = {!! Auth::user() !!}
        var elt = document.getElementById('data-table-default');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "listado de Clientes" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ( user.name+'-Clients-'+moment().format('MMMM Do YYYY, h:mm:ss a')+'.'+(type || 'xlsx')));
    }

    /* funciones para ejecutar la modal */
    function elim(id) {
        Swal.fire({
            title: 'Estás seguro?',
            text: 'No serás capaz de recuperar el registro a borrar!',
            icon: 'error',
            showCancelButton: false
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "{{ route('clients.destroy', 'id_replace' ) }}".replace('id_replace', id);
                $.ajax({
                    url: url,
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
    function create() { 
        Swal.fire({
            title: 'Nuevo Registro',
            showConfirmButton: false,
            width: '800px',
            allowOutsideClick: false,
            showCloseButton: true,
            html:`
                <form id="form_user_create" class="needs-validation" action="javascript:void(0);" novalidate >
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
                                    <input required type="number" id="cedula" name="cedula" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su numero de cedula" >
                                    <div class="invalid-feedback text-left">Ingrese un numero de Cedula porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Cumpleaños <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="date" id="f_nac" name="f_nac" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese fecha de cumpleaños" >
                                    <div class="invalid-feedback text-left">Ingrese una fecha de Cumpleaños porfavor.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Telefono <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input required type="number" id="phone" name="phone" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese su numero de telefono" >
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
                        {{-- Booleanos --}}
                        <div class="row px-2 my-3">
                            <div class="col-sm-6">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> ¿ Le gustaria pertenecer al club ? <span class="text-danger">*</span> </label>
                                    <div class="col-12 text-left ml-2">
                                        <div class="form-check">
                                            <input required class="form-check-input" type="radio" name="club_vip" id="club_vip-1" value="1">
                                            <label class="form-check-label" for="club_vip-1">
                                                Si
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input required class="form-check-input" type="radio" name="club_vip" id="club_vip-0" value="0" >
                                            <label class="form-check-label" for="club_vip-0">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> ¿ Cual es su medio de transporte ? <span class="text-danger">*</span> </label>
                                    <div class="col-12 text-left ml-2">

                                        

                                        @foreach ($transportations as $item)
                                            <div class="form-check">
                                                <input required class="form-check-input" type="radio" name="transportation_id" id="transportation_id-{{ $loop->iteration }}" value="{{ $item->id }}">
                                                <label class="form-check-label" for="transportation_id-{{ $loop->iteration }}">
                                                    {{ $item->name }} 
                                                </label>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> ¿ Como nos conoce ? <span class="text-danger">*</span> </label>
                                    
                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="referido" id="referido-1" value="1">
                                                <label class="form-check-label" for="referido-1"> Si </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="referido" id="referido-0" value="0">
                                                <label class="form-check-label" for="referido-0"> No </label>
                                            </div>
                                            <span class="font-italic"> - Referido </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="vive_cerca" id="vive_cerca-1" value="1">
                                                <label class="form-check-label" for="vive_cerca-1"> Si </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="vive_cerca" id="vive_cerca-0" value="0">
                                                <label class="form-check-label" for="vive_cerca-0"> No </label>
                                            </div>
                                            <span class="font-italic"> - Vive cerca </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="trabaja_cerca" id="trabaja_cerca-1" value="1">
                                                <label class="form-check-label" for="trabaja_cerca-1"> Si </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="trabaja_cerca" id="trabaja_cerca-0" value="0">
                                                <label class="form-check-label" for="trabaja_cerca-0"> No </label>
                                            </div>
                                            <span class="font-italic"> - Trabaja cerca </span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="solo_de_paso" id="solo_de_paso-1" value="1">
                                                <label class="form-check-label" for="solo_de_paso-1"> Si </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="solo_de_paso" id="solo_de_paso-0" value="0">
                                                <label class="form-check-label" for="solo_de_paso-0"> No </label>
                                            </div>
                                            <span class="font-italic"> - Solo de paso </span>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> Preferencias por Beneficio <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="descuento" id="descuento-1" value="1">
                                                <label class="form-check-label" for="descuento-1">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="descuento" id="descuento-0" value="0">
                                                <label class="form-check-label" for="descuento-0">
                                                    No
                                                </label>
                                            </div>
                                            <span class="font-italic"> - Descuento </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="puntos_por_canje" id="puntos_por_canje-1" value="1">
                                                <label class="form-check-label" for="puntos_por_canje-1">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="puntos_por_canje" id="puntos_por_canje-0" value="0">
                                                <label class="form-check-label" for="puntos_por_canje-0">
                                                    No
                                                </label>
                                            </div>
                                            <span class="font-italic"> - Puntos por canje </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row text-left">
                                            <div class="form-check ml-3">
                                                <input required class="form-check-input" type="radio" name="ticket_souvenirs" id="ticket_souvenirs-1" value="1">
                                                <label class="form-check-label" for="ticket_souvenirs-1">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check ml-3 mr-1">
                                                <input required class="form-check-input" type="radio" name="ticket_souvenirs" id="ticket_souvenirs-0" value="0">
                                                <label class="form-check-label" for="ticket_souvenirs-0">
                                                    No
                                                </label>
                                            </div>
                                            <span class="font-italic"> - Tickets extras Souvenirs </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- Checkboxs --}}
                        <div class="col-sm-12">
                            <div class="row px-2 my-3">
                                <div class="col-sm-6">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label font-weight-bold"> Maquinas Favoritas </label>
                                        <div class="col-12 text-left ml-2">
                                            @foreach ($machines as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="machines" id="machines-{{ $loop->iteration }}" value="{{ $item->id }}">
                                                    <label class="form-check-label" for="machines-{{ $loop->iteration }}">
                                                        {{ $item->name }} 
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label font-weight-bold"> Mesas en vivo Favoritos </label>
                                        <div class="col-12 text-left ml-2">
                                            @foreach ($tables as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="tables" id="tables-{{ $loop->iteration }}" value="{{ $item->id }}">
                                                    <label class="form-check-label" for="tables-{{ $loop->iteration }}">
                                                        {{ $item->name }} 
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-2 my-3">
                            <div class="col-sm-4">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> Comidas Favoritas </label>
                                    <div class="col-12 text-left ml-2">
                                        @foreach ($foods as $item)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="foods" id="foods-{{ $loop->iteration }}" value="{{ $item->id }}">
                                                <label class="form-check-label" for="foods-{{ $loop->iteration }}">
                                                    {{ $item->name }} 
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> jugos Favoritos </label>
                                    <div class="col-12 text-left ml-2">
                                        @foreach ($juices as $item)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="juices" id="juices-{{ $loop->iteration }}" value="{{ $item->id }}">
                                                <label class="form-check-label" for="juices-{{ $loop->iteration }}">
                                                    {{ $item->name }} 
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label font-weight-bold"> Tragos Favoritos </label>
                                    <div class="col-12 text-left ml-2">
                                        @foreach ($drinks as $item)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="drinks" id="drinks-{{ $loop->iteration }}" value="{{ $item->id }}">
                                                <label class="form-check-label" for="drinks-{{ $loop->iteration }}">
                                                    {{ $item->name }} 
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="create_Submit()" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;">Guardar</button>
                        </div>
                    </div>
                </form>`
        })
        validateForm()
    }
    function edit(params) {

        Swal.fire({
            title: 'Editar',
            showConfirmButton: false,
            html:`
                <form id="form_user_edit" >
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nodo <span class="text-danger">*</span> </label>
                                <select id="network_id" class="form-control w-100">
                                    <option value="0" selected disabled >Seleccione ...</option>
                                        <option value="" >  </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Host <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="number" id="host" name="host" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.host}" >
                                    <div id="text-error-host"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Tipo <span class="text-danger">*</span> </label>
                                <select id="type_id" class="form-control w-100">
                                    <option value="0" selected disabled >Seleccione ...</option>
                                        <option value="" > </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nombre <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.name}" >
                                    <div id="text-error-name"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Bloque <span class="text-danger">*</span> </label>
                                <select id="block_id" class="form-control w-100">
                                    <option value="0" selected disabled >Seleccione ...</option>
                                        <option value="" > </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Usuario <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="username" name="username" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.username}" >
                                    <div id="text-error-username"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Contraseña <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="password" name="password" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.password}" >
                                    <div id="text-error-password"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> SSID <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="ssid" name="ssid" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.ssid}" >
                                    <div id="text-error-ssid"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Contraseña SSID <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="ssid_password" name="ssid_password" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.ssid_password}" >
                                    <div id="text-error-ssid_password"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> MAC <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <input type="text" id="mac" name="mac" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." value="${params.mac}" >
                                    <div id="text-error-mac"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Descripcion <span class="text-danger">*</span> </label>
                                <div class="col-lg-12">
                                    <textarea type="text" id="description" name="description" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese ..." >${params.description}</textarea>
                                    <div id="text-error-description"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="edit_Submit(${params.id})" type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;">Editar</button>
                        </div>
                    </div>
                </form>`
        })
        $('#network_id').val(params.network_id)
        $('#type_id').val(params.type_id)
        $('#block_id').val(params.block_id)
    };
    /* funciones para hacer el crud */
    function edit_Submit(id) {
        let network_id = $('#network_id').val()
        let host = parseInt($('#host').val())
        let type_id = $('#type_id').val()
        let name = $('#name').val()
        let block_id = $('#block_id').val()
        let username = $('#username').val()
        let password = $('#password').val()
        let ssid = $('#ssid').val()
        let ssid_password = $('#ssid_password').val()
        let mac = $('#mac').val()
        let description = $('#description').val()
        let url = "{{ route('clients.update', 'id_replace' ) }}".replace('id_replace', id);
        $.ajax({
            url: url,
            type: "PUT",
            data: {
                "_token": $("meta[name='csrf-token']").attr("content"),
                "network_id": network_id,
                "host": host,
                "type_id": type_id,
                "name": name,
                "block_id": block_id,
                "username": username,
                "password": password,
                "ssid": ssid,
                "ssid_password": ssid_password,
                "mac": mac,
                "description": description,
            },
            success: function (res) {
                if(res.type === 'error'){
                    Object.keys(res.data).find( ( item ) => {
                        $(`#${item}`).removeClass('parsley-normal').addClass('parsley-error')
                        $(`#text-error-${item}`).empty().append(`<ul class="parsley-errors-list filled"><li class="parsley-required" style="text-align: left"> ${ res.data[item] } </li></ul>`)
                    })
                }
                if(res.type === 'success'){
                    location.reload();
                }
            }
        });

    }

    function create_Submit() {
        let validity = document.getElementById('form_user_create').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                name: $("#name").val(),
                last_name: $("#last_name").val(),
                cedula: $("#cedula").val(),
                f_nac: $("#f_nac").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),
                address: $("#address").val(),
                club_vip: $("input[name=club_vip]:checked").val(),
                referido: $("input[name=referido]:checked").val(),
                vive_cerca: $("input[name=vive_cerca]:checked").val(),
                trabaja_cerca: $("input[name=trabaja_cerca]:checked").val(),
                solo_de_paso: $("input[name=solo_de_paso]:checked").val(),
                descuento: $("input[name=descuento]:checked").val(),
                puntos_por_canje: $("input[name=puntos_por_canje]:checked").val(),
                ticket_souvenirs: $("input[name=ticket_souvenirs]:checked").val(),
                transportation_id: $("input[name=transportation_id]:checked").val(),
                client_machines: $("input[name=machines]").filter(':checked').map(function () { return this.value }).get(),
                client_tables: $("input[name=tables]").filter(':checked').map(function () { return this.value }).get(),
                client_foods: $("input[name=foods]").filter(':checked').map(function () { return this.value }).get(),
                client_juices: $("input[name=juices]").filter(':checked').map(function () { return this.value }).get(),
                client_drinks: $("input[name=drinks]").filter(':checked').map(function () { return this.value }).get(),
            }
            let url = "{{ route('clients.store') }}";
            $.ajax({
                url: url,
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
        {
            render: function ( data,type, row  ) {
                data_modal_current[row.id] = row
                let url_edit = "{{ route('clients.edit', 'id_replace' ) }}".replace('id_replace', row.id);
                let url_destroy = "{{ route('clients.destroy', 'id_replace' ) }}".replace('id_replace', row.id);
                return `
                    <a onclick="elim(${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="edit(data_modal_current[${row.id}])" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                `;
            }
        },
    ])







    FilePond.create(
        document.querySelector('input'),
        {
            labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        }
    );







    
</script>
@endsection




