@extends('layouts.layout')
<!--@section('title', 'Welcome to Nitol Motors Limited')-->
@section('content')
	<body>
		@include('layouts.header')

		@include('home.hero-slider')

		@include('home.types-of-vehicles')

		@include('home.vehicles')

		@include('home.touch-point')

		@include('home.media-center')

		@include('home.upcoming-vehicles')
@stop