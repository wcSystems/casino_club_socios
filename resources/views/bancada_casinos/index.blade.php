@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"> Bancada de Salas y boveda al iniciar el negocio por primera vez</h4>
        
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
                        <th>#</th>
                        <th>Sede</th>
                        <th>Stack Sede</th>
                        <th>Stack Boveda</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#bancada_casino_nav').removeClass("closed").addClass("active").addClass("expand")
    function saveBancadaCasino(sede_id) {
        let fichas_casinos={!! $fichas_casinos !!}.filter(i=>i.sede_id==sede_id)

        let countReset = 0
        let total_registros = fichas_casinos.length

        fichas_casinos.forEach(element => {

            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: $(`#id-${element.id}`).val() },
                data: {
                    sede_id: sede_id,
                    fichas_casino_id: element.id,
                    cantidad: ( $(`#cantidad-${element.id}`).val() == "" ) ? 0 : parseFloat($(`#cantidad-${element.id}`).val())
                }
            }

            $.ajax({
                url: "{{ route('bancada_sede_casinos.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {

                    if(res.type === 'success'){
                        countReset = countReset+1
                        $(`#cantidad-${element.id}`).replaceWith(`<div id="cantidad-${element.id}"><i class="fas fa-check-circle text-success fa-lg"></i></div>`)
                        if( countReset == total_registros ){
                            location.reload();
                        }
                    }


                }
            });

        });
    }
    function saveBancadaBoveda(sede_id) {
        let fichas_casinos={!! $fichas_casinos !!}.filter(i=>i.sede_id==sede_id)

        let countReset = 0
        let total_registros = fichas_casinos.length

        fichas_casinos.forEach(element => {

            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: $(`#id-${element.id}`).val() },
                data: {
                    sede_id: sede_id,
                    fichas_casino_id: element.id,
                    cantidad: ( $(`#cantidad-${element.id}`).val() == "" ) ? 0 : parseFloat($(`#cantidad-${element.id}`).val())
                }
            }

            $.ajax({
                url: "{{ route('bancada_sede_bovedas.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {

                    if(res.type === 'success'){
                        countReset = countReset+1
                        $(`#cantidad-${element.id}`).replaceWith(`<div id="cantidad-${element.id}"><i class="fas fa-check-circle text-success fa-lg"></i></div>`)
                        if( countReset == total_registros ){
                            location.reload();
                        }
                    }


                }
            });

        });
    }
    dataTable("{{route('bancada_casinos.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'sede_name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="bancadaCasino(${row.id})" style="color: var(--global-2)" class="btn btn-blue btn-icon btn-circle"><i class="fas fa-coins"></i></a>
                `;
            }
        },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="bancadaBoveda(${row.id})" style="color: var(--global-2)" class="btn btn-blue btn-icon btn-circle"><i class="fas fa-coins"></i></a>
                `;
            }
        },
    ])



    function bancadaCasino(sede_id) {
        let timerInterval 
        setLoading(timerInterval)
        $.ajax({
            url: `api/bancada_sede_casinos/sede/${sede_id}`,
            success: function (res) {
                let list = res

               
                clearInterval(timerInterval)
    
                let html = ``;

                html += `
                <div class="table-responsive mt-3">
                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" > Cantidad </th>
                                <th class="text-center text-uppercase font-weight-bold" > Valor </th>
                                <th class="text-center text-uppercase font-weight-bold" > TOTAL </th>
                            </tr>
                        </thead>
                        <tbody>`
                            list.fichas.forEach(item => {
                                
                                let current = list.bancada.find( i => i.fichas_casino_id == item.id )
                                let item_id = ( current == undefined ) ? 0 : parseFloat(current.id)
                                let item_value = ( current == undefined ) ? "" : parseFloat(current.cantidad)


                                html += `
                                <tr>

                                    <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                        <input id="id-${item.id}" type="hidden" value="${item_id}"  > 
                                        <input id="cantidad-${item.id}"  value="${item_value}" min="0" onkeyup="totalFichasValor( ${item.id} , ${item.name}, ${sede_id} )"  type="number"  class="form-control p-0 m-auto text-center font-weight-bold parsley-normal upper" style="min-width:80px !important" > 
                                    </td>

                                    <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                        <input id="ficha-${item.id}" type="text" disabled value="$ ${item.name}" class="form-control p-0 m-auto text-center border-0 font-weight-bold"  >
                                    </td>

                                    

                                    <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                        <input id="total-${item.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:100px !important" value="$ 0" > 
                                    </td>

                                    `
                                    
                                html += `
                                        
                                </tr>
                                `
                            });
                            
                            html += `
                            <tr>
                                <td colspan="2" class="font-weight-bold"style="background-color:#EDEDED !important"  >
                                    <div class="d-flex align-items-center">
                                        <input  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL BANCA" > 
                                    </div>
                                </td>
                                <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                    <input id="total_banca"  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                                </td>
                            </tr>


                            
                        </tbody>
                    </table>
                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="saveBancadaCasino(${sede_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                    </div>
                </div>`

                Swal.fire({
                    title: `Banca <br /> Casino ${ list.sede_name }`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                    width: "95%",
                    html: html
                }) 
                list.fichas.forEach(item => {
                    totalFichasValor( item.id , item.name, sede_id )
                })
            }
        });

    }
    function bancadaBoveda(sede_id) {
        let timerInterval 
        setLoading(timerInterval)
        $.ajax({
            url: `api/bancada_sede_bovedas/sede/${sede_id}`,
            success: function (res) {
                let list = res

               
                clearInterval(timerInterval)
    
                let html = ``;

                html += `
                <div class="table-responsive mt-3">
                    <table  class="data-table-default-schedule table table-bordered table-td-valign-middle mt-3 d-inline justify-content-center" style="overflow-x: auto;display: block;white-space: nowrap;width:100% !important">
                        <thead style="background-color:paleturquoise;"  >
                            <tr>
                                <th class="text-center text-uppercase font-weight-bold" > Cantidad </th>
                                <th class="text-center text-uppercase font-weight-bold" > Valor </th>
                                <th class="text-center text-uppercase font-weight-bold" > TOTAL </th>
                            </tr>
                        </thead>
                        <tbody>`
                            list.fichas.forEach(item => {
                                
                                let current = list.bancada.find( i => i.fichas_casino_id == item.id )
                                let item_id = ( current == undefined ) ? 0 : parseFloat(current.id)
                                let item_value = ( current == undefined ) ? "" : parseFloat(current.cantidad)


                                html += `
                                <tr>

                                    <td class="font-weight-bold" style="background-color:#EDEDED !important" >
                                        <input id="id-${item.id}" type="hidden" value="${item_id}"  > 
                                        <input id="cantidad-${item.id}"  value="${item_value}" min="0" onkeyup="totalFichasValor( ${item.id} , ${item.name}, ${sede_id} )"  type="number"  class="form-control p-0 m-auto text-center font-weight-bold parsley-normal upper" style="min-width:80px !important" > 
                                    </td>

                                    <td class="font-weight-bold text-left d-flex align-items-center" style="background-color:paleturquoise;"> 
                                        <input id="ficha-${item.id}" type="text" disabled value="$ ${item.name}" class="form-control p-0 m-auto text-center border-0 font-weight-bold"  >
                                    </td>

                                    

                                    <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                        <input id="total-${item.id}" disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" style="min-width:100px !important" value="$ 0" > 
                                    </td>

                                    `
                                    
                                html += `
                                        
                                </tr>
                                `
                            });
                            
                            html += `
                            <tr>
                                <td colspan="2" class="font-weight-bold"style="background-color:#EDEDED !important"  >
                                    <div class="d-flex align-items-center">
                                        <input  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="TOTAL BANCA" > 
                                    </div>
                                </td>
                                <td class="font-weight-bold " style="background-color:paleturquoise;" >
                                    <input id="total_banca"  disabled type="text" class="form-control p-0 m-auto text-center border-0 font-weight-bold" value="$ 0" > 
                                </td>
                            </tr>


                            
                        </tbody>
                    </table>
                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="saveBancadaBoveda(${sede_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                    </div>
                </div>`

                Swal.fire({
                    title: `Banca <br /> Boveda ${ list.sede_name }`,
                    showConfirmButton: false,
                    showCloseButton: true,
                    allowOutsideClick: false,
                    width: "95%",
                    html: html
                }) 
                list.fichas.forEach(item => {
                    totalFichasValor( item.id , item.name, sede_id )
                })
            }
        });

    }

    function totalFichasValor(id,ficha,sede_id) {

        let fichas_casinos={!! $fichas_casinos !!}.filter(i=>i.sede_id==sede_id).map( f => f.id )


        let cantidad = ( $(`#cantidad-${id}`).val() == "" ) ? 0 : parseFloat($(`#cantidad-${id}`).val())
        let valor = parseFloat(ficha)
        let total_final = 0

        $(`#total-${id}`).val(`$ ${cantidad*valor}`)

        fichas_casinos.forEach(element => {
            let cantidad_total = ( $(`#cantidad-${element}`).val() == "" ) ? 0 : parseFloat($(`#cantidad-${element}`).val())
            let valor_total =  parseFloat($(`#ficha-${element}`).val().slice(1))
            total_final = total_final + (cantidad_total*valor_total)

        });

        $(`#total_banca`).val(`$ ${total_final}`)


    }
</script>
@endsection