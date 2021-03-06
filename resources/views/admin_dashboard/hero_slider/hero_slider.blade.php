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
						href="{!! url('/add_hero_slider'); !!}" 
						role="button" 
						class="float-right btn btn-outline-success btn-sm">Add
					</a>
				</div>
                <div class="card-body">
                	<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Image</th>
								<th scope="col">Template type</th>
								<th scope="col">Description</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sliders as $slider)
							<tr>
								<th scope="row">{{ $slider->id }}</th>
								<td>
									<img 
										style="width: 150px;" 
										src="{{ URL('/uploads/hero_slider/'.$slider->slider_image )}}">
										<br>
										<br>
									<img 
										style="width: 100px;" 
										src="{{ URL('/uploads/hero_slider/mobile/'.$slider->mobile_slider_image )}}">
								</td>
								<td>
									@if ($slider->template == '1')
										Template 1(Center text with shadow)
									@elseif ($slider->template == '2')
										Template 2(Right text without shadow)
									@else
										Template 3(Right text with shadow)
									@endif
								</td>
								<td>
									<?php echo '<b>Web:</b><br />'.$slider->description.'<br />'; ?>
									<?php echo '<b>Mobile:</b><br />'.$slider->mobile_description.'<br />'; ?>
								</td>
								<td>
									@if ($slider->is_active == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									<a href="{{ url('/edit_hero_slider/'.$slider->id )}}" role="button" class="btn btn-outline-primary btn-sm">Edit</a>
									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_hero_slider/'.$slider->id )}}" 
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