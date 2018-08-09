@extends('layouts.layout')
@section('content')
	<body class="products">
		<div class="banner relative" style="background-image: url( {{ URL('/uploads/product_category/banner_image/'.$product_type->banner_image )}} ) !important">
			@include('products.overview')

			@include('layouts.header')
		</div>
		@include('products.products-title')

		@include('products.product-list')
@stop