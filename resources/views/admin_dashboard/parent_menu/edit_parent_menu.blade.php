@extends('layouts.app')
@section('content')
    @include('admin_dashboard.page_name')
                <div class="card-header">{{ $page_name }} </div>
                <div class="card-body">
                	<form 
                		class="needs-validation" 
                		novalidate 
                		method="POST" 
                		action="{{ url('/update_parent_menu/'.$menu->id) }}">
                		{{ method_field('PATCH') }}
                		{{ csrf_field() }}
						<div class="form-group row {{ $errors->has('menu_name') ? ' has-error' : '' }}">
							<label for="menu_name" class="col-sm-2 col-form-label">Menu name</label>
							<div class="col-sm-10">
								<input 
									type="text" 
									class="form-control" 
									id="menu_name" 
									name="menu_name" 
									placeholder="menu name" 
									value="{{ $menu->menu_name }}" 
									required 
									{{ $errors->has('menu_name') ? 'is-invalid' : '' }}>
								<div class="invalid-feedback">{{ $errors->first('menu_name') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('url') ? ' has-error' : '' }}">
							<label for="url" class="col-sm-2 col-form-label">Menu url</label>
							<div class="col-sm-10">
								<input 
									type="text" 
									class="form-control" 
									id="url" 
									name="url" 
									placeholder="url" 
									value="{{ $menu->url }}" 
									required 
									{{ $errors->has('url') ? 'is-invalid' : '' }}>
								<div class="invalid-feedback">{{ $errors->first('url') }}</div>
							</div>
						</div>

						<div class="form-group row {{ $errors->has('order') ? ' has-error' : '' }}">
							<label for="order" class="col-sm-2 col-form-label">Order</label>
							<div class="col-sm-10">
								<input 
									type="number" 
									class="form-control" 
									id="order" 
									name="order" 
									placeholder="order" 
									value="{{ $menu->order }}" 
									required 
									{{ $errors->has('order') ? 'is-invalid' : '' }}>
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
											{{ $menu->is_active == '1'? 'checked': '' }}>
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
											{{ $menu->is_active == '0'? 'checked': '' }}>
										<label class="form-check-label" for="is_active_2">
										No
										</label>
									</div>
								</div>
							</div>
						</fieldset>
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