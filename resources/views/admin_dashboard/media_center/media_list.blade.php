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
						href="{!! url('/add_media'); !!}" 
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
								<th scope="col">Image1</th>
								<th scope="col">Image2</th>
								<th scope="col">Image3</th>
								<th scope="col">Image4</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($medias as $media)
							<tr>
								<th scope="row">{{ $media->id }}</th>
								<td>
									{{ $media->title }}
								</td>
								<td>
									<img 
									style="width: 150px; height: auto;" 
									src="{{ URL('/uploads/media/'.$media->image_1 )}}">
								</td>
								<td>
									<img 
									style="width: 150px; height: auto;" 
									src="{{ URL('/uploads/media/'.$media->image_2 )}}">
								</td>
								<td>
									<img 
									style="width: 150px; height: auto;" 
									src="{{ URL('/uploads/media/'.$media->image_3 )}}">
								</td>
								<td>
									<img 
									style="width: 150px; height: auto;" 
									src="{{ URL('/uploads/media/'.$media->image_4 )}}">
								</td>
								
								<td>
									@if ($media->is_active == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									<form 
										action="{{ url('/media_status_update/'.$media->id )}}" 
										method="POST" 
										style="display: inline-block;">
										{{ csrf_field() }}
										{{ method_field('PATCH') }}
										<button 
											role="button" 
											type="submit" 
											class="btn btn-outline-info btn-sm">
											@if ($media->is_active == '1')
												Inactive
											@else
												Active
											@endif
										</button>
										
									</form>

									<a 
										href="{{ url('/edit_media/'.$media->id )}}" 
										role="button" 
										class="btn btn-outline-primary btn-sm">Edit
									</a>

									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_product/'.$media->id )}}" 
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