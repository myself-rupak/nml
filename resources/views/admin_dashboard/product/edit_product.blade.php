@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">
                	<ol class="breadcrumb">
					    <li class="breadcrumb-item"><a href="{!! url('/product_item'); !!}">Product list</a></li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
					</ol>
				</div>
                <div class="card-body">
                	<form 
                		class="needs-validation" 
                		enctype="multipart/form-data" 
                		novalidate 
                		method="POST" 
                		action="{!! url('/update_product/'.$product->id); !!}">
                		{{ method_field('PATCH') }}
                		{{ csrf_field() }}

                		<fieldset class="form-group">
							<div class="row">
								<legend class="col-form-label col-sm-2 pt-0">Product status</legend>
								<div class="col-sm-10">
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="radio" 
											name="product_condition" 
											id="is_active_1" 
											value="1" 
											{{ ($product->product_condition == '1')?'checked':'' }}>
										<label class="form-check-label" for="is_active_1">
										Existing
										</label>
									</div>
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="radio" 
											name="product_condition" 
											id="is_active_2" 
											value="0"
											{{ ($product->product_condition == '0')?'checked':'' }}>
										<label class="form-check-label" for="is_active_2">
										Upcoming
										</label>
									</div>
								</div>
							</div>
						</fieldset>

                		<div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="title" value="{{ $product->title }}" required>
								<div class="invalid-feedback">{{ $errors->has('title') ? $errors->first('title'):'Write product title please' }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('url') ? ' has-error' : '' }}">
							<label for="url" class="col-sm-2 col-form-label">Url</label>
							<div class="col-sm-10">
								<input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url" name="url" placeholder="url" value="{{ $product->url }}" required>
								<div class="invalid-feedback">{{ $errors->has('title') ? $errors->first('title'):'Write product url please' }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('product_type') ? ' has-error' : '' }}">
							<label for="validationCustomTemplate" class="col-sm-2 col-form-label">Product type</label>
							<div class="col-sm-10">
								<select 
									class="form-control {{ $errors->has('product_type') ? 'is-invalid' : '' }}" 
									id="validationCustomTemplate"
									name="product_type"
									required>
									<option value="">Select product type</option>
									@foreach($productTypes as $productType)
									<option {{ ($product->product_types_id == $productType->id)?'selected="selected"':'' }} value="{{ $productType->id }}">{{ $productType->title }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">{{ $errors->has('product_type') ? $errors->first('product_type'):'Select product type please' }}</div>
							</div>
						</div>
						<fieldset class="form-group">
							<div class="row">
								<legend class="col-form-label col-sm-2 pt-0">Is featured?</legend>
								<div class="col-sm-10">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="featured_product" id="is_active_1" value="1" {{ ($product->featured_product == '1')?'checked="checked"':'' }}>
										<label class="form-check-label" for="is_active_1">
										Yes
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="featured_product" id="is_active_2" value="0" {{ ($product->featured_product == '0')?'checked="checked"':'' }}>
										<label class="form-check-label" for="is_active_2">
										No
										</label>
									</div>
								</div>
							</div>
						</fieldset>
						<fieldset class="form-group">
							<div class="row">
								<legend class="col-form-label col-sm-2 pt-0">Is active?</legend>
								<div class="col-sm-10">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" {{ ($product->is_active == '1')?'checked="checked"':'' }}>
										<label class="form-check-label" for="is_active_1">
										Yes
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="is_active" id="is_active_2" value="0" {{ ($product->is_active == '0')?'checked="checked"':'' }}>
										<label class="form-check-label" for="is_active_2">
										No
										</label>
									</div>
								</div>
							</div>
						</fieldset>

						<div class="form-group row {{ $errors->has('overview') ? ' has-error' : '' }}">
							<label for="validationCustomOverview" class="col-sm-2 col-form-label">Overview</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control {{ $errors->has('overview') ? 'is-invalid' : '' }}" 
									id="summernote" 
									name="overview"
									required
									>
									{{ $product->overview }}
								</textarea>
								<div class="invalid-feedback">
									{{ $errors->has('overview') ? $errors->first('overview'):'Write product overview please' }}
								</div>
							</div>
						</div>
						

						<div class="form-group row {{ $errors->has('home_page_description') ? ' has-error' : '' }}">
							<label for="validationCustomHomePageDescription" class="col-sm-2 col-form-label">Home page <br> description</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control {{ $errors->has('home_page_description') ? 'is-invalid' : '' }}" 
									id="summernote_home_page_description" 
									name="home_page_description"
									required
									>
									{{ $product->home_page_description }}
								</textarea>

								<div class="invalid-feedback">
									{{ $errors->has('home_page_description') ? $errors->first('home_page_description'):'Write product description for home page' }}
								</div>
							</div>
						</div>
						

						<div class="form-group row {{ $errors->has('product_list_page_description') ? ' has-error' : '' }}">
							<label for="validationCustomProductListDescription" class="col-sm-2 col-form-label">Product list <br> description</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control {{ $errors->has('product_list_page_description') ? 'is-invalid' : '' }}" 
									id="summernote_product_list_page_description" 
									name="product_list_page_description"
									required>
									{{ $product->product_list_page_description }}
								</textarea>
								<div class="invalid-feedback">
									{{ $errors->has('product_list_page_description') ? $errors->first('product_list_page_description'):'Write product description for list page' }}
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="card" style="width: 15rem;">
									<input type="hidden" name="old_banner_image" value="{{ $product->banner_image }}">
								  	<img  
								  		class="card-img-top img-thumbnail" 
								  		src="{{ URL('/uploads/product/banner/'.$product->banner_image )}}" 
								  		alt="Card image cap">
								  	<div class="card-body">
								  		<p>
								  			Banner image
								  		</p>
								  	</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="card" style="width: 15rem;">
									<input type="hidden" name="old_overview_image" value="{{ $product->overview_image }}">
								  	<img  
								  		class="card-img-top img-thumbnail" 
								  		src="{{ URL('/uploads/product/overview/'.$product->overview_image )}}" 
								  		alt="Card image cap">
								  	<div class="card-body">
								  		<p>
								  			Overview image
								  		</p>
								  	</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="card" style="width: 15rem;">
									<input type="hidden" name="old_home_thumb_image" value="{{ $product->home_thumb_image }}">
								  	<img  
								  		class="card-img-top img-thumbnail" 
								  		src="{{ URL('/uploads/product/home_thumb_image/'.$product->home_thumb_image )}}" 
								  		alt="Card image cap">
								  	<div class="card-body">
								  		<p>
								  			Home thumb image
								  		</p>
								  	</div>
								</div>
							</div>

							<div class="col-md-3">
								<div class="card" style="width: 15rem;">
									<input type="hidden" name="old_list_thumb_image" value="{{ $product->list_thumb_image }}">
								  	<img  
								  		class="card-img-top img-thumbnail" 
								  		src="{{ URL('/uploads/product/list_thumb_image/'.$product->list_thumb_image )}}" 
								  		alt="Card image cap">
								  	<div class="card-body">
								  		<p>
								  			List thumb image
								  		</p>
								  	</div>
								</div>
							</div>
						</div>

						<div class="row" style="margin-bottom: 10px; margin-top: 10px;">
							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="banner_image" 
									type="file" 
									class="file {{ $errors->has('banner_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="banner image"
								>
							</div>
							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="overview_image" 
									type="file" 
									class="file {{ $errors->has('overview_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="overview image"
								>
							</div>
							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="home_thumb_image" 
									type="file" 
									class="file {{ $errors->has('home_thumb_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="home page product image"
								>
							</div>
							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="list_thumb_image" 
									type="file" 
									class="file {{ $errors->has('list_thumb_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="list page product image"
								>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function() {
	  	$('#summernote').summernote({
	  		placeholder: 'Write product overview here',
	        height: 200
	  	});

	  	$('#summernote_home_page_description').summernote({
	  		placeholder: 'Write product description here for home page',
	        height: 200
	  	});

	  	$('#summernote_product_list_page_description').summernote({
	  		placeholder: 'Write product description for product list page  here',
	        height: 200
	  	});

	  	$('#mobile_summernote').summernote({
	  		placeholder: 'Write mobile view description here',
	        height: 200
	  	});
	});
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {

  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
@endsection