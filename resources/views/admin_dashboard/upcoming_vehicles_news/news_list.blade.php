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
						href="{!! url('/add_upcoming'); !!}" 
						role="button" 
						class="float-right btn btn-outline-success btn-sm">Add
					</a>
				</div>
                <div class="card-body">
                	<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Content</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($news as $new)
							<tr>
								<th scope="row">
									{{ $new->id }}
								</th>
								<td><?php echo $new->content; ?></td>
								<td>
									@if ($new->is_active == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									<a 
										href="{{ url('/edit_upcoming_vehicles_news/'.$new->id )}}" 
										role="button" 
										class="btn btn-outline-primary btn-sm">Edit
									</a>

									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_product/'.$new->id )}}" 
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