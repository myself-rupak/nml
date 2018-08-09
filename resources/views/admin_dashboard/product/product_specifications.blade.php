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
					<form 
                		class="needs-validation"
                		novalidate 
                		method="POST" 
                		action="{!! url('/save_product_wise_specification/'.$product->id); !!}">
                		{{ csrf_field() }}
						<table class="table table-bordered">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Specification</th>
									<th scope="col">Content</th>
								</tr>
							</thead>
							<tbody>
								@php
									$product_specifications = $product->productWiseSpecifications;
								@endphp
								@foreach($specifications as $specification)
								@php
									$product_specification = $product_specifications->whereIn('product_specification_id', $specification->id)->first();
								@endphp
								<tr>
									<td>{{ $specification->id }}</td>
									<td>{{ $specification->title }}</td>
									<td>
										<input 
											type="text" 
											name="specification_content_{{ $specification->id }}" 
											class="form-control" 
											value="{{ $product_specification['specification_detail'] }}" />
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="form-group row">
							<div class="col-sm-12">
								<button type="submit" class="btn btn-primary float-right">Add</button>
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection