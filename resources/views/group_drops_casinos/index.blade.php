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
        <div class="table-responsive">
            <table id="data-table-default" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sede</th>

                        <th>Drop</th>
                        <th>Gañota</th>
                        <th>Total</th>

                        <th>Fecha</th>
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
    let global_sumTotalFinal = 0
    $('#group_drops_casinos_nav').removeClass("closed").addClass("active").addClass("expand")
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
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        </div>
                    </div>
                </form>`
        })
        if(id){
            let current={!! $group_drops_casinos !!}.find(i=>i.id===id)
            $("#sede_id").val(current.sede_id)
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
                    sede_id: $('#sede_id').val()
                }
            }
            setLoading(timerInterval)
            $.ajax({
                url: "{{ route('group_drops_casinos.store') }}",
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
    dataTable("{{route('group_drops_casinos.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'sede_name' },
        {
            render: function ( data,type, row,all  ) {
                let conteo_drop_cecom_casinos = {!! $conteo_drop_cecom_casinos !!}.find( i => i.group_drops_casino_id == row.id )
                let total = conteo_drop_cecom_casinos == undefined ? 0 : conteo_drop_cecom_casinos.total
                return `$ ${ total }`;
            }
        },
        {
            render: function ( data,type, row,all  ) {
                return `$ ${ parseInt(row.extra ? row.extra : 0 ) }`;
            }
        },
        {
            render: function ( data,type, row,all  ) {
                let conteo_drop_cecom_casinos = {!! $conteo_drop_cecom_casinos !!}.find( i => i.group_drops_casino_id == row.id )
                let total = conteo_drop_cecom_casinos == undefined ? 0 : conteo_drop_cecom_casinos.total
                return `$ ${ parseInt( row.extra ? row.extra : 0  ) + parseInt(total ) }`;
            }
        },




        
        {
            render: function ( data,type, row,all  ) {
                return moment(row.created_at).format("YYYY-MM-DD");
            }
        },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('group_drops_casinos',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="viewDrop(${row.id},${row.sede_id},${row.extra})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fa fa-eye"></i></a>
                `;
            }
        },
    ],"group_name")


    function viewDrop(id,sede_id,extra) {
        let currentGroup = {!! $group_drops_casinos !!}.find( i => i.id == id )
        let timerInterval 
        let payload = {
            _token: $("meta[name='csrf-token']").attr("content"),
            id: id
        }
        setLoading(timerInterval)
        $.ajax({
            url: "{{ route('conteo_drop_cecom_casinos.list') }}",
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
                                        <input type="text" disabled class="form-control p-0 m-auto text-center border-0 font-weight-bold"   value="${mesa.name}" >
                                    </td>`
                                    billetes_casinos.forEach(billete => {
                                        let current = res.list.find( i => i.mesas_casino_id == mesa.id && i.billetes_casino_id == billete.id )
                                        let id = ( current == undefined ) ? 0 : parseInt(current.id)
                                        let cantidad = ( current == undefined ) ? 0 : parseInt(current.cantidad)
                                        html += `
                                        <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                            <input type="hidden" id="id_${mesa.id}_${billete.id}" value="${id}"  > 
                                            <input value="${cantidad}" id="mesa_billete_${mesa.id}_${billete.id}" onkeyup="sumMesaBilleteTotal(${mesa.id},${billete.id},${billete.name},${sede_id})" type="number" min="0"  class="form-control p-0 m-auto text-center font-weight-bold"  class="form-control parsley-normal upper"  > 
                                        </td>`
                                    });
                                html += `
                                        <td class="font-weight-bold bg-gris" >
                                            <input id="total_mesa_${mesa.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0 ( 0 )" > 
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
                    title: `DROP CECOM <br /> ${moment( currentGroup.created_at ).format("YYYY-MM-DD")}`,
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

    function saveDrop(group_drops_casino_id,sede_id) {
        let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
        let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
        let total_registros = mesas_casinos.length*billetes_casinos.length
        let countReset = 0

        billetes_casinos.forEach(element_billete => {
            mesas_casinos.forEach(element_mesa => {
                let payload = {
                    _token: $("meta[name='csrf-token']").attr("content"),
                    id: { id: $(`#id_${element_mesa.id}_${element_billete.id}`).val() },

                    extra: $(`#extra`).val() == "" ? 0 : parseInt($(`#extra`).val()),
                    group_drops_casino_id: group_drops_casino_id, 

                    data: {
                        group_drops_casino_id: group_drops_casino_id, 
                        mesas_casino_id: element_mesa.id,
                        billetes_casino_id: element_billete.id,
                        cantidad: $(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).val() == "" ? 0 : parseInt($(`#mesa_billete_${element_mesa.id}_${element_billete.id}`).val())
                    }
                }
                $.ajax({
                    url: "{{ route('conteo_drop_cecom_casinos.store') }}",
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
    function totalExtra() {
        let extra = $(`#extra`).val() == "" ? 0 : parseInt($(`#extra`).val())
        $(`#total_extra`).val(`$ ${global_sumTotalFinal+extra}`)
    }
    function sumMesaBilleteTotal(mesa_id,billete_id,billete_name,sede_id) {
        let extra = $(`#extra`).val() == "" ? 0 : parseInt($(`#extra`).val())
        let sumTotalMesas = 0
        let sumTotalBilletes = 0
        let sumTotalFinal = 0

        let cantidad_mesaFinal = 0
        let cantidad_billeteFinal = 0
        let cantidadFinal = 0

        let mesas_casinos = {!! $mesas_casinos !!}.filter( i => i.sede_id == sede_id )
        let billetes_casinos = {!! $billetes_casinos !!}.filter( i => i.sede_id == sede_id )
            
            billetes_casinos.forEach(element => {
                let cantidad_billete = $(`#mesa_billete_${mesa_id}_${element.id}`).val() == "" ? 0 : parseInt($(`#mesa_billete_${mesa_id}_${element.id}`).val())
                let precio_billete = parseInt(element.name)
                let subtotal_billete = precio_billete*cantidad_billete
                sumTotalMesas = sumTotalMesas+subtotal_billete
                cantidad_mesaFinal = cantidad_mesaFinal+cantidad_billete
            });

            mesas_casinos.forEach(element => {
                let cantidad_mesa = $(`#mesa_billete_${element.id}_${billete_id}`).val() == "" ? 0 : parseInt($(`#mesa_billete_${element.id}_${billete_id}`).val())
                let precio_mesa = parseInt(billete_name)
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
                    sumTotalFinal = sumTotalFinal+parseInt(dividir[0])
                    cantidadFinal = cantidadFinal+parseInt(dividir[1])
            });

            global_sumTotalFinal = sumTotalFinal
            $(`#total_final`).val(`$ ${sumTotalFinal} ( ${cantidadFinal} )`)
            $(`#total_extra`).val(`$ ${sumTotalFinal+extra}`)

            
    }


    function salir() {
        $(".swal2-close").click()
    }

</script>
@endsection