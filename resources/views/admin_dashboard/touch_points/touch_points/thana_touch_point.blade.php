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
                        <li class="breadcrumb-item"><a href="{!! url('/thanas'); !!}">Thanas</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
                    </ol>
                </div>
                <div class="card-body">
                	<form 
                        class="needs-validation" 
                        novalidate 
                        method="POST" 
                        action="{!! url('/save_touch_point/'.$thana->id); !!}">
                		{{ csrf_field() }}
                        <div class="form-group row {{ $errors->has('point_type') ? ' has-error' : '' }}">
                            <label for="validationCustomTemplate" class="col-sm-2 col-form-label">Touch point type</label>
                            <div class="col-sm-10">
                                <select 
                                    class="form-control {{ $errors->has('point_type') ? 'is-invalid' : '' }}" 
                                    id="validationCustomTemplate"
                                    name="point_type"
                                >
                                    <option value="">Select touch point type</option>
                                    @foreach($touch_point_types as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->has('point_type') ? $errors->first('point_type'):'Select touch point type' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ old('name')}}" required>
                                <div class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name'):'Write touch point name please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" placeholder="Address" value="{{ old('address')}}" required>
                                <div class="invalid-feedback">{{ $errors->has('address') ? $errors->first('address'):'Write touch point address please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('contact_person') ? ' has-error' : '' }}">
                            <label for="contact_person" class="col-sm-2 col-form-label">Contact person</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('contact_person') ? 'is-invalid' : '' }}" id="contact_person" name="contact_person" placeholder="Contact person" value="{{ old('contact_person')}}" required>
                                <div class="invalid-feedback">{{ $errors->has('contact_person') ? $errors->first('contact_person'):'Write contact person name please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                            <label for="contact_phone" class="col-sm-2 col-form-label">Contact phone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" id="contact_phone" name="contact_phone" placeholder="Contact phone" value="{{ old('contact_phone')}}" required>
                                <div class="invalid-feedback">{{ $errors->has('contact_phone') ? $errors->first('contact_phone'):'Write contact phone please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email')}}">
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" id="latitude" name="latitude" placeholder="Latitude" value="{{ old('latitude')}}" required>
                                <div class="invalid-feedback">{{ $errors->has('latitude') ? $errors->first('latitude'):'Write address latitude please' }}</div>
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" id="longitude" name="longitude" placeholder="Longitude" value="{{ old('longitude')}}" required>
                                <div class="invalid-feedback">{{ $errors->has('longitude') ? $errors->first('longitude'):'Write address longitude please' }}</div>
                            </div>
                        </div>
                		
			            <div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</div>
                	</form>
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
                            @foreach ($thana->touchPoints as $touch_point)
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