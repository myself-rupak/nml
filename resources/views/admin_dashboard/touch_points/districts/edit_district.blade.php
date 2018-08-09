@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('/districts'); !!}">Districts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $page_name }}</li>
                    </ol>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="POST" action="{!! url('/update_district/'.$district->id ); !!}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="District name" value="{{ $district->name }}" required>
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