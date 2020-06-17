@extends('layouts.index')
@section('title')
Best e-commerce website
@endsection
@section('content')
<header id=@mobile "home-mobile" @else "home" @endmobile">
    <div class="row">
        <div class="col-12 text-light bg-dark-transparent h-39">
            <ul class="list-group list-group-horizontal @computer pr-5 @endcomputer">
                @computer
                <li class="list-group-item bg-transparent py-0"><i class="fa fa-envelope text-white"></i> <a class="text-white" href="mailto:contact-us@onbiponi.com">contact-us@onbiponi.com</a></li>
                @endcomputer
                <li class="list-group-item bg-transparent py-0 ml-auto" id="app"><a class="text-white" href="{{ route('chats.show', 1) }}"><i class="fa fa-comments text-light"></i>
                    @auth
						<chat-counter v-bind:user="{{ $user ?? '' }}" v-bind:partner="{{ $partner ?? '{}' }}" v-bind:total_unread_message="{{ $total_unread_message ?? 0 }}"></chat-counter>
					@endauth
                </a></li>
                <li class="list-group-item bg-transparent py-0"><a class="text-white" href="skype:-skype-name-?chat"><i class="fa fa-skype text-primary"></i></a></li>
                <li class="list-group-item bg-transparent py-0"><a class="text-white" href="https://api.whatsapp.com/send?phone=8801817338234&text={{ urlencode('Hi') }}" target="_blank"><i class="fa fa-whatsapp text-success"></i></a></li>
            </ul>
        </div> 
        <div class="col-12 z-2">
            <nav class="navbar navbar-expand-md navbar-dark @computer pr-5 @else bg-dark @endcomputer" id="navbar">
                <!-- Brand -->
                <a class="navbar-brand m-0 p-0" href="{{ url('/') }}"><img src="{{ asset('assets/logo-white.png') }}" class="logo" alt="{{ config('app.name') }} Logo" /></a>
                
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto font-weight-bold">
                        <li class="nav-item active"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Templates</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact-us.index') }}">Contact Us</a></li>
                    </ul>
                </div>
            </nav>
            <!-- /Header -->
        </div>
        <div class="col-12 height-middle text-center pt-3 z-1">
            <p class="text-white display-5">WE ARE CREATIVE AGENCY</p>
            <p class="text-white">We will supercharge your imagination by delivering you impeccable development work from the initial concept to the completed project.</p>
            <a href="{{ route('products.index', 'category=e-commerce') }}" title="bd freelancer" class="btn btn-light m-1 btn-lg">E-commerce</a> <a href="{{ route('products.index', 'category=frontend') }}" class="btn btn-success m-1 btn-lg">Frontend</a> <a href="{{ route('products.index', 'category=dashboard') }}" class="btn btn-secondary m-1 btn-lg">Dashboard</a>
        </div>
    </div>
</header>
<section class="container">
    <div class="row">
        <div class="col-12 @computer py-5 @endcomputer text-center">
            <h1 class="text-dark @computer mt-5 @endcomputer">Best E-commerce website</h1>
            <p class="text-secondary">We develop best e-cmmerce templates using bootstrap4, VueJs and other modern technologis. Responsive and dynamic templates at frontend.</p>
            <div class="owl-carousel">
                @foreach($products as $product)
                <div>
                    <div class="size-21">
                        @computer
                        <img src="{{ url('assets/products') }}/{{ $product->image1 ?? 'not-found.jpg' }}" alt="{{ $product->name ?? 'No title' }}" height="150">
                        @else
                        <img src="{{ url('assets/products') }}/{{ $product->image3 ?? 'not-found.jpg' }}" alt="{{ $product->name ?? 'No title' }}" height="150">
                        @endcomputer
                    </div>
                    <div class="bg-light text-dark clearfix">
                        <div class="p-2 text-left"><span class="img-thumbnail px-2">${{ $product->msrp ?? 0 }}</span><a class="btn btn-primary btn-sm float-right" href="{{ route('products.show', $product->id) }}">Preview</a></div>
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
            <a class="btn btn-primary" rel="canonical" href="{{ route('products.index') }}" title="Bangladeshi templates" >View All</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h2>Need a e-commerce website?</h2>
            <a class="btn btn-light btn-lg border"  rel="canonical" href="{{ route('contact-us.index') }}" title="Bangladeshi freelancer" >Contact Us</a>
        </div>
    </div>
</section>
@endsection