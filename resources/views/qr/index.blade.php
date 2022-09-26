<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Menu Casino PLC</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSS
			================================================ -->
		<!-- Owl Carousel -->
		<link rel="stylesheet" href="menu-list-qr/css/owl.carousel.css">
		<!-- bootstrap.min css -->
		<link rel="stylesheet" href="menu-list-qr/css/bootstrap.min.css">
		<!-- Font-awesome.min css -->
		<link rel="stylesheet" href="menu-list-qr/css/font-awesome.min.css">
		<!-- Main Stylesheet -->
		<link rel="stylesheet" href="menu-list-qr/css/animate.min.css">

		<link rel="stylesheet" href="menu-list-qr/css/main.css">
		<!-- Responsive Stylesheet -->
		<link rel="stylesheet" href="menu-list-qr/css/responsive.css">
		<!-- Js -->
		<script src="menu-list-qr/js/vendor/modernizr-2.6.2.min.js"></script>
		<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
		<script>
			window.jQuery || document.write('<script src="menu-list-qr/js/vendor/jquery-1.10.2.min.js"><\/script>')
		</script>
		<script src="menu-list-qr/js/jquery.nav.js"></script>
		<script src="menu-list-qr/js/jquery.sticky.js"></script>
		<script src="menu-list-qr/js/bootstrap.min.js"></script>
		<script src="menu-list-qr/js/plugins.js"></script>
		<script src="menu-list-qr/js/wow.min.js"></script>
		<script src="menu-list-qr/js/main.js"></script>
		<style>
			.main-img {
				display: inline-block;
				border-radius: 50%;
				height: 150px;
				margin-bottom: 20px;
				width: 150px;
					object-fit: cover;
					object-position: center center;
			}
		</style>
	</head>
	<body>
		<section id="price">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="block">
							<h1 class="heading wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">Nuestro
								<span>MENU</span> con <span>PRECIOS</span></h1>
							<p class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms">Listado de menu Cortesia exclusiva para clientes </p>
							<div class="pricing-list">
								<ul>
									@foreach ($ayb_items as $item)
										<li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
											<div class="item">

												<div class="d-flex">
													@foreach ($item->imgs as $item_img)
														<img class="main-img" src="{{ url('public/Ayb_item/'.$item->id.'/'.$item_img->name) }}"/>
													@endforeach
												</div>

												<div class="item-title">
													<h2>{{ $item->name }} </h2>
													<div class="border-bottom"></div>
													@if( $item->group_menu_id != 2 )
														<span>$ {{ $item->price }} </span>
													@endif
												</div>
												<p >{{ $item->description }}</p>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>