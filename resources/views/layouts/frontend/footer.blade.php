    <footer class="bg-dark text-center p-2 w-100">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <h5 class="text-light pt-3">{{ __('Members Area') }}</h5>
                <ul class="list-group list-group-flush">
                    @auth
                    <li class="list-group-item bg-transparent"><a class="text-white" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                    <li class="list-group-item bg-transparent"><a class="text-white" href="{{ route('logout') }}" onclick="if (!window.__cfRLUnblockHandlers) return false; event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a></li>
                    @endauth
                    @guest
                    <li class="list-group-item bg-transparent"><a class="text-white" href="{{ route('login') }}"><i class="fa fa-sign-in"></i> {{ __('Login') }}</a></li>
                    <li class="list-group-item bg-transparent"><a class="text-white" href="{{ route('register') }}"><i class="fa fa-registered"></i> {{ __('Register') }}</a></li>
                    @endguest
                </ul>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <h5 class="text-light pt-3">{{ __('More about') }} <a href="{{ route('index') }}">{{ __(config('app.name')) }}</a></h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent"><a class="text-white" href="{{ route('contact-us.index') }}"><i class="fa fa-envelope"></i> {{ __('Contact Us') }}</a></li>
                    <li class="list-group-item bg-transparent"><a class="text-white" href="{{ route('privacy-policy') }}"><i class="fa fa-lock"></i> {{ __('Privacy Policy') }}</a></li>
                </ul>
            </div>
            @computer
            <div class="col-12 col-sm-6 col-md-3">
                <h5 class="text-light pt-3">{{ __('Subscribe to') }} <a href="{{ route('index') }}">{{ __(config('app.name')) }}</a></h5>
                <form action="{{ route('subscriptions.store') }}" method="post">
                    <div class="input-group">
                            @csrf
                            <input type="email" name="email" class="form-control" placeholder="email@example.com">
                        
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">{{ __('Go') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <h5 class="text-light pt-3">{{ __('Find us on') }}</h5>
                <div class="d-flex">
                    <ul class="list-group list-group-horizontal mx-auto">
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://facebook.com/onbiponi"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://onbiponi.blogspot.com"><i class="fa fa-google"></i></a></li>
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://www.instagram.com/onbiponi"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://twitter.com/onbiponi"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="d-flex">
                    <ul class="list-group list-group-horizontal mx-auto">
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://www.linkedin.com/company/onbiponi"><i class="fa fa-linkedin"></i></a></li>
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://www.upwork.com/agencies/~01827f5c7ac62e3e02"><i class="fa fa-circle-o"></i></a></li>
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://www.behance.net/onbiponi"><i class="fa fa-behance"></i></a></li>
                        <li class="list-group-item bg-transparent"><a class="text-white" href="https://www.youtube.com/channel/UC7q1Neydzi_4aNEYFAv1n8w"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            @endcomputer
        </div>
        <div class="row bg-dark">
            <div class="col-12 text-center text-secondary">{{ __('Copyright') }} &copy; {{ date("Y") }}. {{ __('All rights reserved by') }} <strong>{{ __(config('app.name')) }}</strong></div>
        </div>
    </footer>
    <div class="img-thumbnail rounded-circle" id="cart"><a class="btn btn-link btn-sm" href="{{ route('cart') }}"><i class="fa fa-shopping-cart"><span class="product-number badge badge-warning text-success">@{{ totalProduct }}</span></i></a></div>
	@auth
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		@csrf
	</form>
	<form id="delete-form" action="#" method="POST" style="display: none;">
		@csrf
		@delete
	</form>
	@endauth
	<!-- Default Success Modal called from JavaScript -->
	<div class="modal fade" id="success-modal">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">{{ __('Success') }}</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body text-success">
				{{ __('Updated successfully') }}
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Ok') }}</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Default Success Modal called from JavaScript -->
	<div class="modal fade" id="error-modal">
		<div class="modal-dialog modal-dialog-centered modal-sm">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">{{ __('Error<') }}/h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body text-danger">
				{{ __('Error! Update error. Please try again.') }}
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Ok') }}</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	@yield('script')
</body>
</html>