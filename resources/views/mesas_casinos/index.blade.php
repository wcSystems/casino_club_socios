@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    
    <div class="panel-heading ui-sortable-handle">
            <div class="panel-heading ui-sortable-handle d-flex justify-content-between">
              
                <a class="d-flex btn btn-success"   onclick="modal('Crear')" >
                    Bancada de Salas 
                </a>
                <a class="d-flex btn btn-success"   onclick="modal('Crear')" >
                    Bancada de Bovedas 
                </a>
                <a class="d-flex btn btn-success"  onclick="modal('Crear')"  >
                    Bancada de mesas 
                </a>
              
            </div>
        </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table id="data-table-default" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>N de Puestos</th>
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
    $('#mesas_casinos_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Mesa <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el titulo aqui..." >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> N de Puestos <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="number" id="puestos" name="puestos" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina la cantidad de puestos" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
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
            let current={!! $mesas_casinos !!}.find(i=>i.id===id)
            $("#name").val(current.name)
            $("#sede_id").val(current.sede_id)
            $("#puestos").val(current.puestos)
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
                    name: $('#name').val(),
                    sede_id: $('#sede_id').val(),
                    puestos: $('#puestos').val(),
                }
            }
            $.ajax({
                url: "{{ route('mesas_casinos.store') }}",
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
    dataTable("{{route('mesas_casinos.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'name' },
        { data: 'puestos' },
        { data: 'sede_name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('mesas_casinos',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                    <a onclick="stack(${row.id},${row.sede_id})" style="color: var(--global-2)" class="btn btn-blue btn-icon btn-circle"><i class="fas fa-coins"></i></a>
                `;
            }
        },
    ],"group_name")

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

    function salir() {
        $(".swal2-close").click()
    }

    function stack(id, sede_id) {
        let timerInterval 
        setLoading(timerInterval)
        $.ajax({
            url: `api/stack_casinos/fichas/sede/${sede_id}/${id}`,
            success: function (res) {
                let list = res
                let current={!! $mesas_casinos !!}.find(i=>i.id===id)
                clearInterval(timerInterval)
console.log(list.stack)
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
                                
                                let current = list.stack.find( i => i.fichas_casino_id == item.id && i.mesas_casino_id == id )
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
                        <button onclick="save(${id},${sede_id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        <button onclick="salir()" type="submit" class="swal2-confirm swal2-styled bg-secondary" aria-label="" style="display: inline-block;"> Cerrar </button>
                    </div>
                </div>`

                Swal.fire({
                    title: `Banca ${ current.name }`,
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


    function save(id, sede_id) {
        let fichas_casinos={!! $fichas_casinos !!}.filter(i=>i.sede_id==sede_id)

        let countReset = 0
        let total_registros = fichas_casinos.length

        fichas_casinos.forEach(element => {

            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: $(`#id-${element.id}`).val() },
                data: {
                    mesas_casino_id: id,
                    fichas_casino_id: element.id,
                    cantidad: ( $(`#cantidad-${element.id}`).val() == "" ) ? 0 : parseFloat($(`#cantidad-${element.id}`).val())
                }
            }

            console.log(payload)


            $.ajax({
                url: "{{ route('stack_casinos.store') }}",
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

</script>
@endsection