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
                        <th>Nombre</th>
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
                        @foreach( $ayb_items as $item )
                            <div class="row" id="item-{{ $item->id }}" >
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> {{ $item->name }} </label>
                                <input  type="hidden" id="ayb_item_id-{{ $item->id }}" name="ayb_item_id" value="{{ $item->id }}">
                                <div class="col-xs-3">
                                    <div class="form-group row m-b-0">
                                        <div class="col-lg-12">
                                            <input required type="number" id="total-{{ $item->id }}" name="total" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese el total" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group row m-b-0">
                                        <div class="col-lg-12">
                                            <select required id="option-{{ $item->id }}" name="option" class="form-control w-100">
                                                <option value="" selected >Opciones</option>
                                                <option value="1" > Cortesia </option>
                                                <option value="2" > Venta </option>
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group row m-b-0">
                                        <div class="col-lg-12">
                                            <select required id="game-{{ $item->id }}" name="game" class="form-control w-100">
                                                <option value="" selected >Juegos</option>
                                                <option value="1" > Maquinas </option>
                                                <option value="2" > Mesas </option>
                                            </select>
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group row m-b-0">
                                        <div class="col-lg-12">
                                            <input required type="text" id="aprobado-{{ $item->id }}" name="aprobado" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Aprobado por ... " >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        </div>
                    </div>
                </form>`
        })
        if(id){
            let current={!! $ayb_commands !!}.find(i=>i.id===id)
            let payload = []
            current.forEach(element => {
                /* payload.push(id)
                let data = $(`#item-${ element.id }`).serializeArray() */
                console.log(data)
            });

            $("#name").val(current.ayb_item_id)
        }
        validateForm()
    }
    function guardar(id) {
        /* let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    ayb_item_id: $('#name').val()
                }
            }
            $.ajax({
                url: "{{ route('ayb_commands.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {
                    console.log(res)
                    if(res.type === 'success'){
                        location.reload();
                    }
                }
            });
        } */
        let ayb_items = {!! $ayb_items !!}
        ayb_items.forEach(element => {
            
        });
        let data = $(`#form-all`).serializeArray()
            console.log(data)
    }
    dataTable("{{route('ayb_commands.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'ayb_item_id' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('ayb_commands',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                `;
            }
        },
    ])


    

</script>
@endsection