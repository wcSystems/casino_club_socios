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
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sheds" class="form-control w-100">
                            <option value="" selected >Todos los galpones</option>
                            @foreach( $sheds as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="data-table-default" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Serial</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Galpon</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#global_warehouses_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Serial <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="cod" name="cod" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el sn o cod unico aqui..." >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nombre <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Nombre o titulo..." >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Descripcion <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <textarea required type="text" id="description" name="description" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina una descripcion aqui..." ></textarea>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Galpones <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="shed_id" class="form-control w-100">
                                        <option value="" selected >Todos los galpones</option>
                                        @foreach( $sheds as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Historico <span class="text-danger"> *</span> </label>
                                <div id="history_record"></div>
                                <div class="col-lg-12">
                                    <input type="text" id="new_novedad" name="new_novedad" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Nueva Novedad..." >
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
            let current={!! $global_warehouses !!}.find(i=>i.id===id)
            let html_history = ``;
            $("#name").val(current.name)
            $("#description").val(current.description)
            $("#cod").val(current.cod)
            $("#shed_id").val(current.shed_id)
            
            if(current.history.length > 0){
                current.history.forEach(element => {
                    html_history+=`
                        <div class="col-lg-12 mb-2">
                            <input type="text" disabled id="novedad-${element.id}" name="novedad-${element.id}" class="form-control parsley-normal upper" style="color: var(--global-2) !important" value="${moment(element.created_at).format("YYYY-MM-DD")} - ${element.name}" >
                        </div>
                    `;
                });
                $("#history_record").replaceWith(`${html_history}`);
            }
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
                    description: $('#description').val(),
                    cod: $('#cod').val(),
                    shed_id: $('#shed_id').val(),
                },
                new_novedad: $('#new_novedad').val() ? $('#new_novedad').val() : "",
            }
            $.ajax({
                url: "{{ route('global_warehouses.store') }}",
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
    dataTable("{{route('global_warehouses.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'cod' },
        { data: 'name' },
        { data: 'description' },
        { data: 'shed_name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('global_warehouses',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                `;
            }
        },
    ])
</script>
@endsection