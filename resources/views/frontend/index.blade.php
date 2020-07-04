@extends('layouts.index')
@section('title')
{{ __('index.page_title') }}
@endsection
@section('content')
<header id=@mobile "home-mobile" @else "home" @endmobile">
    <div class="row">
        <div class="col-12 text-light bg-dark-transparent h-39">
            <ul class="list-group list-group-horizontal @computer pr-5 @endcomputer">
                @computer
                <li class="list-group-item bg-transparent py-0"><i class="fa fa-envelope text-white"></i> <a rel="nofollow" class="text-white" href="mailto:contact-us@onbiponi.com">contact-us@onbiponi.com</a></li>
                @endcomputer
				@if(App::getLocale() == 'en')
				<li class="list-group-item bg-transparent py-0"><a rel="nofollow" class="text-white btn btn-link" href="{{ route('bn.index') }}">বাংলা</a></li>
                @else
				<li class="list-group-item bg-transparent py-0"><a rel="nofollow" class="text-white btn btn-link" href="{{ url('/') }}">English</a></li>
				@endif
				<li class="list-group-item bg-transparent py-0 ml-auto" id="app"><a rel="nofollow" class="text-white" href="{{ route('chats.show', 1) }}"><i class="fa fa-comments text-light"></i>
                    @auth
						<chat-counter v-bind:user="{{ $user ?? '' }}" v-bind:partner="{{ $partner ?? '{}' }}" v-bind:total_unread_message="{{ $total_unread_message ?? 0 }}"></chat-counter>
					@endauth
                </a></li>
                <li class="list-group-item bg-transparent py-0"><a rel="nofollow" class="text-white" href="skype:rejauldu?chat"><i class="fa fa-skype text-primary"></i></a></li>
                <li class="list-group-item bg-transparent py-0"><a rel="nofollow" class="text-white" href="https://api.whatsapp.com/send?phone=8801817338234&text={{ urlencode('Hi') }}" target="_blank"><i class="fa fa-whatsapp text-success"></i></a></li>
            </ul>
        </div> 
        <div class="col-12 z-2">
            <nav class="navbar navbar-expand-md navbar-dark @computer pr-5 @else bg-dark @endcomputer" id="navbar">
                <!-- Brand -->
                <a class="navbar-brand m-0 p-0" href="{{ route('index') }}"><img src="{{ asset('assets/logo-white.png') }}" class="logo" alt="{{ config('app.name') }} Logo" /></a>
                
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto font-weight-bold">
                        <li class="nav-item active"><a class="nav-link" href="{{ route('index') }}">{{ __('Home') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">{{ __('Mangoes') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact-us.index') }}">{{ __('Contact Us') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('checkout') }}">{{ __('Checkout') }}</a></li>
                    </ul>
                </div>
            </nav>
            <!-- /Header -->
        </div>
        <div class="col-12 height-middle text-center pt-5 z-1">
            <p class="text-white display-5">{{ __('index.title') }}</p>
            <p class="text-white">{{ __('index.slogan') }}</p>
            <a href="{{ route('products.index', 'category=langra') }}" title="bd mango" class="btn btn-light m-1 btn-lg">{{ __('Langra') }}</a> <a href="{{ route('products.index', 'category=Aam%20Rupali') }}" title="Aam rupali" class="btn btn-success m-1 btn-lg">{{ __('Aam Rupali') }}</a> <a href="{{ route('products.index', 'category=himsagor') }}" title="Himsagor" class="btn btn-secondary m-1 btn-lg">{{ __('Himsagor') }}</a>
        </div>
    </div>
</header>
<section class="container">
    <div class="row">
        <div class="col-12 @computer py-5 @endcomputer text-center">
            <h1 class="text-dark @computer mt-5 @endcomputer">{{ __('index.slider_title') }}</h1>
            <p class="text-secondary">{{ __('index.slider_slogan') }}</p>
            <div class="owl-carousel">
                @foreach($products as $product)
                <div>
                    <div class="size-11">
                        @computer
                        <img src="{{ url('assets/products') }}/{{ $product->image1 ?? 'not-found.jpg' }}" alt="{{ $product->name ?? 'No title' }}" height="150">
                        @else
                        <img src="{{ url('assets/products') }}/{{ $product->image3 ?? 'not-found.jpg' }}" alt="{{ $product->name ?? 'No title' }}" height="150">
                        @endcomputer
                    </div>
                    <div class="bg-light text-dark clearfix">
                        <div class="p-2 text-left"><span class="img-thumbnail px-2">৳{{ $product->msrp ?? 0 }}</span><a class="btn btn-primary btn-sm float-right" href="{{ route('products.show', $product->id) }}">Detail</a></div>
                        <h3 class="owl-heading">{{ $product->name ?? 'No title' }}</h3>
                        <div class="owl-paragraph mb-2 text-secondary">{!! $product->note ?? 'No Description' !!}</div>
                        <div><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> (0 reviews)</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-5">
            <a class="btn btn-primary" rel="canonical" href="{{ route('products.index') }}" title="formalin-free Bangladeshi mango seller" >View All</a>
        </div>
    </div>
</section>
<section class="container @computer my-5 @endcomputer">
    <div class="row">
        <div class="col-0 col-sm-1 col-md-2"></div>
        <div class="col-12 col-sm-10 col-md-8 text-justify">
            <div class="bg-white-transparent @computer p-5 @else p-2 @endcomputer">
                <h2 class="@computer mt-5 @endcomputer text-center">{{ __('Our Promise') }} <small class="text-success">{{ __('to you') }}</small></h2>
                <p class="mb-5">{{ __('index.promise') }}</p>
            </div>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <div class="display-5">{{ __('Need more information?') }}</div>
            <a class="btn btn-light btn-lg border"  rel="canonical" href="{{ route('contact-us.index') }}" title="formalin-free Bangladeshi mango" >{{ __('Contact Us') }}</a>
        </div>
    </div>
</section>
@endsection