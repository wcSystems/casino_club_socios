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
                        <th>Acciones ( Modulos )</th>
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
    $('#cierre_mesas_nav').removeClass("closed").addClass("active").addClass("expand")
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
            let current={!! $group_cierre_bovedas !!}.find(i=>i.id===id)
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
                url: "{{ route('cierre_mesas.store') }}",
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
    dataTable("{{route('cierre_mesas.service')}}",[
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
                    btns +=`<div class="text-center">`
                    btns +=`<a class="btn btn-blue m-5" onclick="viewDrop(${row.id},${row.sede_id},${row.extra})" > Drop </a>`
                    btns +=`<a class="btn btn-info m-5" onclick="viewArch(${row.id},${row.sede_id})" > Arqueo </a>`
                    btns +=`<a class="btn btn-blue m-5" > Fichas </a>`
                    btns +=`<a class="btn btn-info m-5" onclick="viewEfectivo(${row.id},${row.sede_id})" > Efectivo </a>`
                    btns +=`<a class="btn btn-blue m-5" > Operaciones </a>`
                    btns +=`<a class="btn btn-info m-5" > Libro I & E </a>`
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
    function viewDrop(id,sede_id,extra) {
        let currentGroup = {!! $group_cierre_bovedas !!}.find( i => i.id == id )
        let sede = {!! $sedes !!}.find( i => i.id == sede_id )
       
        let timerInterval 
        let payload = {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        }
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('conteo_drop_boveda_casinos.list') }}",
            type: "POST",
            data: payload,
            success: function (res) {


                clearInterval(timerInterval)

                let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
                let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
                let html = ``;
                html += `
                <div class="table-responsive mt-3">
                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
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
                                        let current = res.list.find( i => i.mesas_casino_id == mesa.id && i.billetes_casino_id == billete.id )
                                        let id = ( current == undefined ) ? 0 : parseFloat(current.id)
                                        let cantidad = ( current == undefined ) ? "" : parseFloat(current.cantidad)
                                        html += `
                                        <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                            <input type="hidden" id="id_${mesa.id}_${billete.id}" value="${id}"  > 
                                            <input  value="${cantidad}" id="mesa_billete_${mesa.id}_${billete.id}" onkeyup="sumMesaBilleteTotal(${mesa.id},${billete.id},${billete.name},${sede_id})" type="number" min="0"  class="form-control p-0 m-auto text-center font-weight-bold parsley-normal upper" style="min-width:80px !important" > 
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
                                        <input id="extra"  type="number" onkeyup=totalExtra()  class="pl-1 text-left col-6 form-control p-0 m-auto text-center border-0 font-weight-bold" value="${extra}" > 
                                    </div>
                                </td>
                                <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                    <input id="total_extra"  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="saveDrop(${id},${sede_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                    </div>
                </div>`
                Swal.fire({
                    title: `DROP <br />  Boveda ${sede.name} <br /> ${moment( currentGroup.created_at ).format("YYYY-MM-DD")}`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                    width: "95%",
                    html: html
                }) 
                mesas_casinos.forEach(mesa => {
                    billetes_casinos.forEach(billete => {
                        sumMesaBilleteTotal(mesa.id,billete.id,billete.name,sede_id)
                    })
                })
                //sumMesaALL(sede_id)
            }
        });
    }
    function sumMesaBilleteTotal(mesa_id,billete_id,billete_name,sede_id) {
        let extra = $(`#extra`).val() == "" ? 0 : parseFloat($(`#extra`).val())
        let sumTotalMesas = 0
        let sumTotalBilletes = 0
        let sumTotalFinal = 0

        let cantidad_mesaFinal = 0
        let cantidad_billeteFinal = 0
        let cantidadFinal = 0

        let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
        let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
            
            billetes_casinos.forEach(element => {
                let cantidad_billete = $(`#mesa_billete_${mesa_id}_${element.id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_${mesa_id}_${element.id}`).val())
                let precio_billete = parseFloat(element.name)
                let subtotal_billete = precio_billete*cantidad_billete
                sumTotalMesas = sumTotalMesas+subtotal_billete
                cantidad_mesaFinal = cantidad_mesaFinal+cantidad_billete
            });

            mesas_casinos.forEach(element => {
                let cantidad_mesa = $(`#mesa_billete_${element.id}_${billete_id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_${element.id}_${billete_id}`).val())
                let precio_mesa = parseFloat(billete_name)
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
                    sumTotalFinal = sumTotalFinal+parseFloat(dividir[0])
                    cantidadFinal = cantidadFinal+parseFloat(dividir[1])
            });

            global_sumTotalFinal = sumTotalFinal
            $(`#total_final`).val(`$ ${sumTotalFinal} ( ${cantidadFinal} )`)
            $(`#total_extra`).val(`$ ${sumTotalFinal+extra}`)

            
    }
    function totalExtra() {
        let extra = $(`#extra`).val() == "" ? 0 : parseFloat($(`#extra`).val())
        $(`#total_extra`).val(`$ ${global_sumTotalFinal+extra}`)
    }
    function saveDrop(group_cierre_boveda_id,sede_id) {
        let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
        let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
        let total_registros = mesas_casinos.length*billetes_casinos.length
        let countReset = 0

        billetes_casinos.forEach(element_billete => {
            mesas_casinos.forEach(element_mesa => {
                let payload = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: { id: $(`#id_${element_mesa.id}_${element_billete.id}`).val() },

                    extra: $(`#extra`).val() == "" ? 0 : parseFloat($(`#extra`).val()),
                    group_cierre_boveda_id: group_cierre_boveda_id, 

                    data: {
                        group_cierre_boveda_id: group_cierre_boveda_id, 
                        mesas_casino_id: element_mesa.id,
                        billetes_casino_id: element_billete.id,
                        cantidad: $(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).val())
                    }
                }
                $.ajax({
                    url: "{{ route('conteo_drop_boveda_casinos.store') }}",
                    type: "POST",
                    data: payload,
                    success: function (res) {
                        if(res.type === 'success'){
                            countReset = countReset+1
                            $(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).replaceWith(`<div id="mesa_billete_${element_mesa.id}_${element_billete.id}"><i class="fas fa-check-circle text-success fa-lg"></i></div>`)
                            if( countReset == total_registros ){
                                location.reload();
                            }
                        }

                    }
                });

            });
        });
    }

    /* OPCION N3 - ARQUEO */
    function viewArch(id,sede_id) {
        let currentGroup = {!! $group_cierre_bovedas !!}.find( i => i.id == id )
        let sede = {!! $sedes !!}.find( i => i.id == sede_id )

        let timerInterval 
        let payload = {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        }
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('conteo_arching_boveda_casinos.list') }}",
            type: "POST",
            data: payload,
            success: function (res) {


                clearInterval(timerInterval)

                let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
                let fichas_casinos = {!! $fichas_casinos !!}.filter( i => i.sede_id == sede_id )
                
                let html = ``;
                html += `
                <div class="table-responsive mt-3">

                `
                            mesas_casinos.forEach(mesa => {
                                html += `
                                <div class="my-5 p-0 mx-0">
                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle  d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th colspan="${fichas_casinos.length+2}" class="text-center text-uppercase font-weight-bold" > ${mesa.name} </th>
                            </tr>
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" > Arqueo </th>`
                                fichas_casinos.forEach(billete => {
                                    html += `<td class="font-weight-bold text-left" style="background-color:paleturquoise;font-size:12px !important"> $ ${ billete.name } </td>`
                                });
                                html += `
                                <th class="text-center text-uppercase font-weight-bold" > TOTAL </th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                        <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="Conteo" >
                                    </td>`
                                    fichas_casinos.forEach(billete => {
                                        let current = res.list.find( i => i.mesas_casino_id == mesa.id && i.fichas_casino_id == billete.id )
                                    
                                     
                                        let id = ( current == undefined ) ? 0 : parseFloat(current.id)
                                        let cantidad = ( current == undefined ) ? "" : parseFloat(current.cantidad)
                                        html += `
                                        <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                            <input type="hidden" id="id_${mesa.id}_${billete.id}" value="${id}"  > 
                                            <input  value="${cantidad}" id="mesa_billete_${mesa.id}_${billete.id}" onkeyup="sumMesaBilleteTotalArch(${mesa.id},${billete.id},${billete.name},${sede_id})" type="number" min="0"  class="form-control p-0 m-auto text-center font-weight-bold parsley-normal upper" style="min-width:80px !important" > 
                                        </td>`
                                    });
                                    html += `
                                    <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                        <input id="total_mesa_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:100px !important" value="0" > 
                                    </td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                        <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="Bancada" >
                                    </td>`
                                    fichas_casinos.forEach(billete => {
                                     
                                        let stack_casinos = {!! $stack_casinos !!}.find( i => i.mesas_casino_id == mesa.id &&  i.fichas_casino_id == billete.id  )
                                        let stack_casino_cantidad = ( stack_casinos == undefined ) ? 0 : parseFloat(stack_casinos.cantidad)
                                      
                                        html += `
                                        <td class="font-weight-bold" style="background-color:paleturquoise;" >
                                            $ ${ stack_casino_cantidad*parseFloat(billete.name) } ( ${stack_casino_cantidad} )
                                        </td>`
                                    });

                                    let stacks = {!! $stack_casinos !!}
                                    let stack_mesa = stacks.filter( i => i.mesas_casino_id == mesa.id && fichas_casinos.map( x => x.id == i.fichas_casino_id ) )

                                    const total_stack = stack_mesa.reduce((acc, number) => acc + ( parseFloat(number.cantidad) * parseFloat(number.ficha_name) ), 0);
                                    const total_stack_count = stack_mesa.reduce((acc, number) => acc + ( parseFloat(number.cantidad)  ), 0);
                                  
                                   
                                    
                                    html += `
                                    <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                        $ ${ total_stack } ( ${ total_stack_count } )
                                    </td>
                                </tr>
                               
                            <tr>
                                <td colspan="${fichas_casinos.length}" class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="Cierre" >
                                </td>`
                                
                                fichas_casinos.forEach(billete => {
                                    html += `
                                    <td class="font-weight-bold bg-gris"  >
                                        <input id="cierre_billete_${billete.id}_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>`
                                });
                                    html += `
                                    <td class="font-weight-bold bg-gris"   >
                                        <input id="cierre_final_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>

                            
                            </tr>


                            <tr>
                                <td colspan="${fichas_casinos.length}" class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="Diferencia" >
                                </td>`
                                
                                fichas_casinos.forEach(billete => {
                                    html += `
                                    <td class="font-weight-bold bg-gris"  >
                                        <input id="total_billete_${billete.id}_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>`
                                });
                                    html += `
                                    <td class="font-weight-bold bg-gris"   >
                                        <input id="total_final_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>

                            
                            </tr>
                        </tbody>
                    </table>
                    </div>


                    

                    `
                            });

                            
                            html += `


                            <div class="my-5 p-0 mx-0">
                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle  d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th colspan="${fichas_casinos.length+2}" class="text-center text-uppercase font-weight-bold" > DIFERENCIA GLOBAL </th>
                            </tr>
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" > ARQUEO </th>
                                <th class="text-center text-uppercase font-weight-bold" > $ FICHAS </th>
                                <th class="text-center text-uppercase font-weight-bold" > N° FICHAS </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                    <input id="" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="BANCADA" > 
                                </td>
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="sala_bancada_monto" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                                </td>
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="sala_bancada_cantidad" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="0" > 
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                    <input id="" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="CIERRE" > 
                                </td>
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="sala_cierre_monto" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                                </td>
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="sala_cierre_cantidad" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="0" > 
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                    <input id="" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="DIFERENCIA" > 
                                </td>
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="sala_diferencia_monto" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                                </td>
                                <td class="font-weight-bold bg-gris"  >
                                    <input id="sala_diferencia_cantidad" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="0" > 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>

                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="saveArch(${id},${sede_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                    </div>
                </div>`
                Swal.fire({
                    title: `ARQUEO <br />  Boveda ${sede.name} <br /> ${moment( currentGroup.created_at ).format("YYYY-MM-DD")}`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                    width: "95%",
                    html: html
                }) 
                mesas_casinos.forEach(mesa => {
                    fichas_casinos.forEach(billete => {
                        sumMesaBilleteTotalArch(mesa.id,billete.id,billete.name,sede_id)
                    })
                })
                //sumMesaALL(sede_id)
            }
        });
    }
    function sumMesaBilleteTotalArch(mesa_id,billete_id,billete_name,sede_id) {
        let extra = $(`#extra`).val() == "" ? 0 : parseFloat($(`#extra`).val())
        let sumTotalMesas = 0
        let sumTotalBilletes = 0
        let sumTotalFinal = 0

        let cantidad_mesaFinal = 0
        let cantidad_billeteFinal = 0
        let cantidadFinal = 0

        let global_sumTotalFinal = 0
        let global_sumcantidadFinal = 0

        let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
        let fichas_casinos = {!! $fichas_casinos !!}.filter( i => i.sede_id == sede_id )
            
            fichas_casinos.forEach(element => {
                let cantidad_billete = $(`#mesa_billete_${mesa_id}_${element.id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_${mesa_id}_${element.id}`).val())
                let precio_billete = parseFloat(element.name)
                let subtotal_billete = precio_billete*cantidad_billete
                sumTotalMesas = sumTotalMesas+subtotal_billete
                cantidad_mesaFinal = cantidad_mesaFinal+cantidad_billete
            });

           
                let cantidad_mesa = $(`#mesa_billete_${mesa_id}_${billete_id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_${mesa_id}_${billete_id}`).val())
                let precio_mesa = parseFloat(billete_name)
                let subtotal_mesa = precio_mesa*cantidad_mesa
                sumTotalBilletes = sumTotalBilletes+subtotal_mesa
                cantidad_billeteFinal = cantidad_billeteFinal+cantidad_mesa
            

                let stack_casinos = {!! $stack_casinos !!}.find( i => i.mesas_casino_id == mesa_id &&  i.fichas_casino_id == billete_id  )
                let stack_casino_cantidad = ( stack_casinos == undefined ) ? 0 : parseFloat(stack_casinos.cantidad)



            $(`#total_mesa_${mesa_id}`).val(`$ ${sumTotalMesas} ( ${cantidad_mesaFinal} )`)

            let total_final_diferencia = (stack_casino_cantidad*precio_mesa) - sumTotalBilletes
            let total_conteo_diferencia = stack_casino_cantidad - cantidad_billeteFinal

            
            $(`#total_billete_${billete_id}_${mesa_id}`).val(`$ ${ (total_final_diferencia < 0) ? total_final_diferencia * -1 : total_final_diferencia } ( ${ (total_conteo_diferencia < 0) ? total_conteo_diferencia * -1 : total_conteo_diferencia } )`)


            $(`#cierre_billete_${billete_id}_${mesa_id}`).val(`$ ${sumTotalBilletes} ( ${cantidad_billeteFinal} )`)

            if( stack_casino_cantidad > cantidad_billeteFinal ){
                $(`#total_billete_${billete_id}_${mesa_id}`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
            }else{
                $(`#total_billete_${billete_id}_${mesa_id}`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
            }
            
            

           

                let dividir = $(`#total_mesa_${mesa_id}`).val() == "" ? 0 : $(`#total_mesa_${mesa_id}`).val().slice(1).split("(")
                    sumTotalFinal = sumTotalFinal+parseFloat(dividir[0])
                    cantidadFinal = cantidadFinal+parseFloat(dividir[1])
           

               

           



            $(`#cierre_final_${mesa_id}`).val(`$ ${sumTotalFinal} ( ${cantidadFinal} )`)



            mesas_casinos.filter( i=> i.sede_id == sede_id ).forEach(element => {
                   
                    let dividir = $(`#cierre_final_${element.id}`).val() == "" ? 0 : $(`#cierre_final_${element.id}`).val().slice(1).split("(")
                    global_sumTotalFinal = global_sumTotalFinal + parseFloat(dividir[0])
                    global_sumcantidadFinal = global_sumcantidadFinal + parseFloat(dividir[1])

                   
    
            });








            let stacks = {!! $stack_casinos !!}
            let stack_mesa = stacks.filter( i => i.mesas_casino_id == mesa_id && fichas_casinos.map( x => x.id == i.fichas_casino_id ) )
            const total_stack = stack_mesa.reduce((acc, number) => acc + ( parseFloat(number.cantidad) * parseFloat(number.ficha_name) ), 0);
            const total_stack_count = stack_mesa.reduce((acc, number) => acc + ( parseFloat(number.cantidad)  ), 0);


            let stack_mesa_all_sala = stacks.filter( i => i.sede_id == sede_id && fichas_casinos.map( x => x.id == i.fichas_casino_id ) )
            const total_stack_all_sala = stack_mesa_all_sala.reduce((acc, number) => acc + ( parseFloat(number.cantidad) * parseFloat(number.ficha_name) ), 0);
            const total_stack_count_all_sala = stack_mesa_all_sala.reduce((acc, number) => acc + ( parseFloat(number.cantidad)  ), 0);
            
            $(`#sala_bancada_monto`).val("$ "+total_stack_all_sala)
            $(`#sala_bancada_cantidad`).val(total_stack_count_all_sala)

            $(`#sala_cierre_monto`).val("$ "+global_sumTotalFinal)
            $(`#sala_cierre_cantidad`).val(global_sumcantidadFinal)
            
            let diferencia_sala_monto = total_stack_all_sala - global_sumTotalFinal
                diferencia_sala_monto = (diferencia_sala_monto < 0) ? diferencia_sala_monto * -1 : diferencia_sala_monto

            let diferencia_sala_cantidad = total_stack_count_all_sala - global_sumcantidadFinal
                diferencia_sala_cantidad = (diferencia_sala_cantidad < 0) ? diferencia_sala_cantidad * -1 : diferencia_sala_cantidad


            $(`#sala_diferencia_monto`).val("$ "+diferencia_sala_monto)
            $(`#sala_diferencia_cantidad`).val(diferencia_sala_cantidad)
            
            if( total_stack_count_all_sala > global_sumcantidadFinal ){
                $(`#sala_diferencia_monto`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
                $(`#sala_diferencia_cantidad`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
            }else{
                $(`#sala_diferencia_monto`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
                $(`#sala_diferencia_cantidad`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
            }



            let final_mesa_diferencia = total_stack - sumTotalFinal
            let final_conteo_mesa_diferencia = total_stack_count - cantidadFinal

            $(`#total_final_${mesa_id}`).val(`$ ${(final_mesa_diferencia < 0) ? final_mesa_diferencia * -1 : final_mesa_diferencia} ( ${(final_conteo_mesa_diferencia < 0) ? final_conteo_mesa_diferencia * -1 : final_conteo_mesa_diferencia} )`)

            

            if( total_stack_count > cantidadFinal ){
                $(`#total_final_${mesa_id}`).removeClass("bg-verde-oscuro").addClass("bg-rojo-oscuro")
            }else{
                $(`#total_final_${mesa_id}`).removeClass("bg-rojo-oscuro").addClass("bg-verde-oscuro")
            }


    }
    function saveArch(group_cierre_boveda_id,sede_id) {
        let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
        let fichas_casinos = {!! $fichas_casinos !!}.filter( i => i.sede_id == sede_id )
        let total_registros = mesas_casinos.length*fichas_casinos.length
        let countReset = 0

        mesas_casinos.forEach(element_mesa => {
            fichas_casinos.forEach(element_billete => {
                let payload = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: { id: $(`#id_${element_mesa.id}_${element_billete.id}`).val() },
                    group_cierre_boveda_id: group_cierre_boveda_id, 

                    data: {
                        group_cierre_boveda_id: group_cierre_boveda_id, 
                        mesas_casino_id: element_mesa.id,
                        fichas_casino_id: element_billete.id,
                        cantidad: $(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).val() == "" ? 0 : parseFloat($(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).val())
                    }
                }
                $.ajax({
                    url: "{{ route('conteo_arching_boveda_casinos.store') }}",
                    type: "POST",
                    data: payload,
                    success: function (res) {
                        if(res.type === 'success'){
                            countReset = countReset+1
                            $(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).replaceWith(`<div id="mesa_billete_${element_mesa.id}_${element_billete.id}"><i class="fas fa-check-circle text-success fa-lg"></i></div>`)
                            if( countReset == total_registros ){
                                location.reload();
                            }
                        }

                    }
                });

            });
        });
    }

    /* OPCION N5 - EFECTIVO */
    function viewEfectivo(id,sede_id) {
        let currentGroup = {!! $group_cierre_bovedas !!}.find( i => i.id == id )
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
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" > Efectivo </th>`
                                billetes_casinos.forEach(billete => {
                                    html += `<td class="font-weight-bold text-left" style="background-color:paleturquoise;font-size:12px !important"> $ ${ billete.name } </td>`
                                });
                                html += `
                                <th class="text-center text-uppercase font-weight-bold" > TOTAL </th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
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
                                            <input id="total_mesa_conteo_efectivo" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:100px !important" value="$ 0 ( 0 )" > 
                                        </td>
                                </tr>
                           
                            <tr>
                                <td colspan="${billetes_casinos.length}" class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                    <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL" >
                                </td>`
                                
                                billetes_casinos.forEach(billete => {
                                    html += `
                                    <td class="font-weight-bold bg-gris"  >
                                        <input id="total_billete_conteo_efectivo_${billete.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
                                    </td>`
                                });
                                    html += `
                                    <td class="font-weight-bold" style="background-color:paleturquoise;"  >
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