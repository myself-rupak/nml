@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('/touch_point'); !!}">Touch points</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
                    </ol>
                </div>
                <div class="card-body">
                	<form 
                        class="needs-validation" 
                        novalidate 
                        method="POST" 
                        action="{!! url('/save_touch_point'); !!}">
                		{{ csrf_field() }}
                        <div class="form-group row">
                            <label for="validationCustomTemplate" class="col-sm-2 col-form-label">Touch point type</label>
                            <div class="col-sm-10">
                                <select 
                                    class="form-control" 
                                    id="validationCustomTemplate"
                                    name="point_type"
                                    >
                                    <option value="">Select touch point type</option>
                                    @foreach($touch_point_types as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="validationCustomTemplate" class="col-sm-2 col-form-label">District</label>
                            <div class="col-sm-10">
                                <select 
                                    class="form-control" 
                                    id="validationCustomTemplate"
                                    name="district_id"
                                    >
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="validationCustomTemplate" class="col-sm-2 col-form-label">Thana</label>
                            <div class="col-sm-10">
                                <select 
                                    class="form-control" 
                                    id="validationCustomTemplate"
                                    name="thana_id"
                                    >
                                    <option value="">Select thana</option>
                                    @foreach($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                		
			            <div class="form-group row">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-primary">Add</button>
							</div>
						</div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection