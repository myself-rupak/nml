@extends('layouts.layout')
@section('content')
{!! $map['js'] !!}
	<body class="products touch_point">
		<div class="banner relative" style="background-image: url( {{ URL('/uploads/touch_point/touchpoint_banner.png' )}} ) !important">
			@include('layouts.header')
		</div>
		<div class="title">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<h3>
							Touch point
						</h3>
					</div>
					<div class="col-md-6 col-xs-12">
					    <input type="text" class="form-control" placeholder="Search Touch point" id="myPlaceTextBox">
					</div>
				</div>
			</div>
		</div>
	    {!! $map['html'] !!}
@stop