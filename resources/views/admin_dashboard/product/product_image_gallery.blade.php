@extends('layouts.app')
@section('content')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center;">
	<strong>{{ session()->get('success') }}</strong>
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">&times;</span>
  	</button>
</div>
@endif
	@include('admin_dashboard.page_name')
				<div class="card-header">
					<ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="{!! url('/product_item'); !!}">Product list</a></li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
					</ol>
				</div>
				<div class="card-body">
					<div class="row">
						@if ($product->background_image != '')
						<div class="col-md-12" style="margin-bottom: 10px;">
							<div class="top-right-corner">
								<form 
									onsubmit="return confirm('Do you really want to delete?');" 
									action="{{ url('/delete_background_image/'.$product->id )}}" 
									method="POST" 
									style="display: inline-block;">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<button role="button" type="submit" class="btn btn-outline-danger btn-sm">X</button>
								</form>
							</div>
							<img 
								class="img-thumbnail" 
								src="{{ URL('/uploads/product/background_image/'.$product->background_image )}}"
								style="width: 100%; height: 400px;">
								<div class="centered">Background image</div>
						</div>
						@endif
						@php 
							$images = $product->productGalleryImages;
						@endphp
						@foreach ($images as $image)
						<div class="col-md-3">
							<div class="card" style="width: 15rem;">
							  	<img 
							  		style="background: {{ ($image->is_active == '1')? '#D4EDDA' :'#F8D7DA' }}" 
							  		class="card-img-top img-thumbnail" 
							  		src="{{ URL('/uploads/product/product_image_gallery/'.$image->image )}}" 
							  		alt="Card image cap">
							  	<div class="card-body">
							  		<form
										action="{{ url('/update_product_gallery_image_status/'.$image->id )}}" 
										method="POST" 
										style="display: inline-block;">
										{{ csrf_field() }}
										{{ method_field('PATCH') }}
										<button 
											role="button" 
											type="submit" 
											class="btn btn-outline-primary btn-sm">
											@if ($image->is_active == '1')
									    		Inactive
									    	@else
									    		Active
									    	@endif
										</button>
									</form>

								    <form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_product_gallery_image/'.$image->id.'/'.$product->id )}}" 
										method="POST" 
										style="display: inline-block;">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button role="button" type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
									</form>
							  	</div>
							</div>
						</div>
						@endforeach
					</div>
					
					<form 
                		enctype="multipart/form-data" 
                		novalidate 
                		method="POST" 
                		action="{!! url('/save_product_gallery_image/'.$product->id); !!}">
                		{{ csrf_field() }}

                		<div class="form-group row" style="margin-bottom: 1rem !important;">
							<div class="col-sm-12">
								<input 
									type="hidden" 
									name="old_background_image" 
									value="{{ $product->background_image }}">
								<input 
									id="input-b3" 
									name="background_image" 
									type="file" 
									class="file"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select background image for upload..."
								>
							</div>
						</div>

						<div class="form-group row" style="margin-bottom: 1rem !important;">
							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="image_1" 
									type="file" 
									class="file"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="image 1 for upload..."
								>
							</div>

							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="image_2" 
									type="file" 
									class="file"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="image 2 for upload..."
								>
							</div>

							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="image_3" 
									type="file" 
									class="file"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="image 3 for upload..."
								>
							</div>

							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="image_4" 
									type="file" 
									class="file"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="image 4 for upload..."
								>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection