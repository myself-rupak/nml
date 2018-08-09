@extends('layouts.app')
@section('content')

    @include('admin_dashboard.page_name')
                <div class="card-header">{{ $page_name }} </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate method="POST" action="{!! url('/update_product_specification/'.$product_specification->id ); !!}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                        <div class="form-group row {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" placeholder="Product specificatin title" value="{{ $product_specification->title }}" required>
                                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
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