@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
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
                            <input required class="form-control w-100" type="date" name="end"  value="2022-12-31"id="end" >
                        </div>
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
                        <th>Hora de Marcaje</th>
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
                let first_pictureURL = row.first_pictureURL.slice(7);
                let last_pictureURL = row.last_pictureURL.slice(7);
                    first_pictureURL = `http://admin:Cas1n01234@${first_pictureURL}`;
                    last_pictureURL = `http://admin:Cas1n01234@${last_pictureURL}`;
                return `<span class='font-weight-bold'>Entrada: </span>` +moment(row.first).format('h:mm:ss a')+`
                        <a href='${first_pictureURL}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>
                        <span class='font-weight-bold'>Salida: </span>`+ moment(row.last).format('h:mm:ss a')+`
                        <a href='${last_pictureURL}' target='_blank' style='color: var(--global-2)' class='btn btn-yellow btn-icon btn-circle'><i class='fas fa-camera'></i></a>`;
                       
            }
        },
    ],"group_name_all")
    
    fetch('https://api.ipify.org/?format=json').then(results => results.json()).then(data => {
        $.ajax({ type: "POST", url: "{{route('isapi.getEvent')}}", data: data });
    })    
</script>
@endsection