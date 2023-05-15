@extends('layouts.app')
@section('css')
<style>
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
     {
       text-align: center !important
    }
    
</style>
@endsection
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
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sede_all" class="form-control w-100">
                            <option value="" selected >Todos las sedes</option>
                            @foreach( $sedes as $item )
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
                        <th>Fecha</th>
                        <th>Sede</th>
                        <th>Ventanillas ( Cajas )</th>
                        <th>Mesas</th>
                        <th>Cuadros ( Vistas )</th>
                        <th>Reporte Final ( Cierre )</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    let global_sumTotalFinal = 0
    let all = [];
    let chart_drop_diario_mes_data;
    $('#group_cierre_boveda_casinos_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Sedes <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="sede_id" class="form-control w-100" >
                                        <option value="" selected disabled >Selecione una Sede</option>
                                        @foreach( $sedes as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Fecha <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="date" id="created_at" name="created_at" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina la fecha aca" >
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
            let current={!! $group_cierre_boveda_casinos !!}.find(i=>i.id===id)
            $("#sede_id").val(current.sede_id)
            $("#created_at").val(current.created_at)
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
                    sede_id: $('#sede_id').val(),
                    created_at: $('#created_at').val()
                }
            }
            setLoading(timerInterval)
            $.ajax({
                url: "{{ route('group_cierre_boveda_casinos.store') }}",
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
    function salir() {
        $(".swal2-close").click()
    }
    dataTable("{{route('group_cierre_boveda_casinos.service')}}",[
        {
            render: function ( data,type, row  ) {
                
                return row.created_at;
            }
        },
        { data: 'sede_name' },
        {
            render: function ( data,type, row  ) {
                let btns = ``;
                    btns +=`<div class="text-center">`
                    btns +=`<a class="btn btn-yellow m-5" > Caja </a>`
                    btns +=`</div>`
                return btns;
            }
        },
        {
            render: function ( data,type, row  ) {
                let btns = ``;
                    btns +=`<a class="btn btn-blue m-5" onclick="viewOperacion(${row.id},${row.sede_id})"  > Operaciones </a>`
                    btns +=`<a class="btn btn-info m-5" onclick="viewEfectivo(${row.id},${row.sede_id})" > Efectivo </a>`
                    btns +=`</div>`
                return btns;
            }
        },
        {
            render: function ( data,type, row  ) {
                let btns = ``;
                    btns +=`<div class="text-center">`
                    btns +=`<a class="btn btn-gray m-5" > Comparativo </a>`
                    btns +=`<a class="btn btn-gray m-5" > Mesas </a>`
                    btns +=`<a class="btn btn-gray m-5" > Fichas </a>`
                    btns +=`<a class="btn btn-gray m-5" > Sedes </a>`
                    btns +=`</div>`
                return btns;
            }
        },
        {
            render: function ( data,type, row  ) {
                let btns = ``;
                    btns +=`<div class="text-center">`
                    btns +=`<a class="btn btn-danger m-5" > Ver / Imprimir </a>`
                    btns +=`</div>`
                return btns;
            }
        },
    ],"group_name")

    /* OPCION N2 - DROP */
    function viewOperacion(id,sede_id,extra) {
        let currentGroup = {!! $group_cierre_boveda_casinos !!}.find( i => i.id == id )
        let sede = {!! $sedes !!}.find( i => i.id == sede_id )
       
        let timerInterval 
        let payload = {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        }
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('operaciones_mesas_casinos.list') }}",
            type: "POST",
            data: payload,
            success: function (res) {
                clearInterval(timerInterval)
                let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
                let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
                let fichas_casinos = {!! $fichas_casinos !!}.filter( i => i.sede_id == sede_id )
                let html = ``;

                mesas_casinos.forEach(mesa => {
                    html += `
                    <div class="mt-2 mb-5">
                        <div class="d-flex flex-row">
                            <div style="background-color:#ccc;" class="table-responsive">
                                <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                                    <thead   >
                                        <tr>
                                            <th  class="text-center text-uppercase font-weight-bold border-0" >${mesa.name} </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">


                            <div class="table-responsive">
                                <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                                    <thead   >
                                        <tr>
                                            <th COLSPAN="6" class="text-center text-uppercase font-weight-bold" style="background-color:#CCFFFF" >FILL</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center text-uppercase font-weight-bold" style="background-color:#CCFFFF" > Ficha </th>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> FILL 1 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> FILL 2 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> FILL 3 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> CIERRE </td>
                                            <th class="text-center text-uppercase font-weight-bold" style="background-color:#ccc" > TOTAL </th>
                                        </tr>
                                    </thead>
                                    <tbody>`
                                        fichas_casinos.forEach(ficha => {
                                            
                                            html += `
                                            <tr>
                                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#CCFFFF;"> 
                                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="${ficha.name}" >
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-fill_1" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="fillChange(this)" type="number"  class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-fill_2" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="fillChange(this)"  type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-fill_3" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="fillChange(this)"  type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-fill_cierre" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="fillChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold " style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-${ficha.id}-fill_total" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="0" > 
                                                </td>
                                            </tr>
                                            `
                                        });
                                        
                                        html += `
                                            <tr>
                                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#ccc;"> 
                                                    <input type="text"  disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL" >
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-fill_1_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-fill_2_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-fill_3_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-fill_cierre_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold"  style="background-color:#CCFFFF;">
                                                    <input disabled id="${id}-${mesa.id}-fill_cierre_total_final" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="table-responsive">
                                <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                                    <thead style="background-color:#ccc;"  >
                                        <tr>
                                            <th COLSPAN="6" class="text-center text-uppercase font-weight-bold" style="background-color:#CC99CC" >CRED</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center text-uppercase font-weight-bold" style="background-color:#CC99CC" > Ficha </th>
                                            <td class="font-weight-bold text-left" style="background-color:#CC99CC;font-size:12px !important"> CRED 1 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CC99CC;font-size:12px !important"> CRED 2 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CC99CC;font-size:12px !important"> CRED 3 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CC99CC;font-size:12px !important"> CIERRE </td>
                                            <th class="text-center text-uppercase font-weight-bold" style="background-color:#ccc" > TOTAL </th>
                                        </tr>
                                    </thead>
                                    <tbody>`
                                        fichas_casinos.forEach(ficha => {
                                            html += `
                                            <tr>
                                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#CC99CC"> 
                                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="${ficha.name}" >
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-cred_1" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="credChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-cred_2" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="credChange(this)"  type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-cred_3" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="credChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${ficha.id}-cred_cierre" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${ficha.id}" data-ficha_name="${ficha.name}" onkeyup="credChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold " style="background-color:#ccc" >
                                                    <input disabled id="${id}-${mesa.id}-${ficha.id}-cred_total" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="0" > 
                                                </td>
                                            </tr>
                                            `
                                        });
                                        
                                        html += `
                                            <tr>
                                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#ccc"> 
                                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL" >
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc" >
                                                    <input disabled id="${id}-${mesa.id}-cred_1_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc" >
                                                    <input disabled id="${id}-${mesa.id}-cred_2_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc" >
                                                    <input disabled id="${id}-${mesa.id}-cred_3_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc" >
                                                    <input disabled id="${id}-${mesa.id}-cred_cierre_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold"  style="background-color:#CC99CC" >
                                                    <input disabled id="${id}-${mesa.id}-cred_cierre_total_final" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                                    <thead   >
                                        <tr>
                                            <th COLSPAN="6" class="text-center text-uppercase font-weight-bold" style="background-color:#CCFFFF;"   >CONTEO</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center text-uppercase font-weight-bold" style="background-color:#CCFFFF;" > Billete </th>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> PRE 1 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> PRE 2 </td>
                                            <td class="font-weight-bold text-left" style="background-color:#CCFFFF;font-size:12px !important"> CONTEO </td>
                                            <td class="font-weight-bold text-left" style="background-color:#ccc;font-size:12px !important"> PIEZAS </td>
                                            <th class="text-center text-uppercase font-weight-bold" style="background-color:#ccc;" > TOTAL </th>
                                        </tr>
                                    </thead>
                                    <tbody>`
                                        billetes_casinos.forEach(billete => {
                                            html += `
                                            <tr>
                                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#CCFFFF;"> 
                                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="${billete.name}" >
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${billete.id}-conteo_1" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${billete.id}" data-ficha_name="${billete.name}" onkeyup="conteoChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${billete.id}-conteo_2" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${billete.id}" data-ficha_name="${billete.name}" onkeyup="conteoChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold bg-gris" >
                                                    <input id="${id}-${mesa.id}-${billete.id}-conteo_cierre" data-sede_id="${sede_id}" data-group_cierre_boveda_casino_id="${id}" data-mesa_id="${mesa.id}" data-mesa_name="${mesa.name}" data-ficha_id="${billete.id}" data-ficha_name="${billete.name}" onkeyup="conteoChange(this)" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-${billete.id}-conteo_pieza" type="number" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="0" > 
                                                </td>
                                                <td class="font-weight-bold " style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-${billete.id}-conteo_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                            </tr>
                                            `
                                        });
                                        
                                        html += `
                                            <tr>
                                                <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#ccc;"> 
                                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL" >
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled  id="${id}-${mesa.id}-conteo_1_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-conteo_2_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-conteo_cierre_total" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#ccc;" >
                                                    <input disabled id="${id}-${mesa.id}-conteo_cierre_pieza" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="0" > 
                                                </td>
                                                <td class="font-weight-bold" style="background-color:#CCFFFF;" >
                                                    <input disabled id="${id}-${mesa.id}-conteo_cierre_total_final" type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold"  style="min-width:50px !important" value="$ 0" > 
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>`
                });

                Swal.fire({
                    title: `Operaciones de Mesas <br /> ${sede.name} <br /> ${moment( currentGroup.created_at ).format("YYYY-MM-DD")}`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                    width: "95%",
                    html: html
                }) 

                
            }
        });
    }

    function fillChange(params){

        let dataset = params.dataset
        let cantidad = params.value
        
        let fill_suma_1 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_1`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_1`).val()
        let fill_suma_2 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_2`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_2`).val()
        let fill_suma_3 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_3`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_3`).val()
        let fill_suma_cierre = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_cierre`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_cierre`).val()
        let fill_suma_total = parseFloat(fill_suma_1)+parseFloat(fill_suma_2)+parseFloat(fill_suma_3)+parseFloat(fill_suma_cierre)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-fill_total`).val(fill_suma_total)


        let fichas_casinos = {!! $fichas_casinos !!}.filter( i => i.sede_id == dataset.sede_id )
        let acc_fill = { acc_fill_suma_1: 0, acc_fill_suma_2: 0, acc_fill_suma_3: 0, acc_fill_suma_cierre: 0 }
            fichas_casinos.forEach(element => {
                let fill_suma_1 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_1`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_1`).val()
                let fill_suma_2 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_2`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_2`).val()
                let fill_suma_3 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_3`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_3`).val()
                let fill_suma_cierre = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_cierre`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-fill_cierre`).val()
                acc_fill.acc_fill_suma_1 = parseFloat(acc_fill.acc_fill_suma_1) + parseFloat(fill_suma_1) * parseFloat(element.name)
                acc_fill.acc_fill_suma_2 = parseFloat(acc_fill.acc_fill_suma_2) + parseFloat(fill_suma_2) * parseFloat(element.name)
                acc_fill.acc_fill_suma_3 = parseFloat(acc_fill.acc_fill_suma_3) + parseFloat(fill_suma_3) * parseFloat(element.name)
                acc_fill.acc_fill_suma_cierre = parseFloat(acc_fill.acc_fill_suma_cierre) + parseFloat(fill_suma_cierre) * parseFloat(element.name)
            });
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-fill_1_total`).val(`$ ${acc_fill.acc_fill_suma_1}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-fill_2_total`).val(`$ ${acc_fill.acc_fill_suma_2}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-fill_3_total`).val(`$ ${acc_fill.acc_fill_suma_3}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-fill_cierre_total`).val(`$ ${acc_fill.acc_fill_suma_cierre}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-fill_cierre_total_final`).val(`$ ${acc_fill.acc_fill_suma_1+acc_fill.acc_fill_suma_2+acc_fill.acc_fill_suma_3+acc_fill.acc_fill_suma_cierre}`)
        
    }

    function credChange(params){

        let dataset = params.dataset
        let cantidad = params.value
        
        let cred_suma_1 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_1`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_1`).val()
        let cred_suma_2 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_2`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_2`).val()
        let cred_suma_3 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_3`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_3`).val()
        let cred_suma_cierre = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_cierre`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_cierre`).val()
        let cred_suma_total = parseFloat(cred_suma_1)+parseFloat(cred_suma_2)+parseFloat(cred_suma_3)+parseFloat(cred_suma_cierre)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-cred_total`).val(cred_suma_total)


        let fichas_casinos = {!! $fichas_casinos !!}.filter( i => i.sede_id == dataset.sede_id )
        let acc_cred = { acc_cred_suma_1: 0, acc_cred_suma_2: 0, acc_cred_suma_3: 0, acc_cred_suma_cierre: 0 }
            fichas_casinos.forEach(element => {
                let cred_suma_1 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_1`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_1`).val()
                let cred_suma_2 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_2`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_2`).val()
                let cred_suma_3 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_3`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_3`).val()
                let cred_suma_cierre = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_cierre`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-cred_cierre`).val()
                acc_cred.acc_cred_suma_1 = parseFloat(acc_cred.acc_cred_suma_1) + parseFloat(cred_suma_1) * parseFloat(element.name)
                acc_cred.acc_cred_suma_2 = parseFloat(acc_cred.acc_cred_suma_2) + parseFloat(cred_suma_2) * parseFloat(element.name)
                acc_cred.acc_cred_suma_3 = parseFloat(acc_cred.acc_cred_suma_3) + parseFloat(cred_suma_3) * parseFloat(element.name)
                acc_cred.acc_cred_suma_cierre = parseFloat(acc_cred.acc_cred_suma_cierre) + parseFloat(cred_suma_cierre) * parseFloat(element.name)
            });
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-cred_1_total`).val(`$ ${acc_cred.acc_cred_suma_1}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-cred_2_total`).val(`$ ${acc_cred.acc_cred_suma_2}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-cred_3_total`).val(`$ ${acc_cred.acc_cred_suma_3}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-cred_cierre_total`).val(`$ ${acc_cred.acc_cred_suma_cierre}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-cred_cierre_total_final`).val(`$ ${acc_cred.acc_cred_suma_1+acc_cred.acc_cred_suma_2+acc_cred.acc_cred_suma_3+acc_cred.acc_cred_suma_cierre}`)
        
    }
    function conteoChange(params){

        let dataset = params.dataset
        let cantidad = params.value
        
        let conteo_suma_1 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_1`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_1`).val()
        let conteo_suma_2 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_2`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_2`).val()
        let conteo_suma_cierre = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_cierre`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_cierre`).val()
        let conteo_suma_total = parseFloat(conteo_suma_1)+parseFloat(conteo_suma_2)+parseFloat(conteo_suma_cierre)
        console.log(conteo_suma_1)
        console.log(conteo_suma_2)
        console.log(conteo_suma_cierre)
        console.log(conteo_suma_total)
        console.log(dataset)

        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_pieza`).val(conteo_suma_total)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${dataset.ficha_id}-conteo_total`).val(`$ ${parseFloat(conteo_suma_total*dataset.ficha_name)}`)


        let fichas_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == dataset.sede_id )
        let acc_conteo = { acc_conteo_suma_1: 0, acc_conteo_suma_2: 0, acc_conteo_suma_cierre: 0, acc_piezas: 0 }
            fichas_casinos.forEach(element => {
                let conteo_suma_1 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_1`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_1`).val()
                let conteo_suma_2 = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_2`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_2`).val()
                let conteo_suma_cierre = $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_cierre`).val() == "" ? 0 : $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_cierre`).val()
                acc_conteo.acc_conteo_suma_1 = parseFloat(acc_conteo.acc_conteo_suma_1) + parseFloat(conteo_suma_1) * parseFloat(element.name)
                acc_conteo.acc_conteo_suma_2 = parseFloat(acc_conteo.acc_conteo_suma_2) + parseFloat(conteo_suma_2) * parseFloat(element.name)
                acc_conteo.acc_conteo_suma_cierre = parseFloat(acc_conteo.acc_conteo_suma_cierre) + parseFloat(conteo_suma_cierre) * parseFloat(element.name)
                acc_conteo.acc_piezas = parseFloat(acc_conteo.acc_piezas) + parseFloat( $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-${element.id}-conteo_pieza`).val() )
            });
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-conteo_1_total`).val(`$ ${acc_conteo.acc_conteo_suma_1}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-conteo_2_total`).val(`$ ${acc_conteo.acc_conteo_suma_2}`)
        
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-conteo_cierre_pieza`).val(`${acc_conteo.acc_piezas}`)

        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-conteo_cierre_total`).val(`$ ${acc_conteo.acc_conteo_suma_cierre}`)
        $(`#${dataset.group_cierre_boveda_casino_id}-${dataset.mesa_id}-conteo_cierre_total_final`).val(`$ ${acc_conteo.acc_conteo_suma_1+acc_conteo.acc_conteo_suma_2+acc_conteo.acc_conteo_suma_cierre}`)
        
    }


    /* OPCION N5 - EFECTIVO */
    function viewEfectivo(id,sede_id) {
        let currentGroup = {!! $group_cierre_boveda_casinos !!}.find( i => i.id == id )
        let sede = {!! $sedes !!}.find( i => i.id == sede_id )
       
        let timerInterval 
        let payload = {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        }
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('conteo_efectivo_boveda_casinos.list') }}",
            type: "POST",
            data: payload,
            success: function (res) {


                clearInterval(timerInterval)

                let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
                let html = ``;
                html += `
                <div class="table-responsive mt-3">
                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                        <thead style="background-color:#ccc;"  >
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" > Efectivo </th>`
                                billetes_casinos.forEach(billete => {
                                    html += `<td class="font-weight-bold text-left" style="background-color:#ccc;font-size:12px !important"> $ ${ billete.name } </td>`
                                });
                                html += `
                                <th class="text-center text-uppercase font-weight-bold" > TOTAL </th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:#ccc;"> 
                                        <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$" >
                                    </td>`
                                    billetes_casinos.forEach(billete => {
                                        let current = res.list.find( i =>  i.billetes_casino_id == billete.id )
                                        let id = ( current == undefined ) ? 0 : parseFloat(current.id)
                                        let cantidad = ( current == undefined ) ? "" : parseFloat(current.cantidad)
                                        html += `
                                        <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                            <input type="hidden" id="id_conteo_efectivo_${billete.id}" value="${id}"  > 
                                            <input  value="${cantidad}" id="mesa_billete_conteo_efectivo_${billete.id}" onkeyup="sumMesaBilleteTotalEfectivo(${billete.id},${billete.name},${sede_id})" type="number" min="0"  class="form-control p-0 m-auto text-center font-weight-bold parsley-normal upper" style="min-width:80px !important" > 
                                        </td>`
                                    });
                                html += `
                                        <td class="font-weight-bold bg-gris" >
                                            <input id="total_mesa_conteo_efectivo" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:50px !important" value="$ 0 ( 0 )" > 
                                        </td>
                                </tr>
                           
                            <tr>
                                <td colspan="${billetes_casinos.length}" class="font-weight-bold text-left d-flex align-items-center" style="background-color:#ccc;"> 
                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL" >
                                </td>`
                                
                                billetes_casinos.forEach(billete => {
                                    html += `
                                    <td class="font-weight-bold bg-gris"  >
                                        <input id="total_billete_conteo_efectivo_${billete.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>`
                                });
                                    html += `
                                    <td class="font-weight-bold" style="background-color:#ccc;"  >
                                        <input id="total_final_conteo_efectivo" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>

                            
                            </tr>
                           
                        </tbody>
                    </table>
                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="saveEfectivo(${id},${sede_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                    </div>
                </div>`
                Swal.fire({
                    title: `Conteo Efectivo <br />  Boveda ${sede.name} <br /> ${moment( currentGroup.created_at ).format("YYYY-MM-DD")}`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                    width: "95%",
                    html: html
                }) 
                    billetes_casinos.forEach(billete => {
                        sumMesaBilleteTotalEfectivo(billete.id,billete.name,sede_id)
                    })
                //sumMesaALL(sede_id)
            }
        });
    }
    function sumMesaBilleteTotalEfectivo(billete_id,billete_name,sede_id) {
    
        let sumTotalMesas = 0
        let sumTotalBilletes = 0
        let sumTotalFinal = 0

        let cantidad_mesaFinal = 0
        let cantidad_billeteFinal = 0
        let cantidadFinal = 0

        let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )

                let cantidad_billete = $(`#mesa_billete_conteo_efectivo_${billete_id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_conteo_efectivo_${billete_id}`).val())
                let precio_billete = parseFloat(billete_name)
                let subtotal_billete = precio_billete*cantidad_billete
                sumTotalMesas = sumTotalMesas+subtotal_billete
                cantidad_mesaFinal = cantidad_mesaFinal+cantidad_billete
      

                    sumTotalBilletes = sumTotalBilletes+subtotal_billete
                cantidad_billeteFinal = cantidad_billeteFinal+cantidad_billete
           

             






            
            $(`#total_billete_conteo_efectivo_${billete_id}`).val(`$ ${sumTotalBilletes} ( ${cantidad_billeteFinal} )`)





            if( $(`#total_billete_conteo_efectivo_${billete_id}`).val() == "$ 0 ( 0 )" ){
                $(`#total_billete_conteo_efectivo_${billete_id}`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
            }else{
                $(`#total_billete_conteo_efectivo_${billete_id}`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
            }
            
          

            if( $(`#mesa_billete_conteo_efectivo_${billete_id}`).val() == "" || $(`#mesa_billete_conteo_efectivo_${billete_id}`).val() == 0 ){
                $(`#mesa_billete_conteo_efectivo_${billete_id}`).removeClass("bg-verde").addClass("bg-rojo")
            }else{
                $(`#mesa_billete_conteo_efectivo_${billete_id}`).removeClass("bg-rojo").addClass("bg-verde")
            }

                

            billetes_casinos.forEach(element => {
                let dividir = $(`#total_billete_conteo_efectivo_${element.id}`).val() == "" ? 0 : $(`#total_billete_conteo_efectivo_${element.id}`).val().slice(1).split("(")
                    sumTotalFinal = sumTotalFinal+parseFloat(dividir[0])
                    cantidadFinal = cantidadFinal+parseFloat(dividir[1])
            });

            global_sumTotalFinal = sumTotalFinal
            $(`#total_mesa_conteo_efectivo`).val(`$ ${sumTotalFinal} ( ${cantidadFinal} )`)
            $(`#total_final_conteo_efectivo`).val(`$ ${sumTotalFinal} ( ${cantidadFinal} )`)

            if( $(`#total_mesa_conteo_efectivo`).val() == "$ 0 ( 0 )" ){
                $(`#total_mesa_conteo_efectivo`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
            }else{
                $(`#total_mesa_conteo_efectivo`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
            }
            
    }
    function saveEfectivo(group_cierre_boveda_id,sede_id) {
        let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
        let total_registros = billetes_casinos.length
        let countReset = 0

        billetes_casinos.forEach(element_billete => {
           
                let payload = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: { id: $(`#id_conteo_efectivo_${element_billete.id}`).val() },

                    group_cierre_boveda_id: group_cierre_boveda_id, 

                    data: {
                        group_cierre_boveda_id: group_cierre_boveda_id, 
                        billetes_casino_id: element_billete.id,
                        cantidad: $(`#mesa_billete_conteo_efectivo_${element_billete.id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_conteo_efectivo_${element_billete.id}`).val())
                    }
                }
                $.ajax({
                    url: "{{ route('conteo_efectivo_boveda_casinos.store') }}",
                    type: "POST",
                    data: payload,
                    success: function (res) {
                        if(res.type === 'success'){
                            countReset = countReset+1
                            $(`#mesa_billete_conteo_efectivo_${element_billete.id}`).replaceWith(`<div id="mesa_billete_conteo_efectivo_${element_billete.id}"><i class="fas fa-check-circle text-success fa-lg"></i></div>`)
                            if( countReset == total_registros ){
                                location.reload();
                            }
                        }

                    }
                });

       
        });
    }
   

</script>
@endsection