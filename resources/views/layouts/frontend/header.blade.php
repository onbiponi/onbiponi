<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="keywords" content='formalin-free mango dhaka bangladesh chemical-free bd online order Chapainawabganj Rajshahi onbiponi' />
    <meta name="description" content='We sell chemical-free mango in Bangladesh. Formalin-free mango is the key of our business. We collect mango from Chapainawabganj and Rajshahi.' />
    <meta name='author' content='{{ config('app.name', 'Laravel') }}' />
    <meta name='copyright' content='{{ config('app.name', 'Laravel') }}' />
    <meta name='summary' content='We sell chemical-free mango in Bangladesh. Formalin-free mango is the key of our business. We collect mango from Chapainawabganj and Rajshahi; We sell mango all over bangladesh through courier service and home delivery in Dhaka. We are the best mango seller in Dhaka.' />
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
	<meta property="og:type"          content="product" />
	<meta property="og:title"         content="Formalin-free mango" />
	<meta property="og:description"   content="We are determined to take the organic mango market to a higher level in Bangladesh. Quality, nutrition, and taste are the keys of our business. We sell chemical-free mango in Bangladesh. Formalin-free mango is the key of our business. We take online order for mango in onbiponi. We sell formalin-free and sweet mango at a lower cost. You can check the price of mango in onbiponi and buy online. We sell varieties of mango including usual Langra (lengra), Himsagar and Fazli (Fajli), Aam Rupali etc." />
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