@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="pdfExport('model_machines')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-pdf"></i>
            </button>
            <button onclick="excelExport('model_machines')" class="d-flex btn btn-1 btn-secondary mx-1">
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
                    <div class="px-0 col-xs-12">
                        <select id="search_type_group_associated" class="form-control w-100">
                            <option value="" selected > Asociados o Invitados</option>
                            @foreach( $associated_groups as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12">
                        <select id="search_associated_select" class="form-control w-100">
                            <option value="" selected > Asociado / Invitado</option>
                            @foreach( $associated_groups as $itemGroup )
                                <optgroup label="{{ $itemGroup->name }}">
                                    @foreach( $associated_machines as $item )
                                        @if( $item->associated_group_id == $itemGroup->id )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12">
                        <select id="search_type_group_room" class="form-control w-100">
                            <option value="" selected > Salas o Galpones</option>
                            @foreach( $room_groups as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12">
                        <select id="search_room_select" class="form-control w-100">
                            <option value="" selected > Sala / Galpon</option>
                            @foreach( $room_groups as $itemGroup )
                                <optgroup label="{{ $itemGroup->name }}">
                                    @foreach( $rooms as $item )
                                        @if( $item->room_group_id == $itemGroup->id )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12">
                        <select id="search_brand_machines_select" class="form-control w-100">
                            <option value="" selected > Todas las marcas</option>
                            @foreach( $brand_machines as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12">
                        <select id="search_model_machines_select" class="form-control w-100">
                            <option value="" selected > Todas los modelos</option>
                            @foreach( $brand_machines as $itemBrand )
                                <optgroup label="{{ $itemBrand->name }}">
                                    @foreach( $model_machines as $item )
                                        @if( $item->brand_machine_id == $itemBrand->id )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12">
                        <select id="search_condicion_select" class="form-control w-100">
                            <option value="" selected > Todas las condiciones</option>
                            @foreach( $condicion_groups as $item )
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
                            <th>Sala / Galpon</th>
                            <th>Asociado / Invitado</th>
                            <th>Marca y Modelo</th>
                            <th>Condicion</th>
                            <th>Historico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">

    <!-- Asociados / Invitados -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                <select id="chart_type_group_associated" class="form-control w-100" style="color: #fff !important" onchange="datatableAssociatedGroup()">
                    <option value="" selected > Asociados o Invitados</option>
                    @foreach( $associated_groups as $item )
                        <option value="{{ $item->name }}" > {{ $item->name }} </option>
                    @endforeach
                </select>
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="associated_group_data"></canvas>
            </div>
        </div>
    </div>

    <!-- Salas / Galpones -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                <select id="chart_type_group_room" class="form-control w-100" style="color: #fff !important" onchange="datatableRoomGroup()">
                    <option value="" selected > Salas o Galpones</option>
                    @foreach( $room_groups as $item )
                        <option value="{{ $item->name }}" > {{ $item->name }} </option>
                    @endforeach
                </select>
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="room_group_data"></canvas>
            </div>
        </div>
    </div>

    <!-- Marcas / Modelos -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                <select id="chart_type_group_brand" class="form-control w-100" style="color: #fff !important" onchange="datatableBrandGroup()">
                    <option value="" selected > Marcas </option>
                    @foreach( $brand_machines as $item )
                        <option value="{{ $item->name }}" > {{ $item->name }} </option>
                    @endforeach
                </select>
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="brand_group_data"></canvas>
            </div>
        </div>
    </div>

    <!-- Condiciones -->
    <div class="panel bg-transparent panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3  " >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                <select id="chart_type_group_condicion" class="form-control w-100" style="color: #fff !important" onchange="datatableCondicionGroup()">
                    <option value="condiciones" selected > Condiciones </option>
                    <option value="imagenes" > Imagenes </option>
                    <option value="sinserial" > Sin Serial </option>
                </select>
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="condicion_group_data"></canvas>
            </div>
        </div>
    </div>

    
    
</div>
@endsection
@section('js')
<script>
    let all = [];
    let associated_group_data;
    let room_group_data;
    let brand_group_data;
    let condicion_group_data;
    
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
                                    <input required type="text" id="serial" name="serial" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Ingrese el serial de la maquina" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Asociados <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="associated_machine_id" class="form-control w-100">
                                        <option value="" selected disabled > Asociados / Invitados </option>
                                        @foreach( $associated_groups as $itemGroup )
                                            <optgroup label="{{ $itemGroup->name }}">
                                                @foreach( $associated_machines as $item )
                                                    @if( $item->associated_group_id == $itemGroup->id )
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
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Marca <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="brand_machine_id" class="form-control w-100" onchange="listModel()">
                                        <option value="" selected disabled >Todas las marcas</option>
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
                                <label class=" text-lg-right col-form-label"> Condicion <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="condicion_group_id" class="form-control w-100" >
                                        <option value="" selected disabled >Selecione una Condicion</option>
                                        @foreach( $condicion_groups as $item )
                                            <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Salas / Galpones <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="room_id" class="form-control w-100">
                                        <option value="" selected disabled >Salas / Galpones</option>
                                        @foreach( $room_groups as $itemGroup )
                                            <optgroup label="{{ $itemGroup->name }}">
                                                @foreach( $rooms as $item )
                                                    @if( $item->room_group_id == $itemGroup->id )
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
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nueva Novedad <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <textarea type="text" id="new_novedad" name="new_novedad" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Explique la novedad" ></textarea>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mt-3">
                            <div class="form-group row">
                                <label class="d-flex m-auto">
                                    <input require  multiple type="file" id="images" name="images" >
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                        </div>
                      
                    </div>
                </form>`
        })
        $("#serial").val("S/S")
        if(id){
            let current={!! $global_warehouses !!}.find(i=>i.id===id)
            let html_history = ``;
            $("#serial").val(current.serial)
            $("#associated_machine_id").val(current.associated_machine_id)
            $("#brand_machine_id").val(current.brand_machine_id)
            $("#condicion_group_id").val(current.condicion_group_id)
            $("#room_id").val(current.room_id)
            listModel(current.model_machine_id)
        }
        validateForm()
    }
    function guardar(id) {
        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = new FormData();   
                payload.append('id',id ? id : "")
                payload.append('serial',$('#serial').val())
                payload.append('associated_machine_id',$('#associated_machine_id').val())
                payload.append('brand_machine_id',$('#brand_machine_id').val())
                payload.append('model_machine_id',$('#model_machine_id').val())
                payload.append('condicion_group_id',$('#condicion_group_id').val())
                payload.append('room_id',$('#room_id').val())
                payload.append('new_novedad',$('#new_novedad').val())
                $.each($("input[type='file']")[0].files, function(i, file) {
                    payload.append('images[]', file);
                });
            $.ajax({
                url: "{{ route('global_warehouses.store') }}",
                type: "POST",
                data: payload,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                success: function (res) {
                    if(res.type === 'success'){
                        location.reload();
                    }
                }
            });
        }
    }
    function listModel(params) {
        let brand_machine_id = $("#brand_machine_id").val()
            $.ajax({
                url: "{{ route('global_warehouses.listModel') }}",
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
    function historico(params) {

        let current={!! $global_warehouses !!}.find(i=>i.id===params)
       
        let htmlTemplate = ``
        htmlTemplate += `
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data-table-default-historico" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Novedad</th>
                        </tr>
                    </thead>
                    <tbody>`;
                        current.history.forEach(element => {
                            htmlTemplate +=`
                            <tr>
                                <td>${ moment(element.created_at).format("YYYY-MM-DD") }</td>
                                <td>${ element.name }</td>
                            </tr>
                            `;
                        });
                    htmlTemplate+=
                    `</tbody>
                </table>
            </div>
        </div>`;
        Swal.fire({
            title: `Historico de Novedades`,
            showConfirmButton: false,
            html: htmlTemplate,
            width: '80em',
        })
        dataTableSimple("data-table-default-historico")
    }
    function imgs(params) {

        let current={!! $global_warehouses !!}.find(i=>i.id===params)
        let htmlTemplate = ``
        htmlTemplate += `
        <form id="form-all-imgs" class="needs-validation" action="javascript:void(0);" novalidate>
            <div class="row">`
            if(current.imgs.length > 0){
                current.imgs.forEach(element => {
                    htmlTemplate += `
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group row">
                            <label class="d-flex m-auto">
                                <img id="imgUser" class="" src="public/warehouses/${current.id}/${element.name}" width="100%" />
                            </label>
                        </div>
                    </div>
                    `
                });
            }else{
                htmlTemplate += `
                <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                        <label class="d-flex m-auto">
                            <img id="imgUser" class="rounded-circle" src="public/users/null.jpg" width="150px" height="150px" />
                        </label>
                    </div>
                </div>
                `;
            }
            
            htmlTemplate += `
            </div>
        </form>
        `;
        Swal.fire({
            title: `Fotos`,
            showConfirmButton: true,
            confirmButtonText: 'CERRAR',
            html: htmlTemplate,
            showCloseButton: true,
            width: '80em',
        })
    }
    dataTable("{{route('global_warehouses.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'serial' },
        {
            render: function ( data,type, row,all  ) {
                return "<span class='font-weight-bold'>"+row.room_group+":&nbsp;</span>"+row.room_name;
            }
        },
        {
            render: function ( data,type, row,all  ) {
                return "<span class='font-weight-bold'>"+row.associated_group+":&nbsp;</span>"+row.associated_name;
            }
        },
        {
            render: function ( data,type, row,all  ) {
                return "<span class='font-weight-bold'>Marca:&nbsp;</span>"+row.brand_name+"<span class='font-weight-bold'>&nbsp;Modelo:&nbsp;</span>"+row.model_name;
            }
        },
        { data: 'condicion_group' },
        { data: 'history_query' },
        {
            render: function ( data,type, row  ) {
                let imgExist = {!! $global_warehouses !!}.filter( i => i.id == row.id  ).map( i => i.imgs )[0].length > 0
                let htmlFunctions = ``;
                    htmlFunctions += `
                        <div class="m-auto text-center">
                            <a onclick="elim('global_warehouses',${row.id})" style="color: var(--global-2)" class="m-2 btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                            <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="m-2 btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                            <a onclick="historico(${row.id})" style="color: var(--global-2)" class="m-2 btn btn-info btn-icon btn-circle"><i class="fas fa-th-list"></i></a>`;
                            if(imgExist){
                                htmlFunctions += `<a onclick="imgs(${row.id})" style="color: var(--global-2)" class="m-2 btn btn-green btn-icon btn-circle"><i class="fas fa-eye"></i></a>`;
                            }
                        htmlFunctions += 
                        `</div>`;
                    return htmlFunctions;
            }
        },
    ],"group_name_all")


    
    function ajaxReloadDatatablesFN(res){
        all = res;

        if(associated_group_data!=null){ associated_group_data.destroy(); }
        let associated_group =all.map( i => i.associated_group ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        associated_group_data = new Chart(document.getElementById('associated_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(associated_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(associated_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });

        if(room_group_data!=null){ room_group_data.destroy(); }
        let room_group =all.map( i => i.room_group ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        room_group_data = new Chart(document.getElementById('room_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(room_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(room_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });

        if(brand_group_data!=null){ brand_group_data.destroy(); }
        let brand_group =all.map( i => i.brand_name ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        brand_group_data = new Chart(document.getElementById('brand_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(brand_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(brand_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });

        if(condicion_group_data!=null){ condicion_group_data.destroy(); }
        let condicion_group =all.map( i => i.condicion_group ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        condicion_group_data = new Chart(document.getElementById('condicion_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(condicion_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(condicion_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });

    }      


    function datatableAssociatedGroup(){
        if(associated_group_data!=null){ associated_group_data.destroy(); }

        let associated_group = all.map( i => ( i.associated_group == $("#chart_type_group_associated").val() && $("#chart_type_group_associated").val() != ""  ) ? i.associated_name : ( $("#chart_type_group_associated").val() == "" ) ? i.associated_group : ["borrar"] ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        delete associated_group.borrar
        associated_group_data = new Chart(document.getElementById('associated_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(associated_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(associated_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });
    }
    function datatableRoomGroup(){
        if(room_group_data!=null){ room_group_data.destroy(); }

        let room_group = all.map( i => ( i.room_group == $("#chart_type_group_room").val() && $("#chart_type_group_room").val() != ""  ) ? i.room_name : ( $("#chart_type_group_room").val() == "" ) ? i.room_group : ["borrar"] ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        delete room_group.borrar
        room_group_data = new Chart(document.getElementById('room_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(room_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(room_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });
    }
    
    function datatableBrandGroup() {
        if(brand_group_data!=null){ brand_group_data.destroy(); }

        let brand_group = all.map( i => ( i.brand_name == $("#chart_type_group_brand").val() && $("#chart_type_group_brand").val() != ""  ) ? i.model_name : ( $("#chart_type_group_brand").val() == "" ) ? i.brand_name : ["borrar"] ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
        delete brand_group.borrar
        brand_group_data = new Chart(document.getElementById('brand_group_data').getContext('2d'),{ 
            type:'doughnut',
            data: {
                labels: Object.keys(brand_group), 
                datasets: [ 
                    { 'label': '', 'data': Object.values(brand_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                 ] 
            }
        });
    }

    function datatableCondicionGroup() {
        if(condicion_group_data!=null){ condicion_group_data.destroy(); }

        /* Condiciones */
        if( $("#chart_type_group_condicion").val() == "condiciones" ){
            let condicion_group =all.map( i => i.condicion_group ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
            condicion_group_data = new Chart(document.getElementById('condicion_group_data').getContext('2d'),{ 
                type:'doughnut',
                data: {
                    labels: Object.keys(condicion_group), 
                    datasets: [ 
                        { 'label': '', 'data': Object.values(condicion_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                    ] 
                }
            });
        }

        /* Imagenes */
        if( $("#chart_type_group_condicion").val() == "imagenes" ){
            let condicion_group =all.map( i => i.img_query ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
            condicion_group_data = new Chart(document.getElementById('condicion_group_data').getContext('2d'),{ 
                type:'doughnut',
                data: {
                    labels: Object.keys(condicion_group), 
                    datasets: [ 
                        { 'label': '', 'data': Object.values(condicion_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                    ] 
                }
            });
        }

        /* Sin serial */
        if( $("#chart_type_group_condicion").val() == "sinserial" ){
            let condicion_group =all.map( i => i.serial_query ).reduce((accumulator, value) => {  accumulator[value] = ++accumulator[value] || 1; return accumulator; }, {});
            condicion_group_data = new Chart(document.getElementById('condicion_group_data').getContext('2d'),{ 
                type:'doughnut',
                data: {
                    labels: Object.keys(condicion_group), 
                    datasets: [ 
                        { 'label': '', 'data': Object.values(condicion_group), 'backgroundColor': {!! $all_colors !!}, 'borderWidth': 1 },
                    ] 
                }
            });
        }
        
        
    }
    

</script>
@endsection