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
					    <li 
					    	class="breadcrumb-item">
					    	<a href="{!! url('/media_center'); !!}">Media center</a>
					   	</li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
					</ol>
				</div>
				<div class="card-body">
					<form 
                		enctype="multipart/form-data" 
                		novalidate 
                		method="POST" 
                		action="{!! url('/save_media'); !!}">
                		{{ csrf_field() }}

                		<div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
							<label for="title" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="title" value="{{ old('title')}}" required>
								<div class="invalid-feedback">{{ $errors->has('title') ? $errors->first('title'):'Write media title please' }}</div>
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

						<div class="form-group row {{ $errors->has('content') ? ' has-error' : '' }}">
							<label for="validationCustomOverview" class="col-sm-2 col-form-label">Content</label>
							<div class="col-sm-10">
								<textarea 
									class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" 
									id="summernote" 
									name="content"
									required
									value="{{ old('content')}}"
									>
								</textarea>
								<div class="invalid-feedback">
									{{ $errors->has('content') ? $errors->first('content'):'Write media content please' }}
								</div>
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
<script>
	$(document).ready(function() {
	  	$('#summernote').summernote({
	  		placeholder: 'Write media content here',
	        height: 200
	  	});
	});
</script>
@endsection