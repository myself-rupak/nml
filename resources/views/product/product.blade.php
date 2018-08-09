@extends('layouts.layout')
@section('content')
	<body class="products product">
		<div class="banner relative" style="background-image: url( {{ URL('/uploads/product/banner/'.$product->banner_image )}} ) !important">
			@include('product.overview')

			@include('layouts.header')
		</div>
		@include('product.products-title')
		@include('product.product-details')
@stop