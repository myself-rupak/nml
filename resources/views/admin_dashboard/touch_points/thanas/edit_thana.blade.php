@extends('layouts.app')
@section('content')

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
                        action="{!! url('/update_thana/'.$thana->id ); !!}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                        <div class="form-group row {{ $errors->has('district_id') ? ' has-error' : '' }}">
                            <label for="validationCustomTemplate" class="col-sm-2 col-form-label">District</label>
                            <div class="col-sm-10">
                                <select 
                                    class="form-control {{ $errors->has('district_id') ? 'is-invalid' : '' }}" 
                                    id="validationCustomTemplate"
                                    name="district_id"
                                    required
                                    >
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                    <option {{ ($district->id == $thana->district->id )?'selected="selected"':'' }} value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->has('district_id') ? $errors->first('district_id'):'Select district please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Thana name" value="{{ $thana->name }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection