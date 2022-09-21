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
                        <th>Item</th>
                        <th>Opcion</th>
                        <th>Juego</th>
                        <th>Total</th>
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
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            width: '50em',
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="col-12">
                            <div class="row" id="item" >
                                <div class="col-xs-4">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> Item <span class="text-danger"> *</span> </label>
                                        <div class="col-lg-12">
                                            <select required id="ayb_item_id" name="option" class="form-control w-100">
                                                <option value="" selected >Items</option>
                                                @foreach( $ayb_items as $item )
                                                    <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> Total <span class="text-danger"> *</span> </label>
                                        <div class="col-lg-12">
                                            <input required type="number" id="total" name="total" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese el total" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
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
                                <div class="col-xs-6">
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
                                <div class="col-xs-6">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> Aprobado <span class="text-danger"> *</span> </label>
                                        <div class="col-lg-12">
                                            <input required type="text" id="aprobado" name="aprobado" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Aprobado por ... " >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
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
            let current={!! $ayb_item_commands !!}.find(i=>i.id===id)
            $("#ayb_item_id").val(current.ayb_item_id)
            $("#total").val(current.total)
            $("#option").val(current.option)
            $("#game").val(current.game)
            $("#aprobado").val(current.aprobado)
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
                    ayb_item_id: $('#ayb_item_id').val(),
                    total: $('#total').val(),
                    option: $('#option').val(),
                    game: $('#game').val(),
                    aprobado: $('#aprobado').val()
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
        let ayb_items = {!! $ayb_items !!}
        ayb_items.forEach(element => {
            
        });
        let data = $(`#form-all`).serializeArray()
    }
    dataTable("{{route('ayb_commands.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'item_name' },
        { data: 'option' },
        { data: 'game' },
        { data: 'total' },
        { data: 'aprobado' },
        { data: 'created_at' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('ayb_commands',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                `;
            }
        },
    ],"group_name_all")


    

</script>
@endsection