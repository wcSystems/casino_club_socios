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
                        <!-- <th>Cedula</th -->>
                        <th>Nombre y Apellido</th>
                        <th>Fecha</th>
                        <th>Hora de Marcaje</th>
                        <th>Foto</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="application/javascript" src="/js/digest-fetch-master/digest-fetch.js"></script>
<script>
    let attlogs = {!! $attlogs !!}
    console.log(attlogs)



    $('#attlogs_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Titulo <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el titulo aqui..." >
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
            let current={!! $attlogs !!}.find(i=>i.id===id)
            $("#name").val(current.name)
        }
        validateForm()
    }
    function preview(params) {
       

        params = $(`#img-preview-${params}`).data("img")
        
        Swal.fire({
            title: `Foto`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <div class="col-lg-12">
                                    <img src="${params}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>`
        })
    }
    function guardar(id) {
        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    name: $('#name').val()
                }
            }
            $.ajax({
                url: "{{ route('attlogs.store') }}",
                type: "POST",
                data: payload,
                success: function (res) {
                    console.log(res)
                    if(res.type === 'success'){
                        location.reload();
                    }
                }
            });
        }
    }
    dataTableAttlog("{{route('attlogs.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        //{ data: 'employeeID' },
        { data: 'name' },
        {
            render: function ( data,type, row,all  ) {
                
                return moment(row.time).format('YYYY-MM-DD');
            }
        },
        {
            render: function ( data,type, row,all  ) {
                return "<span class='font-weight-bold'>Entrada: </span>" +moment(row.time).format('h:mm:ss a')+" "+" <span class='font-weight-bold'>Salida: </span>"+ moment(row.time).format('h:mm:ss a');
            }
        },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="preview(${row.serialNo})" id="img-preview-${row.serialNo}" data-img="${row.pictureURL}" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-img"></i></a>
                `;
            }
        },
       
    ],"group_name_all")
</script>
@endsection