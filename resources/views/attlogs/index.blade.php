@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <div class="panel-heading ui-sortable-handle d-flex justify-content-between">
            <a class="d-flex btn btn-danger" onclick="getDataBiometrico()" >
                OBTENER DATA DEL BIOMETRICO
            </a>
            <button onclick="pdfExport('Attlogs')" class="d-flex btn btn-1 btn-success">
                <i class="m-auto fas fa-lg fa-file-pdf"></i>
            </button>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                    <label for="start" class="text-left d-block"> Desde </label>
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-control w-100" type="date" name="start" value="2022-01-01" id="start" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                    <label for="end" class="text-left d-block"> Hasta </label>
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-control w-100" type="date" name="end"  value="2023-12-31"id="end" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sede_attlogs" class="form-control w-100">
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
                        <select id="search_department_attlogs" class="form-control w-100">
                            <option value="" selected >Todos los departamentos</option>
                            @foreach( $departments as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_position_attlogs" class="form-control w-100">
                            <option value="" selected >Todos los cargos</option>
                            @foreach( $positions as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sex_attlogs" class="form-control w-100">
                            <option value="" selected >Todos los sexos</option>
                            @foreach( $sexs as $item )
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
                        <th>Cedula</th>
                        <th>Nombre y Apellido</th>
                        <th>Fecha</th>
                        <th>Hora de Marcaje ( INTERNO ) </th>
                        <th>Hora de Marcaje ( EXTERNO ) </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $('#attlogs_nav').removeClass("closed").addClass("active").addClass("expand")

    dataTableAttlog("{{route('attlogs.service')}}",[
        { data: 'serialNo' },
        { data: 'employeeNoString' },
        { data: 'name' },
        { data: 'date' },
        {
            render: function ( data,type, row,all  ) { 

                    return `<span class='font-weight-bold'>Marcaje: </span>` +moment(row.time).format('h:mm:ss a')+`
                            <a href='http://admin:Cas1n01234@192.168.5.181${row.pictureURL.slice(27)}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>`
                    
            }
        },
        {
            render: function ( data,type, row,all  ) { 

                    return `<span class='font-weight-bold'>Marcaje: </span>` +moment(row.time).format('h:mm:ss a')+`
                            <a href='http://admin:Cas1n01234@${row.pictureURL.slice(7)}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>`
                    
            }
        },
    ],"group_name_all")
    
    function getDataBiometrico(params) {
        Swal.fire({
            title: `Biometrico`,
            showConfirmButton: false,
            showCloseButton: true,
            allowOutsideClick: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Mes y Año <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="month" value="${moment().format('YYYY-MM')}"  id="year_month" name="year_month" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el año aca" >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" style="margin-top:20px">
                            <button onclick="getSyncBiometric()" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Sincronizar </button>
                        </div>
                    </div>
                </form>`
            })
    }

    function getSyncBiometric() {
        let timerInterval
        let month = $("#year_month").val().slice(5)
        let payload = {
            end: moment(month).daysInMonth(),
            month: month,
            year: $("#year_month").val().slice(0,4)
        }
        setLoading(timerInterval)
        $.ajax({ 
            url: "{{route('isapi.getEvent')}}",
            type: "POST",
            data: payload,
            success: function (res) {
                clearInterval(timerInterval)
                if( res.type == "success" ){
                    location.reload();
                }
                if( res.type == "error" ){
                    Swal.fire({
						title: 'ERROR',
						text: 'Sin registros, porfavor verifique el mes y año.',
						icon: 'error',
						showConfirmButton: true,
						showCloseButton: true,
						allowOutsideClick: false,
						confirmButtonText: 'OK',
						confirmButtonColor: '#fd7e14',
					})
                }
                if( res.type == "error_server" ){
                    Swal.fire({
						title: 'ERROR SERVIDOR',
						text: 'Error de conexion con biometrico, porfavor verifique que el año introducido sea el correcto y que el biometrico este encendido antes de contactar a soporte.',
						icon: 'error',
						showConfirmButton: true,
						showCloseButton: true,
						allowOutsideClick: false,
						confirmButtonText: 'OK',
						confirmButtonColor: '#fd7e14',
					})
                }
            }
        });

    }

    function setLoading(timerInterval) {
        Swal.fire({
            title: 'Sincronizando!',
            text: 'porfavor espere mientra se extraen los registros del biometrico...',
            timer: 300000,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => { }, 100)
            },
        })
    }

</script>
@endsection