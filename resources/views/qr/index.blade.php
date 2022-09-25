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




body {
  /* overflow: hidden; */
  margin: 0;  
  /* background: #222; */
}

#main-img {
  display: block;
  border: 1px solid rgba(255,255,255,0.2);
  filter: grayscale(0);
  margin: 20px;
  height: 300px;
  width: 800px;
      object-fit: cover;
      object-position: center center;
}

#zoom-img {
  pointer-events: none;
  position: relative;
  top: 50%;
  left: 50%;
}

#zoom {
  position: absolute;
  width: 250px;
  height: 250px;
  box-shadow: 0 0 0 2px rgba(255,0,0,0.5),
    5px 5px 10px 5px rgba(0,0,0,0.2);
  border-radius: 50%;  
  top: 0;
  left: 0;
  overflow: hidden;
  pointer-events: none;
  visibility: hidden;
  opacity: 0;
}






	</style>




</head>

<body>

	<!--
    price start
    ============================ -->
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

										



											<img id="main-img"  src="{{ url('public/Ayb_item/'.$item->img) }}"/>
											<div id="zoom">
												<img id="zoom-img"  />
											</div>




                                            <div class="item-title">
                                                <h2>{{ $item->name }} </h2>
                                                <div class="border-bottom"></div>
												@if( $item->group_menu_id != 2 )
													<span>$ {{ $item->price }} </span>
												@endif
                                            </div>
                                            <p>{{ $item->description }}</p>
                                        </div>
                                    </li>
                                @endforeach

							</ul>
						</div>
					</div>
				</div><!-- .col-md-12 close -->
			</div><!-- .row close -->
		</div><!-- .containe close -->
	</section><!-- #price close -->

	
	<!-- <section id="contact-us" class="mb-3">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="block">
						<h1 class="heading wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">Algunas
							<span>SUGERENCIAS</span></h1>
						<form>
							<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="600ms">
								<input type="email" class="form-control" id="exampleInputEmail1"
									placeholder="Nombre y Apellido">
							</div>
							<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="800ms">
								<input type="text" class="form-control" placeholder="Numero de Whatsapp">
							</div>
							<div class="form-group wow fadeInDown" data-wow-duration="500ms" data-wow-delay="1000ms">
								<textarea class="form-control" rows="3" placeholder="Escribanos sus sugerencias"></textarea>
							</div>
						</form>
						<a class="btn btn-default wow bounceIn" data-wow-duration="500ms" data-wow-delay="1300ms" href="menu-list-qr/#"
							role="button">Enviar</a>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
<script>
	var zoom    = document.querySelector("#zoom");
var zoomImg = document.querySelector("#zoom-img");
var mainImg = document.querySelector("#main-img");
var enterTL = new TimelineMax({ paused: true });
var timer   = TweenLite.delayedCall(1, () => enterTL.reverse()).pause();

var cx, cy, ratio;

window.addEventListener("load", init);

function init() {
  
  zoomImg.src = mainImg.src;
  ratio = mainImg.naturalWidth / mainImg.width;
  resize();
  
  TweenLite.set([zoom, zoomImg], { xPercent: -50, yPercent: -50 });
  TweenLite.set(zoom, { autoAlpha: 0, scale: 0 });
  
  enterTL
    .to(mainImg, 0.5, { filter: "grayscale(1)", "-webkit-filter": "grayscale(1)" }, 0)
    .to(zoom, 0.5, { autoAlpha: 1, scale: 1 }, 0)
    
  window.addEventListener("resize", resize);  
  mainImg.addEventListener("mouseleave", leaveAction);
  mainImg.addEventListener("mousemove", moveAction);
}

function leaveAction() {
  enterTL.reverse();
}

function moveAction(e) {
  enterTL.play();
  timer.restart(true);
  TweenLite.set(zoom, { x: e.x, y: e.y });
  TweenLite.set(zoomImg, { x: (cx - e.x) * ratio, y: (cy - e.y) * ratio }); 
}

function resize() { 
  var rect = mainImg.getBoundingClientRect();
  cx = rect.left + rect.width  / 2;
  cy = rect.top  + rect.height / 2;
}

</script>
</body>

</html>