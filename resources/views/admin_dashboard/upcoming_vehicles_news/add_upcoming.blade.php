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
					    	<a href="{!! url('/upcoming_vehicles_news'); !!}">Upcoming vehicles news</a>
					   	</li>
					    <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
					</ol>
				</div>
				<div class="card-body">
					<form
                		novalidate 
                		method="POST" 
                		action="{!! url('/save_upcoming'); !!}">
                		{{ csrf_field() }}

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
									>
									{{ old('content')}}
								</textarea>
								<div class="invalid-feedback">
									{{ $errors->has('content') ? $errors->first('content'):'Write upcoming vehicles news content please' }}
								</div>
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
	  		placeholder: 'Write upcoming vehicles news content please',
	        height: 200
	  	});
	});
</script>
@endsection