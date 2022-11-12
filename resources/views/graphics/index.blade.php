
@extends('layouts.app')
@section('content')
<div class="row">
    <!-- Clientes VIP -->
    <div class="panel panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Clientes VIP
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="club_vip"></canvas>
            </div>
        </div>
    </div>
    <!-- Medio de transporte -->
    <div class="panel panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Medio de Transporte
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="transportation" ></canvas>
            </div>
        </div>
    </div>
    <!-- Maquinas Favoritas -->
    <div class="panel panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Maquinas Favoritas
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="machine"></canvas>
            </div>
        </div>
    </div>
    <!-- Mesas Favoritas -->
    <div class="panel panel-inverse col-sm-6 col-md-6 col-lg-6 col-xl-3 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Mesas en vivo Favoritas
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="table"></canvas>
            </div>
        </div>
    </div>
    <!-- Como nos conoce -->
    <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-6 col-xl-6 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Como nos conoce
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="como_nos_conoce" ></canvas>
            </div>
        </div>
    </div>
    <!-- Preferencias por beneficios -->
    <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-6 col-xl-6 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Preferencias por beneficios
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="preferencias_por_beneficios"></canvas>
            </div>
        </div>
    </div>
    <!-- Comidas Favoritas -->
    <div class="panel panel-inverse col-sm-6 col-md-6 col-lg-4 col-xl-4 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Comidas Favoritas
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="food"></canvas>
            </div>
        </div>
    </div>
    <!-- Jugos Favoritos -->
    <div class="panel panel-inverse col-sm-6 col-md-6 col-lg-4 col-xl-4 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Jugos Favoritas
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="juice"></canvas>
            </div>
        </div>
    </div>
    <!-- Tragos Favoritas -->
    <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-4 col-xl-4 bg-transparent" >
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">
                Tragos Favoritas
            </h4>
        </div>
        <div class="panel-body">
            <div class="chart-container">
                <canvas id="drink"></canvas>
            </div>
        </div>
    </div>

    @foreach( $sedes as $item_sede )
        @foreach( $group_menus as $item_group_menu )

            <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-2 col-xl-2 bg-transparent" >
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">
                        QR Menu - {{ $item_sede->name }} - {{ $item_group_menu->name }}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="title m-b-md m-auto text-center">
                    {!! QrCode::size(300)->generate(Request::url().'/menu/'.$item_group_menu->id.'/'.$item_sede->id) !!}
                    </div>
                </div>
            </div>

        @endforeach
    @endforeach

    
    

</div>
@endsection
@section('js')

<script>
    $('#graphics_nav').removeClass("closed").addClass("active").addClass("expand")
    let charts = {!! $charts !!}
    
    const chart_club_vip = new Chart(document.getElementById('club_vip'),{ type:'pie',data: charts.club_vip});
    const chart_transportation = new Chart(document.getElementById('transportation'),{ type:'pie',data: charts.transportation});
    const chart_como_nos_conoce = new Chart(document.getElementById('como_nos_conoce'),{ type:'bar',data: charts.como_nos_conoce});
    const chart_preferencias_por_beneficios = new Chart(document.getElementById('preferencias_por_beneficios'),{ type:'bar',data: charts.preferencias_por_beneficios});
    const chart_machine = new Chart(document.getElementById('machine'),{ type:'pie',data: charts.machine});
    const chart_table = new Chart(document.getElementById('table'),{ type:'pie',data: charts.table});
    const chart_food = new Chart(document.getElementById('food'),{ type:'pie',data: charts.food});
    const chart_juice = new Chart(document.getElementById('juice'),{ type:'pie',data: charts.juice});
    const chart_drink = new Chart(document.getElementById('drink'),{ type:'pie',data: charts.drink});


</script>
@endsection




