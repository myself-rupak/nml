<div class="product-details">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumbs text-right text-muted">
					HOME / PRODUCT / {{ $product->productType->title }} / <span> {{ $product->title }} / Overview</span>
				</div>
				<div class="product-title">
					<h1>{{ $product->title }}</h1>
				</div>
			</div>
		</div>
		<div class="row tab-links">
			<div class="col-md-4 col-sm-4 col-xs-4">
				<a href="#overview" class="tab-link active">Overview</a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<a href="#specifications" class="tab-link">Specifications</a>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-4">
				<a href="#gallery" class="tab-link">Image Gallery</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<img src="{{ URL('/uploads/product/overview/'.$product->overview_image )}}" alt="">
			</div>
		</div>
		<div id="overview" class="tab-content">
			<div class="row">
				<div class="col-md-12">
					<?php echo $product->overview; ?>
				</div>
			</div>
		</div>
		<div id="specifications" class="tab-content hidden">
			<h3>{{ $product->title }} Specifications</h3>
			<div class="table-responsive">
				<table class="table table-striped">
					<tbody>
						@foreach ($product->productWiseSpecifications as $specification)
						<tr>
							<td>{{ $specification->productSpecification->title }}</td>
							<td>
								{{ $specification->specification_detail }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div id="gallery" class="tab-content hidden">
			<div class="row thumbs">
				@php
					$i = 1;
				@endphp
				@foreach ($product->productGalleryImages as $gallery)
				<div class="col-md-3 col-sm-3 col-xs-3">
					<a 
						href="{{ URL('/uploads/product/product_image_gallery/'.$gallery->image )}}" 
						class="thumb {{ ($i == '1')?'active':'' }}"
						style="background: #EDEDEE;">
						<img src="{{ URL('/uploads/product/product_image_gallery/'.$gallery->image )}}" style="height: auto !important;" alt="">
					</a>
				</div>
				@php
					$i++;
				@endphp
				@endforeach
			</div>
			<div class="relative">
				<div class="prev-image">
					<img src="{{ URL::asset('assets/images/left-arrow.png') }}" alt="">
				</div>
				<div class="next-image">
					<img src="{{ URL::asset('assets/images/right-arrow.png') }}" alt="">
				</div>
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-1"></div>
					<div 
						class="col-md-10 col-sm-10 col-xs-10" 
						style="
						background-image: url( {{ URL('/uploads/product/background_image/'.$product->background_image )}} ) !important;
						background-position: center;
						max-width: 100%;
						height: auto;">
						<img src="{{ URL('/uploads/product/product_image_gallery/'.$product->productGalleryImages[0]->image )}}" alt="" class="gallery-image">
					</div>
					<div class="col-md-1 col-sm-1 col-xs-1"></div>
				</div>
			</div>
		</div>
	</div>
</div>