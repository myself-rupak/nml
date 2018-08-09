@extends('layouts.app')
<!--@section('title', 'Welcome to Nitol Motors Limited')-->
@section('content')
	@include('admin_dashboard.page_name')
				<div class="card-header">{{ $page_name }} 
					<a 
						href="{!! url('/add_parent_menu'); !!}" 
						role="button" 
						class="float-right btn btn-outline-success btn-sm">Add
					</a>
				</div>
                <div class="card-body">
                	<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Menu name</th>
								<th scope="col">Menu URL</th>
								<th scope="col">order</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($parent_menus as $parent_menu)
							<tr>
								<th scope="row">{{ $parent_menu->id }}</th>
								<td>{{ $parent_menu->menu_name }}</td>
								<td>{{ $parent_menu->url }}</td>
								<td>{{ $parent_menu->order }}</td>
								<td>
									@if ($parent_menu->is_active == '1')
										<span class="badge badge-success">Yes</span>
									@else
										<span class="badge badge-warning">No</span>
									@endif
								</td>
								<td>
									<a href="{{ url('/edit_parent_menu/'.$parent_menu->id )}}" role="button" class="btn btn-outline-primary btn-sm">Edit</a>
									<form 
										onsubmit="return confirm('Do you really want to delete?');" 
										action="{{ url('/delete_parent_menu/'.$parent_menu->id )}}" 
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