<div class="upcoming-vehicles">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><span>UPCOMING</span> COMMERCIAL VEHICLES</h2>
				<?php echo $vehicle_news->content; ?>
			</div>
		</div>
		<div class="row">
			@foreach ($three_upcoming_products as $upcoming_product)
			<div class="col-md-4 col-sm-4">
				<div class="thumbnail">
				    <img src="{{ URL('/uploads/product/home_thumb_image/'.$upcoming_product->home_thumb_image )}}" alt="">
				    <div class="caption">
				        <?php echo $upcoming_product->home_page_description; ?>
				        <p class="text-center">
				        	<a href="{{ URL('product/'.$upcoming_product->url) }}" class="btn btn-primary relative" role="button">
				        		DETAILS <span><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></span>
				        	</a>
				        </p>
				    </div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>