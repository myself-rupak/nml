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
				<div class="card-header">{{ $page_name }} 
					<a 
						href="{!! url('/add_product'); !!}" 
						role="button" 
						class="float-right btn btn-outline-success btn-sm">Add
					</a>
				</div>
                <div class="card-body">
                	<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Title</th>
								<th scope="col">Image</th>
								<th scope="col">Featured product</th>
								<th scope="col">Product type</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($products as $product)
							<tr>
								<th scope="row">
									{{ $product->id }}
									<br>
									<b>{{ ($product->product_condition == '1')? 'Existing':'Upcoming' }}</b>
								</th>
								<td>{{ $product->title }}</td>
								<td>
									<img style="width: 150px; height: auto;" src="{{ URL('/uploads/product/overview/'.$product->overview_image )}}">
								</td>
								
								<td>
									@if ($product->featured_product == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									{{ $product->productType->title }}
								</td>
								<td>
									@if ($product->is_active == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									<a href="{{ url('/product_wise_specifications/'.$product->id )}}" role="button" class="btn btn-outline-secondary btn-sm">Specifications</a>
									<a href="{{ url('/product_wise_image_gallery/'.$product->id )}}" role="button" class="btn btn-outline-warning btn-sm">Images</a>
									<a href="{{ url('/edit_product/'.$product->id )}}" role="button" class="btn btn-outline-primary btn-sm">Edit</a>
									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_product/'.$product->id )}}" 
										method="POST" 
										style="display: inline-block;">
										{{ csrf_field() }}
										{{ method_field('DELETE') }}
										<button role="button" type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection