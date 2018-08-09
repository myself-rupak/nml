@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">{{ $page_name }} </div>
                <div class="card-body">
                	<form class="needs-validation" enctype="multipart/form-data" novalidate method="POST" action="{!! url('/save_product_specification'); !!}">
                		{{ csrf_field() }}
                		<div class="after-add-more">
							<div class="form-group row {{ $errors->has('title.'.$number) ? ' has-error' : '' }}">
								<label for="title" class="col-sm-2 col-form-label">Title</label>
								<div class="col-sm-10">
									<div class="input-group mb-3">
										<input 
											type="text" 
											class="form-control {{ $errors->has('title.'.$number) ? 'is-invalid' : '' }}" 
											placeholder="Product specification title" 
											aria-label="Product specification title" 
											aria-describedby="basic-addon2"
											name="title[]"
											{{ old('title')}}
											>
										<div class="input-group-append">
											<button 
												class="btn btn-success add-more" 
												type="button">
												<i class="glyphicon glyphicon-plus"></i> 
												+
											</button>
											<!--<span class="input-group-text" id="basic-addon2">@example.com</span>-->
										</div>
										<div class="invalid-feedback">{{ $errors->first('title.'.$number) }}</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</div>
					</form>
					<div class="copy hide" style="display: none;">
						<div class="form-group row {{ $errors->has('title.'.$number) ? ' has-error' : '' }}" style="margin-top:10px">
							<label for="title" class="col-sm-2 col-form-label">Title</label>
							<div class="col-sm-10">
								<div class="input-group mb-3">
									<input 
										type="text" 
										class="form-control {{ $errors->has('title.'.$number) ? 'is-invalid' : '' }}" 
										placeholder="Product specification title" 
										aria-label="Product specification title" 
										aria-describedby="basic-addon2"
										name="title[]"
										{{ old('title')}}
										>
									<div class="input-group-append">
										<button 
											class="btn btn-danger remove" 
											type="button">
											<i class="glyphicon glyphicon-plus"></i> 
											-
										</button>
										<!--<span class="input-group-text" id="basic-addon2">@example.com</span>-->
									</div>
									<div class="invalid-feedback">{{ $errors->first('title.'.$number) }}</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	$(".add-more").click(function(){
		var html = $(".copy").html();
		$(".after-add-more").append(html);
	});

	$("body").on("click",".remove",function(){ 
		$(this).parents(".form-group").remove();
	});
});
</script>
@endsection