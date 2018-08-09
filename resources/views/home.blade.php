@extends('layouts.app')

@section('content')
    @include('admin_dashboard.page_name')
                <div class="card-header">{{ $page_name }} </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
