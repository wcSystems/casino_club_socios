
@extends('layouts.app')
@section('content')
<div class="row">

    @foreach( $sedes as $item_sede )
            <div class="panel panel-inverse col-sm-12 col-md-12 col-lg-4 col-xl-4 bg-transparent" >
                <div class="panel-heading ui-sortable-handle">
                    <h4 class="panel-title">
                        QR Menu - {{ $item_sede->name }}
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="title m-b-md m-auto text-center">
                    {!! QrCode::size(300)->generate(Request::url().'/menu/'.$item_sede->id) !!}
                    </div>
                </div>
            </div>
    @endforeach
    
</div>
@endsection
@section('js')

<script>
    $('#graphics_nav').removeClass("closed").addClass("active").addClass("expand")
</script>
@endsection




