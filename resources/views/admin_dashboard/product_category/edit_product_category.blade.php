@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">{{ $page_name }} </div>
                <div class="card-body">
                	<form 
                		class="needs-validation" 
                		enctype="multipart/form-data" 
                		novalidate method="POST" 
                		action="{!! url('/update_product_category/'.$product_category->id ); !!}">
                		{{ method_field('PATCH') }}
                		{{ csrf_field() }}

						<div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<input 
									type="text" 
									class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" 
									id="title" 
									name="title" 
									placeholder="title" 
									value="{{ $product_category->title }}" required>
								<div class="invalid-feedback">{{ $errors->first('title') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('url') ? ' has-error' : '' }}">
							<label for="url" class="col-sm-2 col-form-label">Url</label>
							<div class="col-sm-10">
								<input 
									type="text" 
									class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" 
									id="url" 
									name="url" 
									placeholder="url" value="{{ $product_category->url }}" required>
								<div class="invalid-feedback">{{ $errors->first('url') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('order') ? ' has-error' : '' }}">
							<label for="order" class="col-sm-2 col-form-label">Order</label>
							<div class="col-sm-10">
								<input 
									type="number" 
									class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" 
									id="order" 
									name="order" 
									placeholder="order" 
									value="{{ $product_category->order }}" required>
								<div class="invalid-feedback">{{ $errors->first('order') }}</div>
							</div>
						</div>

						<fieldset class="form-group">
							<div class="row">
								<legend class="col-form-label col-sm-2 pt-0">Is active?</legend>
								<div class="col-sm-10">
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="radio" 
											name="is_active" 
											id="is_active_1" 
											value="1" 
											{{ $product_category->is_active == '1'? 'checked': '' }}>
										<label class="form-check-label" for="is_active_1">
										Yes
										</label>
									</div>
									<div class="form-check">
										<input 
											class="form-check-input" 
											type="radio" 
											name="is_active" 
											id="is_active_2" 
											value="0" 
											{{ $product_category->is_active == '0'? 'checked': '' }}>
										<label class="form-check-label" for="is_active_2">
										No
										</label>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="form-group row">
							<div class="container download" id="downloads">
							    <h2>Image lists</h2>
							    <div class="row">
							    	<div class="col-md-3 col-sm-6 col-xs-12">
							        	<p class="lead">Banner image</p>
								        <a href="#">
								        	<input type="hidden" name="old_banner_image" value="{{ $product_category->banner_image }}">
								            <img alt="AltText" src="{{ URL('/uploads/product_category/banner_image/'.$product_category->banner_image )}}" class="img-fluid">
								        </a>
							        </div>

							        <div class="col-md-3 col-sm-6 col-xs-12">
							        	<p class="lead">Main image</p>
								        <a href="#">
								        	<input type="hidden" name="old_image" value="{{ $product_category->image }}">
								            <img alt="AltText" src="{{ URL('/uploads/product_category/image/'.$product_category->image )}}" class="img-fluid">
								        </a>
							        </div>

							        <div class="col-md-3 col-sm-6 col-xs-12">
							        	<p class="lead">Hover image</p>
								        <a href="#">
								        	<input type="hidden" name="old_hover_image" value="{{ $product_category->hover_image }}">
								            <img  alt="AltText" src="{{ URL('/uploads/product_category/hover_image/'.$product_category->hover_image )}}" class="img-fluid">
								        </a>
							        </div>

							        <div class="col-md-3 col-sm-6 col-xs-12">
							        	<p class="lead">menu image</p>
								        <a href="#" style="background: #0079;">
								        	<input type="hidden" name="old_menu_image" value="{{ $product_category->menu_image }}">
								            <img src="{{ URL('/uploads/product_category/menu_image/'.$product_category->menu_image )}}" alt="AltText" class="img-fluid">
								        </a>
							        </div>
						        </div>
						    </div>
						</div>
						<div class="form-group row {{ $errors->has('banner_image') ? ' has-error' : '' }}" style="margin-bottom: 1rem !important;">
							<div class="col-sm-12">
								<input 
									id="input-b3" 
									name="banner_image" 
									type="file" 
									class="file {{ $errors->has('banner_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select banner image for upload..."
								>
								<div class="invalid-feedback">{{ $errors->first('banner_image') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('image') ? ' has-error' : '' }}" style="margin-bottom: 1rem !important;">
							<div class="col-sm-12">
								<input 
									id="input-b3" 
									name="image" 
									type="file" 
									class="file {{ $errors->has('image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select image for upload..."
								>
								<div class="invalid-feedback">{{ $errors->first('image') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('hover_image') ? ' has-error' : '' }}" style="margin-bottom: 1rem !important;">
							<div class="col-sm-12">
								<input 
									id="input-b3" 
									name="hover_image" 
									type="file" 
									class="file {{ $errors->has('hover_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select hover image for upload..."
								>
								<div class="invalid-feedback">{{ $errors->first('hover_image') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('menu_image') ? ' has-error' : '' }}" style="margin-bottom: 1rem !important;">
							<div class="col-sm-12">
								<input 
									id="input-b3" 
									name="menu_image" 
									type="file" 
									class="file {{ $errors->has('menu_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select menu image for upload..."
								>
								<div class="invalid-feedback">{{ $errors->first('menu_image') }}</div>
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