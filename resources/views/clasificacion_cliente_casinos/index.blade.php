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
    $('#clasificacion_cliente_casinos_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
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
            let current={!! $clasificacion_cliente_casinos !!}.find(i=>i.id===id)
            $("#name").val(current.name)
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
                    name: $('#name').val()
                }
            }
            $.ajax({
                url: "{{ route('clasificacion_cliente_casinos.store') }}",
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
    dataTable("{{route('clasificacion_cliente_casinos.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return row.id;
            }
        },
        { data: 'name' },
        {
            render: function ( data,type, row  ) {

                let dataUser = {!! $dataUser !!}
                let html = ``
                    html += `<a onclick="elim('clasificacion_cliente_casinos',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle m-2"><i class="fa fa-times"></i></a>`
                    html += `<a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle m-2"><i class="fas fa-pen"></i></a>`
                    html += `<a onclick="viewEmployees(${row.id})" style="color: var(--global-2)" class="btn btn-gray btn-icon btn-circle my-2 mx-3"><i class="fas fa-camera"></i></a>`;
                  
                return html;
            }
        },
    ])
    function viewEmployees(id) {
        let current={!! $clasificacion_cliente_casinos !!}.find(i=>i.id===id)
        let clientes_casinos={!! $clientes_casinos !!}
        let html = `<div class="row d-flex justify-content-center">`;

        let dataUser = {!! $dataUser !!}
            clientes_casinos = ( dataUser.level_id > 1 ) ? clientes_casinos.filter( i => i.sede_id == dataUser.sede_id ) : clientes_casinos

            clientes_casinos.forEach(element => {
                let clasificacion_cliente_casinos={!! $clasificacion_cliente_casinos !!}.find(i=>i.id==id)
                let sex={!! $sexs !!}.find(i=>i.id==element.sex_id)
                let sede={!! $sedes !!}.find(i=>i.id==element.sede_id)
                if( element.clasificacion_cliente_casino_id == id ){
                    html += `
                        <div class=" col-md-4 col-sm-6 col-xs-12" >
                            <img class="rounded-circle" src='public/clientes_casinos/${element.id}.jpg' width="150" height="150" onerror="this.onerror=null;this.src='public/users/null.jpg';" />
                            <div class="font-weight-bold mt-1">${element.name}</div>
                            
                            <div>Carpeta: ${ clasificacion_cliente_casinos.name }, Sexo: ${ sex.name }</div>
                            <div class="font-weight-bold">Sede: ${sede.name}</div>
                            <div class="my-2"> <span class="font-weight-bold" > Noveda:</span>  ${element.description} </div>
                        </div>
                        `
                }
                
            });
            html += `</div>`;
        Swal.fire({
            title: current.name,
            width: '80em',
            showConfirmButton: true,
            showCloseButton: true,
            confirmButtonText: 'CERRAR',
            html: html
        })
    }
    function setLoading(timerInterval) {
            Swal.fire({
                title: 'Procesando datos!',
                text: 'porfavor espere',
                timer: 300000,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => { }, 100)
                },
            })
    }
</script>
@endsection