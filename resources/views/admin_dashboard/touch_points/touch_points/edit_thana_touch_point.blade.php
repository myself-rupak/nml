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
                        action="{!! url('/update_touch_point/'.$touch_point->id ); !!}"
                    >
                    {{ method_field('PATCH') }}
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
                                    <option 
                                        {{ ($touch_point->point_type == $key)?'selected="selected"':'' }} 
                                        value="{{ $key }}">
                                        {{ $value }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->has('point_type') ? $errors->first('point_type'):'Select touch point type' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Name" value="{{ $touch_point->name }}" required>
                                <div class="invalid-feedback">{{ $errors->has('name') ? $errors->first('name'):'Write  name please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" placeholder="Address" value="{{ $touch_point->address }}" required>
                                <div class="invalid-feedback">{{ $errors->has('address') ? $errors->first('address'):'Write touch point address please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('contact_person') ? ' has-error' : '' }}">
                            <label for="contact_person" class="col-sm-2 col-form-label">Contact person</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('contact_person') ? 'is-invalid' : '' }}" id="contact_person" name="contact_person" placeholder="Contact person" value="{{ $touch_point->contact_person }}" required>
                                <div class="invalid-feedback">{{ $errors->has('contact_person') ? $errors->first('contact_person'):'Write contact person name please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                            <label for="contact_phone" class="col-sm-2 col-form-label">Contact phone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" id="contact_phone" name="contact_phone" placeholder="Contact phone" value="{{ $touch_point->contact_phone }}" required>
                                <div class="invalid-feedback">{{ $errors->has('contact_phone') ? $errors->first('contact_phone'):'Write contact phone please' }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $touch_point->email }}">
                            </div>
                        </div>
                        <div class="form-group row {{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <label for="latitude" class="col-sm-2 col-form-label">Latitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" id="latitude" name="latitude" placeholder="Latitude" value="{{ $touch_point->latitude }}" required>
                                <div class="invalid-feedback">{{ $errors->has('latitude') ? $errors->first('latitude'):'Write address latitude please' }}</div>
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <label for="longitude" class="col-sm-2 col-form-label">Longitude</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" id="longitude" name="longitude" placeholder="Longitude" value="{{ $touch_point->longitude }}" required>
                                <div class="invalid-feedback">{{ $errors->has('longitude') ? $errors->first('longitude'):'Write address longitude please' }}</div>
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