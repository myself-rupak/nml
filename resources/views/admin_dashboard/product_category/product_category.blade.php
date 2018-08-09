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
						href="{!! url('/add_product_category'); !!}" 
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
								<th scope="col">Banner</th>
								<th scope="col">Image</th>
								<th scope="col">Hover image</th>
								<th scope="col">Menu image</th>
								<th scope="col">Menu URL</th>
								<th scope="col">order</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($product_categories as $product_category)
							<tr>
								<th scope="row">{{ $product_category->id }}</th>
								<td>{{ $product_category->title }}</td>
								<td>
									<img
									style="width: 150px; height: auto;"
									src="{{ URL('/uploads/product_category/banner_image/'.$product_category->banner_image )}}">
								</td>
								<td>
									<img src="{{ URL('/uploads/product_category/image/'.$product_category->image )}}">
								</td>
								<td>
									<img src="{{ URL('/uploads/product_category/hover_image/'.$product_category->hover_image )}}">
								</td>
								<td style="background: #B2B2B2; text-align: center;">
									<img src="{{ URL('/uploads/product_category/menu_image/'.$product_category->menu_image )}}">
								</td>
								<td>{{ $product_category->url }}</td>
								<td>{{ $product_category->order }}</td>
								<td>
									@if ($product_category->is_active == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									<a href="{{ url('/edit_product_category/'.$product_category->id )}}" role="button" class="btn btn-outline-primary btn-sm">Edit</a>
									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_product_category/'.$product_category->id )}}" 
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