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
						href="{!! url('/add_product_specification'); !!}" 
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
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($product_specifications as $product_specification)
							<tr>
								<th scope="row">{{ $product_specification->id }}</th>
								<td>
									{{ $product_specification->title }}
								</td>
								<td>
									<a href="{{ url('/edit_product_specification/'.$product_specification->id )}}" role="button" class="btn btn-outline-primary btn-sm">Edit</a>
									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_product_specification/'.$product_specification->id )}}" 
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