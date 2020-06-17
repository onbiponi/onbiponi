<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="keywords" content='e-commerce web developer Bangladeshi ecommerce website' />
    <meta name="description" content='E-commerce Web developer using Laravel framework and Bootstrap 4. Responsive and Cross-Platform websites. Best e-commerce website in Bangladesh.' />
    <meta name='author' content='{{ config('app.name', 'Laravel') }}' />
    <meta name='copyright' content='{{ config('app.name', 'Laravel') }}' />
    <meta name='summary' content='Bangladeshi E-commerce Web developer using Laravel framework.' />
    <meta name='Classification' content='Company' />
    <meta name='designer' content='{{ config('app.name', 'Laravel') }}' />
    <meta name='reply-to' content='{{ config('app.name', 'Laravel') }}' />
    <meta name='url' content='{{ config('app.url', 'Laravel') }}' />
    <!!--For iOS-->
    <link rel="apple-touch-icon" href="apple-touch-iphone.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="apple-touch-ipad.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="apple-touch-iphone4.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="apple-touch-ipad-retina.png" />
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!--base url for Script files -->
	<meta name="base-url" content="{{ url('/') }}">
	<!--Facebook Share-->
	<meta property="og:url"           content="{{ Request::url() }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Best e-commerce website in Bangladesh" />
	<meta property="og:description"   content="OnBiponi is the best e-commerce web development agency in Bangladesh. It has skilled web developer on PHP, Laravel, WordPress, VueJS, Bootstrap, CSS, JavaScript. Hence, we developed many e-commerce websites. They develop cross-platform and responsive website for e-commerce product.
" />
	@if(isset($product))
	<meta property="og:image"         content="{{ url('/assets/products') }}/{{ $product->image1 ?? 'not-found.jpg' }}" />
	@else
	<meta property="og:image"         content="{{ asset('/assets/logo.png') }}" />
	@endif
	<meta property="fb:app_id"   content="2588391271421526" />
	<!--/Facebook Share end-->
	<title>@yield('title')</title>
	<link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/gif" sizes="16x16">
	<!-- Fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- All packages style -->
	<!-- All packages style -->
	<link href="{{ asset('css/frontend/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	
	@yield('style')
</head>
<body>