@extends('layouts.app')
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <button onclick="pdfExport('ayb_history')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-pdf"></i>
            </button>
            <button onclick="excelExport('ayb_history')" class="d-flex btn btn-1 btn-secondary mx-1">
                <i class="m-auto fas fa-lg fa-file-excel"></i>
            </button>
         
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
          
           

            <div class="table-responsive">
                <table id="data-table-default" class="table table-bordered table-td-valign-middle" style="width:100% !important">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Menu</th>
                            <th>Sede</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    let all = [];
    
    $('#ayb_records_nav').removeClass("closed").addClass("active").addClass("expand")
    
    
    
    dataTable("{{route('ayb_records.service')}}",[
        
        { data: 'ayb_item_id' },
        { data: 'ayb_item_name' },
        { data: 'sede_name' },
        { data: 'type_command_name' },
        { data: 'created_at' },
        { data: 'cantidad' },
        {
            render: function ( data,type, row,all  ) {
                return "$ "+row.price;
            }
        },
        {
            render: function ( data,type, row,all  ) {
                return "$ "+row.total_menu;
            }
        },
       
    ],"group_name_all")

   
    
    function ajaxReloadDatatablesFN(res){
        all = res;
        console.log("all",all)
    }      



</script>
@endsection