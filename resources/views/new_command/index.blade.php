<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Nueva Comanda</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/menu-list-qr/css/main.css">
		<link rel="apple-touch-icon" href="{{asset('img/logo_wisi.png')}}">
    	<link rel="shortcut icon" type="image/x-icon" href="{{asset('img/logo_wisi.png')}}">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			#type-3 { background: #F0F8FF !important; }
			#type-5 { background: #FF7F50 !important; }
			#type-1 { background: #B22222 !important; }
			#type-2 { background: #FF69B4 !important; }
			#type-4 { background: #FFFACD !important; }
			.centrado {
				display: -ms-flexbox!important;
				display: flex!important;
				justify-content: center;
				align-items: center;
				flex-wrap: wrap;
			}
			.centrado-arriba {
				display: -ms-flexbox!important;
				display: flex!important;
				justify-content: center;
				align-items: flex-start;
				flex-wrap: wrap;
			}

			.main-img {
				display: inline-block;
				height: 150px !important;
				margin-bottom: 20px;
				width: 100% !important;
				object-fit: cover;
				object-position: center center;
			}
			.color-orange {
				color: #fd7e14 !important;
			}

			.background-active {
				background-color: #fd7e14 !important;
			}

			.box-50{
				width: 50px !important;
				height: 50px !important;
				text-align: center;
			}

			.form-none {
				border: none !important;
				background-color: transparent !important
			}

			.stiky-fixed{
				position: fixed;
				width: 100%;
				z-index: 1000;
				top: 0;
				height: 100px !important
			}

		</style>
	</head>
	<body>
		
		<div id="selectTypeCommand" class="centrado"  >
			@foreach ($type_commands as $item)
				<button type="button" id="type-{{ $item->id }}" class="px-5 col centrado btn"  style="height:100vh !important;" onclick="selectTypeCommand({{ $item->id }})" >
					<h1 class="text-white font-weight-bold" style="font-size: 8rem !important"  >
					{{ $item->name }}
					</h1>
				</button>
			@endforeach
		</div>

		<div id="selectEmployee" class="d-none" >
			<div class="d-flex w-100 bg-secondary stiky-fixed"  onclick="volver('1')"  >
				<button type="button" class="col btn text-white font-weight-bold" style="font-size: 2rem !important">
					VOLVER
				</button>
			</div>
			<div class="text-center centrado" style="height: calc( 100vh - 100px ) !important;margin-top: 100px;" >
				@foreach ($employees as $item)
					<img onclick="selectEmployee({{ $item->id }})" src='/public/employees/{{ $item->employeeNo }}.jpg' onerror="this.onerror=null;this.src='public/users/null.jpg';" class="col rounded-circle m-3" style="width:150px !important;height:150px !important;max-width:150px !important;max-height:150px !important;" />
				@endforeach
			</div>
		</div>

		<div id="selectMenu" class="d-none" >
			<div class="d-flex w-100 stiky-fixed"    >
				<button type="button" class="col btn text-white font-weight-bold bg-secondary rounded-0" style="font-size: 2rem !important" onclick="volver('2')">
					VOLVER
				</button>
				<button type="button" class="col btn text-white font-weight-bold background-active rounded-0" style="font-size: 2rem !important" onclick="procesar()">
					PROCESAR
				</button>
			</div>
			<div class="text-center container-fluid py-5 centrado-arriba" style="height: calc( 100vh - 100px ) !important;margin-top: 100px;" >
				@foreach ($group_menus as $item_group)
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mx-3" >
						<h1 class="text-left mb-3" data-wow-duration="300ms" data-wow-delay="300ms"><span class="color-orange" >{{ $item_group->name }}</span></h1>
						<div class="pricing-list py-0">
							<ul>
								@foreach ($ayb_items as $item)
									@if( $item->group_menu_id == $item_group->id )
										<li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
											<form class="item">
												@csrf
												<div class="row">
													<div class="col-sm-12 my-3">
														<div class="row">
															<input readonly type="number" id="total-{{ $item->id }}" class="total box-50 rounded-circle form-control parsley-normal upper mr-2" style="color: var(--global-2) !important" value="0" min="0" >
															<h2 class="p-0 col text-left">{{ $item->name }} </h2>
															<button type="button" onclick="totalSum('-',{{ $item->id }})" class="btn btn-secondary box-50 rounded-circle mx-1" style="height: fit-content" > - </button>
															<button type="button" onclick="totalSum('+',{{ $item->id }})" class="btn btn-secondary box-50 rounded-circle" style="height: fit-content" > + </button>
														</div>
														<span class="row my-2">
															<select id="table-{{ $item->id }}" class="table form-control w-100" onchange="validDestino({{ $item->id }})">
																<option value="" selected >Seleccione un destino</option>
																@foreach( $tables as $item )
																	<option value="{{ $item->id }}" > {{ $item->name }} </option>
																@endforeach
															</select>
														</span>
													</div>
												</div>
											</form>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<script>

			let type_command_id = ""
            let employee_id = ""

			function selectTypeCommand(id) {
				type_command_id = id
				$("#selectTypeCommand").removeClass("centrado").addClass("d-none")
				$("#selectEmployee").removeClass("d-none").addClass("centrado")
			}
			function selectEmployee(id) {
				employee_id = id
				$("#selectEmployee").removeClass("centrado").addClass("d-none")
				$("#selectMenu").removeClass("d-none").addClass("centrado")
			}
			function volver(option) {
				if(option == 1){
					$("#selectTypeCommand").removeClass("d-none").addClass("centrado")
					$("#selectEmployee").removeClass("centrado").addClass("d-none")
				}
				if(option == 2){
					$("#selectEmployee").removeClass("d-none").addClass("centrado")
					$("#selectMenu").removeClass("centrado").addClass("d-none")
				}
			}
			function totalSum(type,id) {
				let total = parseInt($(`#total-${parseInt(id)}`).val())

				if(type == "-" && total > 0){
					total = total - 1
				}

				if(type == "+"){
					total = total + 1
				}
				
				if(total > 0){
					$(`#total-${parseInt(id)}`).addClass("background-active")
					if( $(`#table-${parseInt(id)}`).val() == "" ){
						$(`#table-${parseInt(id)}`).addClass("border-danger")
					}else{
						$(`#table-${parseInt(id)}`).removeClass("border-danger")
					}
				}else{
					$(`#total-${parseInt(id)}`).removeClass("background-active")
					$(`#table-${parseInt(id)}`).val("")
					$(`#table-${parseInt(id)}`).removeClass("border-danger")
				}

				$(`#total-${parseInt(id)}`).val(total)
			}
			function validDestino(id) {
				let total = parseInt($(`#total-${parseInt(id)}`).val())

				if(total > 0){
					$(`#total-${parseInt(id)}`).addClass("background-active")
					if( $(`#table-${parseInt(id)}`).val() == "" ){
						$(`#table-${parseInt(id)}`).addClass("border-danger")
					}else{
						$(`#table-${parseInt(id)}`).removeClass("border-danger")
					}
				}else{
					$(`#total-${parseInt(id)}`).removeClass("background-active")
				}

			}
			function limpiar() {
				$(`.total`).removeClass("background-active")
				$(`.table`).removeClass("border-danger")
				$(`.total`).val("0")
				$(`.table`).val("")
				type_command_id = ""
            	employee_id = ""
				$("#selectEmployee").removeClass("centrado").addClass("d-none")
				$("#selectMenu").removeClass("centrado").addClass("d-none")
				$("#selectTypeCommand").removeClass("d-none").addClass("centrado")
			}
			function procesar() {
				let timerInterval 
				let arrayMenu = [];
				let menus = {!! $ayb_items !!}
					menus.forEach(element => {
						if( $(`#total-${parseInt(element.id)}`).val() > 0 ){
							
								arrayMenu.push({ 
									"ayb_item_id": element.id, 
									"total": $(`#total-${parseInt(element.id)}`).val(),
									"table_id": $(`#table-${parseInt(element.id)}`).val()
								})
							
						}
					});
				if( arrayMenu.length <= 0 || arrayMenu.find( i => i.table_id == "" ) ){
					Swal.fire({
						title: 'ERROR',
						text: 'Porfavor verifique los destinos de los menus, y que alla al menos uno incluido.',
						icon: 'error',
						showConfirmButton: true,
						showCloseButton: true,
						allowOutsideClick: false,
						confirmButtonText: 'OK',
						confirmButtonColor: '#fd7e14',
					})
				 }else{
					let payload = {
						_token: $("meta[name='csrf-token']").attr("content"),
						type_command_id: type_command_id,
						employee_id: employee_id,
						items: arrayMenu
					}
					setLoading(timerInterval)
					$.ajax({
						url: "{{ route('ayb_commands.store') }}",
						type: "POST",
						data: payload,
						success: function (res) {
							if(res.type === 'success'){
								clearInterval(timerInterval)
								Swal.fire({
									title: 'COMPLETADO',
									text: 'La comanda se ha creado exitosamente.',
									icon: 'success',
									showConfirmButton: true,
									allowOutsideClick: false,
									confirmButtonText: 'INICIO',
									confirmButtonColor: '#fd7e14',
								}).then((result) => {
									if (result.isConfirmed) {
										limpiar()
									}
								})
							}
						}
					});
				}
			}
			function setLoading(timerInterval) {
				Swal.fire({
					title: 'Generando Comanda!',
					text: 'porfavor espere...',
					timer: 300000,
					didOpen: () => {
						Swal.showLoading()
						const b = Swal.getHtmlContainer().querySelector('b')
						timerInterval = setInterval(() => { }, 100)
					},
				})
			}

		</script>
	</body>
</html>