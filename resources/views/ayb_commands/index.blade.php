@extends('layouts.app')
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
                        <th>Aprobado</th>
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
            width: '50em',
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                    <div class="col-12">

                            <div id="items">
                                <label class=" text-lg-left col-form-label font-weight-bold"> Pedido #1 </label>
                                <div class="row " >
                                    <div class="col-xs-3">
                                        <div class="form-group row m-b-0">
                                            <label class=" text-lg-right col-form-label"> Item <span class="text-danger"> *</span> </label>
                                            <div class="col-lg-12">
                                                <select required id="ayb_item_id" name="ayb_item_id" class="form-control w-100">
                                                    <option value="" selected >Items</option>
                                                    @foreach( $ayb_items as $item )
                                                        <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group row m-b-0">
                                            <label class=" text-lg-right col-form-label"> Total <span class="text-danger"> *</span> </label>
                                            <div class="col-lg-12">
                                                <input required type="number" id="total" name="total" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese el total" >
                                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group row m-b-0">
                                            <label class=" text-lg-right col-form-label"> tipo <span class="text-danger"> *</span> </label>
                                            <div class="col-lg-12">
                                                <select required id="option" name="option" class="form-control w-100">
                                                    <option value="" selected >Opciones</option>
                                                    <option value="Cortesia" > Cortesia </option>
                                                    <option value="Venta" > Venta </option>
                                                </select>
                                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group row m-b-0">
                                            <label class=" text-lg-right col-form-label"> Destino <span class="text-danger"> *</span> </label>
                                            <div class="col-lg-12">
                                                <select required id="game" name="game" class="form-control w-100">
                                                    <option value="" selected >Juegos</option>
                                                    <option value="Maquinas" > Maquinas </option>
                                                    <option value="Mesas" > Mesas </option>
                                                </select>
                                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="item2" >
                                <div class="col-xs-6">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> Aprobado <span class="text-danger"> *</span> </label>
                                        <div class="col-lg-12">
                                            <select required id="user_id" name="user_id" class="form-control w-100">
                                                <option value="" selected >Items</option>
                                                @foreach( $users as $item )
                                                    <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
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
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Destino</th>
                                    <th>Tipo</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>`;
                                res.productos.forEach(element => {
                                    html +=`
                                    <tr>
                                        <td> ${element.id} </td>
                                        <td> ${element.item_name} </td>
                                        <td> ${element.game} </td>
                                        <td> ${element.option} </td>
                                        <td> ${element.total} </td>
                                        <td> ${element.price} $ </td>
                                        <td> ${ element.total * element.price } $ </td>
                                    </tr>
                                    `;
                                });
                            html += 
                                `<tr>
                                    <td colspan="5" > Comanda Autorizada por:  <span class="font-weight-bold">${res.aprobado}<span> </td>
                                    <th> TOTAL </th>
                                    <td> ${ res.productos.reduce((sum, i) => (i.total * i.price) + sum , 0) } $</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>`;





                Swal.fire({
                    title: `Comanda Nª ${id} - ${ moment( res.fecha ).format("DD-MM-YYYY")  }`,
                    showConfirmButton: false,
                    width: '50em',
                    html: html
                })
            }
        });
      
    }
    function guardar(id) {

        let arr_ayb_item_id = $("[name*='ayb_item_id']").serializeArray().map( i=> i.value )
        let arr_total = $("[name*='total']").serializeArray().map( i=> i.value )
        let arr_option = $("[name*='option']").serializeArray().map( i=> i.value )
        let arr_game = $("[name*='game']").serializeArray().map( i=> i.value )
        let newArrObj = []
        for (let index = 0; index < arrayItems-1; index++) {
            newArrObj.push({ 
                "ayb_item_id": arr_ayb_item_id[index], 
                "total": arr_total[index],
                "option": arr_option[index],
                "game": arr_game[index]
            })
            
        }
        console.log(newArrObj)


        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    obj: newArrObj,
                    user_id: $('#user_id').val()
                }
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
       /*  let ayb_items = {!! $ayb_items !!}
        ayb_items.forEach(element => {
            
        });
        let data = $(`#form-all`).serializeArray() */
    }
    dataTable("{{route('ayb_commands.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'user_name' },
        { data: 'created_at' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('ayb_commands',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="view(${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                `;
            }
        },
    ],"group_name_all")

    function itemCrud(more){

        let newHtmlItem = `
        <div class="row newRow" >
            <div class="col-xs-3">
                <div class="form-group row m-b-0">
                    <label class=" text-lg-right col-form-label"> Item <span class="text-danger"> *</span> </label>
                    <div class="col-lg-12">
                        <select required id="ayb_item_id" name="ayb_item_id" class="form-control w-100">
                            <option value="" selected >Items</option>
                            @foreach( $ayb_items as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group row m-b-0">
                    <label class=" text-lg-right col-form-label"> Total <span class="text-danger"> *</span> </label>
                    <div class="col-lg-12">
                        <input required type="number" id="total" name="total" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese el total" >
                        <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group row m-b-0">
                    <label class=" text-lg-right col-form-label"> tipo <span class="text-danger"> *</span> </label>
                    <div class="col-lg-12">
                        <select required id="option" name="option" class="form-control w-100">
                            <option value="" selected >Opciones</option>
                            <option value="Cortesia" > Cortesia </option>
                            <option value="Venta" > Venta </option>
                        </select>
                        <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="form-group row m-b-0">
                    <label class=" text-lg-right col-form-label"> Destino <span class="text-danger"> *</span> </label>
                    <div class="col-lg-12">
                        <select required id="game" name="game" class="form-control w-100">
                            <option value="" selected >Juegos</option>
                            <option value="Maquinas" > Maquinas </option>
                            <option value="Mesas" > Mesas </option>
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