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
                            <input required class="form-control w-100" type="date" name="start" value="" id="start" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                    <label for="end" class="text-left d-block"> Hasta </label>
                        <div class="form-check" style="justify-content: left !important">
                            <input required class="form-control w-100" type="date" name="end"  value="" id="end" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        @if( Auth::user()->level_id == 1 )
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
            @else
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                    <div class="form-group w-100">
                        <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                            <select id="search_sede_attlogs" class="form-control w-100">
                                @foreach( $sedes as $item )
                                    @if( Auth::user()->sede_id ==  $item->id )
                                        <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            
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
                        <th>Cedula</th>
                        <th>Nombre y Apellido</th>
                        <th>Marcajes </th>
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
    
    $("#start").val(moment().format('YYYY-MM-DD'))
    $("#end").val( moment().add(1, 'days').format('YYYY-MM-DD'))
    
    dataTableAttlog("{{route('attlogs.service')}}",[
        { data: 'employeeNoString' },
        { data: 'name' },
        {
            render: function ( data,type, row,all  ) { 

                    return `<span class='font-weight-bold'>Marcajes: </span>`+`
                            <a onclick="viewPicI(this)" data-employeeNoString="${row.employeeNoString}"  style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a></span>`
                    
            }
        }
    ],"group_name")
    
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
                        @if( Auth::user()->level_id == 1 )
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label"> Sedes <span class="text-danger"> *</span> </label>
                                    <div class="col-lg-12">
                                        <select id="sede_id" class="form-control w-100">
                                            <option value="" selected >Todos las sedes</option>
                                            @foreach( $sedes as $item )
                                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row m-b-0">
                                    <label class=" text-lg-right col-form-label"> Sedes <span class="text-danger"> *</span> </label>
                                    <div class="col-lg-12">
                                        <select id="sede_id" class="form-control w-100">
                                            @foreach( $sedes as $item )
                                                @if( Auth::user()->sede_id ==  $item->id )
                                                    <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
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
            year: $("#year_month").val().slice(0,4),
            sede_id: $("#sede_id").val(),
        }
        setLoading(timerInterval)
        $.ajax({ 
            url: "{{route('isapi.getMatches')}}",
            type: "POST",
            data: payload,
            success: function (res) {
                //clearInterval(timerInterval)
                if( res.type == "success" ){
                    let totalMatches = ( res.totalMatches > 30 ) ? Math.trunc(res.totalMatches/30) : 1
                    let tota30Matches = ( totalMatches == 1 ) ? res.totalMatches : (res.totalMatches-(totalMatches*30))
                    let position = 0;
                    for (let index = 1; index <= totalMatches; index++) {
                        let payloadGetEvent = {
                            init: res.time,
                            position: position,
                            end: payload.end,
                            month: payload.month,
                            year: payload.year,
                            sede_id: payload.sede_id,
                        }
                        $.ajax({ 
                            url: "{{route('isapi.getEvent')}}",
                            type: "POST",
                            data: payloadGetEvent,
                            success: function (resGet) {

                                if( resGet.type == "success" ){
                                    $("#swal2-content").replaceWith(`<div id="swal2-content" class="swal2-html-container" style="display: block;">porfavor espere mientra se extraen los registros del biometrico...<br /> Rgistros totales insertados: ${index} de ${totalMatches} <br /> En espera: ${ tota30Matches } </div>`)
                                    if( index == totalMatches ){
                                        clearInterval(timerInterval)
                                        location.reload();
                                    }
                                }

                                if( resGet.type == "error" ){
                                    clearInterval(timerInterval)
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
                                if( resGet.type == "error_server" ){
                                    clearInterval(timerInterval)
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
                        position = position + 30;
                    }
                }
                if( res.type == "error" ){
                    clearInterval(timerInterval)
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
                    clearInterval(timerInterval)
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



    function viewPicI(params) {
        let dataset = params.dataset
        let timerInterval
        setLoading(timerInterval)
        
        $.ajax({ 
            url: "{{route('attlogs.marcajesEmployee')}}",
            type: "POST",
            data: { employeeNoString: dataset.employeenostring },
            success: function (res) {
                if( res.type == "success" ){
                    clearInterval(timerInterval)
                            let html = ``
                            html += `
                            <div id="carrousel" class="carousel slide" data-ride="carousel">
                                
                                <div class="carousel-inner">`;
                                (res.query).forEach( (element2, index2 ) => {
                                    html += `
                                        <div class="carousel-item ${ ( index2 == 0 ) ? 'active' : '' }">
                                            <h5 class="font-weight-bold text-left">
                                                ${element2.departments_name}, ${element2.positions_name} | ${element2.name} | ${element2.sedes_name} | ${moment(element2.time).format('YYYY-MM-DD, h:mm:ss a.')}
                                            </h5>
                                            <img class="d-block w-100 main-img" src="${element2.pictureURL}" alt="slide" >
                                            <h6 class="font-weight-bold text-left">
                                                ( ${index2+1} DE ${(res.query).length} ) 
                                            </h6>
                                        </div>`
                                })
                                html += `
                                </div>
                                <a class="carousel-control-prev" href="#carrousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carrousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            `;


                    Swal.fire({
                        title: ``,
                        showConfirmButton: true,
                        showCloseButton: true,
                        width: '80em',
                        confirmButtonText: 'CERRAR',
                        html: html
                    
                    }) 
                }
            }
        });
      
                    
        
              
    }

</script>
@endsection