<div class="navbar navbar-fixed-bottom">
	@livewire('components.navigation-map', ['comercio_id' => $comercio_id])
	<div class="footer footer-color">  
		<div class="row">
				<div class="col-12 col-md-3 my-1">
					<span><img class="img-fluid footer-img" style="width: 60%" src="/img/LOGO_DDR.png" alt=""></span>
				</div>
				<div class="col-12 col-md-3 my-1 text-dark">
					<span>COPYRIGHT &copy; {{ date('Y') }} DDR SISTEMAS C.A. RIF: J-31512955-8</span>
					<span>V1.0.0 PV2</span>
				</div>
				<div class="col-12 col-md-6 my-1">
					<span><img class="img-fluid footer-img2" src="/img/pie.png" alt=""></span>
				</div>
		</div>
	</div>
</div>