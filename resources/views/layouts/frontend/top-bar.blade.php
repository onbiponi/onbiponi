<header>
    <div class="row">
        <div class="col-12 text-light bg-dark-transparent h-39">
            <ul class="list-group list-group-horizontal @computer pr-5 @endcomputer">
                @computer
                <li class="list-group-item bg-transparent py-0"><i class="fa fa-envelope text-white"></i> <a class="text-white" rel="nofollow" href="mailto:contact-us@onbiponi.com">contact-us@onbiponi.com</a></li>
                @endcomputer
                <li class="list-group-item bg-transparent py-0 ml-auto"><a class="text-white" rel="nofollow" href="{{ route('chats.show', 1) }}"><i class="fa fa-comments text-light"></i>
                    @auth
						<chat-counter v-bind:user="{{ $user ?? '' }}" v-bind:partner="{{ $partner ?? '{}' }}" v-bind:total_unread_message="{{ $total_unread_message ?? 0 }}"></chat-counter>
					@endauth
                </a></li>
                <li class="list-group-item bg-transparent py-0"><a class="text-white" rel="nofollow" href="skype:rejauldu?chat"><i class="fa fa-skype text-primary"></i></a></li>
                <li class="list-group-item bg-transparent py-0"><a class="text-white" rel="nofollow" href="https://api.whatsapp.com/send?phone=8801817338234&text={{ urlencode('Hi') }}" target="_blank"><i class="fa fa-whatsapp text-success"></i></a></li>
            </ul>
        </div> 
        <div class="col-12">
            <nav class="navbar navbar-expand-md navbar-dark @computer bg-dark-transparent-fixed pr-5 @else bg-dark @endcomputer" id="navbar">
                <!-- Brand -->
                <a class="navbar-brand m-0 p-0" href="{{ url('/') }}"><img src="{{ asset('assets/logo-white.png') }}" class="logo" /></a>
                
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto font-weight-bold">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                        <li class="nav-item @if(\Request::route()->getName() == 'products.index') active @endif"><a class="nav-link" href="{{ route('products.index') }}">Mango</a></li>
                        <li class="nav-item @if(\Request::route()->getName() == 'contact-us.index') active @endif"><a class="nav-link" href="{{ route('contact-us.index') }}">Contact Us</a></li>
                        <li class="nav-item @if(\Request::route()->getName() == 'checkout') active @endif"><a class="nav-link" href="{{ route('checkout') }}">Checkout</a></li>
                    </ul>
                </div>
            </nav>
            <!-- /Header -->
        </div>
    </div>
</header>