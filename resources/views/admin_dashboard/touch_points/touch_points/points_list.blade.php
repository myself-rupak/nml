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
						href="{!! url('/add_touch_points'); !!}" 
						role="button" 
						class="float-right btn btn-outline-success btn-sm">Add
					</a>
				</div>
                <div class="card-body">
                	<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Address</th>
								<th scope="col">Contact</th>
								<th scope="col">Type</th>
								<th scope="col">Latitude/Longitude</th>
								<th scope="col">Active?</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($touch_points as $touch_point)
							<tr>
								<th scope="row">{{ $touch_point->id }}</th>
								<td>{{ $touch_point->name }}</td>
								<td><?php echo $touch_point->address.'<br>'.$touch_point->district->name.'/'.$touch_point->thana->name; ?></td>
								<td>
									<?php echo 'Name: '.$touch_point->contact_person.'<br>Number: '.$touch_point->contact_phone.'<br>Email: '.$touch_point->email; ?>
								</td>
								<td>
                                    @php 
                                        $point_type = $touch_point->point_type;
                                    @endphp
                                    {{ $touch_point_types[$point_type] }}
                                </td>
                                <td>
                                    <?php echo 'Lat: '.$touch_point->latitude.'<br>Lon: '.$touch_point->longitude; ?>
                                </td>
                                <td>
                                    <form 
                                        action="{{ url('/update_touch_point_status/'.$touch_point->id )}}" 
                                        method="POST" 
                                        style="display: inline-block;">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        
                                        @if ($touch_point->is_active == '1')
                                            <button role="button" type="submit" class="btn btn-outline-success btn-sm">
                                            Deactive
                                        @else
                                            <button role="button" type="submit" class="btn btn-outline-danger btn-sm">
                                            Active
                                        @endif
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ url('/edit_thana_touch_point/'.$touch_point->id )}}" role="button" class="btn btn-outline-primary btn-sm">Edit</a>
                                    <form 
                                        onsubmit="return confirm('Do you really want to delete?');" 
                                        action="{{ url('/delete_touch_point/'.$touch_point->id )}}" 
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