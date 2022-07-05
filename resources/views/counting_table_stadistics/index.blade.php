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
                        <th>Fecha</th>
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
    $counting_table_stadistics = {!! $counting_table_stadistics !!}
    $('#counting_table_stadistics_nav').removeClass("closed").addClass("active").addClass("expand")
    function modal(type,id) {
        if($counting_table_stadistics.find( i => moment(i.created_at).format('YYYY-MM-DD') == moment().format('YYYY-MM-DD') && type === "Crear" )){
            Swal.fire({
                title: 'ALERTA',
                text: 'A la fecha de hoy ya hay un registro, porfavor revise en el listado de la tabla el registro mas reciente.',
                icon: 'info',
                showCancelButton: false
            })
        }else{
            Swal.fire({
                title: `${type} Registro`,
                showConfirmButton: false,
                width: '80em',
                allowOutsideClick: false,
                showCloseButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Guardar',
                showConfirmButton: true,
                showCancelButton: true,
                html:`
                    <form id="form-all" class="needs-validation" action="javascript:void(0);" novalidate>
                        <div class="row">

                            {{-- 14:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 14:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_1400" name="pk1_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_1400" name="pk2_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_1400" name="pk3_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_1400" name="bj1_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_1400" name="bj2_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_1400" name="bj3_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_1400" name="ra1_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_1400" name="ra2_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_1400" name="ra3_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_1400" name="ra4_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_1400" name="pb1_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_1400" name="pb2_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_1400" name="pb3_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_1400" name="pb4_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_1400" name="pb5_1400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 15:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 15:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_1500" name="pk1_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_1500" name="pk2_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_1500" name="pk3_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_1500" name="bj1_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_1500" name="bj2_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_1500" name="bj3_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_1500" name="ra1_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_1500" name="ra2_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_1500" name="ra3_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_1500" name="ra4_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_1500" name="pb1_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_1500" name="pb2_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_1500" name="pb3_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_1500" name="pb4_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_1500" name="pb5_1500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 16:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 16:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_1600" name="pk1_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_1600" name="pk2_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_1600" name="pk3_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_1600" name="bj1_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_1600" name="bj2_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_1600" name="bj3_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_1600" name="ra1_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_1600" name="ra2_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_1600" name="ra3_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_1600" name="ra4_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_1600" name="pb1_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_1600" name="pb2_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_1600" name="pb3_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_1600" name="pb4_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_1600" name="pb5_1600" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 17:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 17:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_1700" name="pk1_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_1700" name="pk2_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_1700" name="pk3_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_1700" name="bj1_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_1700" name="bj2_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_1700" name="bj3_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_1700" name="ra1_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_1700" name="ra2_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_1700" name="ra3_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_1700" name="ra4_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_1700" name="pb1_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_1700" name="pb2_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_1700" name="pb3_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_1700" name="pb4_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_1700" name="pb5_1700" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 18:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 18:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_1800" name="pk1_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_1800" name="pk2_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_1800" name="pk3_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_1800" name="bj1_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_1800" name="bj2_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_1800" name="bj3_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_1800" name="ra1_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_1800" name="ra2_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_1800" name="ra3_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_1800" name="ra4_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_1800" name="pb1_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_1800" name="pb2_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_1800" name="pb3_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_1800" name="pb4_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_1800" name="pb5_1800" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 19:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 19:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_1900" name="pk1_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_1900" name="pk2_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_1900" name="pk3_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_1900" name="bj1_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_1900" name="bj2_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_1900" name="bj3_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_1900" name="ra1_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_1900" name="ra2_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_1900" name="ra3_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_1900" name="ra4_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_1900" name="pb1_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_1900" name="pb2_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_1900" name="pb3_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_1900" name="pb4_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_1900" name="pb5_1900" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 20:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 20:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_2000" name="pk1_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_2000" name="pk2_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_2000" name="pk3_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_2000" name="bj1_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_2000" name="bj2_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_2000" name="bj3_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_2000" name="ra1_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_2000" name="ra2_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_2000" name="ra3_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_2000" name="ra4_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_2000" name="pb1_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_2000" name="pb2_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_2000" name="pb3_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_2000" name="pb4_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_2000" name="pb5_2000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 21:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 21:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_2100" name="pk1_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_2100" name="pk2_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_2100" name="pk3_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_2100" name="bj1_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_2100" name="bj2_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_2100" name="bj3_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_2100" name="ra1_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_2100" name="ra2_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_2100" name="ra3_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_2100" name="ra4_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_2100" name="pb1_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_2100" name="pb2_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_2100" name="pb3_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_2100" name="pb4_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_2100" name="pb5_2100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 22:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 22:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_2200" name="pk1_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_2200" name="pk2_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_2200" name="pk3_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_2200" name="bj1_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_2200" name="bj2_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_2200" name="bj3_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_2200" name="ra1_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_2200" name="ra2_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_2200" name="ra3_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_2200" name="ra4_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_2200" name="pb1_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_2200" name="pb2_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_2200" name="pb3_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_2200" name="pb4_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_2200" name="pb5_2200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 23:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 23:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_2300" name="pk1_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_2300" name="pk2_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_2300" name="pk3_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_2300" name="bj1_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_2300" name="bj2_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_2300" name="bj3_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_2300" name="ra1_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_2300" name="ra2_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_2300" name="ra3_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_2300" name="ra4_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_2300" name="pb1_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_2300" name="pb2_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_2300" name="pb3_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_2300" name="pb4_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_2300" name="pb5_2300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 00:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 00:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_0000" name="pk1_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_0000" name="pk2_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_0000" name="pk3_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_0000" name="bj1_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_0000" name="bj2_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_0000" name="bj3_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_0000" name="ra1_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_0000" name="ra2_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_0000" name="ra3_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_0000" name="ra4_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_0000" name="pb1_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_0000" name="pb2_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_0000" name="pb3_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_0000" name="pb4_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_0000" name="pb5_0000" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 01:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 01:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_0100" name="pk1_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_0100" name="pk2_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_0100" name="pk3_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_0100" name="bj1_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_0100" name="bj2_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_0100" name="bj3_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_0100" name="ra1_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_0100" name="ra2_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_0100" name="ra3_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_0100" name="ra4_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_0100" name="pb1_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_0100" name="pb2_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_0100" name="pb3_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_0100" name="pb4_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_0100" name="pb5_0100" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 02:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 02:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_0200" name="pk1_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_0200" name="pk2_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_0200" name="pk3_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_0200" name="bj1_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_0200" name="bj2_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_0200" name="bj3_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_0200" name="ra1_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_0200" name="ra2_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_0200" name="ra3_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_0200" name="ra4_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_0200" name="pb1_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_0200" name="pb2_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_0200" name="pb3_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_0200" name="pb4_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_0200" name="pb5_0200" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 03:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 03:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_0300" name="pk1_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_0300" name="pk2_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_0300" name="pk3_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_0300" name="bj1_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_0300" name="bj2_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_0300" name="bj3_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_0300" name="ra1_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_0300" name="ra2_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_0300" name="ra3_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_0300" name="ra4_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_0300" name="pb1_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_0300" name="pb2_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_0300" name="pb3_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_0300" name="pb4_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_0300" name="pb5_0300" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 04:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 04:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_0400" name="pk1_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_0400" name="pk2_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_0400" name="pk3_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_0400" name="bj1_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_0400" name="bj2_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_0400" name="bj3_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_0400" name="ra1_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_0400" name="ra2_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_0400" name="ra3_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_0400" name="ra4_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_0400" name="pb1_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_0400" name="pb2_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_0400" name="pb3_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_0400" name="pb4_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_0400" name="pb5_0400" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- 05:00 --}}
                            <div class="row col-12 mb-3">
                                <label class="col-12 text-lg-left col-form-label font-weight-bold"> 05:00 H </label>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk1_0500" name="pk1_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk2_0500" name="pk2_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PK3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pk3_0500" name="pk3_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj1_0500" name="bj1_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj2_0500" name="bj2_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> BJ3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="bj3_0500" name="bj3_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra1_0500" name="ra1_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra2_0500" name="ra2_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra3_0500" name="ra3_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> RA4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="ra4_0500" name="ra4_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB1 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb1_0500" name="pb1_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB2 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb2_0500" name="pb2_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB3 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb3_0500" name="pb3_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB4 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb4_0500" name="pb4_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm">
                                    <div class="form-group row m-b-0">
                                        <label class=" text-lg-right col-form-label"> PB5 </label>
                                        <div class="col-lg-12">
                                            <input placeholder="0" type="number" min="0" id="pb5_0500" name="pb5_0500" class="form-control parsley-normal upper" style="color: var(--global-2) !important"" >
                                            <div class="invalid-feedback text-left">Error campo obligatorio.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="row m-auto">
                                <div col-xs-3 col-sm2" style="margin-top:20px">
                                    <button onclick="guardar(${id})" type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;"> Guardar </button>
                                </div>
                            </div>--}}
                        </div>
                    </form>`
            }).then((result) => {
                if (result.isConfirmed) {
                    guardar(id)
                }
            })
            if(id){
                let current={!! $counting_table_stadistics !!}.find(i=>i.id===id)
                
                $('#pk1_1400').val(current.pk1_1400)
                $('#pk2_1400').val(current.pk2_1400)
                $('#pk3_1400').val(current.pk3_1400)
                $('#bj1_1400').val(current.bj1_1400)
                $('#bj2_1400').val(current.bj2_1400)
                $('#bj3_1400').val(current.bj3_1400)
                $('#ra1_1400').val(current.ra1_1400)
                $('#ra2_1400').val(current.ra2_1400)
                $('#ra3_1400').val(current.ra3_1400)
                $('#ra4_1400').val(current.ra4_1400)
                $('#pb1_1400').val(current.pb1_1400)
                $('#pb2_1400').val(current.pb2_1400)
                $('#pb3_1400').val(current.pb3_1400)
                $('#pb4_1400').val(current.pb4_1400)
                $('#pb5_1400').val(current.pb5_1400)

                $('#pk1_1500').val(current.pk1_1500)
                $('#pk2_1500').val(current.pk2_1500)
                $('#pk3_1500').val(current.pk3_1500)
                $('#bj1_1500').val(current.bj1_1500)
                $('#bj2_1500').val(current.bj2_1500)
                $('#bj3_1500').val(current.bj3_1500)
                $('#ra1_1500').val(current.ra1_1500)
                $('#ra2_1500').val(current.ra2_1500)
                $('#ra3_1500').val(current.ra3_1500)
                $('#ra4_1500').val(current.ra4_1500)
                $('#pb1_1500').val(current.pb1_1500)
                $('#pb2_1500').val(current.pb2_1500)
                $('#pb3_1500').val(current.pb3_1500)
                $('#pb4_1500').val(current.pb4_1500)
                $('#pb5_1500').val(current.pb5_1500)

                $('#pk1_1600').val(current.pk1_1600)
                $('#pk2_1600').val(current.pk2_1600)
                $('#pk3_1600').val(current.pk3_1600)
                $('#bj1_1600').val(current.bj1_1600)
                $('#bj2_1600').val(current.bj2_1600)
                $('#bj3_1600').val(current.bj3_1600)
                $('#ra1_1600').val(current.ra1_1600)
                $('#ra2_1600').val(current.ra2_1600)
                $('#ra3_1600').val(current.ra3_1600)
                $('#ra4_1600').val(current.ra4_1600)
                $('#pb1_1600').val(current.pb1_1600)
                $('#pb2_1600').val(current.pb2_1600)
                $('#pb3_1600').val(current.pb3_1600)
                $('#pb4_1600').val(current.pb4_1600)
                $('#pb5_1600').val(current.pb5_1600)

                $('#pk1_1700').val(current.pk1_1700)
                $('#pk2_1700').val(current.pk2_1700)
                $('#pk3_1700').val(current.pk3_1700)
                $('#bj1_1700').val(current.bj1_1700)
                $('#bj2_1700').val(current.bj2_1700)
                $('#bj3_1700').val(current.bj3_1700)
                $('#ra1_1700').val(current.ra1_1700)
                $('#ra2_1700').val(current.ra2_1700)
                $('#ra3_1700').val(current.ra3_1700)
                $('#ra4_1700').val(current.ra4_1700)
                $('#pb1_1700').val(current.pb1_1700)
                $('#pb2_1700').val(current.pb2_1700)
                $('#pb3_1700').val(current.pb3_1700)
                $('#pb4_1700').val(current.pb4_1700)
                $('#pb5_1700').val(current.pb5_1700)

                $('#pk1_1800').val(current.pk1_1800)
                $('#pk2_1800').val(current.pk2_1800)
                $('#pk3_1800').val(current.pk3_1800)
                $('#bj1_1800').val(current.bj1_1800)
                $('#bj2_1800').val(current.bj2_1800)
                $('#bj3_1800').val(current.bj3_1800)
                $('#ra1_1800').val(current.ra1_1800)
                $('#ra2_1800').val(current.ra2_1800)
                $('#ra3_1800').val(current.ra3_1800)
                $('#ra4_1800').val(current.ra4_1800)
                $('#pb1_1800').val(current.pb1_1800)
                $('#pb2_1800').val(current.pb2_1800)
                $('#pb3_1800').val(current.pb3_1800)
                $('#pb4_1800').val(current.pb4_1800)
                $('#pb5_1800').val(current.pb5_1800)

                $('#pk1_1900').val(current.pk1_1900)
                $('#pk2_1900').val(current.pk2_1900)
                $('#pk3_1900').val(current.pk3_1900)
                $('#bj1_1900').val(current.bj1_1900)
                $('#bj2_1900').val(current.bj2_1900)
                $('#bj3_1900').val(current.bj3_1900)
                $('#ra1_1900').val(current.ra1_1900)
                $('#ra2_1900').val(current.ra2_1900)
                $('#ra3_1900').val(current.ra3_1900)
                $('#ra4_1900').val(current.ra4_1900)
                $('#pb1_1900').val(current.pb1_1900)
                $('#pb2_1900').val(current.pb2_1900)
                $('#pb3_1900').val(current.pb3_1900)
                $('#pb4_1900').val(current.pb4_1900)
                $('#pb5_1900').val(current.pb5_1900)

                $('#pk1_2000').val(current.pk1_2000)
                $('#pk2_2000').val(current.pk2_2000)
                $('#pk3_2000').val(current.pk3_2000)
                $('#bj1_2000').val(current.bj1_2000)
                $('#bj2_2000').val(current.bj2_2000)
                $('#bj3_2000').val(current.bj3_2000)
                $('#ra1_2000').val(current.ra1_2000)
                $('#ra2_2000').val(current.ra2_2000)
                $('#ra3_2000').val(current.ra3_2000)
                $('#ra4_2000').val(current.ra4_2000)
                $('#pb1_2000').val(current.pb1_2000)
                $('#pb2_2000').val(current.pb2_2000)
                $('#pb3_2000').val(current.pb3_2000)
                $('#pb4_2000').val(current.pb4_2000)
                $('#pb5_2000').val(current.pb5_2000)

                $('#pk1_2100').val(current.pk1_2100)
                $('#pk2_2100').val(current.pk2_2100)
                $('#pk3_2100').val(current.pk3_2100)
                $('#bj1_2100').val(current.bj1_2100)
                $('#bj2_2100').val(current.bj2_2100)
                $('#bj3_2100').val(current.bj3_2100)
                $('#ra1_2100').val(current.ra1_2100)
                $('#ra2_2100').val(current.ra2_2100)
                $('#ra3_2100').val(current.ra3_2100)
                $('#ra4_2100').val(current.ra4_2100)
                $('#pb1_2100').val(current.pb1_2100)
                $('#pb2_2100').val(current.pb2_2100)
                $('#pb3_2100').val(current.pb3_2100)
                $('#pb4_2100').val(current.pb4_2100)
                $('#pb5_2100').val(current.pb5_2100)

                $('#pk1_2200').val(current.pk1_2200)
                $('#pk2_2200').val(current.pk2_2200)
                $('#pk3_2200').val(current.pk3_2200)
                $('#bj1_2200').val(current.bj1_2200)
                $('#bj2_2200').val(current.bj2_2200)
                $('#bj3_2200').val(current.bj3_2200)
                $('#ra1_2200').val(current.ra1_2200)
                $('#ra2_2200').val(current.ra2_2200)
                $('#ra3_2200').val(current.ra3_2200)
                $('#ra4_2200').val(current.ra4_2200)
                $('#pb1_2200').val(current.pb1_2200)
                $('#pb2_2200').val(current.pb2_2200)
                $('#pb3_2200').val(current.pb3_2200)
                $('#pb4_2200').val(current.pb4_2200)
                $('#pb5_2200').val(current.pb5_2200)

                $('#pk1_2300').val(current.pk1_2300)
                $('#pk2_2300').val(current.pk2_2300)
                $('#pk3_2300').val(current.pk3_2300)
                $('#bj1_2300').val(current.bj1_2300)
                $('#bj2_2300').val(current.bj2_2300)
                $('#bj3_2300').val(current.bj3_2300)
                $('#ra1_2300').val(current.ra1_2300)
                $('#ra2_2300').val(current.ra2_2300)
                $('#ra3_2300').val(current.ra3_2300)
                $('#ra4_2300').val(current.ra4_2300)
                $('#pb1_2300').val(current.pb1_2300)
                $('#pb2_2300').val(current.pb2_2300)
                $('#pb3_2300').val(current.pb3_2300)
                $('#pb4_2300').val(current.pb4_2300)
                $('#pb5_2300').val(current.pb5_2300)

                $('#pk1_0000').val(current.pk1_0000)
                $('#pk2_0000').val(current.pk2_0000)
                $('#pk3_0000').val(current.pk3_0000)
                $('#bj1_0000').val(current.bj1_0000)
                $('#bj2_0000').val(current.bj2_0000)
                $('#bj3_0000').val(current.bj3_0000)
                $('#ra1_0000').val(current.ra1_0000)
                $('#ra2_0000').val(current.ra2_0000)
                $('#ra3_0000').val(current.ra3_0000)
                $('#ra4_0000').val(current.ra4_0000)
                $('#pb1_0000').val(current.pb1_0000)
                $('#pb2_0000').val(current.pb2_0000)
                $('#pb3_0000').val(current.pb3_0000)
                $('#pb4_0000').val(current.pb4_0000)
                $('#pb5_0000').val(current.pb5_0000)

                $('#pk1_0100').val(current.pk1_0100)
                $('#pk2_0100').val(current.pk2_0100)
                $('#pk3_0100').val(current.pk3_0100)
                $('#bj1_0100').val(current.bj1_0100)
                $('#bj2_0100').val(current.bj2_0100)
                $('#bj3_0100').val(current.bj3_0100)
                $('#ra1_0100').val(current.ra1_0100)
                $('#ra2_0100').val(current.ra2_0100)
                $('#ra3_0100').val(current.ra3_0100)
                $('#ra4_0100').val(current.ra4_0100)
                $('#pb1_0100').val(current.pb1_0100)
                $('#pb2_0100').val(current.pb2_0100)
                $('#pb3_0100').val(current.pb3_0100)
                $('#pb4_0100').val(current.pb4_0100)
                $('#pb5_0100').val(current.pb5_0100)

                $('#pk1_0200').val(current.pk1_0200)
                $('#pk2_0200').val(current.pk2_0200)
                $('#pk3_0200').val(current.pk3_0200)
                $('#bj1_0200').val(current.bj1_0200)
                $('#bj2_0200').val(current.bj2_0200)
                $('#bj3_0200').val(current.bj3_0200)
                $('#ra1_0200').val(current.ra1_0200)
                $('#ra2_0200').val(current.ra2_0200)
                $('#ra3_0200').val(current.ra3_0200)
                $('#ra4_0200').val(current.ra4_0200)
                $('#pb1_0200').val(current.pb1_0200)
                $('#pb2_0200').val(current.pb2_0200)
                $('#pb3_0200').val(current.pb3_0200)
                $('#pb4_0200').val(current.pb4_0200)
                $('#pb5_0200').val(current.pb5_0200)

                $('#pk1_0300').val(current.pk1_0300)
                $('#pk2_0300').val(current.pk2_0300)
                $('#pk3_0300').val(current.pk3_0300)
                $('#bj1_0300').val(current.bj1_0300)
                $('#bj2_0300').val(current.bj2_0300)
                $('#bj3_0300').val(current.bj3_0300)
                $('#ra1_0300').val(current.ra1_0300)
                $('#ra2_0300').val(current.ra2_0300)
                $('#ra3_0300').val(current.ra3_0300)
                $('#ra4_0300').val(current.ra4_0300)
                $('#pb1_0300').val(current.pb1_0300)
                $('#pb2_0300').val(current.pb2_0300)
                $('#pb3_0300').val(current.pb3_0300)
                $('#pb4_0300').val(current.pb4_0300)
                $('#pb5_0300').val(current.pb5_0300)

                $('#pk1_0400').val(current.pk1_0400)
                $('#pk2_0400').val(current.pk2_0400)
                $('#pk3_0400').val(current.pk3_0400)
                $('#bj1_0400').val(current.bj1_0400)
                $('#bj2_0400').val(current.bj2_0400)
                $('#bj3_0400').val(current.bj3_0400)
                $('#ra1_0400').val(current.ra1_0400)
                $('#ra2_0400').val(current.ra2_0400)
                $('#ra3_0400').val(current.ra3_0400)
                $('#ra4_0400').val(current.ra4_0400)
                $('#pb1_0400').val(current.pb1_0400)
                $('#pb2_0400').val(current.pb2_0400)
                $('#pb3_0400').val(current.pb3_0400)
                $('#pb4_0400').val(current.pb4_0400)
                $('#pb5_0400').val(current.pb5_0400)

                $('#pk1_0500').val(current.pk1_0500)
                $('#pk2_0500').val(current.pk2_0500)
                $('#pk3_0500').val(current.pk3_0500)
                $('#bj1_0500').val(current.bj1_0500)
                $('#bj2_0500').val(current.bj2_0500)
                $('#bj3_0500').val(current.bj3_0500)
                $('#ra1_0500').val(current.ra1_0500)
                $('#ra2_0500').val(current.ra2_0500)
                $('#ra3_0500').val(current.ra3_0500)
                $('#ra4_0500').val(current.ra4_0500)
                $('#pb1_0500').val(current.pb1_0500)
                $('#pb2_0500').val(current.pb2_0500)
                $('#pb3_0500').val(current.pb3_0500)
                $('#pb4_0500').val(current.pb4_0500)
                $('#pb5_0500').val(current.pb5_0500)

            }
            validateForm()
        }
    }
    function guardar(id) {
        let validity = document.getElementById('form-all').checkValidity()
        if(validity){
            let payload = {
                _token: $("meta[name='csrf-token']").attr("content"),
                id: { id: id ? id : "" },
                data: {
                    
                    pk1_1400: ( $('#pk1_1400').val() !== "" ) ? $('#pk1_1400').val() : 0,
                    pk2_1400: ( $('#pk2_1400').val() !== "" ) ? $('#pk2_1400').val() : 0,
                    pk3_1400: ( $('#pk3_1400').val() !== "" ) ? $('#pk3_1400').val() : 0,
                    bj1_1400: ( $('#bj1_1400').val() !== "" ) ? $('#bj1_1400').val() : 0,
                    bj2_1400: ( $('#bj2_1400').val() !== "" ) ? $('#bj2_1400').val() : 0,
                    bj3_1400: ( $('#bj3_1400').val() !== "" ) ? $('#bj3_1400').val() : 0,
                    ra1_1400: ( $('#ra1_1400').val() !== "" ) ? $('#ra1_1400').val() : 0,
                    ra2_1400: ( $('#ra2_1400').val() !== "" ) ? $('#ra2_1400').val() : 0,
                    ra3_1400: ( $('#ra3_1400').val() !== "" ) ? $('#ra3_1400').val() : 0,
                    ra4_1400: ( $('#ra4_1400').val() !== "" ) ? $('#ra4_1400').val() : 0,
                    pb1_1400: ( $('#pb1_1400').val() !== "" ) ? $('#pb1_1400').val() : 0,
                    pb2_1400: ( $('#pb2_1400').val() !== "" ) ? $('#pb2_1400').val() : 0,
                    pb3_1400: ( $('#pb3_1400').val() !== "" ) ? $('#pb3_1400').val() : 0,
                    pb4_1400: ( $('#pb4_1400').val() !== "" ) ? $('#pb4_1400').val() : 0,
                    pb5_1400: ( $('#pb5_1400').val() !== "" ) ? $('#pb5_1400').val() : 0,

                    pk1_1500: ( $('#pk1_1500').val() !== "" ) ? $('#pk1_1500').val() : 0,
                    pk2_1500: ( $('#pk2_1500').val() !== "" ) ? $('#pk2_1500').val() : 0,
                    pk3_1500: ( $('#pk3_1500').val() !== "" ) ? $('#pk3_1500').val() : 0,
                    bj1_1500: ( $('#bj1_1500').val() !== "" ) ? $('#bj1_1500').val() : 0,
                    bj2_1500: ( $('#bj2_1500').val() !== "" ) ? $('#bj2_1500').val() : 0,
                    bj3_1500: ( $('#bj3_1500').val() !== "" ) ? $('#bj3_1500').val() : 0,
                    ra1_1500: ( $('#ra1_1500').val() !== "" ) ? $('#ra1_1500').val() : 0,
                    ra2_1500: ( $('#ra2_1500').val() !== "" ) ? $('#ra2_1500').val() : 0,
                    ra3_1500: ( $('#ra3_1500').val() !== "" ) ? $('#ra3_1500').val() : 0,
                    ra4_1500: ( $('#ra4_1500').val() !== "" ) ? $('#ra4_1500').val() : 0,
                    pb1_1500: ( $('#pb1_1500').val() !== "" ) ? $('#pb1_1500').val() : 0,
                    pb2_1500: ( $('#pb2_1500').val() !== "" ) ? $('#pb2_1500').val() : 0,
                    pb3_1500: ( $('#pb3_1500').val() !== "" ) ? $('#pb3_1500').val() : 0,
                    pb4_1500: ( $('#pb4_1500').val() !== "" ) ? $('#pb4_1500').val() : 0,
                    pb5_1500: ( $('#pb5_1500').val() !== "" ) ? $('#pb5_1500').val() : 0,

                    pk1_1600: ( $('#pk1_1600').val() !== "" ) ? $('#pk1_1600').val() : 0,
                    pk2_1600: ( $('#pk2_1600').val() !== "" ) ? $('#pk2_1600').val() : 0,
                    pk3_1600: ( $('#pk3_1600').val() !== "" ) ? $('#pk3_1600').val() : 0,
                    bj1_1600: ( $('#bj1_1600').val() !== "" ) ? $('#bj1_1600').val() : 0,
                    bj2_1600: ( $('#bj2_1600').val() !== "" ) ? $('#bj2_1600').val() : 0,
                    bj3_1600: ( $('#bj3_1600').val() !== "" ) ? $('#bj3_1600').val() : 0,
                    ra1_1600: ( $('#ra1_1600').val() !== "" ) ? $('#ra1_1600').val() : 0,
                    ra2_1600: ( $('#ra2_1600').val() !== "" ) ? $('#ra2_1600').val() : 0,
                    ra3_1600: ( $('#ra3_1600').val() !== "" ) ? $('#ra3_1600').val() : 0,
                    ra4_1600: ( $('#ra4_1600').val() !== "" ) ? $('#ra4_1600').val() : 0,
                    pb1_1600: ( $('#pb1_1600').val() !== "" ) ? $('#pb1_1600').val() : 0,
                    pb2_1600: ( $('#pb2_1600').val() !== "" ) ? $('#pb2_1600').val() : 0,
                    pb3_1600: ( $('#pb3_1600').val() !== "" ) ? $('#pb3_1600').val() : 0,
                    pb4_1600: ( $('#pb4_1600').val() !== "" ) ? $('#pb4_1600').val() : 0,
                    pb5_1600: ( $('#pb5_1600').val() !== "" ) ? $('#pb5_1600').val() : 0,

                    pk1_1700: ( $('#pk1_1700').val() !== "" ) ? $('#pk1_1700').val() : 0,
                    pk2_1700: ( $('#pk2_1700').val() !== "" ) ? $('#pk2_1700').val() : 0,
                    pk3_1700: ( $('#pk3_1700').val() !== "" ) ? $('#pk3_1700').val() : 0,
                    bj1_1700: ( $('#bj1_1700').val() !== "" ) ? $('#bj1_1700').val() : 0,
                    bj2_1700: ( $('#bj2_1700').val() !== "" ) ? $('#bj2_1700').val() : 0,
                    bj3_1700: ( $('#bj3_1700').val() !== "" ) ? $('#bj3_1700').val() : 0,
                    ra1_1700: ( $('#ra1_1700').val() !== "" ) ? $('#ra1_1700').val() : 0,
                    ra2_1700: ( $('#ra2_1700').val() !== "" ) ? $('#ra2_1700').val() : 0,
                    ra3_1700: ( $('#ra3_1700').val() !== "" ) ? $('#ra3_1700').val() : 0,
                    ra4_1700: ( $('#ra4_1700').val() !== "" ) ? $('#ra4_1700').val() : 0,
                    pb1_1700: ( $('#pb1_1700').val() !== "" ) ? $('#pb1_1700').val() : 0,
                    pb2_1700: ( $('#pb2_1700').val() !== "" ) ? $('#pb2_1700').val() : 0,
                    pb3_1700: ( $('#pb3_1700').val() !== "" ) ? $('#pb3_1700').val() : 0,
                    pb4_1700: ( $('#pb4_1700').val() !== "" ) ? $('#pb4_1700').val() : 0,
                    pb5_1700: ( $('#pb5_1700').val() !== "" ) ? $('#pb5_1700').val() : 0,

                    pk1_1800: ( $('#pk1_1800').val() !== "" ) ? $('#pk1_1800').val() : 0,
                    pk2_1800: ( $('#pk2_1800').val() !== "" ) ? $('#pk2_1800').val() : 0,
                    pk3_1800: ( $('#pk3_1800').val() !== "" ) ? $('#pk3_1800').val() : 0,
                    bj1_1800: ( $('#bj1_1800').val() !== "" ) ? $('#bj1_1800').val() : 0,
                    bj2_1800: ( $('#bj2_1800').val() !== "" ) ? $('#bj2_1800').val() : 0,
                    bj3_1800: ( $('#bj3_1800').val() !== "" ) ? $('#bj3_1800').val() : 0,
                    ra1_1800: ( $('#ra1_1800').val() !== "" ) ? $('#ra1_1800').val() : 0,
                    ra2_1800: ( $('#ra2_1800').val() !== "" ) ? $('#ra2_1800').val() : 0,
                    ra3_1800: ( $('#ra3_1800').val() !== "" ) ? $('#ra3_1800').val() : 0,
                    ra4_1800: ( $('#ra4_1800').val() !== "" ) ? $('#ra4_1800').val() : 0,
                    pb1_1800: ( $('#pb1_1800').val() !== "" ) ? $('#pb1_1800').val() : 0,
                    pb2_1800: ( $('#pb2_1800').val() !== "" ) ? $('#pb2_1800').val() : 0,
                    pb3_1800: ( $('#pb3_1800').val() !== "" ) ? $('#pb3_1800').val() : 0,
                    pb4_1800: ( $('#pb4_1800').val() !== "" ) ? $('#pb4_1800').val() : 0,
                    pb5_1800: ( $('#pb5_1800').val() !== "" ) ? $('#pb5_1800').val() : 0,

                    pk1_1900: ( $('#pk1_1900').val() !== "" ) ? $('#pk1_1900').val() : 0,
                    pk2_1900: ( $('#pk2_1900').val() !== "" ) ? $('#pk2_1900').val() : 0,
                    pk3_1900: ( $('#pk3_1900').val() !== "" ) ? $('#pk3_1900').val() : 0,
                    bj1_1900: ( $('#bj1_1900').val() !== "" ) ? $('#bj1_1900').val() : 0,
                    bj2_1900: ( $('#bj2_1900').val() !== "" ) ? $('#bj2_1900').val() : 0,
                    bj3_1900: ( $('#bj3_1900').val() !== "" ) ? $('#bj3_1900').val() : 0,
                    ra1_1900: ( $('#ra1_1900').val() !== "" ) ? $('#ra1_1900').val() : 0,
                    ra2_1900: ( $('#ra2_1900').val() !== "" ) ? $('#ra2_1900').val() : 0,
                    ra3_1900: ( $('#ra3_1900').val() !== "" ) ? $('#ra3_1900').val() : 0,
                    ra4_1900: ( $('#ra4_1900').val() !== "" ) ? $('#ra4_1900').val() : 0,
                    pb1_1900: ( $('#pb1_1900').val() !== "" ) ? $('#pb1_1900').val() : 0,
                    pb2_1900: ( $('#pb2_1900').val() !== "" ) ? $('#pb2_1900').val() : 0,
                    pb3_1900: ( $('#pb3_1900').val() !== "" ) ? $('#pb3_1900').val() : 0,
                    pb4_1900: ( $('#pb4_1900').val() !== "" ) ? $('#pb4_1900').val() : 0,
                    pb5_1900: ( $('#pb5_1900').val() !== "" ) ? $('#pb5_1900').val() : 0,

                    pk1_2000: ( $('#pk1_2000').val() !== "" ) ? $('#pk1_2000').val() : 0,
                    pk2_2000: ( $('#pk2_2000').val() !== "" ) ? $('#pk2_2000').val() : 0,
                    pk3_2000: ( $('#pk3_2000').val() !== "" ) ? $('#pk3_2000').val() : 0,
                    bj1_2000: ( $('#bj1_2000').val() !== "" ) ? $('#bj1_2000').val() : 0,
                    bj2_2000: ( $('#bj2_2000').val() !== "" ) ? $('#bj2_2000').val() : 0,
                    bj3_2000: ( $('#bj3_2000').val() !== "" ) ? $('#bj3_2000').val() : 0,
                    ra1_2000: ( $('#ra1_2000').val() !== "" ) ? $('#ra1_2000').val() : 0,
                    ra2_2000: ( $('#ra2_2000').val() !== "" ) ? $('#ra2_2000').val() : 0,
                    ra3_2000: ( $('#ra3_2000').val() !== "" ) ? $('#ra3_2000').val() : 0,
                    ra4_2000: ( $('#ra4_2000').val() !== "" ) ? $('#ra4_2000').val() : 0,
                    pb1_2000: ( $('#pb1_2000').val() !== "" ) ? $('#pb1_2000').val() : 0,
                    pb2_2000: ( $('#pb2_2000').val() !== "" ) ? $('#pb2_2000').val() : 0,
                    pb3_2000: ( $('#pb3_2000').val() !== "" ) ? $('#pb3_2000').val() : 0,
                    pb4_2000: ( $('#pb4_2000').val() !== "" ) ? $('#pb4_2000').val() : 0,
                    pb5_2000: ( $('#pb5_2000').val() !== "" ) ? $('#pb5_2000').val() : 0,

                    pk1_2100: ( $('#pk1_2100').val() !== "" ) ? $('#pk1_2100').val() : 0,
                    pk2_2100: ( $('#pk2_2100').val() !== "" ) ? $('#pk2_2100').val() : 0,
                    pk3_2100: ( $('#pk3_2100').val() !== "" ) ? $('#pk3_2100').val() : 0,
                    bj1_2100: ( $('#bj1_2100').val() !== "" ) ? $('#bj1_2100').val() : 0,
                    bj2_2100: ( $('#bj2_2100').val() !== "" ) ? $('#bj2_2100').val() : 0,
                    bj3_2100: ( $('#bj3_2100').val() !== "" ) ? $('#bj3_2100').val() : 0,
                    ra1_2100: ( $('#ra1_2100').val() !== "" ) ? $('#ra1_2100').val() : 0,
                    ra2_2100: ( $('#ra2_2100').val() !== "" ) ? $('#ra2_2100').val() : 0,
                    ra3_2100: ( $('#ra3_2100').val() !== "" ) ? $('#ra3_2100').val() : 0,
                    ra4_2100: ( $('#ra4_2100').val() !== "" ) ? $('#ra4_2100').val() : 0,
                    pb1_2100: ( $('#pb1_2100').val() !== "" ) ? $('#pb1_2100').val() : 0,
                    pb2_2100: ( $('#pb2_2100').val() !== "" ) ? $('#pb2_2100').val() : 0,
                    pb3_2100: ( $('#pb3_2100').val() !== "" ) ? $('#pb3_2100').val() : 0,
                    pb4_2100: ( $('#pb4_2100').val() !== "" ) ? $('#pb4_2100').val() : 0,
                    pb5_2100: ( $('#pb5_2100').val() !== "" ) ? $('#pb5_2100').val() : 0,

                    pk1_2200: ( $('#pk1_2200').val() !== "" ) ? $('#pk1_2200').val() : 0,
                    pk2_2200: ( $('#pk2_2200').val() !== "" ) ? $('#pk2_2200').val() : 0,
                    pk3_2200: ( $('#pk3_2200').val() !== "" ) ? $('#pk3_2200').val() : 0,
                    bj1_2200: ( $('#bj1_2200').val() !== "" ) ? $('#bj1_2200').val() : 0,
                    bj2_2200: ( $('#bj2_2200').val() !== "" ) ? $('#bj2_2200').val() : 0,
                    bj3_2200: ( $('#bj3_2200').val() !== "" ) ? $('#bj3_2200').val() : 0,
                    ra1_2200: ( $('#ra1_2200').val() !== "" ) ? $('#ra1_2200').val() : 0,
                    ra2_2200: ( $('#ra2_2200').val() !== "" ) ? $('#ra2_2200').val() : 0,
                    ra3_2200: ( $('#ra3_2200').val() !== "" ) ? $('#ra3_2200').val() : 0,
                    ra4_2200: ( $('#ra4_2200').val() !== "" ) ? $('#ra4_2200').val() : 0,
                    pb1_2200: ( $('#pb1_2200').val() !== "" ) ? $('#pb1_2200').val() : 0,
                    pb2_2200: ( $('#pb2_2200').val() !== "" ) ? $('#pb2_2200').val() : 0,
                    pb3_2200: ( $('#pb3_2200').val() !== "" ) ? $('#pb3_2200').val() : 0,
                    pb4_2200: ( $('#pb4_2200').val() !== "" ) ? $('#pb4_2200').val() : 0,
                    pb5_2200: ( $('#pb5_2200').val() !== "" ) ? $('#pb5_2200').val() : 0,

                    pk1_2300: ( $('#pk1_2300').val() !== "" ) ? $('#pk1_2300').val() : 0,
                    pk2_2300: ( $('#pk2_2300').val() !== "" ) ? $('#pk2_2300').val() : 0,
                    pk3_2300: ( $('#pk3_2300').val() !== "" ) ? $('#pk3_2300').val() : 0,
                    bj1_2300: ( $('#bj1_2300').val() !== "" ) ? $('#bj1_2300').val() : 0,
                    bj2_2300: ( $('#bj2_2300').val() !== "" ) ? $('#bj2_2300').val() : 0,
                    bj3_2300: ( $('#bj3_2300').val() !== "" ) ? $('#bj3_2300').val() : 0,
                    ra1_2300: ( $('#ra1_2300').val() !== "" ) ? $('#ra1_2300').val() : 0,
                    ra2_2300: ( $('#ra2_2300').val() !== "" ) ? $('#ra2_2300').val() : 0,
                    ra3_2300: ( $('#ra3_2300').val() !== "" ) ? $('#ra3_2300').val() : 0,
                    ra4_2300: ( $('#ra4_2300').val() !== "" ) ? $('#ra4_2300').val() : 0,
                    pb1_2300: ( $('#pb1_2300').val() !== "" ) ? $('#pb1_2300').val() : 0,
                    pb2_2300: ( $('#pb2_2300').val() !== "" ) ? $('#pb2_2300').val() : 0,
                    pb3_2300: ( $('#pb3_2300').val() !== "" ) ? $('#pb3_2300').val() : 0,
                    pb4_2300: ( $('#pb4_2300').val() !== "" ) ? $('#pb4_2300').val() : 0,
                    pb5_2300: ( $('#pb5_2300').val() !== "" ) ? $('#pb5_2300').val() : 0,

                    pk1_0000: ( $('#pk1_0000').val() !== "" ) ? $('#pk1_0000').val() : 0,
                    pk2_0000: ( $('#pk2_0000').val() !== "" ) ? $('#pk2_0000').val() : 0,
                    pk3_0000: ( $('#pk3_0000').val() !== "" ) ? $('#pk3_0000').val() : 0,
                    bj1_0000: ( $('#bj1_0000').val() !== "" ) ? $('#bj1_0000').val() : 0,
                    bj2_0000: ( $('#bj2_0000').val() !== "" ) ? $('#bj2_0000').val() : 0,
                    bj3_0000: ( $('#bj3_0000').val() !== "" ) ? $('#bj3_0000').val() : 0,
                    ra1_0000: ( $('#ra1_0000').val() !== "" ) ? $('#ra1_0000').val() : 0,
                    ra2_0000: ( $('#ra2_0000').val() !== "" ) ? $('#ra2_0000').val() : 0,
                    ra3_0000: ( $('#ra3_0000').val() !== "" ) ? $('#ra3_0000').val() : 0,
                    ra4_0000: ( $('#ra4_0000').val() !== "" ) ? $('#ra4_0000').val() : 0,
                    pb1_0000: ( $('#pb1_0000').val() !== "" ) ? $('#pb1_0000').val() : 0,
                    pb2_0000: ( $('#pb2_0000').val() !== "" ) ? $('#pb2_0000').val() : 0,
                    pb3_0000: ( $('#pb3_0000').val() !== "" ) ? $('#pb3_0000').val() : 0,
                    pb4_0000: ( $('#pb4_0000').val() !== "" ) ? $('#pb4_0000').val() : 0,
                    pb5_0000: ( $('#pb5_0000').val() !== "" ) ? $('#pb5_0000').val() : 0,

                    pk1_0100: ( $('#pk1_0100').val() !== "" ) ? $('#pk1_0100').val() : 0,
                    pk2_0100: ( $('#pk2_0100').val() !== "" ) ? $('#pk2_0100').val() : 0,
                    pk3_0100: ( $('#pk3_0100').val() !== "" ) ? $('#pk3_0100').val() : 0,
                    bj1_0100: ( $('#bj1_0100').val() !== "" ) ? $('#bj1_0100').val() : 0,
                    bj2_0100: ( $('#bj2_0100').val() !== "" ) ? $('#bj2_0100').val() : 0,
                    bj3_0100: ( $('#bj3_0100').val() !== "" ) ? $('#bj3_0100').val() : 0,
                    ra1_0100: ( $('#ra1_0100').val() !== "" ) ? $('#ra1_0100').val() : 0,
                    ra2_0100: ( $('#ra2_0100').val() !== "" ) ? $('#ra2_0100').val() : 0,
                    ra3_0100: ( $('#ra3_0100').val() !== "" ) ? $('#ra3_0100').val() : 0,
                    ra4_0100: ( $('#ra4_0100').val() !== "" ) ? $('#ra4_0100').val() : 0,
                    pb1_0100: ( $('#pb1_0100').val() !== "" ) ? $('#pb1_0100').val() : 0,
                    pb2_0100: ( $('#pb2_0100').val() !== "" ) ? $('#pb2_0100').val() : 0,
                    pb3_0100: ( $('#pb3_0100').val() !== "" ) ? $('#pb3_0100').val() : 0,
                    pb4_0100: ( $('#pb4_0100').val() !== "" ) ? $('#pb4_0100').val() : 0,
                    pb5_0100: ( $('#pb5_0100').val() !== "" ) ? $('#pb5_0100').val() : 0,

                    pk1_0200: ( $('#pk1_0200').val() !== "" ) ? $('#pk1_0200').val() : 0,
                    pk2_0200: ( $('#pk2_0200').val() !== "" ) ? $('#pk2_0200').val() : 0,
                    pk3_0200: ( $('#pk3_0200').val() !== "" ) ? $('#pk3_0200').val() : 0,
                    bj1_0200: ( $('#bj1_0200').val() !== "" ) ? $('#bj1_0200').val() : 0,
                    bj2_0200: ( $('#bj2_0200').val() !== "" ) ? $('#bj2_0200').val() : 0,
                    bj3_0200: ( $('#bj3_0200').val() !== "" ) ? $('#bj3_0200').val() : 0,
                    ra1_0200: ( $('#ra1_0200').val() !== "" ) ? $('#ra1_0200').val() : 0,
                    ra2_0200: ( $('#ra2_0200').val() !== "" ) ? $('#ra2_0200').val() : 0,
                    ra3_0200: ( $('#ra3_0200').val() !== "" ) ? $('#ra3_0200').val() : 0,
                    ra4_0200: ( $('#ra4_0200').val() !== "" ) ? $('#ra4_0200').val() : 0,
                    pb1_0200: ( $('#pb1_0200').val() !== "" ) ? $('#pb1_0200').val() : 0,
                    pb2_0200: ( $('#pb2_0200').val() !== "" ) ? $('#pb2_0200').val() : 0,
                    pb3_0200: ( $('#pb3_0200').val() !== "" ) ? $('#pb3_0200').val() : 0,
                    pb4_0200: ( $('#pb4_0200').val() !== "" ) ? $('#pb4_0200').val() : 0,
                    pb5_0200: ( $('#pb5_0200').val() !== "" ) ? $('#pb5_0200').val() : 0,

                    pk1_0300: ( $('#pk1_0300').val() !== "" ) ? $('#pk1_0300').val() : 0,
                    pk2_0300: ( $('#pk2_0300').val() !== "" ) ? $('#pk2_0300').val() : 0,
                    pk3_0300: ( $('#pk3_0300').val() !== "" ) ? $('#pk3_0300').val() : 0,
                    bj1_0300: ( $('#bj1_0300').val() !== "" ) ? $('#bj1_0300').val() : 0,
                    bj2_0300: ( $('#bj2_0300').val() !== "" ) ? $('#bj2_0300').val() : 0,
                    bj3_0300: ( $('#bj3_0300').val() !== "" ) ? $('#bj3_0300').val() : 0,
                    ra1_0300: ( $('#ra1_0300').val() !== "" ) ? $('#ra1_0300').val() : 0,
                    ra2_0300: ( $('#ra2_0300').val() !== "" ) ? $('#ra2_0300').val() : 0,
                    ra3_0300: ( $('#ra3_0300').val() !== "" ) ? $('#ra3_0300').val() : 0,
                    ra4_0300: ( $('#ra4_0300').val() !== "" ) ? $('#ra4_0300').val() : 0,
                    pb1_0300: ( $('#pb1_0300').val() !== "" ) ? $('#pb1_0300').val() : 0,
                    pb2_0300: ( $('#pb2_0300').val() !== "" ) ? $('#pb2_0300').val() : 0,
                    pb3_0300: ( $('#pb3_0300').val() !== "" ) ? $('#pb3_0300').val() : 0,
                    pb4_0300: ( $('#pb4_0300').val() !== "" ) ? $('#pb4_0300').val() : 0,
                    pb5_0300: ( $('#pb5_0300').val() !== "" ) ? $('#pb5_0300').val() : 0,

                    pk1_0400: ( $('#pk1_0400').val() !== "" ) ? $('#pk1_0400').val() : 0,
                    pk2_0400: ( $('#pk2_0400').val() !== "" ) ? $('#pk2_0400').val() : 0,
                    pk3_0400: ( $('#pk3_0400').val() !== "" ) ? $('#pk3_0400').val() : 0,
                    bj1_0400: ( $('#bj1_0400').val() !== "" ) ? $('#bj1_0400').val() : 0,
                    bj2_0400: ( $('#bj2_0400').val() !== "" ) ? $('#bj2_0400').val() : 0,
                    bj3_0400: ( $('#bj3_0400').val() !== "" ) ? $('#bj3_0400').val() : 0,
                    ra1_0400: ( $('#ra1_0400').val() !== "" ) ? $('#ra1_0400').val() : 0,
                    ra2_0400: ( $('#ra2_0400').val() !== "" ) ? $('#ra2_0400').val() : 0,
                    ra3_0400: ( $('#ra3_0400').val() !== "" ) ? $('#ra3_0400').val() : 0,
                    ra4_0400: ( $('#ra4_0400').val() !== "" ) ? $('#ra4_0400').val() : 0,
                    pb1_0400: ( $('#pb1_0400').val() !== "" ) ? $('#pb1_0400').val() : 0,
                    pb2_0400: ( $('#pb2_0400').val() !== "" ) ? $('#pb2_0400').val() : 0,
                    pb3_0400: ( $('#pb3_0400').val() !== "" ) ? $('#pb3_0400').val() : 0,
                    pb4_0400: ( $('#pb4_0400').val() !== "" ) ? $('#pb4_0400').val() : 0,
                    pb5_0400: ( $('#pb5_0400').val() !== "" ) ? $('#pb5_0400').val() : 0,

                    pk1_0500: ( $('#pk1_0500').val() !== "" ) ? $('#pk1_0500').val() : 0,
                    pk2_0500: ( $('#pk2_0500').val() !== "" ) ? $('#pk2_0500').val() : 0,
                    pk3_0500: ( $('#pk3_0500').val() !== "" ) ? $('#pk3_0500').val() : 0,
                    bj1_0500: ( $('#bj1_0500').val() !== "" ) ? $('#bj1_0500').val() : 0,
                    bj2_0500: ( $('#bj2_0500').val() !== "" ) ? $('#bj2_0500').val() : 0,
                    bj3_0500: ( $('#bj3_0500').val() !== "" ) ? $('#bj3_0500').val() : 0,
                    ra1_0500: ( $('#ra1_0500').val() !== "" ) ? $('#ra1_0500').val() : 0,
                    ra2_0500: ( $('#ra2_0500').val() !== "" ) ? $('#ra2_0500').val() : 0,
                    ra3_0500: ( $('#ra3_0500').val() !== "" ) ? $('#ra3_0500').val() : 0,
                    ra4_0500: ( $('#ra4_0500').val() !== "" ) ? $('#ra4_0500').val() : 0,
                    pb1_0500: ( $('#pb1_0500').val() !== "" ) ? $('#pb1_0500').val() : 0,
                    pb2_0500: ( $('#pb2_0500').val() !== "" ) ? $('#pb2_0500').val() : 0,
                    pb3_0500: ( $('#pb3_0500').val() !== "" ) ? $('#pb3_0500').val() : 0,
                    pb4_0500: ( $('#pb4_0500').val() !== "" ) ? $('#pb4_0500').val() : 0,
                    pb5_0500: ( $('#pb5_0500').val() !== "" ) ? $('#pb5_0500').val() : 0,

                }
            }
            $.ajax({
                url: "{{ route('counting_table_stadistics.store') }}",
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

    function view(params) {
        let bg_hora = "#A5FF33" //verde
        let bg_mesa = "#33B8FF" //azul
        let bg_all = "#FF3396" //morado
        let current = $counting_table_stadistics.find( i => i.id === params )
        let puestos = 7
        let mesas = 15
        let totalPuestos = puestos*mesas
        let sumHoras = {
            _1400: parseInt(current.pk1_1400) + parseInt(current.pk2_1400) + parseInt(current.pk3_1400) + parseInt(current.bj1_1400) + parseInt(current.bj2_1400) + parseInt(current.bj3_1400) + parseInt(current.ra1_1400) + parseInt(current.ra2_1400) + parseInt(current.ra3_1400) + parseInt(current.ra4_1400) + parseInt(current.pb1_1400) + parseInt(current.pb2_1400) + parseInt(current.pb3_1400) + parseInt(current.pb4_1400) + parseInt(current.pb5_1400),
            _1500: parseInt(current.pk1_1500) + parseInt(current.pk2_1500) + parseInt(current.pk3_1500) + parseInt(current.bj1_1500) + parseInt(current.bj2_1500) + parseInt(current.bj3_1500) + parseInt(current.ra1_1500) + parseInt(current.ra2_1500) + parseInt(current.ra3_1500) + parseInt(current.ra4_1500) + parseInt(current.pb1_1500) + parseInt(current.pb2_1500) + parseInt(current.pb3_1500) + parseInt(current.pb4_1500) + parseInt(current.pb5_1500),
            _1600: parseInt(current.pk1_1600) + parseInt(current.pk2_1600) + parseInt(current.pk3_1600) + parseInt(current.bj1_1600) + parseInt(current.bj2_1600) + parseInt(current.bj3_1600) + parseInt(current.ra1_1600) + parseInt(current.ra2_1600) + parseInt(current.ra3_1600) + parseInt(current.ra4_1600) + parseInt(current.pb1_1600) + parseInt(current.pb2_1600) + parseInt(current.pb3_1600) + parseInt(current.pb4_1600) + parseInt(current.pb5_1600),
            _1700: parseInt(current.pk1_1700) + parseInt(current.pk2_1700) + parseInt(current.pk3_1700) + parseInt(current.bj1_1700) + parseInt(current.bj2_1700) + parseInt(current.bj3_1700) + parseInt(current.ra1_1700) + parseInt(current.ra2_1700) + parseInt(current.ra3_1700) + parseInt(current.ra4_1700) + parseInt(current.pb1_1700) + parseInt(current.pb2_1700) + parseInt(current.pb3_1700) + parseInt(current.pb4_1700) + parseInt(current.pb5_1700),
            _1800: parseInt(current.pk1_1800) + parseInt(current.pk2_1800) + parseInt(current.pk3_1800) + parseInt(current.bj1_1800) + parseInt(current.bj2_1800) + parseInt(current.bj3_1800) + parseInt(current.ra1_1800) + parseInt(current.ra2_1800) + parseInt(current.ra3_1800) + parseInt(current.ra4_1800) + parseInt(current.pb1_1800) + parseInt(current.pb2_1800) + parseInt(current.pb3_1800) + parseInt(current.pb4_1800) + parseInt(current.pb5_1800),
            _1900: parseInt(current.pk1_1900) + parseInt(current.pk2_1900) + parseInt(current.pk3_1900) + parseInt(current.bj1_1900) + parseInt(current.bj2_1900) + parseInt(current.bj3_1900) + parseInt(current.ra1_1900) + parseInt(current.ra2_1900) + parseInt(current.ra3_1900) + parseInt(current.ra4_1900) + parseInt(current.pb1_1900) + parseInt(current.pb2_1900) + parseInt(current.pb3_1900) + parseInt(current.pb4_1900) + parseInt(current.pb5_1900),
            _2000: parseInt(current.pk1_2000) + parseInt(current.pk2_2000) + parseInt(current.pk3_2000) + parseInt(current.bj1_2000) + parseInt(current.bj2_2000) + parseInt(current.bj3_2000) + parseInt(current.ra1_2000) + parseInt(current.ra2_2000) + parseInt(current.ra3_2000) + parseInt(current.ra4_2000) + parseInt(current.pb1_2000) + parseInt(current.pb2_2000) + parseInt(current.pb3_2000) + parseInt(current.pb4_2000) + parseInt(current.pb5_2000),
            _2100: parseInt(current.pk1_2100) + parseInt(current.pk2_2100) + parseInt(current.pk3_2100) + parseInt(current.bj1_2100) + parseInt(current.bj2_2100) + parseInt(current.bj3_2100) + parseInt(current.ra1_2100) + parseInt(current.ra2_2100) + parseInt(current.ra3_2100) + parseInt(current.ra4_2100) + parseInt(current.pb1_2100) + parseInt(current.pb2_2100) + parseInt(current.pb3_2100) + parseInt(current.pb4_2100) + parseInt(current.pb5_2100),
            _2200: parseInt(current.pk1_2200) + parseInt(current.pk2_2200) + parseInt(current.pk3_2200) + parseInt(current.bj1_2200) + parseInt(current.bj2_2200) + parseInt(current.bj3_2200) + parseInt(current.ra1_2200) + parseInt(current.ra2_2200) + parseInt(current.ra3_2200) + parseInt(current.ra4_2200) + parseInt(current.pb1_2200) + parseInt(current.pb2_2200) + parseInt(current.pb3_2200) + parseInt(current.pb4_2200) + parseInt(current.pb5_2200),
            _2300: parseInt(current.pk1_2300) + parseInt(current.pk2_2300) + parseInt(current.pk3_2300) + parseInt(current.bj1_2300) + parseInt(current.bj2_2300) + parseInt(current.bj3_2300) + parseInt(current.ra1_2300) + parseInt(current.ra2_2300) + parseInt(current.ra3_2300) + parseInt(current.ra4_2300) + parseInt(current.pb1_2300) + parseInt(current.pb2_2300) + parseInt(current.pb3_2300) + parseInt(current.pb4_2300) + parseInt(current.pb5_2300),
            _0000: parseInt(current.pk1_0000) + parseInt(current.pk2_0000) + parseInt(current.pk3_0000) + parseInt(current.bj1_0000) + parseInt(current.bj2_0000) + parseInt(current.bj3_0000) + parseInt(current.ra1_0000) + parseInt(current.ra2_0000) + parseInt(current.ra3_0000) + parseInt(current.ra4_0000) + parseInt(current.pb1_0000) + parseInt(current.pb2_0000) + parseInt(current.pb3_0000) + parseInt(current.pb4_0000) + parseInt(current.pb5_0000),
            _0100: parseInt(current.pk1_0100) + parseInt(current.pk2_0100) + parseInt(current.pk3_0100) + parseInt(current.bj1_0100) + parseInt(current.bj2_0100) + parseInt(current.bj3_0100) + parseInt(current.ra1_0100) + parseInt(current.ra2_0100) + parseInt(current.ra3_0100) + parseInt(current.ra4_0100) + parseInt(current.pb1_0100) + parseInt(current.pb2_0100) + parseInt(current.pb3_0100) + parseInt(current.pb4_0100) + parseInt(current.pb5_0100),
            _0200: parseInt(current.pk1_0200) + parseInt(current.pk2_0200) + parseInt(current.pk3_0200) + parseInt(current.bj1_0200) + parseInt(current.bj2_0200) + parseInt(current.bj3_0200) + parseInt(current.ra1_0200) + parseInt(current.ra2_0200) + parseInt(current.ra3_0200) + parseInt(current.ra4_0200) + parseInt(current.pb1_0200) + parseInt(current.pb2_0200) + parseInt(current.pb3_0200) + parseInt(current.pb4_0200) + parseInt(current.pb5_0200),
            _0300: parseInt(current.pk1_0300) + parseInt(current.pk2_0300) + parseInt(current.pk3_0300) + parseInt(current.bj1_0300) + parseInt(current.bj2_0300) + parseInt(current.bj3_0300) + parseInt(current.ra1_0300) + parseInt(current.ra2_0300) + parseInt(current.ra3_0300) + parseInt(current.ra4_0300) + parseInt(current.pb1_0300) + parseInt(current.pb2_0300) + parseInt(current.pb3_0300) + parseInt(current.pb4_0300) + parseInt(current.pb5_0300),
            _0400: parseInt(current.pk1_0400) + parseInt(current.pk2_0400) + parseInt(current.pk3_0400) + parseInt(current.bj1_0400) + parseInt(current.bj2_0400) + parseInt(current.bj3_0400) + parseInt(current.ra1_0400) + parseInt(current.ra2_0400) + parseInt(current.ra3_0400) + parseInt(current.ra4_0400) + parseInt(current.pb1_0400) + parseInt(current.pb2_0400) + parseInt(current.pb3_0400) + parseInt(current.pb4_0400) + parseInt(current.pb5_0400),
            _0500: parseInt(current.pk1_0500) + parseInt(current.pk2_0500) + parseInt(current.pk3_0500) + parseInt(current.bj1_0500) + parseInt(current.bj2_0500) + parseInt(current.bj3_0500) + parseInt(current.ra1_0500) + parseInt(current.ra2_0500) + parseInt(current.ra3_0500) + parseInt(current.ra4_0500) + parseInt(current.pb1_0500) + parseInt(current.pb2_0500) + parseInt(current.pb3_0500) + parseInt(current.pb4_0500) + parseInt(current.pb5_0500),
        }
        let sumMesas = {
            _pk1: parseInt(current.pk1_1400) + parseInt(current.pk1_1500) + parseInt(current.pk1_1600) + parseInt(current.pk1_1700) + parseInt(current.pk1_1800) + parseInt(current.pk1_1900) + parseInt(current.pk1_2000) + parseInt(current.pk1_2100) + parseInt(current.pk1_2200) + parseInt(current.pk1_2300) + parseInt(current.pk1_0000) + parseInt(current.pk1_0100) + parseInt(current.pk1_0200) + parseInt(current.pk1_0300) + parseInt(current.pk1_0400) + parseInt(current.pk1_0500),
            _pk2: parseInt(current.pk2_1400) + parseInt(current.pk2_1500) + parseInt(current.pk2_1600) + parseInt(current.pk2_1700) + parseInt(current.pk2_1800) + parseInt(current.pk2_1900) + parseInt(current.pk2_2000) + parseInt(current.pk2_2100) + parseInt(current.pk2_2200) + parseInt(current.pk2_2300) + parseInt(current.pk2_0000) + parseInt(current.pk2_0100) + parseInt(current.pk2_0200) + parseInt(current.pk2_0300) + parseInt(current.pk2_0400) + parseInt(current.pk2_0500),
            _pk3: parseInt(current.pk3_1400) + parseInt(current.pk3_1500) + parseInt(current.pk3_1600) + parseInt(current.pk3_1700) + parseInt(current.pk3_1800) + parseInt(current.pk3_1900) + parseInt(current.pk3_2000) + parseInt(current.pk3_2100) + parseInt(current.pk3_2200) + parseInt(current.pk3_2300) + parseInt(current.pk3_0000) + parseInt(current.pk3_0100) + parseInt(current.pk3_0200) + parseInt(current.pk3_0300) + parseInt(current.pk3_0400) + parseInt(current.pk3_0500),
            _bj1: parseInt(current.bj1_1400) + parseInt(current.bj1_1500) + parseInt(current.bj1_1600) + parseInt(current.bj1_1700) + parseInt(current.bj1_1800) + parseInt(current.bj1_1900) + parseInt(current.bj1_2000) + parseInt(current.bj1_2100) + parseInt(current.bj1_2200) + parseInt(current.bj1_2300) + parseInt(current.bj1_0000) + parseInt(current.bj1_0100) + parseInt(current.bj1_0200) + parseInt(current.bj1_0300) + parseInt(current.bj1_0400) + parseInt(current.bj1_0500),
            _bj2: parseInt(current.bj2_1400) + parseInt(current.bj2_1500) + parseInt(current.bj2_1600) + parseInt(current.bj2_1700) + parseInt(current.bj2_1800) + parseInt(current.bj2_1900) + parseInt(current.bj2_2000) + parseInt(current.bj2_2100) + parseInt(current.bj2_2200) + parseInt(current.bj2_2300) + parseInt(current.bj2_0000) + parseInt(current.bj2_0100) + parseInt(current.bj2_0200) + parseInt(current.bj2_0300) + parseInt(current.bj2_0400) + parseInt(current.bj2_0500),
            _bj3: parseInt(current.bj3_1400) + parseInt(current.bj3_1500) + parseInt(current.bj3_1600) + parseInt(current.bj3_1700) + parseInt(current.bj3_1800) + parseInt(current.bj3_1900) + parseInt(current.bj3_2000) + parseInt(current.bj3_2100) + parseInt(current.bj3_2200) + parseInt(current.bj3_2300) + parseInt(current.bj3_0000) + parseInt(current.bj3_0100) + parseInt(current.bj3_0200) + parseInt(current.bj3_0300) + parseInt(current.bj3_0400) + parseInt(current.bj3_0500),
            _ra1: parseInt(current.ra1_1400) + parseInt(current.ra1_1500) + parseInt(current.ra1_1600) + parseInt(current.ra1_1700) + parseInt(current.ra1_1800) + parseInt(current.ra1_1900) + parseInt(current.ra1_2000) + parseInt(current.ra1_2100) + parseInt(current.ra1_2200) + parseInt(current.ra1_2300) + parseInt(current.ra1_0000) + parseInt(current.ra1_0100) + parseInt(current.ra1_0200) + parseInt(current.ra1_0300) + parseInt(current.ra1_0400) + parseInt(current.ra1_0500),
            _ra2: parseInt(current.ra2_1400) + parseInt(current.ra2_1500) + parseInt(current.ra2_1600) + parseInt(current.ra2_1700) + parseInt(current.ra2_1800) + parseInt(current.ra2_1900) + parseInt(current.ra2_2000) + parseInt(current.ra2_2100) + parseInt(current.ra2_2200) + parseInt(current.ra2_2300) + parseInt(current.ra2_0000) + parseInt(current.ra2_0100) + parseInt(current.ra2_0200) + parseInt(current.ra2_0300) + parseInt(current.ra2_0400) + parseInt(current.ra2_0500),
            _ra3: parseInt(current.ra3_1400) + parseInt(current.ra3_1500) + parseInt(current.ra3_1600) + parseInt(current.ra3_1700) + parseInt(current.ra3_1800) + parseInt(current.ra3_1900) + parseInt(current.ra3_2000) + parseInt(current.ra3_2100) + parseInt(current.ra3_2200) + parseInt(current.ra3_2300) + parseInt(current.ra3_0000) + parseInt(current.ra3_0100) + parseInt(current.ra3_0200) + parseInt(current.ra3_0300) + parseInt(current.ra3_0400) + parseInt(current.ra3_0500),
            _ra4: parseInt(current.ra4_1400) + parseInt(current.ra4_1500) + parseInt(current.ra4_1600) + parseInt(current.ra4_1700) + parseInt(current.ra4_1800) + parseInt(current.ra4_1900) + parseInt(current.ra4_2000) + parseInt(current.ra4_2100) + parseInt(current.ra4_2200) + parseInt(current.ra4_2300) + parseInt(current.ra4_0000) + parseInt(current.ra4_0100) + parseInt(current.ra4_0200) + parseInt(current.ra4_0300) + parseInt(current.ra4_0400) + parseInt(current.ra4_0500),
            _pb1: parseInt(current.pb1_1400) + parseInt(current.pb1_1500) + parseInt(current.pb1_1600) + parseInt(current.pb1_1700) + parseInt(current.pb1_1800) + parseInt(current.pb1_1900) + parseInt(current.pb1_2000) + parseInt(current.pb1_2100) + parseInt(current.pb1_2200) + parseInt(current.pb1_2300) + parseInt(current.pb1_0000) + parseInt(current.pb1_0100) + parseInt(current.pb1_0200) + parseInt(current.pb1_0300) + parseInt(current.pb1_0400) + parseInt(current.pb1_0500),
            _pb2: parseInt(current.pb2_1400) + parseInt(current.pb2_1500) + parseInt(current.pb2_1600) + parseInt(current.pb2_1700) + parseInt(current.pb2_1800) + parseInt(current.pb2_1900) + parseInt(current.pb2_2000) + parseInt(current.pb2_2100) + parseInt(current.pb2_2200) + parseInt(current.pb2_2300) + parseInt(current.pb2_0000) + parseInt(current.pb2_0100) + parseInt(current.pb2_0200) + parseInt(current.pb2_0300) + parseInt(current.pb2_0400) + parseInt(current.pb2_0500),
            _pb3: parseInt(current.pb3_1400) + parseInt(current.pb3_1500) + parseInt(current.pb3_1600) + parseInt(current.pb3_1700) + parseInt(current.pb3_1800) + parseInt(current.pb3_1900) + parseInt(current.pb3_2000) + parseInt(current.pb3_2100) + parseInt(current.pb3_2200) + parseInt(current.pb3_2300) + parseInt(current.pb3_0000) + parseInt(current.pb3_0100) + parseInt(current.pb3_0200) + parseInt(current.pb3_0300) + parseInt(current.pb3_0400) + parseInt(current.pb3_0500),
            _pb4: parseInt(current.pb4_1400) + parseInt(current.pb4_1500) + parseInt(current.pb4_1600) + parseInt(current.pb4_1700) + parseInt(current.pb4_1800) + parseInt(current.pb4_1900) + parseInt(current.pb4_2000) + parseInt(current.pb4_2100) + parseInt(current.pb4_2200) + parseInt(current.pb4_2300) + parseInt(current.pb4_0000) + parseInt(current.pb4_0100) + parseInt(current.pb4_0200) + parseInt(current.pb4_0300) + parseInt(current.pb4_0400) + parseInt(current.pb4_0500),
            _pb5: parseInt(current.pb5_1400) + parseInt(current.pb5_1500) + parseInt(current.pb5_1600) + parseInt(current.pb5_1700) + parseInt(current.pb5_1800) + parseInt(current.pb5_1900) + parseInt(current.pb5_2000) + parseInt(current.pb5_2100) + parseInt(current.pb5_2200) + parseInt(current.pb5_2300) + parseInt(current.pb5_0000) + parseInt(current.pb5_0100) + parseInt(current.pb5_0200) + parseInt(current.pb5_0300) + parseInt(current.pb5_0400) + parseInt(current.pb5_0500),
        }
        let promedioSumMesas = parseInt(sumMesas._pk1/puestos) + parseInt(sumMesas._pk2/puestos) + parseInt(sumMesas._pk3/puestos) + parseInt(sumMesas._bj1/puestos) + parseInt(sumMesas._bj2/puestos) + parseInt(sumMesas._bj3/puestos) + parseInt(sumMesas._ra1/puestos) + parseInt(sumMesas._ra2/puestos) + parseInt(sumMesas._ra3/puestos) + parseInt(sumMesas._ra4/puestos) + parseInt(sumMesas._pb1/puestos) + parseInt(sumMesas._pb2/puestos) + parseInt(sumMesas._pb3/puestos) + parseInt(sumMesas._pb4/puestos) + parseInt(sumMesas._pb5/puestos)
        let totalSumMesas = parseInt(sumMesas._pk1) + parseInt(sumMesas._pk2) + parseInt(sumMesas._pk3) + parseInt(sumMesas._bj1) + parseInt(sumMesas._bj2) + parseInt(sumMesas._bj3) + parseInt(sumMesas._ra1) + parseInt(sumMesas._ra2) + parseInt(sumMesas._ra3) + parseInt(sumMesas._ra4) + parseInt(sumMesas._pb1) + parseInt(sumMesas._pb2) + parseInt(sumMesas._pb3) + parseInt(sumMesas._pb4) + parseInt(sumMesas._pb5)
        
        let listado = {
            horas: {
                _1400: ["pk1_1400","pk2_1400","pk3_1400","bj1_1400","bj2_1400","bj3_1400","ra1_1400","ra2_1400","ra3_1400","ra4_1400","pb1_1400","pb2_1400","pb3_1400","pb4_1400","pb5_1400"],
                _1500: ["pk1_1500","pk2_1500","pk3_1500","bj1_1500","bj2_1500","bj3_1500","ra1_1500","ra2_1500","ra3_1500","ra4_1500","pb1_1500","pb2_1500","pb3_1500","pb4_1500","pb5_1500"],
                _1600: ["pk1_1600","pk2_1600","pk3_1600","bj1_1600","bj2_1600","bj3_1600","ra1_1600","ra2_1600","ra3_1600","ra4_1600","pb1_1600","pb2_1600","pb3_1600","pb4_1600","pb5_1600"],
                _1700: ["pk1_1700","pk2_1700","pk3_1700","bj1_1700","bj2_1700","bj3_1700","ra1_1700","ra2_1700","ra3_1700","ra4_1700","pb1_1700","pb2_1700","pb3_1700","pb4_1700","pb5_1700"],
                _1800: ["pk1_1800","pk2_1800","pk3_1800","bj1_1800","bj2_1800","bj3_1800","ra1_1800","ra2_1800","ra3_1800","ra4_1800","pb1_1800","pb2_1800","pb3_1800","pb4_1800","pb5_1800"],
                _1900: ["pk1_1900","pk2_1900","pk3_1900","bj1_1900","bj2_1900","bj3_1900","ra1_1900","ra2_1900","ra3_1900","ra4_1900","pb1_1900","pb2_1900","pb3_1900","pb4_1900","pb5_1900"],
                _2000: ["pk1_2000","pk2_2000","pk3_2000","bj1_2000","bj2_2000","bj3_2000","ra1_2000","ra2_2000","ra3_2000","ra4_2000","pb1_2000","pb2_2000","pb3_2000","pb4_2000","pb5_2000"],
                _2100: ["pk1_2100","pk2_2100","pk3_2100","bj1_2100","bj2_2100","bj3_2100","ra1_2100","ra2_2100","ra3_2100","ra4_2100","pb1_2100","pb2_2100","pb3_2100","pb4_2100","pb5_2100"],
                _2200: ["pk1_2200","pk2_2200","pk3_2200","bj1_2200","bj2_2200","bj3_2200","ra1_2200","ra2_2200","ra3_2200","ra4_2200","pb1_2200","pb2_2200","pb3_2200","pb4_2200","pb5_2200"],
                _2300: ["pk1_2300","pk2_2300","pk3_2300","bj1_2300","bj2_2300","bj3_2300","ra1_2300","ra2_2300","ra3_2300","ra4_2300","pb1_2300","pb2_2300","pb3_2300","pb4_2300","pb5_2300"],
                _0000: ["pk1_0000","pk2_0000","pk3_0000","bj1_0000","bj2_0000","bj3_0000","ra1_0000","ra2_0000","ra3_0000","ra4_0000","pb1_0000","pb2_0000","pb3_0000","pb4_0000","pb5_0000"],
                _0100: ["pk1_0100","pk2_0100","pk3_0100","bj1_0100","bj2_0100","bj3_0100","ra1_0100","ra2_0100","ra3_0100","ra4_0100","pb1_0100","pb2_0100","pb3_0100","pb4_0100","pb5_0100"],
                _0200: ["pk1_0200","pk2_0200","pk3_0200","bj1_0200","bj2_0200","bj3_0200","ra1_0200","ra2_0200","ra3_0200","ra4_0200","pb1_0200","pb2_0200","pb3_0200","pb4_0200","pb5_0200"],
                _0300: ["pk1_0300","pk2_0300","pk3_0300","bj1_0300","bj2_0300","bj3_0300","ra1_0300","ra2_0300","ra3_0300","ra4_0300","pb1_0300","pb2_0300","pb3_0300","pb4_0300","pb5_0300"],
                _0400: ["pk1_0400","pk2_0400","pk3_0400","bj1_0400","bj2_0400","bj3_0400","ra1_0400","ra2_0400","ra3_0400","ra4_0400","pb1_0400","pb2_0400","pb3_0400","pb4_0400","pb5_0400"],
                _0500: ["pk1_0500","pk2_0500","pk3_0500","bj1_0500","bj2_0500","bj3_0500","ra1_0500","ra2_0500","ra3_0500","ra4_0500","pb1_0500","pb2_0500","pb3_0500","pb4_0500","pb5_0500"],
            },
            mesas: {
                _pk1: ["pk1_1400","pk1_1500","pk1_1600","pk1_1700","pk1_1800","pk1_1900","pk1_2000","pk1_2100","pk1_2200","pk1_2300","pk1_0000","pk1_0100","pk1_0200","pk1_0300","pk1_0400","pk1_0500"],       
                _pk2: ["pk2_1400","pk2_1500","pk2_1600","pk2_1700","pk2_1800","pk2_1900","pk2_2000","pk2_2100","pk2_2200","pk2_2300","pk2_0000","pk2_0100","pk2_0200","pk2_0300","pk2_0400","pk2_0500"],       
                _pk3: ["pk3_1400","pk3_1500","pk3_1600","pk3_1700","pk3_1800","pk3_1900","pk3_2000","pk3_2100","pk3_2200","pk3_2300","pk3_0000","pk3_0100","pk3_0200","pk3_0300","pk3_0400","pk3_0500"],       
                _bj1: ["bj1_1400","bj1_1500","bj1_1600","bj1_1700","bj1_1800","bj1_1900","bj1_2000","bj1_2100","bj1_2200","bj1_2300","bj1_0000","bj1_0100","bj1_0200","bj1_0300","bj1_0400","bj1_0500"],       
                _bj2: ["bj2_1400","bj2_1500","bj2_1600","bj2_1700","bj2_1800","bj2_1900","bj2_2000","bj2_2100","bj2_2200","bj2_2300","bj2_0000","bj2_0100","bj2_0200","bj2_0300","bj2_0400","bj2_0500"],       
                _bj3: ["bj3_1400","bj3_1500","bj3_1600","bj3_1700","bj3_1800","bj3_1900","bj3_2000","bj3_2100","bj3_2200","bj3_2300","bj3_0000","bj3_0100","bj3_0200","bj3_0300","bj3_0400","bj3_0500"],       
                _ra1: ["ra1_1400","ra1_1500","ra1_1600","ra1_1700","ra1_1800","ra1_1900","ra1_2000","ra1_2100","ra1_2200","ra1_2300","ra1_0000","ra1_0100","ra1_0200","ra1_0300","ra1_0400","ra1_0500"],       
                _ra2: ["ra2_1400","ra2_1500","ra2_1600","ra2_1700","ra2_1800","ra2_1900","ra2_2000","ra2_2100","ra2_2200","ra2_2300","ra2_0000","ra2_0100","ra2_0200","ra2_0300","ra2_0400","ra2_0500"],       
                _ra3: ["ra3_1400","ra3_1500","ra3_1600","ra3_1700","ra3_1800","ra3_1900","ra3_2000","ra3_2100","ra3_2200","ra3_2300","ra3_0000","ra3_0100","ra3_0200","ra3_0300","ra3_0400","ra3_0500"],       
                _ra4: ["ra4_1400","ra4_1500","ra4_1600","ra4_1700","ra4_1800","ra4_1900","ra4_2000","ra4_2100","ra4_2200","ra4_2300","ra4_0000","ra4_0100","ra4_0200","ra4_0300","ra4_0400","ra4_0500"],       
                _pb1: ["pb1_1400","pb1_1500","pb1_1600","pb1_1700","pb1_1800","pb1_1900","pb1_2000","pb1_2100","pb1_2200","pb1_2300","pb1_0000","pb1_0100","pb1_0200","pb1_0300","pb1_0400","pb1_0500"],       
                _pb2: ["pb2_1400","pb2_1500","pb2_1600","pb2_1700","pb2_1800","pb2_1900","pb2_2000","pb2_2100","pb2_2200","pb2_2300","pb2_0000","pb2_0100","pb2_0200","pb2_0300","pb2_0400","pb2_0500"],       
                _pb3: ["pb3_1400","pb3_1500","pb3_1600","pb3_1700","pb3_1800","pb3_1900","pb3_2000","pb3_2100","pb3_2200","pb3_2300","pb3_0000","pb3_0100","pb3_0200","pb3_0300","pb3_0400","pb3_0500"],       
                _pb4: ["pb4_1400","pb4_1500","pb4_1600","pb4_1700","pb4_1800","pb4_1900","pb4_2000","pb4_2100","pb4_2200","pb4_2300","pb4_0000","pb4_0100","pb4_0200","pb4_0300","pb4_0400","pb4_0500"],       
                _pb5: ["pb5_1400","pb5_1500","pb5_1600","pb5_1700","pb5_1800","pb5_1900","pb5_2000","pb5_2100","pb5_2200","pb5_2300","pb5_0000","pb5_0100","pb5_0200","pb5_0300","pb5_0400","pb5_0500"],       
            }
        }
        let listado_mayores = {
            horas: {
                _1400: colorMayor(current,listado.horas._1400),
                _1500: colorMayor(current,listado.horas._1500),
                _1600: colorMayor(current,listado.horas._1600),
                _1700: colorMayor(current,listado.horas._1700),
                _1800: colorMayor(current,listado.horas._1800),
                _1900: colorMayor(current,listado.horas._1900),
                _2000: colorMayor(current,listado.horas._2000),
                _2100: colorMayor(current,listado.horas._2100),
                _2200: colorMayor(current,listado.horas._2200),
                _2300: colorMayor(current,listado.horas._2300),
                _0000: colorMayor(current,listado.horas._0000),
                _0100: colorMayor(current,listado.horas._0100),
                _0200: colorMayor(current,listado.horas._0200),
                _0300: colorMayor(current,listado.horas._0300),
                _0400: colorMayor(current,listado.horas._0400),
                _0500: colorMayor(current,listado.horas._0500),
            },
            mesas: {
                _pk1: colorMayor(current,listado.mesas._pk1),       
                _pk2: colorMayor(current,listado.mesas._pk2),       
                _pk3: colorMayor(current,listado.mesas._pk3),  
                _bj1: colorMayor(current,listado.mesas._bj1),  
                _bj2: colorMayor(current,listado.mesas._bj2),  
                _bj3: colorMayor(current,listado.mesas._bj3),  
                _ra1: colorMayor(current,listado.mesas._ra1),  
                _ra2: colorMayor(current,listado.mesas._ra2),  
                _ra3: colorMayor(current,listado.mesas._ra3),  
                _ra4: colorMayor(current,listado.mesas._ra4),  
                _pb1: colorMayor(current,listado.mesas._pb1),        
                _pb2: colorMayor(current,listado.mesas._pb2),        
                _pb3: colorMayor(current,listado.mesas._pb3),        
                _pb4: colorMayor(current,listado.mesas._pb4),        
                _pb5: colorMayor(current,listado.mesas._pb5),        
            }
        }
        Swal.fire({
            title: `Conteo de Mesas`,
            showConfirmButton: true,
            width: "60rem",
            showCloseButton: true,
            confirmButtonText: 'Ok',
            html:`
            <div class="table-responsive">
                <table id="data-table-default-stadistic" class=" table table-bordered table-td-valign-middle mt-3" style="width:100% !important">
                    <thead style="background-color:paleturquoise" >
                        <tr>
                            <th>HORA</th>
                            <th>PK1</th>
                            <th>PK2</th>
                            <th>PK3</th>
                            <th>BJ1</th>
                            <th>BJ2</th>
                            <th>BJ3</th>
                            <th>RA1</th>
                            <th>RA2</th>
                            <th>RA3</th>
                            <th>RA4</th>
                            <th>PB1</th>
                            <th>PB2</th>
                            <th>PB3</th>
                            <th>PB4</th>
                            <th>PB5</th>
                            <th>TOTAL</th>
                            <th>% OCUP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th style="background-color:paleturquoise">14:00</th>
                            <td id="td_pk1_1400" >${ current.pk1_1400 }</td>
                            <td id="td_pk2_1400" >${ current.pk2_1400 }</td>
                            <td id="td_pk3_1400" >${ current.pk3_1400 }</td>
                            <td id="td_bj1_1400" >${ current.bj1_1400 }</td>
                            <td id="td_bj2_1400" >${ current.bj2_1400 }</td>
                            <td id="td_bj3_1400" >${ current.bj3_1400 }</td>
                            <td id="td_ra1_1400" >${ current.ra1_1400 }</td>
                            <td id="td_ra2_1400" >${ current.ra2_1400 }</td>
                            <td id="td_ra3_1400" >${ current.ra3_1400 }</td>
                            <td id="td_ra4_1400" >${ current.ra4_1400 }</td>
                            <td id="td_pb1_1400" >${ current.pb1_1400 }</td>
                            <td id="td_pb2_1400" >${ current.pb2_1400 }</td>
                            <td id="td_pb3_1400" >${ current.pb3_1400 }</td>
                            <td id="td_pb4_1400" >${ current.pb4_1400 }</td>
                            <td id="td_pb5_1400" >${ current.pb5_1400 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._1400 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._1400/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">15:00</th>
                            <td id="td_pk1_1500" >${ current.pk1_1500 }</td>
                            <td id="td_pk2_1500" >${ current.pk2_1500 }</td>
                            <td id="td_pk3_1500" >${ current.pk3_1500 }</td>
                            <td id="td_bj1_1500" >${ current.bj1_1500 }</td>
                            <td id="td_bj2_1500" >${ current.bj2_1500 }</td>
                            <td id="td_bj3_1500" >${ current.bj3_1500 }</td>
                            <td id="td_ra1_1500" >${ current.ra1_1500 }</td>
                            <td id="td_ra2_1500" >${ current.ra2_1500 }</td>
                            <td id="td_ra3_1500" >${ current.ra3_1500 }</td>
                            <td id="td_ra4_1500" >${ current.ra4_1500 }</td>
                            <td id="td_pb1_1500" >${ current.pb1_1500 }</td>
                            <td id="td_pb2_1500" >${ current.pb2_1500 }</td>
                            <td id="td_pb3_1500" >${ current.pb3_1500 }</td>
                            <td id="td_pb4_1500" >${ current.pb4_1500 }</td>
                            <td id="td_pb5_1500" >${ current.pb5_1500 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._1500 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._1500/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">16:00</th>
                            <td id="td_pk1_1600" >${ current.pk1_1600 }</td>
                            <td id="td_pk2_1600" >${ current.pk2_1600 }</td>
                            <td id="td_pk3_1600" >${ current.pk3_1600 }</td>
                            <td id="td_bj1_1600" >${ current.bj1_1600 }</td>
                            <td id="td_bj2_1600" >${ current.bj2_1600 }</td>
                            <td id="td_bj3_1600" >${ current.bj3_1600 }</td>
                            <td id="td_ra1_1600" >${ current.ra1_1600 }</td>
                            <td id="td_ra2_1600" >${ current.ra2_1600 }</td>
                            <td id="td_ra3_1600" >${ current.ra3_1600 }</td>
                            <td id="td_ra4_1600" >${ current.ra4_1600 }</td>
                            <td id="td_pb1_1600" >${ current.pb1_1600 }</td>
                            <td id="td_pb2_1600" >${ current.pb2_1600 }</td>
                            <td id="td_pb3_1600" >${ current.pb3_1600 }</td>
                            <td id="td_pb4_1600" >${ current.pb4_1600 }</td>
                            <td id="td_pb5_1600" >${ current.pb5_1600 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._1600 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._1600/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">17:00</th>
                            <td id="td_pk1_1700" >${ current.pk1_1700 }</td>
                            <td id="td_pk2_1700" >${ current.pk2_1700 }</td>
                            <td id="td_pk3_1700" >${ current.pk3_1700 }</td>
                            <td id="td_bj1_1700" >${ current.bj1_1700 }</td>
                            <td id="td_bj2_1700" >${ current.bj2_1700 }</td>
                            <td id="td_bj3_1700" >${ current.bj3_1700 }</td>
                            <td id="td_ra1_1700" >${ current.ra1_1700 }</td>
                            <td id="td_ra2_1700" >${ current.ra2_1700 }</td>
                            <td id="td_ra3_1700" >${ current.ra3_1700 }</td>
                            <td id="td_ra4_1700" >${ current.ra4_1700 }</td>
                            <td id="td_pb1_1700" >${ current.pb1_1700 }</td>
                            <td id="td_pb2_1700" >${ current.pb2_1700 }</td>
                            <td id="td_pb3_1700" >${ current.pb3_1700 }</td>
                            <td id="td_pb4_1700" >${ current.pb4_1700 }</td>
                            <td id="td_pb5_1700" >${ current.pb5_1700 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._1700 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._1700/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">18:00</th>
                            <td id="td_pk1_1800" >${ current.pk1_1800 }</td>
                            <td id="td_pk2_1800" >${ current.pk2_1800 }</td>
                            <td id="td_pk3_1800" >${ current.pk3_1800 }</td>
                            <td id="td_bj1_1800" >${ current.bj1_1800 }</td>
                            <td id="td_bj2_1800" >${ current.bj2_1800 }</td>
                            <td id="td_bj3_1800" >${ current.bj3_1800 }</td>
                            <td id="td_ra1_1800" >${ current.ra1_1800 }</td>
                            <td id="td_ra2_1800" >${ current.ra2_1800 }</td>
                            <td id="td_ra3_1800" >${ current.ra3_1800 }</td>
                            <td id="td_ra4_1800" >${ current.ra4_1800 }</td>
                            <td id="td_pb1_1800" >${ current.pb1_1800 }</td>
                            <td id="td_pb2_1800" >${ current.pb2_1800 }</td>
                            <td id="td_pb3_1800" >${ current.pb3_1800 }</td>
                            <td id="td_pb4_1800" >${ current.pb4_1800 }</td>
                            <td id="td_pb5_1800" >${ current.pb5_1800 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._1800 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._1800/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">19:00</th>
                            <td id="td_pk1_1900" >${ current.pk1_1900 }</td>
                            <td id="td_pk2_1900" >${ current.pk2_1900 }</td>
                            <td id="td_pk3_1900" >${ current.pk3_1900 }</td>
                            <td id="td_bj1_1900" >${ current.bj1_1900 }</td>
                            <td id="td_bj2_1900" >${ current.bj2_1900 }</td>
                            <td id="td_bj3_1900" >${ current.bj3_1900 }</td>
                            <td id="td_ra1_1900" >${ current.ra1_1900 }</td>
                            <td id="td_ra2_1900" >${ current.ra2_1900 }</td>
                            <td id="td_ra3_1900" >${ current.ra3_1900 }</td>
                            <td id="td_ra4_1900" >${ current.ra4_1900 }</td>
                            <td id="td_pb1_1900" >${ current.pb1_1900 }</td>
                            <td id="td_pb2_1900" >${ current.pb2_1900 }</td>
                            <td id="td_pb3_1900" >${ current.pb3_1900 }</td>
                            <td id="td_pb4_1900" >${ current.pb4_1900 }</td>
                            <td id="td_pb5_1900" >${ current.pb5_1900 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._1900 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._1900/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">20:00</th>
                            <td id="td_pk1_2000" >${ current.pk1_2000 }</td>
                            <td id="td_pk2_2000" >${ current.pk2_2000 }</td>
                            <td id="td_pk3_2000" >${ current.pk3_2000 }</td>
                            <td id="td_bj1_2000" >${ current.bj1_2000 }</td>
                            <td id="td_bj2_2000" >${ current.bj2_2000 }</td>
                            <td id="td_bj3_2000" >${ current.bj3_2000 }</td>
                            <td id="td_ra1_2000" >${ current.ra1_2000 }</td>
                            <td id="td_ra2_2000" >${ current.ra2_2000 }</td>
                            <td id="td_ra3_2000" >${ current.ra3_2000 }</td>
                            <td id="td_ra4_2000" >${ current.ra4_2000 }</td>
                            <td id="td_pb1_2000" >${ current.pb1_2000 }</td>
                            <td id="td_pb2_2000" >${ current.pb2_2000 }</td>
                            <td id="td_pb3_2000" >${ current.pb3_2000 }</td>
                            <td id="td_pb4_2000" >${ current.pb4_2000 }</td>
                            <td id="td_pb5_2000" >${ current.pb5_2000 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._2000 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._2000/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">21:00</th>
                            <td id="td_pk1_2100" >${ current.pk1_2100 }</td>
                            <td id="td_pk2_2100" >${ current.pk2_2100 }</td>
                            <td id="td_pk3_2100" >${ current.pk3_2100 }</td>
                            <td id="td_bj1_2100" >${ current.bj1_2100 }</td>
                            <td id="td_bj2_2100" >${ current.bj2_2100 }</td>
                            <td id="td_bj3_2100" >${ current.bj3_2100 }</td>
                            <td id="td_ra1_2100" >${ current.ra1_2100 }</td>
                            <td id="td_ra2_2100" >${ current.ra2_2100 }</td>
                            <td id="td_ra3_2100" >${ current.ra3_2100 }</td>
                            <td id="td_ra4_2100" >${ current.ra4_2100 }</td>
                            <td id="td_pb1_2100" >${ current.pb1_2100 }</td>
                            <td id="td_pb2_2100" >${ current.pb2_2100 }</td>
                            <td id="td_pb3_2100" >${ current.pb3_2100 }</td>
                            <td id="td_pb4_2100" >${ current.pb4_2100 }</td>
                            <td id="td_pb5_2100" >${ current.pb5_2100 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._2100 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._2100/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">22:00</th>
                            <td id="td_pk1_2200" >${ current.pk1_2200 }</td>
                            <td id="td_pk2_2200" >${ current.pk2_2200 }</td>
                            <td id="td_pk3_2200" >${ current.pk3_2200 }</td>
                            <td id="td_bj1_2200" >${ current.bj1_2200 }</td>
                            <td id="td_bj2_2200" >${ current.bj2_2200 }</td>
                            <td id="td_bj3_2200" >${ current.bj3_2200 }</td>
                            <td id="td_ra1_2200" >${ current.ra1_2200 }</td>
                            <td id="td_ra2_2200" >${ current.ra2_2200 }</td>
                            <td id="td_ra3_2200" >${ current.ra3_2200 }</td>
                            <td id="td_ra4_2200" >${ current.ra4_2200 }</td>
                            <td id="td_pb1_2200" >${ current.pb1_2200 }</td>
                            <td id="td_pb2_2200" >${ current.pb2_2200 }</td>
                            <td id="td_pb3_2200" >${ current.pb3_2200 }</td>
                            <td id="td_pb4_2200" >${ current.pb4_2200 }</td>
                            <td id="td_pb5_2200" >${ current.pb5_2200 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._2200 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._2200/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">23:00</th>
                            <td id="td_pk1_2300" >${ current.pk1_2300 }</td>
                            <td id="td_pk2_2300" >${ current.pk2_2300 }</td>
                            <td id="td_pk3_2300" >${ current.pk3_2300 }</td>
                            <td id="td_bj1_2300" >${ current.bj1_2300 }</td>
                            <td id="td_bj2_2300" >${ current.bj2_2300 }</td>
                            <td id="td_bj3_2300" >${ current.bj3_2300 }</td>
                            <td id="td_ra1_2300" >${ current.ra1_2300 }</td>
                            <td id="td_ra2_2300" >${ current.ra2_2300 }</td>
                            <td id="td_ra3_2300" >${ current.ra3_2300 }</td>
                            <td id="td_ra4_2300" >${ current.ra4_2300 }</td>
                            <td id="td_pb1_2300" >${ current.pb1_2300 }</td>
                            <td id="td_pb2_2300" >${ current.pb2_2300 }</td>
                            <td id="td_pb3_2300" >${ current.pb3_2300 }</td>
                            <td id="td_pb4_2300" >${ current.pb4_2300 }</td>
                            <td id="td_pb5_2300" >${ current.pb5_2300 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._2300 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._2300/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">00:00</th>
                            <td id="td_pk1_0000" >${ current.pk1_0000 }</td>
                            <td id="td_pk2_0000" >${ current.pk2_0000 }</td>
                            <td id="td_pk3_0000" >${ current.pk3_0000 }</td>
                            <td id="td_bj1_0000" >${ current.bj1_0000 }</td>
                            <td id="td_bj2_0000" >${ current.bj2_0000 }</td>
                            <td id="td_bj3_0000" >${ current.bj3_0000 }</td>
                            <td id="td_ra1_0000" >${ current.ra1_0000 }</td>
                            <td id="td_ra2_0000" >${ current.ra2_0000 }</td>
                            <td id="td_ra3_0000" >${ current.ra3_0000 }</td>
                            <td id="td_ra4_0000" >${ current.ra4_0000 }</td>
                            <td id="td_pb1_0000" >${ current.pb1_0000 }</td>
                            <td id="td_pb2_0000" >${ current.pb2_0000 }</td>
                            <td id="td_pb3_0000" >${ current.pb3_0000 }</td>
                            <td id="td_pb4_0000" >${ current.pb4_0000 }</td>
                            <td id="td_pb5_0000" >${ current.pb5_0000 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._0000 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._0000/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">01:00</th>
                            <td id="td_pk1_0100" >${ current.pk1_0100 }</td>
                            <td id="td_pk2_0100" >${ current.pk2_0100 }</td>
                            <td id="td_pk3_0100" >${ current.pk3_0100 }</td>
                            <td id="td_bj1_0100" >${ current.bj1_0100 }</td>
                            <td id="td_bj2_0100" >${ current.bj2_0100 }</td>
                            <td id="td_bj3_0100" >${ current.bj3_0100 }</td>
                            <td id="td_ra1_0100" >${ current.ra1_0100 }</td>
                            <td id="td_ra2_0100" >${ current.ra2_0100 }</td>
                            <td id="td_ra3_0100" >${ current.ra3_0100 }</td>
                            <td id="td_ra4_0100" >${ current.ra4_0100 }</td>
                            <td id="td_pb1_0100" >${ current.pb1_0100 }</td>
                            <td id="td_pb2_0100" >${ current.pb2_0100 }</td>
                            <td id="td_pb3_0100" >${ current.pb3_0100 }</td>
                            <td id="td_pb4_0100" >${ current.pb4_0100 }</td>
                            <td id="td_pb5_0100" >${ current.pb5_0100 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._0100 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._0100/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">02:00</th>
                            <td id="td_pk1_0200" >${ current.pk1_0200 }</td>
                            <td id="td_pk2_0200" >${ current.pk2_0200 }</td>
                            <td id="td_pk3_0200" >${ current.pk3_0200 }</td>
                            <td id="td_bj1_0200" >${ current.bj1_0200 }</td>
                            <td id="td_bj2_0200" >${ current.bj2_0200 }</td>
                            <td id="td_bj3_0200" >${ current.bj3_0200 }</td>
                            <td id="td_ra1_0200" >${ current.ra1_0200 }</td>
                            <td id="td_ra2_0200" >${ current.ra2_0200 }</td>
                            <td id="td_ra3_0200" >${ current.ra3_0200 }</td>
                            <td id="td_ra4_0200" >${ current.ra4_0200 }</td>
                            <td id="td_pb1_0200" >${ current.pb1_0200 }</td>
                            <td id="td_pb2_0200" >${ current.pb2_0200 }</td>
                            <td id="td_pb3_0200" >${ current.pb3_0200 }</td>
                            <td id="td_pb4_0200" >${ current.pb4_0200 }</td>
                            <td id="td_pb5_0200" >${ current.pb5_0200 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._0200 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._0200/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">03:00</th>
                            <td id="td_pk1_0300" >${ current.pk1_0300 }</td>
                            <td id="td_pk2_0300" >${ current.pk2_0300 }</td>
                            <td id="td_pk3_0300" >${ current.pk3_0300 }</td>
                            <td id="td_bj1_0300" >${ current.bj1_0300 }</td>
                            <td id="td_bj2_0300" >${ current.bj2_0300 }</td>
                            <td id="td_bj3_0300" >${ current.bj3_0300 }</td>
                            <td id="td_ra1_0300" >${ current.ra1_0300 }</td>
                            <td id="td_ra2_0300" >${ current.ra2_0300 }</td>
                            <td id="td_ra3_0300" >${ current.ra3_0300 }</td>
                            <td id="td_ra4_0300" >${ current.ra4_0300 }</td>
                            <td id="td_pb1_0300" >${ current.pb1_0300 }</td>
                            <td id="td_pb2_0300" >${ current.pb2_0300 }</td>
                            <td id="td_pb3_0300" >${ current.pb3_0300 }</td>
                            <td id="td_pb4_0300" >${ current.pb4_0300 }</td>
                            <td id="td_pb5_0300" >${ current.pb5_0300 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._0300 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._0300/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">04:00</th>
                            <td id="td_pk1_0400" >${ current.pk1_0400 }</td>
                            <td id="td_pk2_0400" >${ current.pk2_0400 }</td>
                            <td id="td_pk3_0400" >${ current.pk3_0400 }</td>
                            <td id="td_bj1_0400" >${ current.bj1_0400 }</td>
                            <td id="td_bj2_0400" >${ current.bj2_0400 }</td>
                            <td id="td_bj3_0400" >${ current.bj3_0400 }</td>
                            <td id="td_ra1_0400" >${ current.ra1_0400 }</td>
                            <td id="td_ra2_0400" >${ current.ra2_0400 }</td>
                            <td id="td_ra3_0400" >${ current.ra3_0400 }</td>
                            <td id="td_ra4_0400" >${ current.ra4_0400 }</td>
                            <td id="td_pb1_0400" >${ current.pb1_0400 }</td>
                            <td id="td_pb2_0400" >${ current.pb2_0400 }</td>
                            <td id="td_pb3_0400" >${ current.pb3_0400 }</td>
                            <td id="td_pb4_0400" >${ current.pb4_0400 }</td>
                            <td id="td_pb5_0400" >${ current.pb5_0400 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._0400 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._0400/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">05:00</th>
                            <td id="td_pk1_0500" >${ current.pk1_0500 }</td>
                            <td id="td_pk2_0500" >${ current.pk2_0500 }</td>
                            <td id="td_pk3_0500" >${ current.pk3_0500 }</td>
                            <td id="td_bj1_0500" >${ current.bj1_0500 }</td>
                            <td id="td_bj2_0500" >${ current.bj2_0500 }</td>
                            <td id="td_bj3_0500" >${ current.bj3_0500 }</td>
                            <td id="td_ra1_0500" >${ current.ra1_0500 }</td>
                            <td id="td_ra2_0500" >${ current.ra2_0500 }</td>
                            <td id="td_ra3_0500" >${ current.ra3_0500 }</td>
                            <td id="td_ra4_0500" >${ current.ra4_0500 }</td>
                            <td id="td_pb1_0500" >${ current.pb1_0500 }</td>
                            <td id="td_pb2_0500" >${ current.pb2_0500 }</td>
                            <td id="td_pb3_0500" >${ current.pb3_0500 }</td>
                            <td id="td_pb4_0500" >${ current.pb4_0500 }</td>
                            <td id="td_pb5_0500" >${ current.pb5_0500 }</td>
                            <th style="background-color: lightgrey !important">${ sumHoras._0500 }</th>
                            <th style="background-color: lightgrey !important">${ ((sumHoras._0500/totalPuestos)*100).toFixed(0) }%</th>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">TOTAL</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pk1 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pk2 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pk3 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._bj1 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._bj2 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._bj3 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._ra1 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._ra2 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._ra3 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._ra4 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pb1 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pb2 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pb3 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pb4 }</th>
                            <th style="background-color: lightgrey !important">${ sumMesas._pb5 }</th>
                            <th style="background-color: lightgrey !important">${ totalSumMesas }</th>
                            <td style="border-right: none !important;border-bottom: none !important">  </td>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">PUESTOS</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ puestos }</th>
                            <th style="background-color: lightgrey !important">${ totalPuestos }</th>
                            <td style="border-right: none !important;border-bottom: none !important;border-top: none !important">  </td>
                        </tr>
                        <tr>
                            <th style="background-color:paleturquoise">PROMEDIO</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pk1/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pk2/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pk3/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._bj1/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._bj2/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._bj3/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._ra1/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._ra2/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._ra3/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._ra4/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pb1/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pb2/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pb3/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pb4/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ (sumMesas._pb5/puestos).toFixed(0) }</th>
                            <th style="background-color: lightgrey !important">${ promedioSumMesas.toFixed(0) }</th>
                            <td style="border-right: none !important;border-bottom: none !important;border-top: none !important">  </td>
                        </tr>
                    </tbody>
                </table>
                <table  class="col-sm-3 table table-bordered table-td-valign-middle">
                    <thead>
                        <tr>
                            <th COLSPAN="2" >LEYENDA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color:${bg_hora}"></td>
                            <th id="td_pk1_1400"> Horas </th>
                        <tr>
                        <tr>
                            <td style="background-color:${bg_mesa}"></td>
                            <th id="td_pk1_1400"> Mesas </th>
                        <tr>
                        <tr>
                            <td style="background-color:${bg_all}"></td>
                            <th id="td_pk1_1400"> Ambas </th>
                        <tr>
                    </tbody>
                </table>
            </div>
            <div class="row">

                <!-- Poker -->
                <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-transparent" >
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">
                            Poker
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="chart-container">
                            <canvas id="charts_pk" ></canvas>
                        </div>
                    </div>
                </div>

                <!-- Blackjack -->
                <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-transparent" >
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">
                        Blackjack
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="chart-container">
                            <canvas id="charts_bj" ></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Ruleta Americana -->
                <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-transparent" >
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">
                        Ruleta Americana
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="chart-container">
                            <canvas id="charts_ra" ></canvas>
                        </div>
                    </div>
                </div>

                <!-- Bacará -->
                <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-transparent" >
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">
                        Bacará
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="chart-container">
                            <canvas id="charts_pb" ></canvas>
                        </div>
                    </div>
                </div>

            </div>
            `
        })
        validacionColores(listado_mayores,bg_hora,bg_mesa,bg_all)
        const charts_pk = new Chart(document.getElementById('charts_pk'),{ 
            type:'bar',
            data: {
                labels: [ '14:00', '15:00', '16:00', '17:00','18:00','19:00','20:00','21:00','22:00','23:00','00:00','01:00','02:00','03:00','04:00','05:00' ],
                datasets: [
                    {
                        label: 'Poker 1',
                        data: [current.pk1_1400,current.pk1_1500,current.pk1_1600,current.pk1_1700,current.pk1_1800,current.pk1_1900,current.pk1_2000,current.pk1_2100,current.pk1_2200,current.pk1_2300,current.pk1_0000,current.pk1_0100,current.pk1_0200,current.pk1_0300,current.pk1_0400,current.pk1_0500],
                        backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                        borderColor: ['rgba(255, 159, 64, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Poker 2',
                        data: [current.pk2_1400,current.pk2_1500,current.pk2_1600,current.pk2_1700,current.pk2_1800,current.pk2_1900,current.pk2_2000,current.pk2_2100,current.pk2_2200,current.pk2_2300,current.pk2_0000,current.pk2_0100,current.pk2_0200,current.pk2_0300,current.pk2_0400,current.pk2_0500],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Poker 3',
                        data: [current.pk3_1400,current.pk3_1500,current.pk3_1600,current.pk3_1700,current.pk3_1800,current.pk3_1900,current.pk3_2000,current.pk3_2100,current.pk3_2200,current.pk3_2300,current.pk3_0000,current.pk3_0100,current.pk3_0200,current.pk3_0300,current.pk3_0400,current.pk3_0500],
                        backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                        borderColor: ['rgba(153, 102, 255, 1)'],
                        borderWidth: 1
                    },
                ] 
            }
        });
        const charts_bj = new Chart(document.getElementById('charts_bj'),{ 
            type:'bar',
            data: {
                labels: [ '14:00', '15:00', '16:00', '17:00','18:00','19:00','20:00','21:00','22:00','23:00','00:00','01:00','02:00','03:00','04:00','05:00' ],
                datasets: [
                    {
                        label: 'Blackjack 1',
                        data: [current.bj1_1400,current.bj1_1500,current.bj1_1600,current.bj1_1700,current.bj1_1800,current.bj1_1900,current.bj1_2000,current.bj1_2100,current.bj1_2200,current.bj1_2300,current.bj1_0000,current.bj1_0100,current.bj1_0200,current.bj1_0300,current.bj1_0400,current.bj1_0500],
                        backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                        borderColor: ['rgba(255, 159, 64, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Blackjack 2',
                        data: [current.bj2_1400,current.bj2_1500,current.bj2_1600,current.bj2_1700,current.bj2_1800,current.bj2_1900,current.bj2_2000,current.bj2_2100,current.bj2_2200,current.bj2_2300,current.bj2_0000,current.bj2_0100,current.bj2_0200,current.bj2_0300,current.bj2_0400,current.bj2_0500],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Blackjack 3',
                        data: [current.bj3_1400,current.bj3_1500,current.bj3_1600,current.bj3_1700,current.bj3_1800,current.bj3_1900,current.bj3_2000,current.bj3_2100,current.bj3_2200,current.bj3_2300,current.bj3_0000,current.bj3_0100,current.bj3_0200,current.bj3_0300,current.bj3_0400,current.bj3_0500],
                        backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                        borderColor: ['rgba(153, 102, 255, 1)'],
                        borderWidth: 1
                    },
                ] 
            }
        });
        const charts_ra = new Chart(document.getElementById('charts_ra'),{ 
            type:'bar',
            data: {
                labels: [ '14:00', '15:00', '16:00', '17:00','18:00','19:00','20:00','21:00','22:00','23:00','00:00','01:00','02:00','03:00','04:00','05:00' ],
                datasets: [
                    {
                        label: 'Ruleta Americana 1',
                        data: [current.ra1_1400,current.ra1_1500,current.ra1_1600,current.ra1_1700,current.ra1_1800,current.ra1_1900,current.ra1_2000,current.ra1_2100,current.ra1_2200,current.ra1_2300,current.ra1_0000,current.ra1_0100,current.ra1_0200,current.ra1_0300,current.ra1_0400,current.ra1_0500],
                        backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                        borderColor: ['rgba(255, 159, 64, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Ruleta Americana 2',
                        data: [current.ra2_1400,current.ra2_1500,current.ra2_1600,current.ra2_1700,current.ra2_1800,current.ra2_1900,current.ra2_2000,current.ra2_2100,current.ra2_2200,current.ra2_2300,current.ra2_0000,current.ra2_0100,current.ra2_0200,current.ra2_0300,current.ra2_0400,current.ra2_0500],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Ruleta Americana 3',
                        data: [current.ra3_1400,current.ra3_1500,current.ra3_1600,current.ra3_1700,current.ra3_1800,current.ra3_1900,current.ra3_2000,current.ra3_2100,current.ra3_2200,current.ra3_2300,current.ra3_0000,current.ra3_0100,current.ra3_0200,current.ra3_0300,current.ra3_0400,current.ra3_0500],
                        backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                        borderColor: ['rgba(153, 102, 255, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Ruleta Americana 4',
                        data: [current.ra4_1400,current.ra4_1500,current.ra4_1600,current.ra4_1700,current.ra4_1800,current.ra4_1900,current.ra4_2000,current.ra4_2100,current.ra4_2200,current.ra4_2300,current.ra4_0000,current.ra4_0100,current.ra4_0200,current.ra4_0300,current.ra4_0400,current.ra4_0500],
                        backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgba(54, 162, 235, 1)'],
                        borderWidth: 1
                    },
                ] 
            }
        });
        const charts_pb = new Chart(document.getElementById('charts_pb'),{ 
            type:'bar',
            data: {
                labels: [ '14:00', '15:00', '16:00', '17:00','18:00','19:00','20:00','21:00','22:00','23:00','00:00','01:00','02:00','03:00','04:00','05:00' ],
                datasets: [
                    {
                        label: 'Bacará 1',
                        data: [current.pb1_1400,current.pb1_1500,current.pb1_1600,current.pb1_1700,current.pb1_1800,current.pb1_1900,current.pb1_2000,current.pb1_2100,current.pb1_2200,current.pb1_2300,current.pb1_0000,current.pb1_0100,current.pb1_0200,current.pb1_0300,current.pb1_0400,current.pb1_0500],
                        backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                        borderColor: ['rgba(255, 159, 64, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Bacará 2',
                        data: [current.pb2_1400,current.pb2_1500,current.pb2_1600,current.pb2_1700,current.pb2_1800,current.pb2_1900,current.pb2_2000,current.pb2_2100,current.pb2_2200,current.pb2_2300,current.pb2_0000,current.pb2_0100,current.pb2_0200,current.pb2_0300,current.pb2_0400,current.pb2_0500],
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderColor: ['rgba(75, 192, 192, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Bacará 3',
                        data: [current.pb3_1400,current.pb3_1500,current.pb3_1600,current.pb3_1700,current.pb3_1800,current.pb3_1900,current.pb3_2000,current.pb3_2100,current.pb3_2200,current.pb3_2300,current.pb3_0000,current.pb3_0100,current.pb3_0200,current.pb3_0300,current.pb3_0400,current.pb3_0500],
                        backgroundColor: ['rgba(153, 102, 255, 0.2)'],
                        borderColor: ['rgba(153, 102, 255, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Bacará 4',
                        data: [current.pb4_1400,current.pb4_1500,current.pb4_1600,current.pb4_1700,current.pb4_1800,current.pb4_1900,current.pb4_2000,current.pb4_2100,current.pb4_2200,current.pb4_2300,current.pb4_0000,current.pb4_0100,current.pb4_0200,current.pb4_0300,current.pb4_0400,current.pb4_0500],
                        backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                        borderColor: ['rgba(54, 162, 235, 1)'],
                        borderWidth: 1
                    },
                    {
                        label: 'Bacará 5',
                        data: [current.pb5_1400,current.pb5_1500,current.pb5_1600,current.pb5_1700,current.pb5_1800,current.pb5_1900,current.pb5_2000,current.pb5_2100,current.pb5_2200,current.pb5_2300,current.pb5_0000,current.pb5_0100,current.pb5_0200,current.pb5_0300,current.pb5_0400,current.pb5_0500],
                        backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 1)'],
                        borderWidth: 1
                    },
                ] 
            }
        });

    }

    function colorMayor(current,params){
        let nMayor = []
        for (let index = 0; index < params.length; index++) { nMayor.push(current[params[index]]) }
        return Math.max(...nMayor)
    }
    function validacionColores(params,bg_hora,bg_mesa,bg_all){

        //pk1
        if($("#td_pk1_1400").text() > 0){ if( $("#td_pk1_1400").text() == params.mesas._pk1 && $("#td_pk1_1400").text() == params.horas._1400 ){ $("#td_pk1_1400").css("background-color", bg_all) }else{
                if( $("#td_pk1_1400").text() == params.horas._1400 && $("#td_pk1_1400").text() != params.mesas._pk1 ){ $("#td_pk1_1400").css("background-color", bg_hora) }
                if( $("#td_pk1_1400").text() == params.mesas._pk1 && $("#td_pk1_1400").text() != params.horas._1400 ){ $("#td_pk1_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_1500").text() > 0){ if( $("#td_pk1_1500").text() == params.mesas._pk1 && $("#td_pk1_1500").text() == params.horas._1500 ){ $("#td_pk1_1500").css("background-color", bg_all) }else{
                if( $("#td_pk1_1500").text() == params.horas._1500 && $("#td_pk1_1500").text() != params.mesas._pk1 ){ $("#td_pk1_1500").css("background-color", bg_hora) }
                if( $("#td_pk1_1500").text() == params.mesas._pk1 && $("#td_pk1_1500").text() != params.horas._1500 ){ $("#td_pk1_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_1600").text() > 0){ if( $("#td_pk1_1600").text() == params.mesas._pk1 && $("#td_pk1_1600").text() == params.horas._1600 ){ $("#td_pk1_1600").css("background-color", bg_all) }else{
                if( $("#td_pk1_1600").text() == params.horas._1600 && $("#td_pk1_1600").text() != params.mesas._pk1 ){ $("#td_pk1_1600").css("background-color", bg_hora) }
                if( $("#td_pk1_1600").text() == params.mesas._pk1 && $("#td_pk1_1600").text() != params.horas._1600 ){ $("#td_pk1_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_1700").text() > 0){ if( $("#td_pk1_1700").text() == params.mesas._pk1 && $("#td_pk1_1700").text() == params.horas._1700 ){ $("#td_pk1_1700").css("background-color", bg_all) }else{
                if( $("#td_pk1_1700").text() == params.horas._1700 && $("#td_pk1_1700").text() != params.mesas._pk1 ){ $("#td_pk1_1700").css("background-color", bg_hora) }
                if( $("#td_pk1_1700").text() == params.mesas._pk1 && $("#td_pk1_1700").text() != params.horas._1700 ){ $("#td_pk1_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_1800").text() > 0){ if( $("#td_pk1_1800").text() == params.mesas._pk1 && $("#td_pk1_1800").text() == params.horas._1800 ){ $("#td_pk1_1800").css("background-color", bg_all) }else{
                if( $("#td_pk1_1800").text() == params.horas._1800 && $("#td_pk1_1800").text() != params.mesas._pk1 ){ $("#td_pk1_1800").css("background-color", bg_hora) }
                if( $("#td_pk1_1800").text() == params.mesas._pk1 && $("#td_pk1_1800").text() != params.horas._1800 ){ $("#td_pk1_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_1900").text() > 0){ if( $("#td_pk1_1900").text() == params.mesas._pk1 && $("#td_pk1_1900").text() == params.horas._1900 ){ $("#td_pk1_1900").css("background-color", bg_all) }else{
                if( $("#td_pk1_1900").text() == params.horas._1900 && $("#td_pk1_1900").text() != params.mesas._pk1 ){ $("#td_pk1_1900").css("background-color", bg_hora) }
                if( $("#td_pk1_1900").text() == params.mesas._pk1 && $("#td_pk1_1900").text() != params.horas._1900 ){ $("#td_pk1_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_2000").text() > 0){ if( $("#td_pk1_2000").text() == params.mesas._pk1 && $("#td_pk1_2000").text() == params.horas._2000 ){ $("#td_pk1_2000").css("background-color", bg_all) }else{
                if( $("#td_pk1_2000").text() == params.horas._2000 && $("#td_pk1_2000").text() != params.mesas._pk1 ){ $("#td_pk1_2000").css("background-color", bg_hora) }
                if( $("#td_pk1_2000").text() == params.mesas._pk1 && $("#td_pk1_2000").text() != params.horas._2000 ){ $("#td_pk1_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_2100").text() > 0){ if( $("#td_pk1_2100").text() == params.mesas._pk1 && $("#td_pk1_2100").text() == params.horas._2100 ){ $("#td_pk1_2100").css("background-color", bg_all) }else{
                if( $("#td_pk1_2100").text() == params.horas._2100 && $("#td_pk1_2100").text() != params.mesas._pk1 ){ $("#td_pk1_2100").css("background-color", bg_hora) }
                if( $("#td_pk1_2100").text() == params.mesas._pk1 && $("#td_pk1_2100").text() != params.horas._2100 ){ $("#td_pk1_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_2200").text() > 0){ if( $("#td_pk1_2200").text() == params.mesas._pk1 && $("#td_pk1_2200").text() == params.horas._2200 ){ $("#td_pk1_2200").css("background-color", bg_all) }else{
                if( $("#td_pk1_2200").text() == params.horas._2200 && $("#td_pk1_2200").text() != params.mesas._pk1 ){ $("#td_pk1_2200").css("background-color", bg_hora) }
                if( $("#td_pk1_2200").text() == params.mesas._pk1 && $("#td_pk1_2200").text() != params.horas._2200 ){ $("#td_pk1_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_2300").text() > 0){ if( $("#td_pk1_2300").text() == params.mesas._pk1 && $("#td_pk1_2300").text() == params.horas._2300 ){ $("#td_pk1_2300").css("background-color", bg_all) }else{
                if( $("#td_pk1_2300").text() == params.horas._2300 && $("#td_pk1_2300").text() != params.mesas._pk1 ){ $("#td_pk1_2300").css("background-color", bg_hora) }
                if( $("#td_pk1_2300").text() == params.mesas._pk1 && $("#td_pk1_2300").text() != params.horas._2300 ){ $("#td_pk1_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_0000").text() > 0){ if( $("#td_pk1_0000").text() == params.mesas._pk1 && $("#td_pk1_0000").text() == params.horas._0000 ){ $("#td_pk1_0000").css("background-color", bg_all) }else{
                if( $("#td_pk1_0000").text() == params.horas._0000 && $("#td_pk1_0000").text() != params.mesas._pk1 ){ $("#td_pk1_0000").css("background-color", bg_hora) }
                if( $("#td_pk1_0000").text() == params.mesas._pk1 && $("#td_pk1_0000").text() != params.horas._0000 ){ $("#td_pk1_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_0100").text() > 0){ if( $("#td_pk1_0100").text() == params.mesas._pk1 && $("#td_pk1_0100").text() == params.horas._0100 ){ $("#td_pk1_0100").css("background-color", bg_all) }else{
                if( $("#td_pk1_0100").text() == params.horas._0100 && $("#td_pk1_0100").text() != params.mesas._pk1 ){ $("#td_pk1_0100").css("background-color", bg_hora) }
                if( $("#td_pk1_0100").text() == params.mesas._pk1 && $("#td_pk1_0100").text() != params.horas._0100 ){ $("#td_pk1_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_0200").text() > 0){ if( $("#td_pk1_0200").text() == params.mesas._pk1 && $("#td_pk1_0200").text() == params.horas._0200 ){ $("#td_pk1_0200").css("background-color", bg_all) }else{
                if( $("#td_pk1_0200").text() == params.horas._0200 && $("#td_pk1_0200").text() != params.mesas._pk1 ){ $("#td_pk1_0200").css("background-color", bg_hora) }
                if( $("#td_pk1_0200").text() == params.mesas._pk1 && $("#td_pk1_0200").text() != params.horas._0200 ){ $("#td_pk1_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_0300").text() > 0){ if( $("#td_pk1_0300").text() == params.mesas._pk1 && $("#td_pk1_0300").text() == params.horas._0300 ){ $("#td_pk1_0300").css("background-color", bg_all) }else{
                if( $("#td_pk1_0300").text() == params.horas._0300 && $("#td_pk1_0300").text() != params.mesas._pk1 ){ $("#td_pk1_0300").css("background-color", bg_hora) }
                if( $("#td_pk1_0300").text() == params.mesas._pk1 && $("#td_pk1_0300").text() != params.horas._0300 ){ $("#td_pk1_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_0400").text() > 0){ if( $("#td_pk1_0400").text() == params.mesas._pk1 && $("#td_pk1_0400").text() == params.horas._0400 ){ $("#td_pk1_0400").css("background-color", bg_all) }else{
                if( $("#td_pk1_0400").text() == params.horas._0400 && $("#td_pk1_0400").text() != params.mesas._pk1 ){ $("#td_pk1_0400").css("background-color", bg_hora) }
                if( $("#td_pk1_0400").text() == params.mesas._pk1 && $("#td_pk1_0400").text() != params.horas._0400 ){ $("#td_pk1_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk1_0500").text() > 0){ if( $("#td_pk1_0500").text() == params.mesas._pk1 && $("#td_pk1_0500").text() == params.horas._0500 ){ $("#td_pk1_0500").css("background-color", bg_all) }else{
                if( $("#td_pk1_0500").text() == params.horas._0500 && $("#td_pk1_0500").text() != params.mesas._pk1 ){ $("#td_pk1_0500").css("background-color", bg_hora) }
                if( $("#td_pk1_0500").text() == params.mesas._pk1 && $("#td_pk1_0500").text() != params.horas._0500 ){ $("#td_pk1_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pk2
        if($("#td_pk2_1400").text() > 0){ if( $("#td_pk2_1400").text() == params.mesas._pk2 && $("#td_pk2_1400").text() == params.horas._1400 ){ $("#td_pk2_1400").css("background-color", bg_all) }else{
                if( $("#td_pk2_1400").text() == params.horas._1400 && $("#td_pk2_1400").text() != params.mesas._pk2 ){ $("#td_pk2_1400").css("background-color", bg_hora) }
                if( $("#td_pk2_1400").text() == params.mesas._pk2 && $("#td_pk2_1400").text() != params.horas._1400 ){ $("#td_pk2_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_1500").text() > 0){ if( $("#td_pk2_1500").text() == params.mesas._pk2 && $("#td_pk2_1500").text() == params.horas._1500 ){ $("#td_pk2_1500").css("background-color", bg_all) }else{
                if( $("#td_pk2_1500").text() == params.horas._1500 && $("#td_pk2_1500").text() != params.mesas._pk2 ){ $("#td_pk2_1500").css("background-color", bg_hora) }
                if( $("#td_pk2_1500").text() == params.mesas._pk2 && $("#td_pk2_1500").text() != params.horas._1500 ){ $("#td_pk2_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_1600").text() > 0){ if( $("#td_pk2_1600").text() == params.mesas._pk2 && $("#td_pk2_1600").text() == params.horas._1600 ){ $("#td_pk2_1600").css("background-color", bg_all) }else{
                if( $("#td_pk2_1600").text() == params.horas._1600 && $("#td_pk2_1600").text() != params.mesas._pk2 ){ $("#td_pk2_1600").css("background-color", bg_hora) }
                if( $("#td_pk2_1600").text() == params.mesas._pk2 && $("#td_pk2_1600").text() != params.horas._1600 ){ $("#td_pk2_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_1700").text() > 0){ if( $("#td_pk2_1700").text() == params.mesas._pk2 && $("#td_pk2_1700").text() == params.horas._1700 ){ $("#td_pk2_1700").css("background-color", bg_all) }else{
                if( $("#td_pk2_1700").text() == params.horas._1700 && $("#td_pk2_1700").text() != params.mesas._pk2 ){ $("#td_pk2_1700").css("background-color", bg_hora) }
                if( $("#td_pk2_1700").text() == params.mesas._pk2 && $("#td_pk2_1700").text() != params.horas._1700 ){ $("#td_pk2_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_1800").text() > 0){ if( $("#td_pk2_1800").text() == params.mesas._pk2 && $("#td_pk2_1800").text() == params.horas._1800 ){ $("#td_pk2_1800").css("background-color", bg_all) }else{
                if( $("#td_pk2_1800").text() == params.horas._1800 && $("#td_pk2_1800").text() != params.mesas._pk2 ){ $("#td_pk2_1800").css("background-color", bg_hora) }
                if( $("#td_pk2_1800").text() == params.mesas._pk2 && $("#td_pk2_1800").text() != params.horas._1800 ){ $("#td_pk2_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_1900").text() > 0){ if( $("#td_pk2_1900").text() == params.mesas._pk2 && $("#td_pk2_1900").text() == params.horas._1900 ){ $("#td_pk2_1900").css("background-color", bg_all) }else{
                if( $("#td_pk2_1900").text() == params.horas._1900 && $("#td_pk2_1900").text() != params.mesas._pk2 ){ $("#td_pk2_1900").css("background-color", bg_hora) }
                if( $("#td_pk2_1900").text() == params.mesas._pk2 && $("#td_pk2_1900").text() != params.horas._1900 ){ $("#td_pk2_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_2000").text() > 0){ if( $("#td_pk2_2000").text() == params.mesas._pk2 && $("#td_pk2_2000").text() == params.horas._2000 ){ $("#td_pk2_2000").css("background-color", bg_all) }else{
                if( $("#td_pk2_2000").text() == params.horas._2000 && $("#td_pk2_2000").text() != params.mesas._pk2 ){ $("#td_pk2_2000").css("background-color", bg_hora) }
                if( $("#td_pk2_2000").text() == params.mesas._pk2 && $("#td_pk2_2000").text() != params.horas._2000 ){ $("#td_pk2_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_2100").text() > 0){ if( $("#td_pk2_2100").text() == params.mesas._pk2 && $("#td_pk2_2100").text() == params.horas._2100 ){ $("#td_pk2_2100").css("background-color", bg_all) }else{
                if( $("#td_pk2_2100").text() == params.horas._2100 && $("#td_pk2_2100").text() != params.mesas._pk2 ){ $("#td_pk2_2100").css("background-color", bg_hora) }
                if( $("#td_pk2_2100").text() == params.mesas._pk2 && $("#td_pk2_2100").text() != params.horas._2100 ){ $("#td_pk2_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_2200").text() > 0){ if( $("#td_pk2_2200").text() == params.mesas._pk2 && $("#td_pk2_2200").text() == params.horas._2200 ){ $("#td_pk2_2200").css("background-color", bg_all) }else{
                if( $("#td_pk2_2200").text() == params.horas._2200 && $("#td_pk2_2200").text() != params.mesas._pk2 ){ $("#td_pk2_2200").css("background-color", bg_hora) }
                if( $("#td_pk2_2200").text() == params.mesas._pk2 && $("#td_pk2_2200").text() != params.horas._2200 ){ $("#td_pk2_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_2300").text() > 0){ if( $("#td_pk2_2300").text() == params.mesas._pk2 && $("#td_pk2_2300").text() == params.horas._2300 ){ $("#td_pk2_2300").css("background-color", bg_all) }else{
                if( $("#td_pk2_2300").text() == params.horas._2300 && $("#td_pk2_2300").text() != params.mesas._pk2 ){ $("#td_pk2_2300").css("background-color", bg_hora) }
                if( $("#td_pk2_2300").text() == params.mesas._pk2 && $("#td_pk2_2300").text() != params.horas._2300 ){ $("#td_pk2_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_0000").text() > 0){ if( $("#td_pk2_0000").text() == params.mesas._pk2 && $("#td_pk2_0000").text() == params.horas._0000 ){ $("#td_pk2_0000").css("background-color", bg_all) }else{
                if( $("#td_pk2_0000").text() == params.horas._0000 && $("#td_pk2_0000").text() != params.mesas._pk2 ){ $("#td_pk2_0000").css("background-color", bg_hora) }
                if( $("#td_pk2_0000").text() == params.mesas._pk2 && $("#td_pk2_0000").text() != params.horas._0000 ){ $("#td_pk2_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_0100").text() > 0){ if( $("#td_pk2_0100").text() == params.mesas._pk2 && $("#td_pk2_0100").text() == params.horas._0100 ){ $("#td_pk2_0100").css("background-color", bg_all) }else{
                if( $("#td_pk2_0100").text() == params.horas._0100 && $("#td_pk2_0100").text() != params.mesas._pk2 ){ $("#td_pk2_0100").css("background-color", bg_hora) }
                if( $("#td_pk2_0100").text() == params.mesas._pk2 && $("#td_pk2_0100").text() != params.horas._0100 ){ $("#td_pk2_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_0200").text() > 0){ if( $("#td_pk2_0200").text() == params.mesas._pk2 && $("#td_pk2_0200").text() == params.horas._0200 ){ $("#td_pk2_0200").css("background-color", bg_all) }else{
                if( $("#td_pk2_0200").text() == params.horas._0200 && $("#td_pk2_0200").text() != params.mesas._pk2 ){ $("#td_pk2_0200").css("background-color", bg_hora) }
                if( $("#td_pk2_0200").text() == params.mesas._pk2 && $("#td_pk2_0200").text() != params.horas._0200 ){ $("#td_pk2_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_0300").text() > 0){ if( $("#td_pk2_0300").text() == params.mesas._pk2 && $("#td_pk2_0300").text() == params.horas._0300 ){ $("#td_pk2_0300").css("background-color", bg_all) }else{
                if( $("#td_pk2_0300").text() == params.horas._0300 && $("#td_pk2_0300").text() != params.mesas._pk2 ){ $("#td_pk2_0300").css("background-color", bg_hora) }
                if( $("#td_pk2_0300").text() == params.mesas._pk2 && $("#td_pk2_0300").text() != params.horas._0300 ){ $("#td_pk2_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_0400").text() > 0){ if( $("#td_pk2_0400").text() == params.mesas._pk2 && $("#td_pk2_0400").text() == params.horas._0400 ){ $("#td_pk2_0400").css("background-color", bg_all) }else{
                if( $("#td_pk2_0400").text() == params.horas._0400 && $("#td_pk2_0400").text() != params.mesas._pk2 ){ $("#td_pk2_0400").css("background-color", bg_hora) }
                if( $("#td_pk2_0400").text() == params.mesas._pk2 && $("#td_pk2_0400").text() != params.horas._0400 ){ $("#td_pk2_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk2_0500").text() > 0){ if( $("#td_pk2_0500").text() == params.mesas._pk2 && $("#td_pk2_0500").text() == params.horas._0500 ){ $("#td_pk2_0500").css("background-color", bg_all) }else{
                if( $("#td_pk2_0500").text() == params.horas._0500 && $("#td_pk2_0500").text() != params.mesas._pk2 ){ $("#td_pk2_0500").css("background-color", bg_hora) }
                if( $("#td_pk2_0500").text() == params.mesas._pk2 && $("#td_pk2_0500").text() != params.horas._0500 ){ $("#td_pk2_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pk3
        if($("#td_pk3_1400").text() > 0){ if( $("#td_pk3_1400").text() == params.mesas._pk3 && $("#td_pk3_1400").text() == params.horas._1400 ){ $("#td_pk3_1400").css("background-color", bg_all) }else{
                if( $("#td_pk3_1400").text() == params.horas._1400 && $("#td_pk3_1400").text() != params.mesas._pk3 ){ $("#td_pk3_1400").css("background-color", bg_hora) }
                if( $("#td_pk3_1400").text() == params.mesas._pk3 && $("#td_pk3_1400").text() != params.horas._1400 ){ $("#td_pk3_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_1500").text() > 0){ if( $("#td_pk3_1500").text() == params.mesas._pk3 && $("#td_pk3_1500").text() == params.horas._1500 ){ $("#td_pk3_1500").css("background-color", bg_all) }else{
                if( $("#td_pk3_1500").text() == params.horas._1500 && $("#td_pk3_1500").text() != params.mesas._pk3 ){ $("#td_pk3_1500").css("background-color", bg_hora) }
                if( $("#td_pk3_1500").text() == params.mesas._pk3 && $("#td_pk3_1500").text() != params.horas._1500 ){ $("#td_pk3_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_1600").text() > 0){ if( $("#td_pk3_1600").text() == params.mesas._pk3 && $("#td_pk3_1600").text() == params.horas._1600 ){ $("#td_pk3_1600").css("background-color", bg_all) }else{
                if( $("#td_pk3_1600").text() == params.horas._1600 && $("#td_pk3_1600").text() != params.mesas._pk3 ){ $("#td_pk3_1600").css("background-color", bg_hora) }
                if( $("#td_pk3_1600").text() == params.mesas._pk3 && $("#td_pk3_1600").text() != params.horas._1600 ){ $("#td_pk3_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_1700").text() > 0){ if( $("#td_pk3_1700").text() == params.mesas._pk3 && $("#td_pk3_1700").text() == params.horas._1700 ){ $("#td_pk3_1700").css("background-color", bg_all) }else{
                if( $("#td_pk3_1700").text() == params.horas._1700 && $("#td_pk3_1700").text() != params.mesas._pk3 ){ $("#td_pk3_1700").css("background-color", bg_hora) }
                if( $("#td_pk3_1700").text() == params.mesas._pk3 && $("#td_pk3_1700").text() != params.horas._1700 ){ $("#td_pk3_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_1800").text() > 0){ if( $("#td_pk3_1800").text() == params.mesas._pk3 && $("#td_pk3_1800").text() == params.horas._1800 ){ $("#td_pk3_1800").css("background-color", bg_all) }else{
                if( $("#td_pk3_1800").text() == params.horas._1800 && $("#td_pk3_1800").text() != params.mesas._pk3 ){ $("#td_pk3_1800").css("background-color", bg_hora) }
                if( $("#td_pk3_1800").text() == params.mesas._pk3 && $("#td_pk3_1800").text() != params.horas._1800 ){ $("#td_pk3_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_1900").text() > 0){ if( $("#td_pk3_1900").text() == params.mesas._pk3 && $("#td_pk3_1900").text() == params.horas._1900 ){ $("#td_pk3_1900").css("background-color", bg_all) }else{
                if( $("#td_pk3_1900").text() == params.horas._1900 && $("#td_pk3_1900").text() != params.mesas._pk3 ){ $("#td_pk3_1900").css("background-color", bg_hora) }
                if( $("#td_pk3_1900").text() == params.mesas._pk3 && $("#td_pk3_1900").text() != params.horas._1900 ){ $("#td_pk3_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_2000").text() > 0){ if( $("#td_pk3_2000").text() == params.mesas._pk3 && $("#td_pk3_2000").text() == params.horas._2000 ){ $("#td_pk3_2000").css("background-color", bg_all) }else{
                if( $("#td_pk3_2000").text() == params.horas._2000 && $("#td_pk3_2000").text() != params.mesas._pk3 ){ $("#td_pk3_2000").css("background-color", bg_hora) }
                if( $("#td_pk3_2000").text() == params.mesas._pk3 && $("#td_pk3_2000").text() != params.horas._2000 ){ $("#td_pk3_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_2100").text() > 0){ if( $("#td_pk3_2100").text() == params.mesas._pk3 && $("#td_pk3_2100").text() == params.horas._2100 ){ $("#td_pk3_2100").css("background-color", bg_all) }else{
                if( $("#td_pk3_2100").text() == params.horas._2100 && $("#td_pk3_2100").text() != params.mesas._pk3 ){ $("#td_pk3_2100").css("background-color", bg_hora) }
                if( $("#td_pk3_2100").text() == params.mesas._pk3 && $("#td_pk3_2100").text() != params.horas._2100 ){ $("#td_pk3_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_2200").text() > 0){ if( $("#td_pk3_2200").text() == params.mesas._pk3 && $("#td_pk3_2200").text() == params.horas._2200 ){ $("#td_pk3_2200").css("background-color", bg_all) }else{
                if( $("#td_pk3_2200").text() == params.horas._2200 && $("#td_pk3_2200").text() != params.mesas._pk3 ){ $("#td_pk3_2200").css("background-color", bg_hora) }
                if( $("#td_pk3_2200").text() == params.mesas._pk3 && $("#td_pk3_2200").text() != params.horas._2200 ){ $("#td_pk3_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_2300").text() > 0){ if( $("#td_pk3_2300").text() == params.mesas._pk3 && $("#td_pk3_2300").text() == params.horas._2300 ){ $("#td_pk3_2300").css("background-color", bg_all) }else{
                if( $("#td_pk3_2300").text() == params.horas._2300 && $("#td_pk3_2300").text() != params.mesas._pk3 ){ $("#td_pk3_2300").css("background-color", bg_hora) }
                if( $("#td_pk3_2300").text() == params.mesas._pk3 && $("#td_pk3_2300").text() != params.horas._2300 ){ $("#td_pk3_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_0000").text() > 0){ if( $("#td_pk3_0000").text() == params.mesas._pk3 && $("#td_pk3_0000").text() == params.horas._0000 ){ $("#td_pk3_0000").css("background-color", bg_all) }else{
                if( $("#td_pk3_0000").text() == params.horas._0000 && $("#td_pk3_0000").text() != params.mesas._pk3 ){ $("#td_pk3_0000").css("background-color", bg_hora) }
                if( $("#td_pk3_0000").text() == params.mesas._pk3 && $("#td_pk3_0000").text() != params.horas._0000 ){ $("#td_pk3_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_0100").text() > 0){ if( $("#td_pk3_0100").text() == params.mesas._pk3 && $("#td_pk3_0100").text() == params.horas._0100 ){ $("#td_pk3_0100").css("background-color", bg_all) }else{
                if( $("#td_pk3_0100").text() == params.horas._0100 && $("#td_pk3_0100").text() != params.mesas._pk3 ){ $("#td_pk3_0100").css("background-color", bg_hora) }
                if( $("#td_pk3_0100").text() == params.mesas._pk3 && $("#td_pk3_0100").text() != params.horas._0100 ){ $("#td_pk3_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_0200").text() > 0){ if( $("#td_pk3_0200").text() == params.mesas._pk3 && $("#td_pk3_0200").text() == params.horas._0200 ){ $("#td_pk3_0200").css("background-color", bg_all) }else{
                if( $("#td_pk3_0200").text() == params.horas._0200 && $("#td_pk3_0200").text() != params.mesas._pk3 ){ $("#td_pk3_0200").css("background-color", bg_hora) }
                if( $("#td_pk3_0200").text() == params.mesas._pk3 && $("#td_pk3_0200").text() != params.horas._0200 ){ $("#td_pk3_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_0300").text() > 0){ if( $("#td_pk3_0300").text() == params.mesas._pk3 && $("#td_pk3_0300").text() == params.horas._0300 ){ $("#td_pk3_0300").css("background-color", bg_all) }else{
                if( $("#td_pk3_0300").text() == params.horas._0300 && $("#td_pk3_0300").text() != params.mesas._pk3 ){ $("#td_pk3_0300").css("background-color", bg_hora) }
                if( $("#td_pk3_0300").text() == params.mesas._pk3 && $("#td_pk3_0300").text() != params.horas._0300 ){ $("#td_pk3_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_0400").text() > 0){ if( $("#td_pk3_0400").text() == params.mesas._pk3 && $("#td_pk3_0400").text() == params.horas._0400 ){ $("#td_pk3_0400").css("background-color", bg_all) }else{
                if( $("#td_pk3_0400").text() == params.horas._0400 && $("#td_pk3_0400").text() != params.mesas._pk3 ){ $("#td_pk3_0400").css("background-color", bg_hora) }
                if( $("#td_pk3_0400").text() == params.mesas._pk3 && $("#td_pk3_0400").text() != params.horas._0400 ){ $("#td_pk3_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pk3_0500").text() > 0){ if( $("#td_pk3_0500").text() == params.mesas._pk3 && $("#td_pk3_0500").text() == params.horas._0500 ){ $("#td_pk3_0500").css("background-color", bg_all) }else{
                if( $("#td_pk3_0500").text() == params.horas._0500 && $("#td_pk3_0500").text() != params.mesas._pk3 ){ $("#td_pk3_0500").css("background-color", bg_hora) }
                if( $("#td_pk3_0500").text() == params.mesas._pk3 && $("#td_pk3_0500").text() != params.horas._0500 ){ $("#td_pk3_0500").css("background-color", bg_mesa) }
            }
        }
        
        //bj1
        if($("#td_bj1_1400").text() > 0){ if( $("#td_bj1_1400").text() == params.mesas._bj1 && $("#td_bj1_1400").text() == params.horas._1400 ){ $("#td_bj1_1400").css("background-color", bg_all) }else{
                if( $("#td_bj1_1400").text() == params.horas._1400 && $("#td_bj1_1400").text() != params.mesas._bj1 ){ $("#td_bj1_1400").css("background-color", bg_hora) }
                if( $("#td_bj1_1400").text() == params.mesas._bj1 && $("#td_bj1_1400").text() != params.horas._1400 ){ $("#td_bj1_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_1500").text() > 0){ if( $("#td_bj1_1500").text() == params.mesas._bj1 && $("#td_bj1_1500").text() == params.horas._1500 ){ $("#td_bj1_1500").css("background-color", bg_all) }else{
                if( $("#td_bj1_1500").text() == params.horas._1500 && $("#td_bj1_1500").text() != params.mesas._bj1 ){ $("#td_bj1_1500").css("background-color", bg_hora) }
                if( $("#td_bj1_1500").text() == params.mesas._bj1 && $("#td_bj1_1500").text() != params.horas._1500 ){ $("#td_bj1_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_1600").text() > 0){ if( $("#td_bj1_1600").text() == params.mesas._bj1 && $("#td_bj1_1600").text() == params.horas._1600 ){ $("#td_bj1_1600").css("background-color", bg_all) }else{
                if( $("#td_bj1_1600").text() == params.horas._1600 && $("#td_bj1_1600").text() != params.mesas._bj1 ){ $("#td_bj1_1600").css("background-color", bg_hora) }
                if( $("#td_bj1_1600").text() == params.mesas._bj1 && $("#td_bj1_1600").text() != params.horas._1600 ){ $("#td_bj1_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_1700").text() > 0){ if( $("#td_bj1_1700").text() == params.mesas._bj1 && $("#td_bj1_1700").text() == params.horas._1700 ){ $("#td_bj1_1700").css("background-color", bg_all) }else{
                if( $("#td_bj1_1700").text() == params.horas._1700 && $("#td_bj1_1700").text() != params.mesas._bj1 ){ $("#td_bj1_1700").css("background-color", bg_hora) }
                if( $("#td_bj1_1700").text() == params.mesas._bj1 && $("#td_bj1_1700").text() != params.horas._1700 ){ $("#td_bj1_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_1800").text() > 0){ if( $("#td_bj1_1800").text() == params.mesas._bj1 && $("#td_bj1_1800").text() == params.horas._1800 ){ $("#td_bj1_1800").css("background-color", bg_all) }else{
                if( $("#td_bj1_1800").text() == params.horas._1800 && $("#td_bj1_1800").text() != params.mesas._bj1 ){ $("#td_bj1_1800").css("background-color", bg_hora) }
                if( $("#td_bj1_1800").text() == params.mesas._bj1 && $("#td_bj1_1800").text() != params.horas._1800 ){ $("#td_bj1_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_1900").text() > 0){ if( $("#td_bj1_1900").text() == params.mesas._bj1 && $("#td_bj1_1900").text() == params.horas._1900 ){ $("#td_bj1_1900").css("background-color", bg_all) }else{
                if( $("#td_bj1_1900").text() == params.horas._1900 && $("#td_bj1_1900").text() != params.mesas._bj1 ){ $("#td_bj1_1900").css("background-color", bg_hora) }
                if( $("#td_bj1_1900").text() == params.mesas._bj1 && $("#td_bj1_1900").text() != params.horas._1900 ){ $("#td_bj1_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_2000").text() > 0){ if( $("#td_bj1_2000").text() == params.mesas._bj1 && $("#td_bj1_2000").text() == params.horas._2000 ){ $("#td_bj1_2000").css("background-color", bg_all) }else{
                if( $("#td_bj1_2000").text() == params.horas._2000 && $("#td_bj1_2000").text() != params.mesas._bj1 ){ $("#td_bj1_2000").css("background-color", bg_hora) }
                if( $("#td_bj1_2000").text() == params.mesas._bj1 && $("#td_bj1_2000").text() != params.horas._2000 ){ $("#td_bj1_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_2100").text() > 0){ if( $("#td_bj1_2100").text() == params.mesas._bj1 && $("#td_bj1_2100").text() == params.horas._2100 ){ $("#td_bj1_2100").css("background-color", bg_all) }else{
                if( $("#td_bj1_2100").text() == params.horas._2100 && $("#td_bj1_2100").text() != params.mesas._bj1 ){ $("#td_bj1_2100").css("background-color", bg_hora) }
                if( $("#td_bj1_2100").text() == params.mesas._bj1 && $("#td_bj1_2100").text() != params.horas._2100 ){ $("#td_bj1_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_2200").text() > 0){ if( $("#td_bj1_2200").text() == params.mesas._bj1 && $("#td_bj1_2200").text() == params.horas._2200 ){ $("#td_bj1_2200").css("background-color", bg_all) }else{
                if( $("#td_bj1_2200").text() == params.horas._2200 && $("#td_bj1_2200").text() != params.mesas._bj1 ){ $("#td_bj1_2200").css("background-color", bg_hora) }
                if( $("#td_bj1_2200").text() == params.mesas._bj1 && $("#td_bj1_2200").text() != params.horas._2200 ){ $("#td_bj1_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_2300").text() > 0){ if( $("#td_bj1_2300").text() == params.mesas._bj1 && $("#td_bj1_2300").text() == params.horas._2300 ){ $("#td_bj1_2300").css("background-color", bg_all) }else{
                if( $("#td_bj1_2300").text() == params.horas._2300 && $("#td_bj1_2300").text() != params.mesas._bj1 ){ $("#td_bj1_2300").css("background-color", bg_hora) }
                if( $("#td_bj1_2300").text() == params.mesas._bj1 && $("#td_bj1_2300").text() != params.horas._2300 ){ $("#td_bj1_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_0000").text() > 0){ if( $("#td_bj1_0000").text() == params.mesas._bj1 && $("#td_bj1_0000").text() == params.horas._0000 ){ $("#td_bj1_0000").css("background-color", bg_all) }else{
                if( $("#td_bj1_0000").text() == params.horas._0000 && $("#td_bj1_0000").text() != params.mesas._bj1 ){ $("#td_bj1_0000").css("background-color", bg_hora) }
                if( $("#td_bj1_0000").text() == params.mesas._bj1 && $("#td_bj1_0000").text() != params.horas._0000 ){ $("#td_bj1_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_0100").text() > 0){ if( $("#td_bj1_0100").text() == params.mesas._bj1 && $("#td_bj1_0100").text() == params.horas._0100 ){ $("#td_bj1_0100").css("background-color", bg_all) }else{
                if( $("#td_bj1_0100").text() == params.horas._0100 && $("#td_bj1_0100").text() != params.mesas._bj1 ){ $("#td_bj1_0100").css("background-color", bg_hora) }
                if( $("#td_bj1_0100").text() == params.mesas._bj1 && $("#td_bj1_0100").text() != params.horas._0100 ){ $("#td_bj1_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_0200").text() > 0){ if( $("#td_bj1_0200").text() == params.mesas._bj1 && $("#td_bj1_0200").text() == params.horas._0200 ){ $("#td_bj1_0200").css("background-color", bg_all) }else{
                if( $("#td_bj1_0200").text() == params.horas._0200 && $("#td_bj1_0200").text() != params.mesas._bj1 ){ $("#td_bj1_0200").css("background-color", bg_hora) }
                if( $("#td_bj1_0200").text() == params.mesas._bj1 && $("#td_bj1_0200").text() != params.horas._0200 ){ $("#td_bj1_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_0300").text() > 0){ if( $("#td_bj1_0300").text() == params.mesas._bj1 && $("#td_bj1_0300").text() == params.horas._0300 ){ $("#td_bj1_0300").css("background-color", bg_all) }else{
                if( $("#td_bj1_0300").text() == params.horas._0300 && $("#td_bj1_0300").text() != params.mesas._bj1 ){ $("#td_bj1_0300").css("background-color", bg_hora) }
                if( $("#td_bj1_0300").text() == params.mesas._bj1 && $("#td_bj1_0300").text() != params.horas._0300 ){ $("#td_bj1_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_0400").text() > 0){ if( $("#td_bj1_0400").text() == params.mesas._bj1 && $("#td_bj1_0400").text() == params.horas._0400 ){ $("#td_bj1_0400").css("background-color", bg_all) }else{
                if( $("#td_bj1_0400").text() == params.horas._0400 && $("#td_bj1_0400").text() != params.mesas._bj1 ){ $("#td_bj1_0400").css("background-color", bg_hora) }
                if( $("#td_bj1_0400").text() == params.mesas._bj1 && $("#td_bj1_0400").text() != params.horas._0400 ){ $("#td_bj1_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj1_0500").text() > 0){ if( $("#td_bj1_0500").text() == params.mesas._bj1 && $("#td_bj1_0500").text() == params.horas._0500 ){ $("#td_bj1_0500").css("background-color", bg_all) }else{
                if( $("#td_bj1_0500").text() == params.horas._0500 && $("#td_bj1_0500").text() != params.mesas._bj1 ){ $("#td_bj1_0500").css("background-color", bg_hora) }
                if( $("#td_bj1_0500").text() == params.mesas._bj1 && $("#td_bj1_0500").text() != params.horas._0500 ){ $("#td_bj1_0500").css("background-color", bg_mesa) }
            }
        }
        
        //bj2
        if($("#td_bj2_1400").text() > 0){ if( $("#td_bj2_1400").text() == params.mesas._bj2 && $("#td_bj2_1400").text() == params.horas._1400 ){ $("#td_bj2_1400").css("background-color", bg_all) }else{
                if( $("#td_bj2_1400").text() == params.horas._1400 && $("#td_bj2_1400").text() != params.mesas._bj2 ){ $("#td_bj2_1400").css("background-color", bg_hora) }
                if( $("#td_bj2_1400").text() == params.mesas._bj2 && $("#td_bj2_1400").text() != params.horas._1400 ){ $("#td_bj2_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_1500").text() > 0){ if( $("#td_bj2_1500").text() == params.mesas._bj2 && $("#td_bj2_1500").text() == params.horas._1500 ){ $("#td_bj2_1500").css("background-color", bg_all) }else{
                if( $("#td_bj2_1500").text() == params.horas._1500 && $("#td_bj2_1500").text() != params.mesas._bj2 ){ $("#td_bj2_1500").css("background-color", bg_hora) }
                if( $("#td_bj2_1500").text() == params.mesas._bj2 && $("#td_bj2_1500").text() != params.horas._1500 ){ $("#td_bj2_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_1600").text() > 0){ if( $("#td_bj2_1600").text() == params.mesas._bj2 && $("#td_bj2_1600").text() == params.horas._1600 ){ $("#td_bj2_1600").css("background-color", bg_all) }else{
                if( $("#td_bj2_1600").text() == params.horas._1600 && $("#td_bj2_1600").text() != params.mesas._bj2 ){ $("#td_bj2_1600").css("background-color", bg_hora) }
                if( $("#td_bj2_1600").text() == params.mesas._bj2 && $("#td_bj2_1600").text() != params.horas._1600 ){ $("#td_bj2_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_1700").text() > 0){ if( $("#td_bj2_1700").text() == params.mesas._bj2 && $("#td_bj2_1700").text() == params.horas._1700 ){ $("#td_bj2_1700").css("background-color", bg_all) }else{
                if( $("#td_bj2_1700").text() == params.horas._1700 && $("#td_bj2_1700").text() != params.mesas._bj2 ){ $("#td_bj2_1700").css("background-color", bg_hora) }
                if( $("#td_bj2_1700").text() == params.mesas._bj2 && $("#td_bj2_1700").text() != params.horas._1700 ){ $("#td_bj2_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_1800").text() > 0){ if( $("#td_bj2_1800").text() == params.mesas._bj2 && $("#td_bj2_1800").text() == params.horas._1800 ){ $("#td_bj2_1800").css("background-color", bg_all) }else{
                if( $("#td_bj2_1800").text() == params.horas._1800 && $("#td_bj2_1800").text() != params.mesas._bj2 ){ $("#td_bj2_1800").css("background-color", bg_hora) }
                if( $("#td_bj2_1800").text() == params.mesas._bj2 && $("#td_bj2_1800").text() != params.horas._1800 ){ $("#td_bj2_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_1900").text() > 0){ if( $("#td_bj2_1900").text() == params.mesas._bj2 && $("#td_bj2_1900").text() == params.horas._1900 ){ $("#td_bj2_1900").css("background-color", bg_all) }else{
                if( $("#td_bj2_1900").text() == params.horas._1900 && $("#td_bj2_1900").text() != params.mesas._bj2 ){ $("#td_bj2_1900").css("background-color", bg_hora) }
                if( $("#td_bj2_1900").text() == params.mesas._bj2 && $("#td_bj2_1900").text() != params.horas._1900 ){ $("#td_bj2_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_2000").text() > 0){ if( $("#td_bj2_2000").text() == params.mesas._bj2 && $("#td_bj2_2000").text() == params.horas._2000 ){ $("#td_bj2_2000").css("background-color", bg_all) }else{
                if( $("#td_bj2_2000").text() == params.horas._2000 && $("#td_bj2_2000").text() != params.mesas._bj2 ){ $("#td_bj2_2000").css("background-color", bg_hora) }
                if( $("#td_bj2_2000").text() == params.mesas._bj2 && $("#td_bj2_2000").text() != params.horas._2000 ){ $("#td_bj2_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_2100").text() > 0){ if( $("#td_bj2_2100").text() == params.mesas._bj2 && $("#td_bj2_2100").text() == params.horas._2100 ){ $("#td_bj2_2100").css("background-color", bg_all) }else{
                if( $("#td_bj2_2100").text() == params.horas._2100 && $("#td_bj2_2100").text() != params.mesas._bj2 ){ $("#td_bj2_2100").css("background-color", bg_hora) }
                if( $("#td_bj2_2100").text() == params.mesas._bj2 && $("#td_bj2_2100").text() != params.horas._2100 ){ $("#td_bj2_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_2200").text() > 0){ if( $("#td_bj2_2200").text() == params.mesas._bj2 && $("#td_bj2_2200").text() == params.horas._2200 ){ $("#td_bj2_2200").css("background-color", bg_all) }else{
                if( $("#td_bj2_2200").text() == params.horas._2200 && $("#td_bj2_2200").text() != params.mesas._bj2 ){ $("#td_bj2_2200").css("background-color", bg_hora) }
                if( $("#td_bj2_2200").text() == params.mesas._bj2 && $("#td_bj2_2200").text() != params.horas._2200 ){ $("#td_bj2_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_2300").text() > 0){ if( $("#td_bj2_2300").text() == params.mesas._bj2 && $("#td_bj2_2300").text() == params.horas._2300 ){ $("#td_bj2_2300").css("background-color", bg_all) }else{
                if( $("#td_bj2_2300").text() == params.horas._2300 && $("#td_bj2_2300").text() != params.mesas._bj2 ){ $("#td_bj2_2300").css("background-color", bg_hora) }
                if( $("#td_bj2_2300").text() == params.mesas._bj2 && $("#td_bj2_2300").text() != params.horas._2300 ){ $("#td_bj2_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_0000").text() > 0){ if( $("#td_bj2_0000").text() == params.mesas._bj2 && $("#td_bj2_0000").text() == params.horas._0000 ){ $("#td_bj2_0000").css("background-color", bg_all) }else{
                if( $("#td_bj2_0000").text() == params.horas._0000 && $("#td_bj2_0000").text() != params.mesas._bj2 ){ $("#td_bj2_0000").css("background-color", bg_hora) }
                if( $("#td_bj2_0000").text() == params.mesas._bj2 && $("#td_bj2_0000").text() != params.horas._0000 ){ $("#td_bj2_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_0100").text() > 0){ if( $("#td_bj2_0100").text() == params.mesas._bj2 && $("#td_bj2_0100").text() == params.horas._0100 ){ $("#td_bj2_0100").css("background-color", bg_all) }else{
                if( $("#td_bj2_0100").text() == params.horas._0100 && $("#td_bj2_0100").text() != params.mesas._bj2 ){ $("#td_bj2_0100").css("background-color", bg_hora) }
                if( $("#td_bj2_0100").text() == params.mesas._bj2 && $("#td_bj2_0100").text() != params.horas._0100 ){ $("#td_bj2_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_0200").text() > 0){ if( $("#td_bj2_0200").text() == params.mesas._bj2 && $("#td_bj2_0200").text() == params.horas._0200 ){ $("#td_bj2_0200").css("background-color", bg_all) }else{
                if( $("#td_bj2_0200").text() == params.horas._0200 && $("#td_bj2_0200").text() != params.mesas._bj2 ){ $("#td_bj2_0200").css("background-color", bg_hora) }
                if( $("#td_bj2_0200").text() == params.mesas._bj2 && $("#td_bj2_0200").text() != params.horas._0200 ){ $("#td_bj2_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_0300").text() > 0){ if( $("#td_bj2_0300").text() == params.mesas._bj2 && $("#td_bj2_0300").text() == params.horas._0300 ){ $("#td_bj2_0300").css("background-color", bg_all) }else{
                if( $("#td_bj2_0300").text() == params.horas._0300 && $("#td_bj2_0300").text() != params.mesas._bj2 ){ $("#td_bj2_0300").css("background-color", bg_hora) }
                if( $("#td_bj2_0300").text() == params.mesas._bj2 && $("#td_bj2_0300").text() != params.horas._0300 ){ $("#td_bj2_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_0400").text() > 0){ if( $("#td_bj2_0400").text() == params.mesas._bj2 && $("#td_bj2_0400").text() == params.horas._0400 ){ $("#td_bj2_0400").css("background-color", bg_all) }else{
                if( $("#td_bj2_0400").text() == params.horas._0400 && $("#td_bj2_0400").text() != params.mesas._bj2 ){ $("#td_bj2_0400").css("background-color", bg_hora) }
                if( $("#td_bj2_0400").text() == params.mesas._bj2 && $("#td_bj2_0400").text() != params.horas._0400 ){ $("#td_bj2_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj2_0500").text() > 0){ if( $("#td_bj2_0500").text() == params.mesas._bj2 && $("#td_bj2_0500").text() == params.horas._0500 ){ $("#td_bj2_0500").css("background-color", bg_all) }else{
                if( $("#td_bj2_0500").text() == params.horas._0500 && $("#td_bj2_0500").text() != params.mesas._bj2 ){ $("#td_bj2_0500").css("background-color", bg_hora) }
                if( $("#td_bj2_0500").text() == params.mesas._bj2 && $("#td_bj2_0500").text() != params.horas._0500 ){ $("#td_bj2_0500").css("background-color", bg_mesa) }
            }
        }
        
        //bj3
        if($("#td_bj3_1400").text() > 0){ if( $("#td_bj3_1400").text() == params.mesas._bj3 && $("#td_bj3_1400").text() == params.horas._1400 ){ $("#td_bj3_1400").css("background-color", bg_all) }else{
                if( $("#td_bj3_1400").text() == params.horas._1400 && $("#td_bj3_1400").text() != params.mesas._bj3 ){ $("#td_bj3_1400").css("background-color", bg_hora) }
                if( $("#td_bj3_1400").text() == params.mesas._bj3 && $("#td_bj3_1400").text() != params.horas._1400 ){ $("#td_bj3_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_1500").text() > 0){ if( $("#td_bj3_1500").text() == params.mesas._bj3 && $("#td_bj3_1500").text() == params.horas._1500 ){ $("#td_bj3_1500").css("background-color", bg_all) }else{
                if( $("#td_bj3_1500").text() == params.horas._1500 && $("#td_bj3_1500").text() != params.mesas._bj3 ){ $("#td_bj3_1500").css("background-color", bg_hora) }
                if( $("#td_bj3_1500").text() == params.mesas._bj3 && $("#td_bj3_1500").text() != params.horas._1500 ){ $("#td_bj3_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_1600").text() > 0){ if( $("#td_bj3_1600").text() == params.mesas._bj3 && $("#td_bj3_1600").text() == params.horas._1600 ){ $("#td_bj3_1600").css("background-color", bg_all) }else{
                if( $("#td_bj3_1600").text() == params.horas._1600 && $("#td_bj3_1600").text() != params.mesas._bj3 ){ $("#td_bj3_1600").css("background-color", bg_hora) }
                if( $("#td_bj3_1600").text() == params.mesas._bj3 && $("#td_bj3_1600").text() != params.horas._1600 ){ $("#td_bj3_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_1700").text() > 0){ if( $("#td_bj3_1700").text() == params.mesas._bj3 && $("#td_bj3_1700").text() == params.horas._1700 ){ $("#td_bj3_1700").css("background-color", bg_all) }else{
                if( $("#td_bj3_1700").text() == params.horas._1700 && $("#td_bj3_1700").text() != params.mesas._bj3 ){ $("#td_bj3_1700").css("background-color", bg_hora) }
                if( $("#td_bj3_1700").text() == params.mesas._bj3 && $("#td_bj3_1700").text() != params.horas._1700 ){ $("#td_bj3_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_1800").text() > 0){ if( $("#td_bj3_1800").text() == params.mesas._bj3 && $("#td_bj3_1800").text() == params.horas._1800 ){ $("#td_bj3_1800").css("background-color", bg_all) }else{
                if( $("#td_bj3_1800").text() == params.horas._1800 && $("#td_bj3_1800").text() != params.mesas._bj3 ){ $("#td_bj3_1800").css("background-color", bg_hora) }
                if( $("#td_bj3_1800").text() == params.mesas._bj3 && $("#td_bj3_1800").text() != params.horas._1800 ){ $("#td_bj3_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_1900").text() > 0){ if( $("#td_bj3_1900").text() == params.mesas._bj3 && $("#td_bj3_1900").text() == params.horas._1900 ){ $("#td_bj3_1900").css("background-color", bg_all) }else{
                if( $("#td_bj3_1900").text() == params.horas._1900 && $("#td_bj3_1900").text() != params.mesas._bj3 ){ $("#td_bj3_1900").css("background-color", bg_hora) }
                if( $("#td_bj3_1900").text() == params.mesas._bj3 && $("#td_bj3_1900").text() != params.horas._1900 ){ $("#td_bj3_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_2000").text() > 0){ if( $("#td_bj3_2000").text() == params.mesas._bj3 && $("#td_bj3_2000").text() == params.horas._2000 ){ $("#td_bj3_2000").css("background-color", bg_all) }else{
                if( $("#td_bj3_2000").text() == params.horas._2000 && $("#td_bj3_2000").text() != params.mesas._bj3 ){ $("#td_bj3_2000").css("background-color", bg_hora) }
                if( $("#td_bj3_2000").text() == params.mesas._bj3 && $("#td_bj3_2000").text() != params.horas._2000 ){ $("#td_bj3_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_2100").text() > 0){ if( $("#td_bj3_2100").text() == params.mesas._bj3 && $("#td_bj3_2100").text() == params.horas._2100 ){ $("#td_bj3_2100").css("background-color", bg_all) }else{
                if( $("#td_bj3_2100").text() == params.horas._2100 && $("#td_bj3_2100").text() != params.mesas._bj3 ){ $("#td_bj3_2100").css("background-color", bg_hora) }
                if( $("#td_bj3_2100").text() == params.mesas._bj3 && $("#td_bj3_2100").text() != params.horas._2100 ){ $("#td_bj3_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_2200").text() > 0){ if( $("#td_bj3_2200").text() == params.mesas._bj3 && $("#td_bj3_2200").text() == params.horas._2200 ){ $("#td_bj3_2200").css("background-color", bg_all) }else{
                if( $("#td_bj3_2200").text() == params.horas._2200 && $("#td_bj3_2200").text() != params.mesas._bj3 ){ $("#td_bj3_2200").css("background-color", bg_hora) }
                if( $("#td_bj3_2200").text() == params.mesas._bj3 && $("#td_bj3_2200").text() != params.horas._2200 ){ $("#td_bj3_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_2300").text() > 0){ if( $("#td_bj3_2300").text() == params.mesas._bj3 && $("#td_bj3_2300").text() == params.horas._2300 ){ $("#td_bj3_2300").css("background-color", bg_all) }else{
                if( $("#td_bj3_2300").text() == params.horas._2300 && $("#td_bj3_2300").text() != params.mesas._bj3 ){ $("#td_bj3_2300").css("background-color", bg_hora) }
                if( $("#td_bj3_2300").text() == params.mesas._bj3 && $("#td_bj3_2300").text() != params.horas._2300 ){ $("#td_bj3_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_0000").text() > 0){ if( $("#td_bj3_0000").text() == params.mesas._bj3 && $("#td_bj3_0000").text() == params.horas._0000 ){ $("#td_bj3_0000").css("background-color", bg_all) }else{
                if( $("#td_bj3_0000").text() == params.horas._0000 && $("#td_bj3_0000").text() != params.mesas._bj3 ){ $("#td_bj3_0000").css("background-color", bg_hora) }
                if( $("#td_bj3_0000").text() == params.mesas._bj3 && $("#td_bj3_0000").text() != params.horas._0000 ){ $("#td_bj3_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_0100").text() > 0){ if( $("#td_bj3_0100").text() == params.mesas._bj3 && $("#td_bj3_0100").text() == params.horas._0100 ){ $("#td_bj3_0100").css("background-color", bg_all) }else{
                if( $("#td_bj3_0100").text() == params.horas._0100 && $("#td_bj3_0100").text() != params.mesas._bj3 ){ $("#td_bj3_0100").css("background-color", bg_hora) }
                if( $("#td_bj3_0100").text() == params.mesas._bj3 && $("#td_bj3_0100").text() != params.horas._0100 ){ $("#td_bj3_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_0200").text() > 0){ if( $("#td_bj3_0200").text() == params.mesas._bj3 && $("#td_bj3_0200").text() == params.horas._0200 ){ $("#td_bj3_0200").css("background-color", bg_all) }else{
                if( $("#td_bj3_0200").text() == params.horas._0200 && $("#td_bj3_0200").text() != params.mesas._bj3 ){ $("#td_bj3_0200").css("background-color", bg_hora) }
                if( $("#td_bj3_0200").text() == params.mesas._bj3 && $("#td_bj3_0200").text() != params.horas._0200 ){ $("#td_bj3_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_0300").text() > 0){ if( $("#td_bj3_0300").text() == params.mesas._bj3 && $("#td_bj3_0300").text() == params.horas._0300 ){ $("#td_bj3_0300").css("background-color", bg_all) }else{
                if( $("#td_bj3_0300").text() == params.horas._0300 && $("#td_bj3_0300").text() != params.mesas._bj3 ){ $("#td_bj3_0300").css("background-color", bg_hora) }
                if( $("#td_bj3_0300").text() == params.mesas._bj3 && $("#td_bj3_0300").text() != params.horas._0300 ){ $("#td_bj3_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_0400").text() > 0){ if( $("#td_bj3_0400").text() == params.mesas._bj3 && $("#td_bj3_0400").text() == params.horas._0400 ){ $("#td_bj3_0400").css("background-color", bg_all) }else{
                if( $("#td_bj3_0400").text() == params.horas._0400 && $("#td_bj3_0400").text() != params.mesas._bj3 ){ $("#td_bj3_0400").css("background-color", bg_hora) }
                if( $("#td_bj3_0400").text() == params.mesas._bj3 && $("#td_bj3_0400").text() != params.horas._0400 ){ $("#td_bj3_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_bj3_0500").text() > 0){ if( $("#td_bj3_0500").text() == params.mesas._bj3 && $("#td_bj3_0500").text() == params.horas._0500 ){ $("#td_bj3_0500").css("background-color", bg_all) }else{
                if( $("#td_bj3_0500").text() == params.horas._0500 && $("#td_bj3_0500").text() != params.mesas._bj3 ){ $("#td_bj3_0500").css("background-color", bg_hora) }
                if( $("#td_bj3_0500").text() == params.mesas._bj3 && $("#td_bj3_0500").text() != params.horas._0500 ){ $("#td_bj3_0500").css("background-color", bg_mesa) }
            }
        }
        
        //ra1
        if($("#td_ra1_1400").text() > 0){ if( $("#td_ra1_1400").text() == params.mesas._ra1 && $("#td_ra1_1400").text() == params.horas._1400 ){ $("#td_ra1_1400").css("background-color", bg_all) }else{
                if( $("#td_ra1_1400").text() == params.horas._1400 && $("#td_ra1_1400").text() != params.mesas._ra1 ){ $("#td_ra1_1400").css("background-color", bg_hora) }
                if( $("#td_ra1_1400").text() == params.mesas._ra1 && $("#td_ra1_1400").text() != params.horas._1400 ){ $("#td_ra1_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_1500").text() > 0){ if( $("#td_ra1_1500").text() == params.mesas._ra1 && $("#td_ra1_1500").text() == params.horas._1500 ){ $("#td_ra1_1500").css("background-color", bg_all) }else{
                if( $("#td_ra1_1500").text() == params.horas._1500 && $("#td_ra1_1500").text() != params.mesas._ra1 ){ $("#td_ra1_1500").css("background-color", bg_hora) }
                if( $("#td_ra1_1500").text() == params.mesas._ra1 && $("#td_ra1_1500").text() != params.horas._1500 ){ $("#td_ra1_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_1600").text() > 0){ if( $("#td_ra1_1600").text() == params.mesas._ra1 && $("#td_ra1_1600").text() == params.horas._1600 ){ $("#td_ra1_1600").css("background-color", bg_all) }else{
                if( $("#td_ra1_1600").text() == params.horas._1600 && $("#td_ra1_1600").text() != params.mesas._ra1 ){ $("#td_ra1_1600").css("background-color", bg_hora) }
                if( $("#td_ra1_1600").text() == params.mesas._ra1 && $("#td_ra1_1600").text() != params.horas._1600 ){ $("#td_ra1_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_1700").text() > 0){ if( $("#td_ra1_1700").text() == params.mesas._ra1 && $("#td_ra1_1700").text() == params.horas._1700 ){ $("#td_ra1_1700").css("background-color", bg_all) }else{
                if( $("#td_ra1_1700").text() == params.horas._1700 && $("#td_ra1_1700").text() != params.mesas._ra1 ){ $("#td_ra1_1700").css("background-color", bg_hora) }
                if( $("#td_ra1_1700").text() == params.mesas._ra1 && $("#td_ra1_1700").text() != params.horas._1700 ){ $("#td_ra1_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_1800").text() > 0){ if( $("#td_ra1_1800").text() == params.mesas._ra1 && $("#td_ra1_1800").text() == params.horas._1800 ){ $("#td_ra1_1800").css("background-color", bg_all) }else{
                if( $("#td_ra1_1800").text() == params.horas._1800 && $("#td_ra1_1800").text() != params.mesas._ra1 ){ $("#td_ra1_1800").css("background-color", bg_hora) }
                if( $("#td_ra1_1800").text() == params.mesas._ra1 && $("#td_ra1_1800").text() != params.horas._1800 ){ $("#td_ra1_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_1900").text() > 0){ if( $("#td_ra1_1900").text() == params.mesas._ra1 && $("#td_ra1_1900").text() == params.horas._1900 ){ $("#td_ra1_1900").css("background-color", bg_all) }else{
                if( $("#td_ra1_1900").text() == params.horas._1900 && $("#td_ra1_1900").text() != params.mesas._ra1 ){ $("#td_ra1_1900").css("background-color", bg_hora) }
                if( $("#td_ra1_1900").text() == params.mesas._ra1 && $("#td_ra1_1900").text() != params.horas._1900 ){ $("#td_ra1_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_2000").text() > 0){ if( $("#td_ra1_2000").text() == params.mesas._ra1 && $("#td_ra1_2000").text() == params.horas._2000 ){ $("#td_ra1_2000").css("background-color", bg_all) }else{
                if( $("#td_ra1_2000").text() == params.horas._2000 && $("#td_ra1_2000").text() != params.mesas._ra1 ){ $("#td_ra1_2000").css("background-color", bg_hora) }
                if( $("#td_ra1_2000").text() == params.mesas._ra1 && $("#td_ra1_2000").text() != params.horas._2000 ){ $("#td_ra1_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_2100").text() > 0){ if( $("#td_ra1_2100").text() == params.mesas._ra1 && $("#td_ra1_2100").text() == params.horas._2100 ){ $("#td_ra1_2100").css("background-color", bg_all) }else{
                if( $("#td_ra1_2100").text() == params.horas._2100 && $("#td_ra1_2100").text() != params.mesas._ra1 ){ $("#td_ra1_2100").css("background-color", bg_hora) }
                if( $("#td_ra1_2100").text() == params.mesas._ra1 && $("#td_ra1_2100").text() != params.horas._2100 ){ $("#td_ra1_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_2200").text() > 0){ if( $("#td_ra1_2200").text() == params.mesas._ra1 && $("#td_ra1_2200").text() == params.horas._2200 ){ $("#td_ra1_2200").css("background-color", bg_all) }else{
                if( $("#td_ra1_2200").text() == params.horas._2200 && $("#td_ra1_2200").text() != params.mesas._ra1 ){ $("#td_ra1_2200").css("background-color", bg_hora) }
                if( $("#td_ra1_2200").text() == params.mesas._ra1 && $("#td_ra1_2200").text() != params.horas._2200 ){ $("#td_ra1_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_2300").text() > 0){ if( $("#td_ra1_2300").text() == params.mesas._ra1 && $("#td_ra1_2300").text() == params.horas._2300 ){ $("#td_ra1_2300").css("background-color", bg_all) }else{
                if( $("#td_ra1_2300").text() == params.horas._2300 && $("#td_ra1_2300").text() != params.mesas._ra1 ){ $("#td_ra1_2300").css("background-color", bg_hora) }
                if( $("#td_ra1_2300").text() == params.mesas._ra1 && $("#td_ra1_2300").text() != params.horas._2300 ){ $("#td_ra1_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_0000").text() > 0){ if( $("#td_ra1_0000").text() == params.mesas._ra1 && $("#td_ra1_0000").text() == params.horas._0000 ){ $("#td_ra1_0000").css("background-color", bg_all) }else{
                if( $("#td_ra1_0000").text() == params.horas._0000 && $("#td_ra1_0000").text() != params.mesas._ra1 ){ $("#td_ra1_0000").css("background-color", bg_hora) }
                if( $("#td_ra1_0000").text() == params.mesas._ra1 && $("#td_ra1_0000").text() != params.horas._0000 ){ $("#td_ra1_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_0100").text() > 0){ if( $("#td_ra1_0100").text() == params.mesas._ra1 && $("#td_ra1_0100").text() == params.horas._0100 ){ $("#td_ra1_0100").css("background-color", bg_all) }else{
                if( $("#td_ra1_0100").text() == params.horas._0100 && $("#td_ra1_0100").text() != params.mesas._ra1 ){ $("#td_ra1_0100").css("background-color", bg_hora) }
                if( $("#td_ra1_0100").text() == params.mesas._ra1 && $("#td_ra1_0100").text() != params.horas._0100 ){ $("#td_ra1_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_0200").text() > 0){ if( $("#td_ra1_0200").text() == params.mesas._ra1 && $("#td_ra1_0200").text() == params.horas._0200 ){ $("#td_ra1_0200").css("background-color", bg_all) }else{
                if( $("#td_ra1_0200").text() == params.horas._0200 && $("#td_ra1_0200").text() != params.mesas._ra1 ){ $("#td_ra1_0200").css("background-color", bg_hora) }
                if( $("#td_ra1_0200").text() == params.mesas._ra1 && $("#td_ra1_0200").text() != params.horas._0200 ){ $("#td_ra1_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_0300").text() > 0){ if( $("#td_ra1_0300").text() == params.mesas._ra1 && $("#td_ra1_0300").text() == params.horas._0300 ){ $("#td_ra1_0300").css("background-color", bg_all) }else{
                if( $("#td_ra1_0300").text() == params.horas._0300 && $("#td_ra1_0300").text() != params.mesas._ra1 ){ $("#td_ra1_0300").css("background-color", bg_hora) }
                if( $("#td_ra1_0300").text() == params.mesas._ra1 && $("#td_ra1_0300").text() != params.horas._0300 ){ $("#td_ra1_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_0400").text() > 0){ if( $("#td_ra1_0400").text() == params.mesas._ra1 && $("#td_ra1_0400").text() == params.horas._0400 ){ $("#td_ra1_0400").css("background-color", bg_all) }else{
                if( $("#td_ra1_0400").text() == params.horas._0400 && $("#td_ra1_0400").text() != params.mesas._ra1 ){ $("#td_ra1_0400").css("background-color", bg_hora) }
                if( $("#td_ra1_0400").text() == params.mesas._ra1 && $("#td_ra1_0400").text() != params.horas._0400 ){ $("#td_ra1_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra1_0500").text() > 0){ if( $("#td_ra1_0500").text() == params.mesas._ra1 && $("#td_ra1_0500").text() == params.horas._0500 ){ $("#td_ra1_0500").css("background-color", bg_all) }else{
                if( $("#td_ra1_0500").text() == params.horas._0500 && $("#td_ra1_0500").text() != params.mesas._ra1 ){ $("#td_ra1_0500").css("background-color", bg_hora) }
                if( $("#td_ra1_0500").text() == params.mesas._ra1 && $("#td_ra1_0500").text() != params.horas._0500 ){ $("#td_ra1_0500").css("background-color", bg_mesa) }
            }
        }
        
        //ra2
        if($("#td_ra2_1400").text() > 0){ if( $("#td_ra2_1400").text() == params.mesas._ra2 && $("#td_ra2_1400").text() == params.horas._1400 ){ $("#td_ra2_1400").css("background-color", bg_all) }else{
                if( $("#td_ra2_1400").text() == params.horas._1400 && $("#td_ra2_1400").text() != params.mesas._ra2 ){ $("#td_ra2_1400").css("background-color", bg_hora) }
                if( $("#td_ra2_1400").text() == params.mesas._ra2 && $("#td_ra2_1400").text() != params.horas._1400 ){ $("#td_ra2_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_1500").text() > 0){ if( $("#td_ra2_1500").text() == params.mesas._ra2 && $("#td_ra2_1500").text() == params.horas._1500 ){ $("#td_ra2_1500").css("background-color", bg_all) }else{
                if( $("#td_ra2_1500").text() == params.horas._1500 && $("#td_ra2_1500").text() != params.mesas._ra2 ){ $("#td_ra2_1500").css("background-color", bg_hora) }
                if( $("#td_ra2_1500").text() == params.mesas._ra2 && $("#td_ra2_1500").text() != params.horas._1500 ){ $("#td_ra2_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_1600").text() > 0){ if( $("#td_ra2_1600").text() == params.mesas._ra2 && $("#td_ra2_1600").text() == params.horas._1600 ){ $("#td_ra2_1600").css("background-color", bg_all) }else{
                if( $("#td_ra2_1600").text() == params.horas._1600 && $("#td_ra2_1600").text() != params.mesas._ra2 ){ $("#td_ra2_1600").css("background-color", bg_hora) }
                if( $("#td_ra2_1600").text() == params.mesas._ra2 && $("#td_ra2_1600").text() != params.horas._1600 ){ $("#td_ra2_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_1700").text() > 0){ if( $("#td_ra2_1700").text() == params.mesas._ra2 && $("#td_ra2_1700").text() == params.horas._1700 ){ $("#td_ra2_1700").css("background-color", bg_all) }else{
                if( $("#td_ra2_1700").text() == params.horas._1700 && $("#td_ra2_1700").text() != params.mesas._ra2 ){ $("#td_ra2_1700").css("background-color", bg_hora) }
                if( $("#td_ra2_1700").text() == params.mesas._ra2 && $("#td_ra2_1700").text() != params.horas._1700 ){ $("#td_ra2_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_1800").text() > 0){ if( $("#td_ra2_1800").text() == params.mesas._ra2 && $("#td_ra2_1800").text() == params.horas._1800 ){ $("#td_ra2_1800").css("background-color", bg_all) }else{
                if( $("#td_ra2_1800").text() == params.horas._1800 && $("#td_ra2_1800").text() != params.mesas._ra2 ){ $("#td_ra2_1800").css("background-color", bg_hora) }
                if( $("#td_ra2_1800").text() == params.mesas._ra2 && $("#td_ra2_1800").text() != params.horas._1800 ){ $("#td_ra2_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_1900").text() > 0){ if( $("#td_ra2_1900").text() == params.mesas._ra2 && $("#td_ra2_1900").text() == params.horas._1900 ){ $("#td_ra2_1900").css("background-color", bg_all) }else{
                if( $("#td_ra2_1900").text() == params.horas._1900 && $("#td_ra2_1900").text() != params.mesas._ra2 ){ $("#td_ra2_1900").css("background-color", bg_hora) }
                if( $("#td_ra2_1900").text() == params.mesas._ra2 && $("#td_ra2_1900").text() != params.horas._1900 ){ $("#td_ra2_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_2000").text() > 0){ if( $("#td_ra2_2000").text() == params.mesas._ra2 && $("#td_ra2_2000").text() == params.horas._2000 ){ $("#td_ra2_2000").css("background-color", bg_all) }else{
                if( $("#td_ra2_2000").text() == params.horas._2000 && $("#td_ra2_2000").text() != params.mesas._ra2 ){ $("#td_ra2_2000").css("background-color", bg_hora) }
                if( $("#td_ra2_2000").text() == params.mesas._ra2 && $("#td_ra2_2000").text() != params.horas._2000 ){ $("#td_ra2_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_2100").text() > 0){ if( $("#td_ra2_2100").text() == params.mesas._ra2 && $("#td_ra2_2100").text() == params.horas._2100 ){ $("#td_ra2_2100").css("background-color", bg_all) }else{
                if( $("#td_ra2_2100").text() == params.horas._2100 && $("#td_ra2_2100").text() != params.mesas._ra2 ){ $("#td_ra2_2100").css("background-color", bg_hora) }
                if( $("#td_ra2_2100").text() == params.mesas._ra2 && $("#td_ra2_2100").text() != params.horas._2100 ){ $("#td_ra2_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_2200").text() > 0){ if( $("#td_ra2_2200").text() == params.mesas._ra2 && $("#td_ra2_2200").text() == params.horas._2200 ){ $("#td_ra2_2200").css("background-color", bg_all) }else{
                if( $("#td_ra2_2200").text() == params.horas._2200 && $("#td_ra2_2200").text() != params.mesas._ra2 ){ $("#td_ra2_2200").css("background-color", bg_hora) }
                if( $("#td_ra2_2200").text() == params.mesas._ra2 && $("#td_ra2_2200").text() != params.horas._2200 ){ $("#td_ra2_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_2300").text() > 0){ if( $("#td_ra2_2300").text() == params.mesas._ra2 && $("#td_ra2_2300").text() == params.horas._2300 ){ $("#td_ra2_2300").css("background-color", bg_all) }else{
                if( $("#td_ra2_2300").text() == params.horas._2300 && $("#td_ra2_2300").text() != params.mesas._ra2 ){ $("#td_ra2_2300").css("background-color", bg_hora) }
                if( $("#td_ra2_2300").text() == params.mesas._ra2 && $("#td_ra2_2300").text() != params.horas._2300 ){ $("#td_ra2_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_0000").text() > 0){ if( $("#td_ra2_0000").text() == params.mesas._ra2 && $("#td_ra2_0000").text() == params.horas._0000 ){ $("#td_ra2_0000").css("background-color", bg_all) }else{
                if( $("#td_ra2_0000").text() == params.horas._0000 && $("#td_ra2_0000").text() != params.mesas._ra2 ){ $("#td_ra2_0000").css("background-color", bg_hora) }
                if( $("#td_ra2_0000").text() == params.mesas._ra2 && $("#td_ra2_0000").text() != params.horas._0000 ){ $("#td_ra2_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_0100").text() > 0){ if( $("#td_ra2_0100").text() == params.mesas._ra2 && $("#td_ra2_0100").text() == params.horas._0100 ){ $("#td_ra2_0100").css("background-color", bg_all) }else{
                if( $("#td_ra2_0100").text() == params.horas._0100 && $("#td_ra2_0100").text() != params.mesas._ra2 ){ $("#td_ra2_0100").css("background-color", bg_hora) }
                if( $("#td_ra2_0100").text() == params.mesas._ra2 && $("#td_ra2_0100").text() != params.horas._0100 ){ $("#td_ra2_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_0200").text() > 0){ if( $("#td_ra2_0200").text() == params.mesas._ra2 && $("#td_ra2_0200").text() == params.horas._0200 ){ $("#td_ra2_0200").css("background-color", bg_all) }else{
                if( $("#td_ra2_0200").text() == params.horas._0200 && $("#td_ra2_0200").text() != params.mesas._ra2 ){ $("#td_ra2_0200").css("background-color", bg_hora) }
                if( $("#td_ra2_0200").text() == params.mesas._ra2 && $("#td_ra2_0200").text() != params.horas._0200 ){ $("#td_ra2_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_0300").text() > 0){ if( $("#td_ra2_0300").text() == params.mesas._ra2 && $("#td_ra2_0300").text() == params.horas._0300 ){ $("#td_ra2_0300").css("background-color", bg_all) }else{
                if( $("#td_ra2_0300").text() == params.horas._0300 && $("#td_ra2_0300").text() != params.mesas._ra2 ){ $("#td_ra2_0300").css("background-color", bg_hora) }
                if( $("#td_ra2_0300").text() == params.mesas._ra2 && $("#td_ra2_0300").text() != params.horas._0300 ){ $("#td_ra2_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_0400").text() > 0){ if( $("#td_ra2_0400").text() == params.mesas._ra2 && $("#td_ra2_0400").text() == params.horas._0400 ){ $("#td_ra2_0400").css("background-color", bg_all) }else{
                if( $("#td_ra2_0400").text() == params.horas._0400 && $("#td_ra2_0400").text() != params.mesas._ra2 ){ $("#td_ra2_0400").css("background-color", bg_hora) }
                if( $("#td_ra2_0400").text() == params.mesas._ra2 && $("#td_ra2_0400").text() != params.horas._0400 ){ $("#td_ra2_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra2_0500").text() > 0){ if( $("#td_ra2_0500").text() == params.mesas._ra2 && $("#td_ra2_0500").text() == params.horas._0500 ){ $("#td_ra2_0500").css("background-color", bg_all) }else{
                if( $("#td_ra2_0500").text() == params.horas._0500 && $("#td_ra2_0500").text() != params.mesas._ra2 ){ $("#td_ra2_0500").css("background-color", bg_hora) }
                if( $("#td_ra2_0500").text() == params.mesas._ra2 && $("#td_ra2_0500").text() != params.horas._0500 ){ $("#td_ra2_0500").css("background-color", bg_mesa) }
            }
        }
        
        //ra3
        if($("#td_ra3_1400").text() > 0){ if( $("#td_ra3_1400").text() == params.mesas._ra3 && $("#td_ra3_1400").text() == params.horas._1400 ){ $("#td_ra3_1400").css("background-color", bg_all) }else{
                if( $("#td_ra3_1400").text() == params.horas._1400 && $("#td_ra3_1400").text() != params.mesas._ra3 ){ $("#td_ra3_1400").css("background-color", bg_hora) }
                if( $("#td_ra3_1400").text() == params.mesas._ra3 && $("#td_ra3_1400").text() != params.horas._1400 ){ $("#td_ra3_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_1500").text() > 0){ if( $("#td_ra3_1500").text() == params.mesas._ra3 && $("#td_ra3_1500").text() == params.horas._1500 ){ $("#td_ra3_1500").css("background-color", bg_all) }else{
                if( $("#td_ra3_1500").text() == params.horas._1500 && $("#td_ra3_1500").text() != params.mesas._ra3 ){ $("#td_ra3_1500").css("background-color", bg_hora) }
                if( $("#td_ra3_1500").text() == params.mesas._ra3 && $("#td_ra3_1500").text() != params.horas._1500 ){ $("#td_ra3_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_1600").text() > 0){ if( $("#td_ra3_1600").text() == params.mesas._ra3 && $("#td_ra3_1600").text() == params.horas._1600 ){ $("#td_ra3_1600").css("background-color", bg_all) }else{
                if( $("#td_ra3_1600").text() == params.horas._1600 && $("#td_ra3_1600").text() != params.mesas._ra3 ){ $("#td_ra3_1600").css("background-color", bg_hora) }
                if( $("#td_ra3_1600").text() == params.mesas._ra3 && $("#td_ra3_1600").text() != params.horas._1600 ){ $("#td_ra3_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_1700").text() > 0){ if( $("#td_ra3_1700").text() == params.mesas._ra3 && $("#td_ra3_1700").text() == params.horas._1700 ){ $("#td_ra3_1700").css("background-color", bg_all) }else{
                if( $("#td_ra3_1700").text() == params.horas._1700 && $("#td_ra3_1700").text() != params.mesas._ra3 ){ $("#td_ra3_1700").css("background-color", bg_hora) }
                if( $("#td_ra3_1700").text() == params.mesas._ra3 && $("#td_ra3_1700").text() != params.horas._1700 ){ $("#td_ra3_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_1800").text() > 0){ if( $("#td_ra3_1800").text() == params.mesas._ra3 && $("#td_ra3_1800").text() == params.horas._1800 ){ $("#td_ra3_1800").css("background-color", bg_all) }else{
                if( $("#td_ra3_1800").text() == params.horas._1800 && $("#td_ra3_1800").text() != params.mesas._ra3 ){ $("#td_ra3_1800").css("background-color", bg_hora) }
                if( $("#td_ra3_1800").text() == params.mesas._ra3 && $("#td_ra3_1800").text() != params.horas._1800 ){ $("#td_ra3_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_1900").text() > 0){ if( $("#td_ra3_1900").text() == params.mesas._ra3 && $("#td_ra3_1900").text() == params.horas._1900 ){ $("#td_ra3_1900").css("background-color", bg_all) }else{
                if( $("#td_ra3_1900").text() == params.horas._1900 && $("#td_ra3_1900").text() != params.mesas._ra3 ){ $("#td_ra3_1900").css("background-color", bg_hora) }
                if( $("#td_ra3_1900").text() == params.mesas._ra3 && $("#td_ra3_1900").text() != params.horas._1900 ){ $("#td_ra3_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_2000").text() > 0){ if( $("#td_ra3_2000").text() == params.mesas._ra3 && $("#td_ra3_2000").text() == params.horas._2000 ){ $("#td_ra3_2000").css("background-color", bg_all) }else{
                if( $("#td_ra3_2000").text() == params.horas._2000 && $("#td_ra3_2000").text() != params.mesas._ra3 ){ $("#td_ra3_2000").css("background-color", bg_hora) }
                if( $("#td_ra3_2000").text() == params.mesas._ra3 && $("#td_ra3_2000").text() != params.horas._2000 ){ $("#td_ra3_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_2100").text() > 0){ if( $("#td_ra3_2100").text() == params.mesas._ra3 && $("#td_ra3_2100").text() == params.horas._2100 ){ $("#td_ra3_2100").css("background-color", bg_all) }else{
                if( $("#td_ra3_2100").text() == params.horas._2100 && $("#td_ra3_2100").text() != params.mesas._ra3 ){ $("#td_ra3_2100").css("background-color", bg_hora) }
                if( $("#td_ra3_2100").text() == params.mesas._ra3 && $("#td_ra3_2100").text() != params.horas._2100 ){ $("#td_ra3_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_2200").text() > 0){ if( $("#td_ra3_2200").text() == params.mesas._ra3 && $("#td_ra3_2200").text() == params.horas._2200 ){ $("#td_ra3_2200").css("background-color", bg_all) }else{
                if( $("#td_ra3_2200").text() == params.horas._2200 && $("#td_ra3_2200").text() != params.mesas._ra3 ){ $("#td_ra3_2200").css("background-color", bg_hora) }
                if( $("#td_ra3_2200").text() == params.mesas._ra3 && $("#td_ra3_2200").text() != params.horas._2200 ){ $("#td_ra3_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_2300").text() > 0){ if( $("#td_ra3_2300").text() == params.mesas._ra3 && $("#td_ra3_2300").text() == params.horas._2300 ){ $("#td_ra3_2300").css("background-color", bg_all) }else{
                if( $("#td_ra3_2300").text() == params.horas._2300 && $("#td_ra3_2300").text() != params.mesas._ra3 ){ $("#td_ra3_2300").css("background-color", bg_hora) }
                if( $("#td_ra3_2300").text() == params.mesas._ra3 && $("#td_ra3_2300").text() != params.horas._2300 ){ $("#td_ra3_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_0000").text() > 0){ if( $("#td_ra3_0000").text() == params.mesas._ra3 && $("#td_ra3_0000").text() == params.horas._0000 ){ $("#td_ra3_0000").css("background-color", bg_all) }else{
                if( $("#td_ra3_0000").text() == params.horas._0000 && $("#td_ra3_0000").text() != params.mesas._ra3 ){ $("#td_ra3_0000").css("background-color", bg_hora) }
                if( $("#td_ra3_0000").text() == params.mesas._ra3 && $("#td_ra3_0000").text() != params.horas._0000 ){ $("#td_ra3_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_0100").text() > 0){ if( $("#td_ra3_0100").text() == params.mesas._ra3 && $("#td_ra3_0100").text() == params.horas._0100 ){ $("#td_ra3_0100").css("background-color", bg_all) }else{
                if( $("#td_ra3_0100").text() == params.horas._0100 && $("#td_ra3_0100").text() != params.mesas._ra3 ){ $("#td_ra3_0100").css("background-color", bg_hora) }
                if( $("#td_ra3_0100").text() == params.mesas._ra3 && $("#td_ra3_0100").text() != params.horas._0100 ){ $("#td_ra3_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_0200").text() > 0){ if( $("#td_ra3_0200").text() == params.mesas._ra3 && $("#td_ra3_0200").text() == params.horas._0200 ){ $("#td_ra3_0200").css("background-color", bg_all) }else{
                if( $("#td_ra3_0200").text() == params.horas._0200 && $("#td_ra3_0200").text() != params.mesas._ra3 ){ $("#td_ra3_0200").css("background-color", bg_hora) }
                if( $("#td_ra3_0200").text() == params.mesas._ra3 && $("#td_ra3_0200").text() != params.horas._0200 ){ $("#td_ra3_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_0300").text() > 0){ if( $("#td_ra3_0300").text() == params.mesas._ra3 && $("#td_ra3_0300").text() == params.horas._0300 ){ $("#td_ra3_0300").css("background-color", bg_all) }else{
                if( $("#td_ra3_0300").text() == params.horas._0300 && $("#td_ra3_0300").text() != params.mesas._ra3 ){ $("#td_ra3_0300").css("background-color", bg_hora) }
                if( $("#td_ra3_0300").text() == params.mesas._ra3 && $("#td_ra3_0300").text() != params.horas._0300 ){ $("#td_ra3_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_0400").text() > 0){ if( $("#td_ra3_0400").text() == params.mesas._ra3 && $("#td_ra3_0400").text() == params.horas._0400 ){ $("#td_ra3_0400").css("background-color", bg_all) }else{
                if( $("#td_ra3_0400").text() == params.horas._0400 && $("#td_ra3_0400").text() != params.mesas._ra3 ){ $("#td_ra3_0400").css("background-color", bg_hora) }
                if( $("#td_ra3_0400").text() == params.mesas._ra3 && $("#td_ra3_0400").text() != params.horas._0400 ){ $("#td_ra3_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra3_0500").text() > 0){ if( $("#td_ra3_0500").text() == params.mesas._ra3 && $("#td_ra3_0500").text() == params.horas._0500 ){ $("#td_ra3_0500").css("background-color", bg_all) }else{
                if( $("#td_ra3_0500").text() == params.horas._0500 && $("#td_ra3_0500").text() != params.mesas._ra3 ){ $("#td_ra3_0500").css("background-color", bg_hora) }
                if( $("#td_ra3_0500").text() == params.mesas._ra3 && $("#td_ra3_0500").text() != params.horas._0500 ){ $("#td_ra3_0500").css("background-color", bg_mesa) }
            }
        }
        
        //ra4
        if($("#td_ra4_1400").text() > 0){ if( $("#td_ra4_1400").text() == params.mesas._ra4 && $("#td_ra4_1400").text() == params.horas._1400 ){ $("#td_ra4_1400").css("background-color", bg_all) }else{
                if( $("#td_ra4_1400").text() == params.horas._1400 && $("#td_ra4_1400").text() != params.mesas._ra4 ){ $("#td_ra4_1400").css("background-color", bg_hora) }
                if( $("#td_ra4_1400").text() == params.mesas._ra4 && $("#td_ra4_1400").text() != params.horas._1400 ){ $("#td_ra4_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_1500").text() > 0){ if( $("#td_ra4_1500").text() == params.mesas._ra4 && $("#td_ra4_1500").text() == params.horas._1500 ){ $("#td_ra4_1500").css("background-color", bg_all) }else{
                if( $("#td_ra4_1500").text() == params.horas._1500 && $("#td_ra4_1500").text() != params.mesas._ra4 ){ $("#td_ra4_1500").css("background-color", bg_hora) }
                if( $("#td_ra4_1500").text() == params.mesas._ra4 && $("#td_ra4_1500").text() != params.horas._1500 ){ $("#td_ra4_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_1600").text() > 0){ if( $("#td_ra4_1600").text() == params.mesas._ra4 && $("#td_ra4_1600").text() == params.horas._1600 ){ $("#td_ra4_1600").css("background-color", bg_all) }else{
                if( $("#td_ra4_1600").text() == params.horas._1600 && $("#td_ra4_1600").text() != params.mesas._ra4 ){ $("#td_ra4_1600").css("background-color", bg_hora) }
                if( $("#td_ra4_1600").text() == params.mesas._ra4 && $("#td_ra4_1600").text() != params.horas._1600 ){ $("#td_ra4_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_1700").text() > 0){ if( $("#td_ra4_1700").text() == params.mesas._ra4 && $("#td_ra4_1700").text() == params.horas._1700 ){ $("#td_ra4_1700").css("background-color", bg_all) }else{
                if( $("#td_ra4_1700").text() == params.horas._1700 && $("#td_ra4_1700").text() != params.mesas._ra4 ){ $("#td_ra4_1700").css("background-color", bg_hora) }
                if( $("#td_ra4_1700").text() == params.mesas._ra4 && $("#td_ra4_1700").text() != params.horas._1700 ){ $("#td_ra4_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_1800").text() > 0){ if( $("#td_ra4_1800").text() == params.mesas._ra4 && $("#td_ra4_1800").text() == params.horas._1800 ){ $("#td_ra4_1800").css("background-color", bg_all) }else{
                if( $("#td_ra4_1800").text() == params.horas._1800 && $("#td_ra4_1800").text() != params.mesas._ra4 ){ $("#td_ra4_1800").css("background-color", bg_hora) }
                if( $("#td_ra4_1800").text() == params.mesas._ra4 && $("#td_ra4_1800").text() != params.horas._1800 ){ $("#td_ra4_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_1900").text() > 0){ if( $("#td_ra4_1900").text() == params.mesas._ra4 && $("#td_ra4_1900").text() == params.horas._1900 ){ $("#td_ra4_1900").css("background-color", bg_all) }else{
                if( $("#td_ra4_1900").text() == params.horas._1900 && $("#td_ra4_1900").text() != params.mesas._ra4 ){ $("#td_ra4_1900").css("background-color", bg_hora) }
                if( $("#td_ra4_1900").text() == params.mesas._ra4 && $("#td_ra4_1900").text() != params.horas._1900 ){ $("#td_ra4_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_2000").text() > 0){ if( $("#td_ra4_2000").text() == params.mesas._ra4 && $("#td_ra4_2000").text() == params.horas._2000 ){ $("#td_ra4_2000").css("background-color", bg_all) }else{
                if( $("#td_ra4_2000").text() == params.horas._2000 && $("#td_ra4_2000").text() != params.mesas._ra4 ){ $("#td_ra4_2000").css("background-color", bg_hora) }
                if( $("#td_ra4_2000").text() == params.mesas._ra4 && $("#td_ra4_2000").text() != params.horas._2000 ){ $("#td_ra4_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_2100").text() > 0){ if( $("#td_ra4_2100").text() == params.mesas._ra4 && $("#td_ra4_2100").text() == params.horas._2100 ){ $("#td_ra4_2100").css("background-color", bg_all) }else{
                if( $("#td_ra4_2100").text() == params.horas._2100 && $("#td_ra4_2100").text() != params.mesas._ra4 ){ $("#td_ra4_2100").css("background-color", bg_hora) }
                if( $("#td_ra4_2100").text() == params.mesas._ra4 && $("#td_ra4_2100").text() != params.horas._2100 ){ $("#td_ra4_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_2200").text() > 0){ if( $("#td_ra4_2200").text() == params.mesas._ra4 && $("#td_ra4_2200").text() == params.horas._2200 ){ $("#td_ra4_2200").css("background-color", bg_all) }else{
                if( $("#td_ra4_2200").text() == params.horas._2200 && $("#td_ra4_2200").text() != params.mesas._ra4 ){ $("#td_ra4_2200").css("background-color", bg_hora) }
                if( $("#td_ra4_2200").text() == params.mesas._ra4 && $("#td_ra4_2200").text() != params.horas._2200 ){ $("#td_ra4_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_2300").text() > 0){ if( $("#td_ra4_2300").text() == params.mesas._ra4 && $("#td_ra4_2300").text() == params.horas._2300 ){ $("#td_ra4_2300").css("background-color", bg_all) }else{
                if( $("#td_ra4_2300").text() == params.horas._2300 && $("#td_ra4_2300").text() != params.mesas._ra4 ){ $("#td_ra4_2300").css("background-color", bg_hora) }
                if( $("#td_ra4_2300").text() == params.mesas._ra4 && $("#td_ra4_2300").text() != params.horas._2300 ){ $("#td_ra4_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_0000").text() > 0){ if( $("#td_ra4_0000").text() == params.mesas._ra4 && $("#td_ra4_0000").text() == params.horas._0000 ){ $("#td_ra4_0000").css("background-color", bg_all) }else{
                if( $("#td_ra4_0000").text() == params.horas._0000 && $("#td_ra4_0000").text() != params.mesas._ra4 ){ $("#td_ra4_0000").css("background-color", bg_hora) }
                if( $("#td_ra4_0000").text() == params.mesas._ra4 && $("#td_ra4_0000").text() != params.horas._0000 ){ $("#td_ra4_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_0100").text() > 0){ if( $("#td_ra4_0100").text() == params.mesas._ra4 && $("#td_ra4_0100").text() == params.horas._0100 ){ $("#td_ra4_0100").css("background-color", bg_all) }else{
                if( $("#td_ra4_0100").text() == params.horas._0100 && $("#td_ra4_0100").text() != params.mesas._ra4 ){ $("#td_ra4_0100").css("background-color", bg_hora) }
                if( $("#td_ra4_0100").text() == params.mesas._ra4 && $("#td_ra4_0100").text() != params.horas._0100 ){ $("#td_ra4_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_0200").text() > 0){ if( $("#td_ra4_0200").text() == params.mesas._ra4 && $("#td_ra4_0200").text() == params.horas._0200 ){ $("#td_ra4_0200").css("background-color", bg_all) }else{
                if( $("#td_ra4_0200").text() == params.horas._0200 && $("#td_ra4_0200").text() != params.mesas._ra4 ){ $("#td_ra4_0200").css("background-color", bg_hora) }
                if( $("#td_ra4_0200").text() == params.mesas._ra4 && $("#td_ra4_0200").text() != params.horas._0200 ){ $("#td_ra4_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_0300").text() > 0){ if( $("#td_ra4_0300").text() == params.mesas._ra4 && $("#td_ra4_0300").text() == params.horas._0300 ){ $("#td_ra4_0300").css("background-color", bg_all) }else{
                if( $("#td_ra4_0300").text() == params.horas._0300 && $("#td_ra4_0300").text() != params.mesas._ra4 ){ $("#td_ra4_0300").css("background-color", bg_hora) }
                if( $("#td_ra4_0300").text() == params.mesas._ra4 && $("#td_ra4_0300").text() != params.horas._0300 ){ $("#td_ra4_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_0400").text() > 0){ if( $("#td_ra4_0400").text() == params.mesas._ra4 && $("#td_ra4_0400").text() == params.horas._0400 ){ $("#td_ra4_0400").css("background-color", bg_all) }else{
                if( $("#td_ra4_0400").text() == params.horas._0400 && $("#td_ra4_0400").text() != params.mesas._ra4 ){ $("#td_ra4_0400").css("background-color", bg_hora) }
                if( $("#td_ra4_0400").text() == params.mesas._ra4 && $("#td_ra4_0400").text() != params.horas._0400 ){ $("#td_ra4_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_ra4_0500").text() > 0){ if( $("#td_ra4_0500").text() == params.mesas._ra4 && $("#td_ra4_0500").text() == params.horas._0500 ){ $("#td_ra4_0500").css("background-color", bg_all) }else{
                if( $("#td_ra4_0500").text() == params.horas._0500 && $("#td_ra4_0500").text() != params.mesas._ra4 ){ $("#td_ra4_0500").css("background-color", bg_hora) }
                if( $("#td_ra4_0500").text() == params.mesas._ra4 && $("#td_ra4_0500").text() != params.horas._0500 ){ $("#td_ra4_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pb1
        if($("#td_pb1_1400").text() > 0){ if( $("#td_pb1_1400").text() == params.mesas._pb1 && $("#td_pb1_1400").text() == params.horas._1400 ){ $("#td_pb1_1400").css("background-color", bg_all) }else{
                if( $("#td_pb1_1400").text() == params.horas._1400 && $("#td_pb1_1400").text() != params.mesas._pb1 ){ $("#td_pb1_1400").css("background-color", bg_hora) }
                if( $("#td_pb1_1400").text() == params.mesas._pb1 && $("#td_pb1_1400").text() != params.horas._1400 ){ $("#td_pb1_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_1500").text() > 0){ if( $("#td_pb1_1500").text() == params.mesas._pb1 && $("#td_pb1_1500").text() == params.horas._1500 ){ $("#td_pb1_1500").css("background-color", bg_all) }else{
                if( $("#td_pb1_1500").text() == params.horas._1500 && $("#td_pb1_1500").text() != params.mesas._pb1 ){ $("#td_pb1_1500").css("background-color", bg_hora) }
                if( $("#td_pb1_1500").text() == params.mesas._pb1 && $("#td_pb1_1500").text() != params.horas._1500 ){ $("#td_pb1_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_1600").text() > 0){ if( $("#td_pb1_1600").text() == params.mesas._pb1 && $("#td_pb1_1600").text() == params.horas._1600 ){ $("#td_pb1_1600").css("background-color", bg_all) }else{
                if( $("#td_pb1_1600").text() == params.horas._1600 && $("#td_pb1_1600").text() != params.mesas._pb1 ){ $("#td_pb1_1600").css("background-color", bg_hora) }
                if( $("#td_pb1_1600").text() == params.mesas._pb1 && $("#td_pb1_1600").text() != params.horas._1600 ){ $("#td_pb1_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_1700").text() > 0){ if( $("#td_pb1_1700").text() == params.mesas._pb1 && $("#td_pb1_1700").text() == params.horas._1700 ){ $("#td_pb1_1700").css("background-color", bg_all) }else{
                if( $("#td_pb1_1700").text() == params.horas._1700 && $("#td_pb1_1700").text() != params.mesas._pb1 ){ $("#td_pb1_1700").css("background-color", bg_hora) }
                if( $("#td_pb1_1700").text() == params.mesas._pb1 && $("#td_pb1_1700").text() != params.horas._1700 ){ $("#td_pb1_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_1800").text() > 0){ if( $("#td_pb1_1800").text() == params.mesas._pb1 && $("#td_pb1_1800").text() == params.horas._1800 ){ $("#td_pb1_1800").css("background-color", bg_all) }else{
                if( $("#td_pb1_1800").text() == params.horas._1800 && $("#td_pb1_1800").text() != params.mesas._pb1 ){ $("#td_pb1_1800").css("background-color", bg_hora) }
                if( $("#td_pb1_1800").text() == params.mesas._pb1 && $("#td_pb1_1800").text() != params.horas._1800 ){ $("#td_pb1_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_1900").text() > 0){ if( $("#td_pb1_1900").text() == params.mesas._pb1 && $("#td_pb1_1900").text() == params.horas._1900 ){ $("#td_pb1_1900").css("background-color", bg_all) }else{
                if( $("#td_pb1_1900").text() == params.horas._1900 && $("#td_pb1_1900").text() != params.mesas._pb1 ){ $("#td_pb1_1900").css("background-color", bg_hora) }
                if( $("#td_pb1_1900").text() == params.mesas._pb1 && $("#td_pb1_1900").text() != params.horas._1900 ){ $("#td_pb1_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_2000").text() > 0){ if( $("#td_pb1_2000").text() == params.mesas._pb1 && $("#td_pb1_2000").text() == params.horas._2000 ){ $("#td_pb1_2000").css("background-color", bg_all) }else{
                if( $("#td_pb1_2000").text() == params.horas._2000 && $("#td_pb1_2000").text() != params.mesas._pb1 ){ $("#td_pb1_2000").css("background-color", bg_hora) }
                if( $("#td_pb1_2000").text() == params.mesas._pb1 && $("#td_pb1_2000").text() != params.horas._2000 ){ $("#td_pb1_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_2100").text() > 0){ if( $("#td_pb1_2100").text() == params.mesas._pb1 && $("#td_pb1_2100").text() == params.horas._2100 ){ $("#td_pb1_2100").css("background-color", bg_all) }else{
                if( $("#td_pb1_2100").text() == params.horas._2100 && $("#td_pb1_2100").text() != params.mesas._pb1 ){ $("#td_pb1_2100").css("background-color", bg_hora) }
                if( $("#td_pb1_2100").text() == params.mesas._pb1 && $("#td_pb1_2100").text() != params.horas._2100 ){ $("#td_pb1_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_2200").text() > 0){ if( $("#td_pb1_2200").text() == params.mesas._pb1 && $("#td_pb1_2200").text() == params.horas._2200 ){ $("#td_pb1_2200").css("background-color", bg_all) }else{
                if( $("#td_pb1_2200").text() == params.horas._2200 && $("#td_pb1_2200").text() != params.mesas._pb1 ){ $("#td_pb1_2200").css("background-color", bg_hora) }
                if( $("#td_pb1_2200").text() == params.mesas._pb1 && $("#td_pb1_2200").text() != params.horas._2200 ){ $("#td_pb1_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_2300").text() > 0){ if( $("#td_pb1_2300").text() == params.mesas._pb1 && $("#td_pb1_2300").text() == params.horas._2300 ){ $("#td_pb1_2300").css("background-color", bg_all) }else{
                if( $("#td_pb1_2300").text() == params.horas._2300 && $("#td_pb1_2300").text() != params.mesas._pb1 ){ $("#td_pb1_2300").css("background-color", bg_hora) }
                if( $("#td_pb1_2300").text() == params.mesas._pb1 && $("#td_pb1_2300").text() != params.horas._2300 ){ $("#td_pb1_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_0000").text() > 0){ if( $("#td_pb1_0000").text() == params.mesas._pb1 && $("#td_pb1_0000").text() == params.horas._0000 ){ $("#td_pb1_0000").css("background-color", bg_all) }else{
                if( $("#td_pb1_0000").text() == params.horas._0000 && $("#td_pb1_0000").text() != params.mesas._pb1 ){ $("#td_pb1_0000").css("background-color", bg_hora) }
                if( $("#td_pb1_0000").text() == params.mesas._pb1 && $("#td_pb1_0000").text() != params.horas._0000 ){ $("#td_pb1_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_0100").text() > 0){ if( $("#td_pb1_0100").text() == params.mesas._pb1 && $("#td_pb1_0100").text() == params.horas._0100 ){ $("#td_pb1_0100").css("background-color", bg_all) }else{
                if( $("#td_pb1_0100").text() == params.horas._0100 && $("#td_pb1_0100").text() != params.mesas._pb1 ){ $("#td_pb1_0100").css("background-color", bg_hora) }
                if( $("#td_pb1_0100").text() == params.mesas._pb1 && $("#td_pb1_0100").text() != params.horas._0100 ){ $("#td_pb1_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_0200").text() > 0){ if( $("#td_pb1_0200").text() == params.mesas._pb1 && $("#td_pb1_0200").text() == params.horas._0200 ){ $("#td_pb1_0200").css("background-color", bg_all) }else{
                if( $("#td_pb1_0200").text() == params.horas._0200 && $("#td_pb1_0200").text() != params.mesas._pb1 ){ $("#td_pb1_0200").css("background-color", bg_hora) }
                if( $("#td_pb1_0200").text() == params.mesas._pb1 && $("#td_pb1_0200").text() != params.horas._0200 ){ $("#td_pb1_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_0300").text() > 0){ if( $("#td_pb1_0300").text() == params.mesas._pb1 && $("#td_pb1_0300").text() == params.horas._0300 ){ $("#td_pb1_0300").css("background-color", bg_all) }else{
                if( $("#td_pb1_0300").text() == params.horas._0300 && $("#td_pb1_0300").text() != params.mesas._pb1 ){ $("#td_pb1_0300").css("background-color", bg_hora) }
                if( $("#td_pb1_0300").text() == params.mesas._pb1 && $("#td_pb1_0300").text() != params.horas._0300 ){ $("#td_pb1_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_0400").text() > 0){ if( $("#td_pb1_0400").text() == params.mesas._pb1 && $("#td_pb1_0400").text() == params.horas._0400 ){ $("#td_pb1_0400").css("background-color", bg_all) }else{
                if( $("#td_pb1_0400").text() == params.horas._0400 && $("#td_pb1_0400").text() != params.mesas._pb1 ){ $("#td_pb1_0400").css("background-color", bg_hora) }
                if( $("#td_pb1_0400").text() == params.mesas._pb1 && $("#td_pb1_0400").text() != params.horas._0400 ){ $("#td_pb1_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb1_0500").text() > 0){ if( $("#td_pb1_0500").text() == params.mesas._pb1 && $("#td_pb1_0500").text() == params.horas._0500 ){ $("#td_pb1_0500").css("background-color", bg_all) }else{
                if( $("#td_pb1_0500").text() == params.horas._0500 && $("#td_pb1_0500").text() != params.mesas._pb1 ){ $("#td_pb1_0500").css("background-color", bg_hora) }
                if( $("#td_pb1_0500").text() == params.mesas._pb1 && $("#td_pb1_0500").text() != params.horas._0500 ){ $("#td_pb1_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pb2
        if($("#td_pb2_1400").text() > 0){ if( $("#td_pb2_1400").text() == params.mesas._pb2 && $("#td_pb2_1400").text() == params.horas._1400 ){ $("#td_pb2_1400").css("background-color", bg_all) }else{
                if( $("#td_pb2_1400").text() == params.horas._1400 && $("#td_pb2_1400").text() != params.mesas._pb2 ){ $("#td_pb2_1400").css("background-color", bg_hora) }
                if( $("#td_pb2_1400").text() == params.mesas._pb2 && $("#td_pb2_1400").text() != params.horas._1400 ){ $("#td_pb2_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_1500").text() > 0){ if( $("#td_pb2_1500").text() == params.mesas._pb2 && $("#td_pb2_1500").text() == params.horas._1500 ){ $("#td_pb2_1500").css("background-color", bg_all) }else{
                if( $("#td_pb2_1500").text() == params.horas._1500 && $("#td_pb2_1500").text() != params.mesas._pb2 ){ $("#td_pb2_1500").css("background-color", bg_hora) }
                if( $("#td_pb2_1500").text() == params.mesas._pb2 && $("#td_pb2_1500").text() != params.horas._1500 ){ $("#td_pb2_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_1600").text() > 0){ if( $("#td_pb2_1600").text() == params.mesas._pb2 && $("#td_pb2_1600").text() == params.horas._1600 ){ $("#td_pb2_1600").css("background-color", bg_all) }else{
                if( $("#td_pb2_1600").text() == params.horas._1600 && $("#td_pb2_1600").text() != params.mesas._pb2 ){ $("#td_pb2_1600").css("background-color", bg_hora) }
                if( $("#td_pb2_1600").text() == params.mesas._pb2 && $("#td_pb2_1600").text() != params.horas._1600 ){ $("#td_pb2_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_1700").text() > 0){ if( $("#td_pb2_1700").text() == params.mesas._pb2 && $("#td_pb2_1700").text() == params.horas._1700 ){ $("#td_pb2_1700").css("background-color", bg_all) }else{
                if( $("#td_pb2_1700").text() == params.horas._1700 && $("#td_pb2_1700").text() != params.mesas._pb2 ){ $("#td_pb2_1700").css("background-color", bg_hora) }
                if( $("#td_pb2_1700").text() == params.mesas._pb2 && $("#td_pb2_1700").text() != params.horas._1700 ){ $("#td_pb2_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_1800").text() > 0){ if( $("#td_pb2_1800").text() == params.mesas._pb2 && $("#td_pb2_1800").text() == params.horas._1800 ){ $("#td_pb2_1800").css("background-color", bg_all) }else{
                if( $("#td_pb2_1800").text() == params.horas._1800 && $("#td_pb2_1800").text() != params.mesas._pb2 ){ $("#td_pb2_1800").css("background-color", bg_hora) }
                if( $("#td_pb2_1800").text() == params.mesas._pb2 && $("#td_pb2_1800").text() != params.horas._1800 ){ $("#td_pb2_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_1900").text() > 0){ if( $("#td_pb2_1900").text() == params.mesas._pb2 && $("#td_pb2_1900").text() == params.horas._1900 ){ $("#td_pb2_1900").css("background-color", bg_all) }else{
                if( $("#td_pb2_1900").text() == params.horas._1900 && $("#td_pb2_1900").text() != params.mesas._pb2 ){ $("#td_pb2_1900").css("background-color", bg_hora) }
                if( $("#td_pb2_1900").text() == params.mesas._pb2 && $("#td_pb2_1900").text() != params.horas._1900 ){ $("#td_pb2_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_2000").text() > 0){ if( $("#td_pb2_2000").text() == params.mesas._pb2 && $("#td_pb2_2000").text() == params.horas._2000 ){ $("#td_pb2_2000").css("background-color", bg_all) }else{
                if( $("#td_pb2_2000").text() == params.horas._2000 && $("#td_pb2_2000").text() != params.mesas._pb2 ){ $("#td_pb2_2000").css("background-color", bg_hora) }
                if( $("#td_pb2_2000").text() == params.mesas._pb2 && $("#td_pb2_2000").text() != params.horas._2000 ){ $("#td_pb2_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_2100").text() > 0){ if( $("#td_pb2_2100").text() == params.mesas._pb2 && $("#td_pb2_2100").text() == params.horas._2100 ){ $("#td_pb2_2100").css("background-color", bg_all) }else{
                if( $("#td_pb2_2100").text() == params.horas._2100 && $("#td_pb2_2100").text() != params.mesas._pb2 ){ $("#td_pb2_2100").css("background-color", bg_hora) }
                if( $("#td_pb2_2100").text() == params.mesas._pb2 && $("#td_pb2_2100").text() != params.horas._2100 ){ $("#td_pb2_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_2200").text() > 0){ if( $("#td_pb2_2200").text() == params.mesas._pb2 && $("#td_pb2_2200").text() == params.horas._2200 ){ $("#td_pb2_2200").css("background-color", bg_all) }else{
                if( $("#td_pb2_2200").text() == params.horas._2200 && $("#td_pb2_2200").text() != params.mesas._pb2 ){ $("#td_pb2_2200").css("background-color", bg_hora) }
                if( $("#td_pb2_2200").text() == params.mesas._pb2 && $("#td_pb2_2200").text() != params.horas._2200 ){ $("#td_pb2_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_2300").text() > 0){ if( $("#td_pb2_2300").text() == params.mesas._pb2 && $("#td_pb2_2300").text() == params.horas._2300 ){ $("#td_pb2_2300").css("background-color", bg_all) }else{
                if( $("#td_pb2_2300").text() == params.horas._2300 && $("#td_pb2_2300").text() != params.mesas._pb2 ){ $("#td_pb2_2300").css("background-color", bg_hora) }
                if( $("#td_pb2_2300").text() == params.mesas._pb2 && $("#td_pb2_2300").text() != params.horas._2300 ){ $("#td_pb2_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_0000").text() > 0){ if( $("#td_pb2_0000").text() == params.mesas._pb2 && $("#td_pb2_0000").text() == params.horas._0000 ){ $("#td_pb2_0000").css("background-color", bg_all) }else{
                if( $("#td_pb2_0000").text() == params.horas._0000 && $("#td_pb2_0000").text() != params.mesas._pb2 ){ $("#td_pb2_0000").css("background-color", bg_hora) }
                if( $("#td_pb2_0000").text() == params.mesas._pb2 && $("#td_pb2_0000").text() != params.horas._0000 ){ $("#td_pb2_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_0100").text() > 0){ if( $("#td_pb2_0100").text() == params.mesas._pb2 && $("#td_pb2_0100").text() == params.horas._0100 ){ $("#td_pb2_0100").css("background-color", bg_all) }else{
                if( $("#td_pb2_0100").text() == params.horas._0100 && $("#td_pb2_0100").text() != params.mesas._pb2 ){ $("#td_pb2_0100").css("background-color", bg_hora) }
                if( $("#td_pb2_0100").text() == params.mesas._pb2 && $("#td_pb2_0100").text() != params.horas._0100 ){ $("#td_pb2_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_0200").text() > 0){ if( $("#td_pb2_0200").text() == params.mesas._pb2 && $("#td_pb2_0200").text() == params.horas._0200 ){ $("#td_pb2_0200").css("background-color", bg_all) }else{
                if( $("#td_pb2_0200").text() == params.horas._0200 && $("#td_pb2_0200").text() != params.mesas._pb2 ){ $("#td_pb2_0200").css("background-color", bg_hora) }
                if( $("#td_pb2_0200").text() == params.mesas._pb2 && $("#td_pb2_0200").text() != params.horas._0200 ){ $("#td_pb2_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_0300").text() > 0){ if( $("#td_pb2_0300").text() == params.mesas._pb2 && $("#td_pb2_0300").text() == params.horas._0300 ){ $("#td_pb2_0300").css("background-color", bg_all) }else{
                if( $("#td_pb2_0300").text() == params.horas._0300 && $("#td_pb2_0300").text() != params.mesas._pb2 ){ $("#td_pb2_0300").css("background-color", bg_hora) }
                if( $("#td_pb2_0300").text() == params.mesas._pb2 && $("#td_pb2_0300").text() != params.horas._0300 ){ $("#td_pb2_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_0400").text() > 0){ if( $("#td_pb2_0400").text() == params.mesas._pb2 && $("#td_pb2_0400").text() == params.horas._0400 ){ $("#td_pb2_0400").css("background-color", bg_all) }else{
                if( $("#td_pb2_0400").text() == params.horas._0400 && $("#td_pb2_0400").text() != params.mesas._pb2 ){ $("#td_pb2_0400").css("background-color", bg_hora) }
                if( $("#td_pb2_0400").text() == params.mesas._pb2 && $("#td_pb2_0400").text() != params.horas._0400 ){ $("#td_pb2_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb2_0500").text() > 0){ if( $("#td_pb2_0500").text() == params.mesas._pb2 && $("#td_pb2_0500").text() == params.horas._0500 ){ $("#td_pb2_0500").css("background-color", bg_all) }else{
                if( $("#td_pb2_0500").text() == params.horas._0500 && $("#td_pb2_0500").text() != params.mesas._pb2 ){ $("#td_pb2_0500").css("background-color", bg_hora) }
                if( $("#td_pb2_0500").text() == params.mesas._pb2 && $("#td_pb2_0500").text() != params.horas._0500 ){ $("#td_pb2_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pb3
        if($("#td_pb3_1400").text() > 0){ if( $("#td_pb3_1400").text() == params.mesas._pb3 && $("#td_pb3_1400").text() == params.horas._1400 ){ $("#td_pb3_1400").css("background-color", bg_all) }else{
                if( $("#td_pb3_1400").text() == params.horas._1400 && $("#td_pb3_1400").text() != params.mesas._pb3 ){ $("#td_pb3_1400").css("background-color", bg_hora) }
                if( $("#td_pb3_1400").text() == params.mesas._pb3 && $("#td_pb3_1400").text() != params.horas._1400 ){ $("#td_pb3_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_1500").text() > 0){ if( $("#td_pb3_1500").text() == params.mesas._pb3 && $("#td_pb3_1500").text() == params.horas._1500 ){ $("#td_pb3_1500").css("background-color", bg_all) }else{
                if( $("#td_pb3_1500").text() == params.horas._1500 && $("#td_pb3_1500").text() != params.mesas._pb3 ){ $("#td_pb3_1500").css("background-color", bg_hora) }
                if( $("#td_pb3_1500").text() == params.mesas._pb3 && $("#td_pb3_1500").text() != params.horas._1500 ){ $("#td_pb3_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_1600").text() > 0){ if( $("#td_pb3_1600").text() == params.mesas._pb3 && $("#td_pb3_1600").text() == params.horas._1600 ){ $("#td_pb3_1600").css("background-color", bg_all) }else{
                if( $("#td_pb3_1600").text() == params.horas._1600 && $("#td_pb3_1600").text() != params.mesas._pb3 ){ $("#td_pb3_1600").css("background-color", bg_hora) }
                if( $("#td_pb3_1600").text() == params.mesas._pb3 && $("#td_pb3_1600").text() != params.horas._1600 ){ $("#td_pb3_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_1700").text() > 0){ if( $("#td_pb3_1700").text() == params.mesas._pb3 && $("#td_pb3_1700").text() == params.horas._1700 ){ $("#td_pb3_1700").css("background-color", bg_all) }else{
                if( $("#td_pb3_1700").text() == params.horas._1700 && $("#td_pb3_1700").text() != params.mesas._pb3 ){ $("#td_pb3_1700").css("background-color", bg_hora) }
                if( $("#td_pb3_1700").text() == params.mesas._pb3 && $("#td_pb3_1700").text() != params.horas._1700 ){ $("#td_pb3_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_1800").text() > 0){ if( $("#td_pb3_1800").text() == params.mesas._pb3 && $("#td_pb3_1800").text() == params.horas._1800 ){ $("#td_pb3_1800").css("background-color", bg_all) }else{
                if( $("#td_pb3_1800").text() == params.horas._1800 && $("#td_pb3_1800").text() != params.mesas._pb3 ){ $("#td_pb3_1800").css("background-color", bg_hora) }
                if( $("#td_pb3_1800").text() == params.mesas._pb3 && $("#td_pb3_1800").text() != params.horas._1800 ){ $("#td_pb3_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_1900").text() > 0){ if( $("#td_pb3_1900").text() == params.mesas._pb3 && $("#td_pb3_1900").text() == params.horas._1900 ){ $("#td_pb3_1900").css("background-color", bg_all) }else{
                if( $("#td_pb3_1900").text() == params.horas._1900 && $("#td_pb3_1900").text() != params.mesas._pb3 ){ $("#td_pb3_1900").css("background-color", bg_hora) }
                if( $("#td_pb3_1900").text() == params.mesas._pb3 && $("#td_pb3_1900").text() != params.horas._1900 ){ $("#td_pb3_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_2000").text() > 0){ if( $("#td_pb3_2000").text() == params.mesas._pb3 && $("#td_pb3_2000").text() == params.horas._2000 ){ $("#td_pb3_2000").css("background-color", bg_all) }else{
                if( $("#td_pb3_2000").text() == params.horas._2000 && $("#td_pb3_2000").text() != params.mesas._pb3 ){ $("#td_pb3_2000").css("background-color", bg_hora) }
                if( $("#td_pb3_2000").text() == params.mesas._pb3 && $("#td_pb3_2000").text() != params.horas._2000 ){ $("#td_pb3_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_2100").text() > 0){ if( $("#td_pb3_2100").text() == params.mesas._pb3 && $("#td_pb3_2100").text() == params.horas._2100 ){ $("#td_pb3_2100").css("background-color", bg_all) }else{
                if( $("#td_pb3_2100").text() == params.horas._2100 && $("#td_pb3_2100").text() != params.mesas._pb3 ){ $("#td_pb3_2100").css("background-color", bg_hora) }
                if( $("#td_pb3_2100").text() == params.mesas._pb3 && $("#td_pb3_2100").text() != params.horas._2100 ){ $("#td_pb3_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_2200").text() > 0){ if( $("#td_pb3_2200").text() == params.mesas._pb3 && $("#td_pb3_2200").text() == params.horas._2200 ){ $("#td_pb3_2200").css("background-color", bg_all) }else{
                if( $("#td_pb3_2200").text() == params.horas._2200 && $("#td_pb3_2200").text() != params.mesas._pb3 ){ $("#td_pb3_2200").css("background-color", bg_hora) }
                if( $("#td_pb3_2200").text() == params.mesas._pb3 && $("#td_pb3_2200").text() != params.horas._2200 ){ $("#td_pb3_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_2300").text() > 0){ if( $("#td_pb3_2300").text() == params.mesas._pb3 && $("#td_pb3_2300").text() == params.horas._2300 ){ $("#td_pb3_2300").css("background-color", bg_all) }else{
                if( $("#td_pb3_2300").text() == params.horas._2300 && $("#td_pb3_2300").text() != params.mesas._pb3 ){ $("#td_pb3_2300").css("background-color", bg_hora) }
                if( $("#td_pb3_2300").text() == params.mesas._pb3 && $("#td_pb3_2300").text() != params.horas._2300 ){ $("#td_pb3_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_0000").text() > 0){ if( $("#td_pb3_0000").text() == params.mesas._pb3 && $("#td_pb3_0000").text() == params.horas._0000 ){ $("#td_pb3_0000").css("background-color", bg_all) }else{
                if( $("#td_pb3_0000").text() == params.horas._0000 && $("#td_pb3_0000").text() != params.mesas._pb3 ){ $("#td_pb3_0000").css("background-color", bg_hora) }
                if( $("#td_pb3_0000").text() == params.mesas._pb3 && $("#td_pb3_0000").text() != params.horas._0000 ){ $("#td_pb3_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_0100").text() > 0){ if( $("#td_pb3_0100").text() == params.mesas._pb3 && $("#td_pb3_0100").text() == params.horas._0100 ){ $("#td_pb3_0100").css("background-color", bg_all) }else{
                if( $("#td_pb3_0100").text() == params.horas._0100 && $("#td_pb3_0100").text() != params.mesas._pb3 ){ $("#td_pb3_0100").css("background-color", bg_hora) }
                if( $("#td_pb3_0100").text() == params.mesas._pb3 && $("#td_pb3_0100").text() != params.horas._0100 ){ $("#td_pb3_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_0200").text() > 0){ if( $("#td_pb3_0200").text() == params.mesas._pb3 && $("#td_pb3_0200").text() == params.horas._0200 ){ $("#td_pb3_0200").css("background-color", bg_all) }else{
                if( $("#td_pb3_0200").text() == params.horas._0200 && $("#td_pb3_0200").text() != params.mesas._pb3 ){ $("#td_pb3_0200").css("background-color", bg_hora) }
                if( $("#td_pb3_0200").text() == params.mesas._pb3 && $("#td_pb3_0200").text() != params.horas._0200 ){ $("#td_pb3_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_0300").text() > 0){ if( $("#td_pb3_0300").text() == params.mesas._pb3 && $("#td_pb3_0300").text() == params.horas._0300 ){ $("#td_pb3_0300").css("background-color", bg_all) }else{
                if( $("#td_pb3_0300").text() == params.horas._0300 && $("#td_pb3_0300").text() != params.mesas._pb3 ){ $("#td_pb3_0300").css("background-color", bg_hora) }
                if( $("#td_pb3_0300").text() == params.mesas._pb3 && $("#td_pb3_0300").text() != params.horas._0300 ){ $("#td_pb3_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_0400").text() > 0){ if( $("#td_pb3_0400").text() == params.mesas._pb3 && $("#td_pb3_0400").text() == params.horas._0400 ){ $("#td_pb3_0400").css("background-color", bg_all) }else{
                if( $("#td_pb3_0400").text() == params.horas._0400 && $("#td_pb3_0400").text() != params.mesas._pb3 ){ $("#td_pb3_0400").css("background-color", bg_hora) }
                if( $("#td_pb3_0400").text() == params.mesas._pb3 && $("#td_pb3_0400").text() != params.horas._0400 ){ $("#td_pb3_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb3_0500").text() > 0){ if( $("#td_pb3_0500").text() == params.mesas._pb3 && $("#td_pb3_0500").text() == params.horas._0500 ){ $("#td_pb3_0500").css("background-color", bg_all) }else{
                if( $("#td_pb3_0500").text() == params.horas._0500 && $("#td_pb3_0500").text() != params.mesas._pb3 ){ $("#td_pb3_0500").css("background-color", bg_hora) }
                if( $("#td_pb3_0500").text() == params.mesas._pb3 && $("#td_pb3_0500").text() != params.horas._0500 ){ $("#td_pb3_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pb4
        if($("#td_pb4_1400").text() > 0){ if( $("#td_pb4_1400").text() == params.mesas._pb4 && $("#td_pb4_1400").text() == params.horas._1400 ){ $("#td_pb4_1400").css("background-color", bg_all) }else{
                if( $("#td_pb4_1400").text() == params.horas._1400 && $("#td_pb4_1400").text() != params.mesas._pb4 ){ $("#td_pb4_1400").css("background-color", bg_hora) }
                if( $("#td_pb4_1400").text() == params.mesas._pb4 && $("#td_pb4_1400").text() != params.horas._1400 ){ $("#td_pb4_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_1500").text() > 0){ if( $("#td_pb4_1500").text() == params.mesas._pb4 && $("#td_pb4_1500").text() == params.horas._1500 ){ $("#td_pb4_1500").css("background-color", bg_all) }else{
                if( $("#td_pb4_1500").text() == params.horas._1500 && $("#td_pb4_1500").text() != params.mesas._pb4 ){ $("#td_pb4_1500").css("background-color", bg_hora) }
                if( $("#td_pb4_1500").text() == params.mesas._pb4 && $("#td_pb4_1500").text() != params.horas._1500 ){ $("#td_pb4_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_1600").text() > 0){ if( $("#td_pb4_1600").text() == params.mesas._pb4 && $("#td_pb4_1600").text() == params.horas._1600 ){ $("#td_pb4_1600").css("background-color", bg_all) }else{
                if( $("#td_pb4_1600").text() == params.horas._1600 && $("#td_pb4_1600").text() != params.mesas._pb4 ){ $("#td_pb4_1600").css("background-color", bg_hora) }
                if( $("#td_pb4_1600").text() == params.mesas._pb4 && $("#td_pb4_1600").text() != params.horas._1600 ){ $("#td_pb4_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_1700").text() > 0){ if( $("#td_pb4_1700").text() == params.mesas._pb4 && $("#td_pb4_1700").text() == params.horas._1700 ){ $("#td_pb4_1700").css("background-color", bg_all) }else{
                if( $("#td_pb4_1700").text() == params.horas._1700 && $("#td_pb4_1700").text() != params.mesas._pb4 ){ $("#td_pb4_1700").css("background-color", bg_hora) }
                if( $("#td_pb4_1700").text() == params.mesas._pb4 && $("#td_pb4_1700").text() != params.horas._1700 ){ $("#td_pb4_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_1800").text() > 0){ if( $("#td_pb4_1800").text() == params.mesas._pb4 && $("#td_pb4_1800").text() == params.horas._1800 ){ $("#td_pb4_1800").css("background-color", bg_all) }else{
                if( $("#td_pb4_1800").text() == params.horas._1800 && $("#td_pb4_1800").text() != params.mesas._pb4 ){ $("#td_pb4_1800").css("background-color", bg_hora) }
                if( $("#td_pb4_1800").text() == params.mesas._pb4 && $("#td_pb4_1800").text() != params.horas._1800 ){ $("#td_pb4_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_1900").text() > 0){ if( $("#td_pb4_1900").text() == params.mesas._pb4 && $("#td_pb4_1900").text() == params.horas._1900 ){ $("#td_pb4_1900").css("background-color", bg_all) }else{
                if( $("#td_pb4_1900").text() == params.horas._1900 && $("#td_pb4_1900").text() != params.mesas._pb4 ){ $("#td_pb4_1900").css("background-color", bg_hora) }
                if( $("#td_pb4_1900").text() == params.mesas._pb4 && $("#td_pb4_1900").text() != params.horas._1900 ){ $("#td_pb4_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_2000").text() > 0){ if( $("#td_pb4_2000").text() == params.mesas._pb4 && $("#td_pb4_2000").text() == params.horas._2000 ){ $("#td_pb4_2000").css("background-color", bg_all) }else{
                if( $("#td_pb4_2000").text() == params.horas._2000 && $("#td_pb4_2000").text() != params.mesas._pb4 ){ $("#td_pb4_2000").css("background-color", bg_hora) }
                if( $("#td_pb4_2000").text() == params.mesas._pb4 && $("#td_pb4_2000").text() != params.horas._2000 ){ $("#td_pb4_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_2100").text() > 0){ if( $("#td_pb4_2100").text() == params.mesas._pb4 && $("#td_pb4_2100").text() == params.horas._2100 ){ $("#td_pb4_2100").css("background-color", bg_all) }else{
                if( $("#td_pb4_2100").text() == params.horas._2100 && $("#td_pb4_2100").text() != params.mesas._pb4 ){ $("#td_pb4_2100").css("background-color", bg_hora) }
                if( $("#td_pb4_2100").text() == params.mesas._pb4 && $("#td_pb4_2100").text() != params.horas._2100 ){ $("#td_pb4_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_2200").text() > 0){ if( $("#td_pb4_2200").text() == params.mesas._pb4 && $("#td_pb4_2200").text() == params.horas._2200 ){ $("#td_pb4_2200").css("background-color", bg_all) }else{
                if( $("#td_pb4_2200").text() == params.horas._2200 && $("#td_pb4_2200").text() != params.mesas._pb4 ){ $("#td_pb4_2200").css("background-color", bg_hora) }
                if( $("#td_pb4_2200").text() == params.mesas._pb4 && $("#td_pb4_2200").text() != params.horas._2200 ){ $("#td_pb4_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_2300").text() > 0){ if( $("#td_pb4_2300").text() == params.mesas._pb4 && $("#td_pb4_2300").text() == params.horas._2300 ){ $("#td_pb4_2300").css("background-color", bg_all) }else{
                if( $("#td_pb4_2300").text() == params.horas._2300 && $("#td_pb4_2300").text() != params.mesas._pb4 ){ $("#td_pb4_2300").css("background-color", bg_hora) }
                if( $("#td_pb4_2300").text() == params.mesas._pb4 && $("#td_pb4_2300").text() != params.horas._2300 ){ $("#td_pb4_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_0000").text() > 0){ if( $("#td_pb4_0000").text() == params.mesas._pb4 && $("#td_pb4_0000").text() == params.horas._0000 ){ $("#td_pb4_0000").css("background-color", bg_all) }else{
                if( $("#td_pb4_0000").text() == params.horas._0000 && $("#td_pb4_0000").text() != params.mesas._pb4 ){ $("#td_pb4_0000").css("background-color", bg_hora) }
                if( $("#td_pb4_0000").text() == params.mesas._pb4 && $("#td_pb4_0000").text() != params.horas._0000 ){ $("#td_pb4_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_0100").text() > 0){ if( $("#td_pb4_0100").text() == params.mesas._pb4 && $("#td_pb4_0100").text() == params.horas._0100 ){ $("#td_pb4_0100").css("background-color", bg_all) }else{
                if( $("#td_pb4_0100").text() == params.horas._0100 && $("#td_pb4_0100").text() != params.mesas._pb4 ){ $("#td_pb4_0100").css("background-color", bg_hora) }
                if( $("#td_pb4_0100").text() == params.mesas._pb4 && $("#td_pb4_0100").text() != params.horas._0100 ){ $("#td_pb4_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_0200").text() > 0){ if( $("#td_pb4_0200").text() == params.mesas._pb4 && $("#td_pb4_0200").text() == params.horas._0200 ){ $("#td_pb4_0200").css("background-color", bg_all) }else{
                if( $("#td_pb4_0200").text() == params.horas._0200 && $("#td_pb4_0200").text() != params.mesas._pb4 ){ $("#td_pb4_0200").css("background-color", bg_hora) }
                if( $("#td_pb4_0200").text() == params.mesas._pb4 && $("#td_pb4_0200").text() != params.horas._0200 ){ $("#td_pb4_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_0300").text() > 0){ if( $("#td_pb4_0300").text() == params.mesas._pb4 && $("#td_pb4_0300").text() == params.horas._0300 ){ $("#td_pb4_0300").css("background-color", bg_all) }else{
                if( $("#td_pb4_0300").text() == params.horas._0300 && $("#td_pb4_0300").text() != params.mesas._pb4 ){ $("#td_pb4_0300").css("background-color", bg_hora) }
                if( $("#td_pb4_0300").text() == params.mesas._pb4 && $("#td_pb4_0300").text() != params.horas._0300 ){ $("#td_pb4_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_0400").text() > 0){ if( $("#td_pb4_0400").text() == params.mesas._pb4 && $("#td_pb4_0400").text() == params.horas._0400 ){ $("#td_pb4_0400").css("background-color", bg_all) }else{
                if( $("#td_pb4_0400").text() == params.horas._0400 && $("#td_pb4_0400").text() != params.mesas._pb4 ){ $("#td_pb4_0400").css("background-color", bg_hora) }
                if( $("#td_pb4_0400").text() == params.mesas._pb4 && $("#td_pb4_0400").text() != params.horas._0400 ){ $("#td_pb4_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb4_0500").text() > 0){ if( $("#td_pb4_0500").text() == params.mesas._pb4 && $("#td_pb4_0500").text() == params.horas._0500 ){ $("#td_pb4_0500").css("background-color", bg_all) }else{
                if( $("#td_pb4_0500").text() == params.horas._0500 && $("#td_pb4_0500").text() != params.mesas._pb4 ){ $("#td_pb4_0500").css("background-color", bg_hora) }
                if( $("#td_pb4_0500").text() == params.mesas._pb4 && $("#td_pb4_0500").text() != params.horas._0500 ){ $("#td_pb4_0500").css("background-color", bg_mesa) }
            }
        }
        
        //pb5
        if($("#td_pb5_1400").text() > 0){ if( $("#td_pb5_1400").text() == params.mesas._pb5 && $("#td_pb5_1400").text() == params.horas._1400 ){ $("#td_pb5_1400").css("background-color", bg_all) }else{
                if( $("#td_pb5_1400").text() == params.horas._1400 && $("#td_pb5_1400").text() != params.mesas._pb5 ){ $("#td_pb5_1400").css("background-color", bg_hora) }
                if( $("#td_pb5_1400").text() == params.mesas._pb5 && $("#td_pb5_1400").text() != params.horas._1400 ){ $("#td_pb5_1400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_1500").text() > 0){ if( $("#td_pb5_1500").text() == params.mesas._pb5 && $("#td_pb5_1500").text() == params.horas._1500 ){ $("#td_pb5_1500").css("background-color", bg_all) }else{
                if( $("#td_pb5_1500").text() == params.horas._1500 && $("#td_pb5_1500").text() != params.mesas._pb5 ){ $("#td_pb5_1500").css("background-color", bg_hora) }
                if( $("#td_pb5_1500").text() == params.mesas._pb5 && $("#td_pb5_1500").text() != params.horas._1500 ){ $("#td_pb5_1500").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_1600").text() > 0){ if( $("#td_pb5_1600").text() == params.mesas._pb5 && $("#td_pb5_1600").text() == params.horas._1600 ){ $("#td_pb5_1600").css("background-color", bg_all) }else{
                if( $("#td_pb5_1600").text() == params.horas._1600 && $("#td_pb5_1600").text() != params.mesas._pb5 ){ $("#td_pb5_1600").css("background-color", bg_hora) }
                if( $("#td_pb5_1600").text() == params.mesas._pb5 && $("#td_pb5_1600").text() != params.horas._1600 ){ $("#td_pb5_1600").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_1700").text() > 0){ if( $("#td_pb5_1700").text() == params.mesas._pb5 && $("#td_pb5_1700").text() == params.horas._1700 ){ $("#td_pb5_1700").css("background-color", bg_all) }else{
                if( $("#td_pb5_1700").text() == params.horas._1700 && $("#td_pb5_1700").text() != params.mesas._pb5 ){ $("#td_pb5_1700").css("background-color", bg_hora) }
                if( $("#td_pb5_1700").text() == params.mesas._pb5 && $("#td_pb5_1700").text() != params.horas._1700 ){ $("#td_pb5_1700").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_1800").text() > 0){ if( $("#td_pb5_1800").text() == params.mesas._pb5 && $("#td_pb5_1800").text() == params.horas._1800 ){ $("#td_pb5_1800").css("background-color", bg_all) }else{
                if( $("#td_pb5_1800").text() == params.horas._1800 && $("#td_pb5_1800").text() != params.mesas._pb5 ){ $("#td_pb5_1800").css("background-color", bg_hora) }
                if( $("#td_pb5_1800").text() == params.mesas._pb5 && $("#td_pb5_1800").text() != params.horas._1800 ){ $("#td_pb5_1800").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_1900").text() > 0){ if( $("#td_pb5_1900").text() == params.mesas._pb5 && $("#td_pb5_1900").text() == params.horas._1900 ){ $("#td_pb5_1900").css("background-color", bg_all) }else{
                if( $("#td_pb5_1900").text() == params.horas._1900 && $("#td_pb5_1900").text() != params.mesas._pb5 ){ $("#td_pb5_1900").css("background-color", bg_hora) }
                if( $("#td_pb5_1900").text() == params.mesas._pb5 && $("#td_pb5_1900").text() != params.horas._1900 ){ $("#td_pb5_1900").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_2000").text() > 0){ if( $("#td_pb5_2000").text() == params.mesas._pb5 && $("#td_pb5_2000").text() == params.horas._2000 ){ $("#td_pb5_2000").css("background-color", bg_all) }else{
                if( $("#td_pb5_2000").text() == params.horas._2000 && $("#td_pb5_2000").text() != params.mesas._pb5 ){ $("#td_pb5_2000").css("background-color", bg_hora) }
                if( $("#td_pb5_2000").text() == params.mesas._pb5 && $("#td_pb5_2000").text() != params.horas._2000 ){ $("#td_pb5_2000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_2100").text() > 0){ if( $("#td_pb5_2100").text() == params.mesas._pb5 && $("#td_pb5_2100").text() == params.horas._2100 ){ $("#td_pb5_2100").css("background-color", bg_all) }else{
                if( $("#td_pb5_2100").text() == params.horas._2100 && $("#td_pb5_2100").text() != params.mesas._pb5 ){ $("#td_pb5_2100").css("background-color", bg_hora) }
                if( $("#td_pb5_2100").text() == params.mesas._pb5 && $("#td_pb5_2100").text() != params.horas._2100 ){ $("#td_pb5_2100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_2200").text() > 0){ if( $("#td_pb5_2200").text() == params.mesas._pb5 && $("#td_pb5_2200").text() == params.horas._2200 ){ $("#td_pb5_2200").css("background-color", bg_all) }else{
                if( $("#td_pb5_2200").text() == params.horas._2200 && $("#td_pb5_2200").text() != params.mesas._pb5 ){ $("#td_pb5_2200").css("background-color", bg_hora) }
                if( $("#td_pb5_2200").text() == params.mesas._pb5 && $("#td_pb5_2200").text() != params.horas._2200 ){ $("#td_pb5_2200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_2300").text() > 0){ if( $("#td_pb5_2300").text() == params.mesas._pb5 && $("#td_pb5_2300").text() == params.horas._2300 ){ $("#td_pb5_2300").css("background-color", bg_all) }else{
                if( $("#td_pb5_2300").text() == params.horas._2300 && $("#td_pb5_2300").text() != params.mesas._pb5 ){ $("#td_pb5_2300").css("background-color", bg_hora) }
                if( $("#td_pb5_2300").text() == params.mesas._pb5 && $("#td_pb5_2300").text() != params.horas._2300 ){ $("#td_pb5_2300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_0000").text() > 0){ if( $("#td_pb5_0000").text() == params.mesas._pb5 && $("#td_pb5_0000").text() == params.horas._0000 ){ $("#td_pb5_0000").css("background-color", bg_all) }else{
                if( $("#td_pb5_0000").text() == params.horas._0000 && $("#td_pb5_0000").text() != params.mesas._pb5 ){ $("#td_pb5_0000").css("background-color", bg_hora) }
                if( $("#td_pb5_0000").text() == params.mesas._pb5 && $("#td_pb5_0000").text() != params.horas._0000 ){ $("#td_pb5_0000").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_0100").text() > 0){ if( $("#td_pb5_0100").text() == params.mesas._pb5 && $("#td_pb5_0100").text() == params.horas._0100 ){ $("#td_pb5_0100").css("background-color", bg_all) }else{
                if( $("#td_pb5_0100").text() == params.horas._0100 && $("#td_pb5_0100").text() != params.mesas._pb5 ){ $("#td_pb5_0100").css("background-color", bg_hora) }
                if( $("#td_pb5_0100").text() == params.mesas._pb5 && $("#td_pb5_0100").text() != params.horas._0100 ){ $("#td_pb5_0100").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_0200").text() > 0){ if( $("#td_pb5_0200").text() == params.mesas._pb5 && $("#td_pb5_0200").text() == params.horas._0200 ){ $("#td_pb5_0200").css("background-color", bg_all) }else{
                if( $("#td_pb5_0200").text() == params.horas._0200 && $("#td_pb5_0200").text() != params.mesas._pb5 ){ $("#td_pb5_0200").css("background-color", bg_hora) }
                if( $("#td_pb5_0200").text() == params.mesas._pb5 && $("#td_pb5_0200").text() != params.horas._0200 ){ $("#td_pb5_0200").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_0300").text() > 0){ if( $("#td_pb5_0300").text() == params.mesas._pb5 && $("#td_pb5_0300").text() == params.horas._0300 ){ $("#td_pb5_0300").css("background-color", bg_all) }else{
                if( $("#td_pb5_0300").text() == params.horas._0300 && $("#td_pb5_0300").text() != params.mesas._pb5 ){ $("#td_pb5_0300").css("background-color", bg_hora) }
                if( $("#td_pb5_0300").text() == params.mesas._pb5 && $("#td_pb5_0300").text() != params.horas._0300 ){ $("#td_pb5_0300").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_0400").text() > 0){ if( $("#td_pb5_0400").text() == params.mesas._pb5 && $("#td_pb5_0400").text() == params.horas._0400 ){ $("#td_pb5_0400").css("background-color", bg_all) }else{
                if( $("#td_pb5_0400").text() == params.horas._0400 && $("#td_pb5_0400").text() != params.mesas._pb5 ){ $("#td_pb5_0400").css("background-color", bg_hora) }
                if( $("#td_pb5_0400").text() == params.mesas._pb5 && $("#td_pb5_0400").text() != params.horas._0400 ){ $("#td_pb5_0400").css("background-color", bg_mesa) }
            }
        }
        if($("#td_pb5_0500").text() > 0){ if( $("#td_pb5_0500").text() == params.mesas._pb5 && $("#td_pb5_0500").text() == params.horas._0500 ){ $("#td_pb5_0500").css("background-color", bg_all) }else{
                if( $("#td_pb5_0500").text() == params.horas._0500 && $("#td_pb5_0500").text() != params.mesas._pb5 ){ $("#td_pb5_0500").css("background-color", bg_hora) }
                if( $("#td_pb5_0500").text() == params.mesas._pb5 && $("#td_pb5_0500").text() != params.horas._0500 ){ $("#td_pb5_0500").css("background-color", bg_mesa) }
            }
        }
        
    }

    dataTable("{{route('counting_table_stadistics.service')}}",[
        {
            render: function ( data,type, row,all  ) {
                return all.row+1;
            }
        },
        {
            render: function ( data,type, row,all  ) {
                return row.created_at+" - "+"<b>"+ ( moment(row.created_at).format('dddd') === moment().format('dddd') ? "Reciente" : moment(row.created_at).format('dddd') ) +"</b>";
            }
        },
        {
            render: function ( data,type, row  ) {
                return `
                    <a onclick="elim('counting_table_stadistics',${row.id})" style="color: var(--global-2)" class="btn btn-danger btn-icon btn-circle"><i class="fa fa-times"></i></a>
                    <a onclick="modal('Editar',${row.id})" style="color: var(--global-2)" class="btn btn-yellow btn-icon btn-circle"><i class="fas fa-pen"></i></a>
                    <a onclick="view(${row.id})" style="color: var(--global-2)" class="btn btn-green btn-icon btn-circle"><i class="fas fa-eye"></i></a>
                `;
            }
        },
    ])

</script>
@endsection