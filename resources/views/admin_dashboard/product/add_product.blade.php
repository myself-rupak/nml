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
                		action="{!! url('/save_product/'); !!}">
                		{{ csrf_field() }}

                		<fieldset class="form-group">
							<div class="row">
								<legend class="col-form-label col-sm-2 pt-0">Product status</legend>
								<div class="col-sm-10">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="product_condition" id="is_active_1" value="1" checked>
										<label class="form-check-label" for="is_active_1">
										Existing
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="product_condition" id="is_active_2" value="0">
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
								<input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="title" value="{{ old('title')}}" required>
								<div class="invalid-feedback">{{ $errors->has('title') ? $errors->first('title'):'Write product title please' }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('url') ? ' has-error' : '' }}">
							<label for="url" class="col-sm-2 col-form-label">Url</label>
							<div class="col-sm-10">
								<input type="text" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" id="url" name="url" placeholder="url" value="{{ old('url')}}" required>
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
									<option value="{{ $productType->id }}">{{ $productType->title }}</option>
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
										<input class="form-check-input" type="radio" name="featured_product" id="is_active_1" value="1" checked>
										<label class="form-check-label" for="is_active_1">
										Yes
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="featured_product" id="is_active_2" value="0">
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
										<input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" checked>
										<label class="form-check-label" for="is_active_1">
										Yes
										</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="is_active" id="is_active_2" value="0">
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
									value="{{ old('overview')}}"
									>
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
									value="{{ old('home_page_description')}}">
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
									required
									value="{{ old('product_list_page_description')}}">
								</textarea>
								<div class="invalid-feedback">
									{{ $errors->has('product_list_page_description') ? $errors->first('product_list_page_description'):'Write product description for list page' }}
								</div>
							</div>
						</div>

						<div class="row" style="margin-top: 10px; margin-bottom: 10px;">
							<div class="col-sm-3">
								<input 
									id="input-b3" 
									name="banner_image" 
									type="file" 
									class="file {{ $errors->has('banner_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="banner image"
									required
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
									required
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
									data-msg-placeholder="home page thumb image"
									required
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
									required
								>
							</div>
						</div>

						<!--<div class="form-group row">
							<label for="validationCustomMobileViewDescription" class="col-sm-2 col-form-label">Mobile View Description</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control" 
									id="mobile_summernote" 
									name="mobile_description">
								</textarea>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('mobile_slider_image') ? ' has-error' : '' }}" style="margin-bottom: 1rem !important;">
							<div class="col-sm-12">
								<input 
									id="input-b3" 
									name="mobile_slider_image" 
									type="file" 
									class="file {{ $errors->has('mobile_slider_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select mobile slider image for upload..."
									required
								>
								<div class="invalid-feedback">{{ $errors->first('mobile_slider_image') }}</div>
							</div>
						</div>-->

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