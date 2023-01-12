@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="pdfExport('all_machines')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-pdf"></i>
            </button>
            <button onclick="excelExport('all_machines')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-excel"></i>
            </button>
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
                        <select id="search_sede_machines" class="form-control w-100">
                            <option value="" selected >Todos las sedes</option>
                            @foreach( $sedes as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_brand_machines" class="form-control w-100">
                            <option value="" selected >Todos las marcas</option>
                            @foreach( $brand_machines as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_model_machines" class="form-control w-100">
                            <option value="" selected >Todos los modelos</option>
                            @foreach( $model_machines as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_range_machines" class="form-control w-100">
                            <option value="" selected >Todos los rangos</option>
                            @foreach( $range_machines as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_associated_machines" class="form-control w-100">
                            <option value="" selected >Todos los asociados</option>
                            @foreach( $associated_machines as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_value_machines" class="form-control w-100">
                            <option value="" selected >Todas las denominaciones</option>
                            @foreach( $value_machines as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_play_machines" class="form-control w-100">
                            <option value="" selected >Todos los juegos</option>
                            @foreach( $play_machines as $item )
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
                        <th>Maquinas</th>
                        <th>Marcas</th>
                        <th>Modelos</th>
                        <th>Rangos</th>
                        <th>Asociados</th>
                        <th>Denominaciones</th>
                        <th>Juegos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>

        

    </div>
</div>

<div class="row">
    <!-- Sedes -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Sedes
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="sede_data"></canvas>
            </div>
        </div>
    </div>
    <!-- Rangos -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Rangos
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="range_data"></canvas>
            </div>
        </div>
    </div>
    <!-- Asociados -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Asociados
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="associated_data"></canvas>
            </div>
        </div>
    </div>
    <!-- Denominaciones -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Denominaciones
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="value_data"></canvas>
            </div>
        </div>
    </div>
    <!-- Marcas -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-4  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Marcas
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="brand_data"></canvas>
            </div>
        </div>
    </div>
    <!-- Modelos -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-4  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Modelos
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="model_data"></canvas>
            </div>
        </div>
    </div>
    <!-- Juegos -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-4  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Juegos
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="play_data"></canvas>
            </div>
        </div>
    </div>
    
</div>

@endsection
@section('js')
<script>

    let charts = {!! $charts !!}
    const sede_data = new Chart(document.getElementById('sede_data'),{ type:'pie',data: charts.sede_data});
    const brand_data = new Chart(document.getElementById('brand_data'),{ type:'pie',data: charts.brand_data});
    const model_data = new Chart(document.getElementById('model_data'),{ type:'pie',data: charts.model_data});
    const range_data = new Chart(document.getElementById('range_data'),{ type:'pie',data: charts.range_data});
    const associated_data = new Chart(document.getElementById('associated_data'),{ type:'pie',data: charts.associated_data});
    const value_data = new Chart(document.getElementById('value_data'),{ type:'pie',data: charts.value_data});
    const play_data = new Chart(document.getElementById('play_data'),{ type:'pie',data: charts.play_data});

    $('#all_machines_nav').removeClass("closed").addClass("active").addClass("expand")
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
                                <label class=" text-lg-right col-form-label"> Nombre <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el nombre de la maquina" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Sede <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="sede_id" class="form-control w-100" >
                                        <option value="" selected >Todas las sedes</option>
                                        @foreach( $sedes as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Marca <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="brand_machine_id" class="form-control w-100" onchange="listModel()">
                                        <option value="" selected >Todas las marcas</option>
                                        @foreach( $brand_machines as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Modelo <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="model_machine_id" class="form-control w-100" disabled>
                                        <option value="" selected >Seleccione una marca primero</option>
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Rango <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="range_machine_id" class="form-control w-100">
                                        <option value="" selected >Todos los rangos</option>
                                        @foreach( $range_machines as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Asociado <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="associated_machine_id" class="form-control w-100">
                                        <option value="" selected >Todos los asociados</option>
                                        @foreach( $associated_machines as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Denominacion <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="value_machine_id" class="form-control w-100">
                                        <option value="" selected >Todos las denominaciones</option>
                                        @foreach( $value_machines as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Juego <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="play_machine_id" class="form-control w-100">
                                        <option value="" selected >Todos los juegos</option>
                                        @foreach( $play_machines as $item )
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
            let current={!! $all_machines !!}.find(i=>i.id===id)
           
            $("#brand_machine_id").val(current.brand_machine_id)
            $("#name").val(current.name)
            $("#sede_id").val(current.sede_id)
            $("#range_machine_id").val(current.range_machine_id)
            $("#associated_machine_id").val(current.associated_machine_id)
            $("#value_machine_id").val(current.value_machine_id)
            $("#play_machine_id").val(current.play_machine_id)
            listModel(current.model_machine_id)
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
                    brand_machine_id: $('#brand_machine_id').val(),
                    model_machine_id: $('#model_machine_id').val(),
                    range_machine_id: $('#range_machine_id').val(),
                    associated_machine_id: $('#associated_machine_id').val(),
                    value_machine_id: $('#value_machine_id').val(),
                    play_machine_id: $('#play_machine_id').val(),
                }
            }
            $.ajax({
                url: "{{ route('all_machines.store') }}",
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
    dataTable("{{route('all_machines.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'name' },
        { data: 'brand_name' },
        { data: 'model_name' },
        { data: 'range_name' },
        { data: 'associated_name' },
        { data: 'value_name' },
        { data: 'play_name' },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('all_machines',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                `;
            }
        },
    ],"group_name_all")

    function listModel(params) {
        let brand_machine_id = $("#brand_machine_id").val()
        $.ajax({
                url: "{{ route('all_machines.listModel') }}",
                type: "POST",
                data: { id: brand_machine_id},
                success: function (res) {
                    if(res.data.length){
                        let html = ``;
                            html += `<option value="" selected >Todos los modelos</option>`;

                            res.data.forEach(element => {
                                html += `<option value="${element.id}" >${element.name}</option>`;
                            });

                        $("#model_machine_id").replaceWith(`<select required id="model_machine_id" class="form-control w-100">${html}</select>`)
                        if (params) {
                            $("#model_machine_id").val(params)
                        }
                    }
                }
            });
        
    }
</script>
@endsection