@extends('layouts.app')
@section('css')
<style>
    input[type="file"] {
    display: none;
}

#horarioTitle > br {
    display: none !important;
}
</style>
@endsection
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
            @if( Auth::user()->level_id == 1 )
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                    <div class="form-group w-100">
                        <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                            <select id="search_sede_all" class="form-control w-100">
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
                            <select id="search_sede_all" class="form-control w-100">
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
                        <select id="search_department_all" class="form-control w-100">
                            <option value="" selected >Todas las carpetas</option>
                            @foreach( $clasificacion_cliente_casinos as $item )
                                <option value="{{ $item->id }}" > {{ $item->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 form-inline mb-3">
                <div class="form-group w-100">
                    <div class="px-0 col-xs-12 col-sm-7 col-md-6 col-lg-8">
                        <select id="search_sex_all" class="form-control w-100">
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
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Carpeta</th>
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
        $('#clientes_casinos_nav').removeClass("closed").addClass("active").addClass("expand")
    

        function modal(type,id) {
            let html = `
            <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                @csrf
                <div class="row">

                        <div class="mx-auto">
                            <label class="d-flex m-0">
                                <img id="imgUser" class="rounded-circle"  src='public/users/null.jpg' onerror="this.onerror=null;this.src='public/users/null.jpg';" width="200" height="200" />
                                <input require onchange="viewImg(this)" type="file" id="image" name="image" style="display:none" >
                            </label>
                        </div>
             
                    <div class="col-md-12 col-sm-12">
                        <div class="form-group row m-b-0">
                            <label class=" text-lg-right col-form-label"> Nombre y Apellido <span class="text-danger"> *</span> </label>
                            <div class="col-lg-12">
                                <input required type="text" id="name" name="name" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Nombre y Apellido porfavor" >
                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group row m-b-0">
                            <label class=" text-lg-right col-form-label"> Sexos <span class="text-danger"> *</span> </label>
                            <div class="col-lg-12">
                                <select required id="sex_id" class="form-control w-100">
                                    <option value="" selected >Todos los Sexos</option>
                                    @foreach( $sexs as $item )
                                        <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                            </div>
                        </div>
                    </div>
                    @if( Auth::user()->level_id == 1 )
                        <div class="col-md-12 col-sm-6">
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
                        <div class="col-md-12 col-sm-6">
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
                    <div class="col-md-12 col-sm-6">
                        <div class="form-group row m-b-0">
                            <label class=" text-lg-right col-form-label"> Carpetas <span class="text-danger"> *</span> </label>
                            <div class="col-lg-12">
                                <select required id="clasificacion_cliente_casino_id" class="form-control w-100">
                                    <option value="" selected >Todos los Departamentos</option>
                                    @foreach( $clasificacion_cliente_casinos as $item )
                                        <option value="{{ $item->id }}" > {{ $item->name }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                            <div class="form-group row m-b-0">
                                <label class=" text-lg-right col-form-label"> Descripcion </label>
                                <div class="col-lg-12">
                                    <textarea type="text" id="description" name="description" class="form-control parsley-normal upper" style="color: var(--global-2) !important" placeholder="Explique la novedad del cliente" ></textarea>
                                    <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                </div>
                            </div>
                        </div>
                   
                    <div class="col-sm-12" style="margin-top:20px">
                        <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar Datos </button>
                      
                    </div>
                </div>
            </form>`

            Swal.fire({
                title: `${type} Registro`,
                showConfirmButton: false,
                html: html
            })
            $("#nacimiento").val(moment().format('YYYY-MM-DD'))
            if(id){
                let current={!! $clientes_casinos !!}.find(i=>i.id===id)
                $("#name").val(current.name)
                $("#sede_id").val(current.sede_id)
                $("#description").val(current.description)
                $("#clasificacion_cliente_casino_id").val(current.clasificacion_cliente_casino_id)
                $("#sex_id").val(current.sex_id)
                $("#imgUser").attr("src",`public/clientes_casinos/${current.id}.jpg`)
            }
            
            validateForm()
            
        }


        function viewImg(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgUser').attr('src', e.target.result).width(200).height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


        async function guardar(id) {

            let validity = document.getElementById('form-all').checkValidity()
            if(validity){
            
                let payload = new FormData();   
                    payload.append('id',id ? id : "")
                    payload.append('name',$('#name').val())
                    payload.append('sex_id',$('#sex_id').val())
                    payload.append('sede_id',$('#sede_id').val())
                    payload.append('description',$('#description').val())
                    payload.append('clasificacion_cliente_casino_id',$('#clasificacion_cliente_casino_id').val())
                    if($('#image').prop('files')[0]){
                        payload.append('image',await resizeImage({ file: $('#image').prop('files')[0],maxSize: 2000 }))
                    }

                    $.ajax({
                        url: "{{ route('clientes_casinos.store') }}",
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
    
       

       

        dataTableClientesCasinos("{{route('clientes_casinos.service')}}",[
            {
                render: function ( data,type, row,all  ) {
                    return row.id;
                }
            },
            {
                render: function ( data,type, row,all  ) {
                    return `<img onclick="previewIMG(${row.id})" src='public/clientes_casinos/${row.id}.jpg' onerror="this.onerror=null;this.src='public/users/null.jpg';" class="btn  btn-icon btn-circle m-2" />`;
                        
                }
            },
            { data: 'name' },
            { data: 'clasificacion_cliente_casinos_name' },
            {
                render: function ( data,type, row  ) {
                    let dataUser = {!! $dataUser !!}
                    let html = ``

                        html += `<a onclick="elim('clientes_casinos',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle m-2"><i class="fa fa-times"></i></a>
                                 <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle m-2"><i class="fas fa-pen"></i></a>`
                  
                    
                    return html;
                        
                }
            },
        ],"group_name")


        function whatsappApi() {
            let version = "v17.0"
            let number_from = "101749299650639"
            let number_to = "584121482348"
            let token = "EAAI4bCbbGgEBAO66F8Wn2b8X9mZAxFgHSujGA4F8TuUaQs42x5PfaqcBJFyFTup44LHQ750kcbHNbFwbUZCOITFRTVRQoU9sIQoN9KaSo7pAZAyVDVmq5pvEdgsoKNCLO3aUyv70vIB5rmZBVZABG3ZC84ZCfOwSnnDAwdZBJHoczbzdy7umkgj5TAKQyOnCNmpcgiZB7JzMINlLea71c5EaMPzA7VTafMUAZD"
            let payload = {
                messaging_product: "whatsapp",
                recipient_type: "individual",
                to: number_to,
                to: "text",
                text: {
                    preview_url: false,
                    body: "test de mensajes"
                }
            }
            $.ajax({
                url: `https://graph.facebook.com/${version}/${number_from}/messages`,
                type: "POST",
                data: payload,
                headers: {'Authorization': `Bearer ${token}`},
                success: function (res) {
                   console.log("respuesta",res)
                }   
            });   

        }

        function previewIMG(id) {
            let current={!! $clientes_casinos !!}.find(i=>i.id===id)
            let clasificacion_cliente_casinos={!! $clasificacion_cliente_casinos !!}.find(i=>i.id==current.clasificacion_cliente_casino_id)
            let sex={!! $sexs !!}.find(i=>i.id==current.sex_id)
            let sede={!! $sedes !!}.find(i=>i.id==current.sede_id)

            Swal.fire({
                        showConfirmButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'CERRAR',
                      
                        html: `<div class="col-xs-12" >
                            <img class="rounded-circle" src='public/clientes_casinos/${current.id}.jpg' width="300" height="300" onerror="this.onerror=null;this.src='public/users/null.jpg';" />
                            <div class="font-weight-bold">${current.name}</div>
                            
                            <div>Carpeta: ${ clasificacion_cliente_casinos.name }, Sexo: ${ sex.name }</div>
                            <div class="font-weight-bold">Sede: ${sede.name}</div>
                            <div class="my-2"> <span class="font-weight-bold" > Noveda:</span>  ${current.description} </div>
                        </div>`

                    })
        }

        function resizeImage(settings) {
                var file = settings.file;
                var maxSize = settings.maxSize;
                var reader = new FileReader();
                var image = new Image();
                var canvas = document.createElement('canvas');
                var dataURItoBlob = function (dataURI) {
                    var bytes = dataURI.split(',')[0].indexOf('base64') >= 0 ?
                        atob(dataURI.split(',')[1]) :
                        unescape(dataURI.split(',')[1]);
                    var mime = dataURI.split(',')[0].split(':')[1].split(';')[0];
                    var max = bytes.length;
                    var ia = new Uint8Array(max);
                    for (var i = 0; i < max; i++)
                        ia[i] = bytes.charCodeAt(i);
                    return new Blob([ia], { type: mime });
                };
                var resize = function () {
                    var width = image.width;
                    var height = image.height;
                    if (width > height) {
                        if (width > maxSize) {
                            height *= maxSize / width;
                            width = maxSize;
                        }
                    } else {
                        if (height > maxSize) {
                            width *= maxSize / height;
                            height = maxSize;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    canvas.getContext('2d').drawImage(image, 0, 0, width, height);
                    var dataUrl = canvas.toDataURL('image/jpeg');
                    return dataURItoBlob(dataUrl);
                };
                return new Promise(function (ok, no) {
                    if (!file.type.match(/image.*/)) {
                        no(new Error("Not an image"));
                        return;
                    }
                    reader.onload = function (readerEvent) {
                        image.onload = function () { return ok(resize()); };
                        image.src = readerEvent.target.result;
                    };
                    reader.readAsDataURL(file);
                });
        };

</script>
@endsection