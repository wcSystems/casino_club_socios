<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Menu Casino PLC</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/menu-list-qr/css/main.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
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
		</style>
	</head>
	<body>
		<section id="price">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="block">
							<h1 class="text-center mb-5" data-wow-duration="300ms" data-wow-delay="300ms">Nuestro <span class="color-orange" >MENU</span> exclusiva para clientes de <br /> {{ $sede->name }}</h1>
							@foreach ($group_menus as $item_group)
								<h1 class="text-left mb-3" data-wow-duration="300ms" data-wow-delay="300ms"><span class="color-orange" >{{ $item_group->name }}</span></h1>
								<div class="pricing-list py-0">
									<ul>
										@foreach ($ayb_items as $item)
											@if( $item->group_menu_id == $item_group->id )
												<li class="wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
													<div class="item">
														<div class="row">
															<div class="col-sm-8">
																<div class="item-title">
																	<h2>{{ $item->name }} </h2>
																</div>
																<p >{{ $item->description }}</p>
															</div>
															<div class="col-sm-4">
																<div id="carrousel-{{ $item->id }}" class="carousel slide" data-ride="carousel">
																	<ol class="carousel-indicators">
																		@foreach ($item->imgs as $item_img)
																			<li data-target="#carrousel-{{ $item->id }}" data-slide-to="{{ $loop->index }}" class="{{ ( $loop->iteration == 1  ) ? 'active' : '' }}"></li>
																		@endforeach
																	</ol>
																	<div class="carousel-inner">
																		@foreach ($item->imgs as $item_img)


																			<div class="modal fade" id="modal-{{ $item_img->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																				<div class="modal-dialog modal-lg" role="document">

																				<!--Content-->
																				<div class="modal-content">

																					<!--Body-->
																					<div class="modal-body mb-0 p-0">

																					<div >
																						<img class="d-block w-100" src="{{ url('public/Ayb_item/'.$item->id.'/'.$item_img->name) }}" allowfullscreen>
																					</div>

																					</div>

																			

																				</div>
																				<!--/.Content-->

																				</div>
																			</div>




																			<div class="carousel-item {{ ( $loop->iteration == 1 ) ? 'active' : '' }}">
																				<img class="d-block w-100 main-img" src="{{ url('public/Ayb_item/'.$item->id.'/'.$item_img->name) }}" alt="slide"  data-toggle="modal" data-target="#modal-{{ $item_img->id }}">
																			</div>
																		@endforeach
																	</div>
																	<a class="carousel-control-prev" href="#carrousel-{{ $item->id }}" role="button" data-slide="prev">
																		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																		<span class="sr-only">Previous</span>
																	</a>
																	<a class="carousel-control-next" href="#carrousel-{{ $item->id }}" role="button" data-slide="next">
																		<span class="carousel-control-next-icon" aria-hidden="true"></span>
																		<span class="sr-only">Next</span>
																	</a>
																</div>
															</div>
														</div>
															<span>$ {{ $item->price }} </span>
														<div class="border-bottom mt-3"></div>
													</div>
												</li>
											@endif
										@endforeach
									</ul>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>