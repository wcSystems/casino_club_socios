@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="pdfExport()" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-pdf"></i>
            </button>
            <button onclick="excelExport('xlsx')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-excel"></i>
            </button>
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
                        <th>Nombre y Apellido</th>
                        <th>Email</th>
                        <!-- <th>Acciones</th> -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#emails_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        Swal.fire({
            title: `${type} Registro`,
            showConfirmButton: false,
            html:`
                <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Nombre y Apellido <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="user" name="user" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el titulo aqui..." >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Usuario <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Defina el titulo aqui..." >
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Dominio <span class="text-danger"> *</span> </label>
                                <div class="col-lg-12">
                                    <select required id="domain_id" class="form-control w-100">
                                        <option value="" selected >Todos los dominios</option>
                                        @foreach( $domains as $item )
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
            let current={!! $emails !!}.find(i=>i.id===id)
            $("#user").val(current.user)
            $("#name").val(current.name)
            $("#domain_id").val(current.domain_id)
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
                    user: $('#user').val(),
                    name: $('#name').val(),
                    domain_id: $('#domain_id').val()
                }
            }
            $.ajax({
                url: "{{ route('emails.store') }}",
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

    function excelExport(type, fn, dl) {
        let user = {!! Auth::user() !!}
        var elt = document.getElementById('data-table-default');
        var wb = XLSX.utils.table_to_book(elt, { sheet: "listado de Correos" });
        return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
        XLSX.writeFile(wb, fn || ( user.name+'-Emails-'+moment().format('MMMM Do YYYY, h:mm:ss a')+'.'+(type || 'xlsx')));
    }
    function pdfExport(type, fn, dl) {
            var doc = new jsPDF()
            doc.autoTable({ html: '#data-table-default' })
            doc.save('table.pdf')
    }

    dataTable("{{route('emails.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        { data: 'user' },
        /* {
            render: function ( data,type, row,all  ) {
                return row.name+'@'+row.domain_name;
            }
        }, */
        {
            render: function ( data,type, row  ) {
                return `
                    <div class="d-flex justify-content-between">
                        <div>${row.name+'@'+row.domain_name}</div>
                        <div>
                            <a onclick="elim('emails',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                            <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                        </div>
                    </div>
                    
                `;
            }
        },
    ])
</script>
@endsection