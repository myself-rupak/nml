<div class="types-of-vehicles">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<form class="form-inline">
				    <div class="form-group">
				        <input type="text" class="form-control" placeholder="Search NML"> &nbsp;
				    </div>
				    <button type="submit" class="btn btn-default">GO</button>
				</form>
			</div>
			<div class="col-md-5">
				<div class="text-center">
					<h2>TYPES OF VEHICLES</h2>
					<h3>THAT WE ARE CURRENTLY DEALING</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul>
					@foreach ($product_categories as $product_category)
					<li>
						<a href="{{ URL('/products/'.$product_category->url) }}" data-category_type="{{ $product_category->url }}">
							<img src="{{ URL('/uploads/product_category/image/'.$product_category->image )}}" alt="" />
							<img src="{{ URL('/uploads/product_category/hover_image/'.$product_category->hover_image )}}" alt="" class="hidden">
							{{ $product_category->title }}
						</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>