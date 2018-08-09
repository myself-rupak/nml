<div class="vehicles random">
	<div class="container">
		<div class="row">
			@foreach ($random_products as $random_product)
			<div class="col-md-4 col-sm-4">
				<div class="thumbnail">
					<p class="text-right text-muted">{{ $random_product->product_types_title }}</p>
				    <img src="{{ URL('/uploads/product/home_thumb_image/'.$random_product->home_thumb_image )}}" alt="">
				    <div class="caption">
				        <h3 class="text-center">{{ $random_product->product_title }}</h3>
				        <div>
				        	<?php echo $random_product->home_page_description; ?>
				        </div>
				        <p class="text-center">
				        	<a 
				        		href="{{ URL('product/'.$random_product->url) }}" 
				        		class="btn btn-primary relative" 
				        		role="button"
				        		>
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
@foreach ($product_categories as $product_category)
<div class="vehicles {{ $product_category->url }}" style="display: none;">
	<div class="container">
		<div class="row">
			@php
				$i = 1;
			@endphp
			@foreach($product_category->products as $product)
				@if ($product->featured_product == '1' && $product->is_active == '1' && $product->product_condition == '1' && $i <= 3)
					<div class="col-md-4 col-sm-4">
						<div class="thumbnail">
							<p class="text-right text-muted">{{ $product->productType->title }}</p>
						    <img src="{{ URL('/uploads/product/home_thumb_image/'.$product->home_thumb_image )}}" alt="">
						    <div class="caption">
						        <h3 class="text-center">{{ $product->title }}</h3>
						        <div>
						        	<?php echo $product->home_page_description; ?>
						        </div>
						        <p class="text-center">
						        	<a 
						        		href="{{ URL('product/'.$product->url) }}" 
						        		class="btn btn-primary relative" 
						        		role="button"
						        		>
						        		DETAILS <span><i class="fa fa-angle-right fa-2x" aria-hidden="true"></i></span>
						        	</a>
						        </p>
						    </div>
						</div>
					</div>
				@endif
				@php
					$i++;
				@endphp
			@endforeach
		</div>
	</div>
</div>
@endforeach
