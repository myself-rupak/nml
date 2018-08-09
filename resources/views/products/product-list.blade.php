<div class="product-list">
	<div class="container">
		@if(!empty($products))
				@if (count($products)>3)
					@php
						$number = 1;
						$num = 3;
						$i = 1;
					@endphp
						@foreach ($products as $product)
							@if ($number == 1)
							<div class="row hidden-xs">
							@endif
								<div 
									class='col-sm-4 col-md-4' 
									style='float: left; text-align: left; padding-left: 5px;'>
									<div class="thumbnail">
									    <a href="{{ URL('/product/'.$product->url) }}">
									    	<img src="{{ URL('/uploads/product/list_thumb_image/'.$product->list_thumb_image )}}" alt="">
									   	</a>
									    <div class="caption">
									        <h3>
									        	<a href="{{ URL('/product/'.$product->url) }}">
									        	{{ $product->title }}
									        	</a>
									        </h3>
										    <div>
										    	<?php echo $product->product_list_page_description; ?>
										    </div>
									    </div>
									</div>
								</div>
							@if (($number == $num))
							</div>
								@php
								$number = 1;
								continue;
								@endphp
							@endif
							@php
							$number++;
							$i++;
							@endphp
						@endforeach
					@if ($i == count($products))
						</div>
					@endif
				@else 
				<div class="row hidden-xs rupak">
					@foreach ($products as $product)
					<div 
						class='col-sm-4 col-md-4 rupak' 
						style='float: left; text-align: left; padding-left: 5px;'>
						<div class="thumbnail">
						    <a href="{{ URL('/product/'.$product->url) }}">
						    	<img src="{{ URL('/uploads/product/list_thumb_image/'.$product->list_thumb_image )}}" alt="">
						   	</a>
						    <div class="caption">
						        <h3>
						        	<a href="{{ URL('/product/'.$product->url) }}">
						        	{{ $product->title }}
						        	</a>
						        </h3>
							    <div>
							    	<?php echo $product->product_list_page_description; ?>
							    </div>
						    </div>
						</div>
					</div>
					@endforeach
				</div>
				@endif

			@if (count($products)>2)
				@php
					$mob_number = 1;
					$mob_num = 2;
				@endphp
				@foreach ($products as $product)
					@if ($mob_number == 1)
					<div class="row visible-xs">
					@endif
					<div class="col-md-4 col-sm-4 col-xs-6">
						<div class="thumbnail">
						    <a href="{{ URL('/product/'.$product->url) }}">
						    	<img src="{{ URL('/uploads/product/list_thumb_image/'.$product->list_thumb_image )}}" alt="">
						   	</a>
						    <div class="caption">
						        <h3><a href="{{ URL('/product/'.$product->url) }}">{{ $product->title }}</a></h3>
							    <div>
							    	<?php echo $product->product_list_page_description; ?>
							    </div>
						    </div>
						</div>
					</div>
					@if ($mob_number == $mob_num)
					</div>
						@php
						$mob_number = 1;
						continue;
						@endphp
					@endif
					@php
						$mob_number++;
					@endphp
				@endforeach
			@else 
				<div class="row visible-xs">
					@foreach ($products as $product)
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="thumbnail">
							    <a href="{{ URL('/product/'.$product->url) }}">
							    	<img src="{{ URL('/uploads/product/list_thumb_image/'.$product->list_thumb_image )}}" alt="">
							    </a>
							    <div class="caption">
							        <h3><a href="{{ URL('/product/'.$product->url) }}">{{ $product->title }}</a></h3>
								    <div>
								    	<?php echo $product->product_list_page_description; ?>
								    </div>
							    </div>
							</div>
						</div>
					@endforeach
				</div>
			@endif
		@endif
	</div>
</div>