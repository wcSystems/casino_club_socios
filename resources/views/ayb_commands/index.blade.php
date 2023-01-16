@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <div class="panel-heading ui-sortable-handle d-flex justify-content-between">
            <a class="d-flex btn btn-danger" href="/new_command" target="_blank" >
                GENERADOR DE COMANDAS
            </a>
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
                        <th>Tipo</th>
                        <th>Generado por:</th>
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
    $('#ayb_commands_nav').removeClass("closed").addClass("active").addClass("expand")
    let arrayItems  = 2
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            allowOutsideClick: false,
            showCloseButton: true,
            width: '50em',
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                    <div class="col-12">


                        <div id="comand" class="my-5">
                            <div class="row " >

                                <div class="col-xs-6">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> Tipo de comanda <span class="text-danger"> *</span> </label>
                                        <div class="col-lg-12">
                                            <select required id="type_command_id" name="type_command_id" class="form-control w-100" >
                                                <option disabled value="" selected >Seleccione una opcion</option>
                                                @foreach( $type_commands as $item )
                                                    <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>

                                

                                
                                <div class="col-xs-6">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> Comandado por: <span class="text-danger"> *</span> </label>
                                        <div class="col-lg-12">
                                            <select required id="employee_id" name="employee_id" class="form-control w-100">
                                                <option disabled value="" selected >Autorizado ( a )</option>
                                              

                                                @foreach( $departments as $itemGroup )
                                                    <optgroup label="{{ $itemGroup->name }}">
                                                        @foreach( $employees as $item )
                                                            @if( $item->department_id == $itemGroup->id )
                                                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach



                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <div id="items">
                            <label class=" text-lg-left col-form-label font-weight-bold"> Pedido #1 </label>
                            <div class="row " >

                                <div class="col-xs-4">
                                    <div class="form-group row m-b-0">
                                        <div class="col-lg-12">
                                            <select required id="ayb_item_id" name="ayb_item_id" class="form-control w-100">
                                                <option disabled value="" selected > Seleccione un menú</option>
                                                @foreach( $group_menus as $itemGroup )
                                                    <optgroup label="{{ $itemGroup->name }}">
                                                        @foreach( $ayb_items as $item )
                                                            @if( $item->group_menu_id == $itemGroup->id )
                                                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xs-4 d-flex">
                                    <button onclick="totalSum('-','1')" class="btn btn-secondary" style="height: fit-content" > - </button>
                                    <input readonly required type="number" id="total-1" name="total" class="form-control parsley-normal upper mx-2" style="color: var(--global-2) !important" value="1" min="1" >
                                    <button onclick="totalSum('+','1')" class="btn btn-secondary" style="height: fit-content" > + </button>
                                </div>

                                
                                <div class="col-xs-4">
                                    <div class="form-group row m-b-0">
                                        <div class="col-lg-12">
                                            <select required id="table_id" name="table_id" class="form-control w-100">
                                                <option disabled value="" selected >Destinos</option>
                                                @foreach( $tables as $item )
                                                    <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>   
                        
                        



                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="itemCrud('-')" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> - </button>
                            <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                            <button onclick="itemCrud('+')" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> + </button>
                        </div>
                    </div>
                </form>`
        })
        validateForm()
    }

    function view(id) {
        let payload = { _token: $("meta[name='csrf-token']").attr("content"), id: { id: id } }
        $.ajax({
            url: "api/ayb_commands/pjoin",
            type: "POST",
            data: payload,
            success: function (res) {
                res = JSON.parse(res)
                let html = ``
                    html += `
                    <div class="table-responsive">
                        <table id="data-table-default-stadistic" class=" table table-bordered table-td-valign-middle mt-3" style="width:100% !important">
                            <thead style="background-color:paleturquoise" >
                                <tr>
                                    <th colspan="5"> N°${res.command.id} - ${res.command.type_command_name} - ${ moment( res.command.created_at ).format("YYYY-MM-DD")  } </th>
                                </tr>
                            </thead>
                            <thead style="background-color:paleturquoise" >
                                <tr>
                                    <th>Producto</th>
                                    <th>Destino</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>`;
                                res.productos.forEach(element => {
                                    html +=`
                                    <tr>
                                        <td class="text-left"> ${element.item_name} </td>
                                        <td class="text-left"> ${element.table_name} </td>
                                        <td > ${element.total} </td>
                                        <td > ${element.price} $ </td>
                                        <td > ${ element.total * element.price } $ </td>
                                    </tr>
                                    `;
                                });
                            html += 
                                `<tr>
                                    <td colspan="3" > Comanda generada por:  <span class="font-weight-bold">${res.command.employee_name}<span> </td>
                                    <th> TOTAL </th>
                                    <td> ${ res.productos.reduce((sum, i) => (i.total * i.price) + sum , 0) } $</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>`;





                Swal.fire({
                    title: `Comanda N°${res.command.id}`,
                    showConfirmButton: false,
                    width: '50em',
                    html: html,
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    showCloseButton: true,
                    confirmButtonText: 'CERRAR',
                })
            }
        });
      
    }
    function guardar(id) {

        let newArrObj = []
        let arr_ayb_item_id = $("[name*='ayb_item_id']").serializeArray().map( i=> i.value )
        let arr_total = $("[name*='total']").serializeArray().map( i=> i.value )
        let arr_table_id = $("[name*='table_id']").serializeArray().map( i=> i.value )
        
        for (let index = 0; index < arrayItems-1; index++) {
            newArrObj.push({ 
                "ayb_item_id": arr_ayb_item_id[index], 
                "total": arr_total[index],
                "table_id": arr_table_id[index]
            })
            
        }
        let payload = {
            _token: $("meta[name='csrf-token']").attr("content"),
            type_command_id: $("#type_command_id").val(),
            employee_id: $("#employee_id").val(),
            items: newArrObj
        }

        $.ajax({
            url: "{{ route('ayb_commands.store') }}",
            type: "POST",
            data: payload,
            success: function (res) {
                if(res.type === 'success'){
                    location.reload();
                }
            }
        });
       
    }
    dataTable("{{route('ayb_commands.service')}}",[
        { data: 'id' },
        { data: 'type_command_name' },
        { data: 'employee_name' },
        {
            render: function ( data,type, row  ) {
                return moment(row.created_at).format('YYYY-MM-DD')
            }
        },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('ayb_commands',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="view(${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-eye"></i></a>
                `;
            }
        },
    ],"group_name_all")

    function totalSum(type,index) {
        let total = parseInt($(`#total-${parseInt(index)}`).val())

        if(type == "-" && total > 1){
            total = total - 1
        }

        if(type == "+"){
            total = total + 1
        }
        $(`#total-${parseInt(index)}`).val(total)
    }

    function itemCrud(more){
        let newHtmlItem = `
        <div class="row newRow" >
            <div class="col-xs-4">
                <div class="form-group row m-b-0">
                    <div class="col-lg-12">
                    <select required id="ayb_item_id" name="ayb_item_id" class="form-control w-100">
                        <option disabled value="" selected > Seleccione un menú</option>
                        @foreach( $group_menus as $itemGroup )
                            <optgroup label="{{ $itemGroup->name }}">
                                @foreach( $ayb_items as $item )
                                    @if( $item->group_menu_id == $itemGroup->id )
                                        <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>

                        <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-4 d-flex">
                <button onclick="totalSum('-',${arrayItems})" class="btn btn-secondary" style="height: fit-content" > - </button>
                <input readonly type="number" id="total-${arrayItems}" name="total" class="form-control parsley-normal upper mx-2" style="color: var(--global-2) !important" value="1" min="1" >
                <button onclick="totalSum('+',${arrayItems})" class="btn btn-secondary" style="height: fit-content" > + </button>
            </div>
            <div class="col-xs-4">
                <div class="form-group row m-b-0">
                    <div class="col-lg-12">
                        <select required id="table_id" name="table_id" class="form-control w-100">
                            <option disabled value="" selected >Destinos</option>
                            @foreach( $tables as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                    </div>
                </div>
            </div>
        </div>`;
        if (more === "+") {
            $('#items').append(`<label class="newRowLabel text-lg-left col-form-label font-weight-bold"> Pedido #${arrayItems} </label>`)
            $('#items').append(newHtmlItem)
            arrayItems = arrayItems+1
        }
        if (more === "-") {
            arrayItems = arrayItems > 2 ? arrayItems-1 : arrayItems 
            $('#items .newRow:last').remove()
            $('#items .newRowLabel:last').remove()
        }
    }

</script>
@endsection