@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">
                	<ol class="breadcrumb">
					    <li 
					    	class="breadcrumb-item">
					    	<a href="{!! url('/hero_slider'); !!}">Hero slider</a>
					   	</li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
					</ol>
                </div>
                <div class="card-body">
                	<form 
                		class="needs-validation" 
                		enctype="multipart/form-data" 
                		novalidate 
                		method="POST" 
                		action="{!! url('/save_hero_slider'); !!}">
                		{{ csrf_field() }}

						<div class="form-group row {{ $errors->has('template') ? ' has-error' : '' }}">
							<label for="validationCustomTemplate" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<select 
									class="form-control {{ $errors->has('template') ? 'is-invalid' : '' }}" 
									id="validationCustomTemplate"
									name="template"
									required>
									<option value="">Select template</option>
									<option value="1">Template 1(Center text with shadow)</option>
									<option value="2">Template 2(Right text without shadow)</option>
									<option value="3">Template 3(Right text with shadow)</option>
								</select>
								<div class="invalid-feedback">{{ $errors->has('template') ? $errors->first('template'):'Select template please' }}</div>
							</div>
						</div>
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
						<div class="form-group row">
							<label for="validationCustomDescription" class="col-sm-2 col-form-label">Description</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control" 
									id="summernote" 
									name="description">
								</textarea>
							</div>
						</div>

						<div class="form-group row">
							<label for="validationCustomMobileViewDescription" class="col-sm-2 col-form-label">Mobile View Description</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control" 
									id="mobile_summernote" 
									name="mobile_description">
								</textarea>
							</div>
						</div>

						<div class="row" style="margin-bottom: 1rem !important;">
							<div class="col-sm-6">
								<input 
									id="input-b3" 
									name="slider_image" 
									type="file" 
									class="file {{ $errors->has('slider_image') ? 'is-invalid' : '' }}"
									data-show-upload="false" 
									data-show-caption="true" 
									data-msg-placeholder="Select slider image for upload..."
									required
								>
							</div>
							<div class="col-sm-6">
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
<script>
	$(document).ready(function() {
	  	$('#summernote').summernote({
	  		placeholder: 'Write description here',
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