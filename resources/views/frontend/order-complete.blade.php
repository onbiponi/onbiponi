@extends('layouts.common')
@section('title')
{{ __('Best Mangoes in Bangladesh') }}
@endsection

@section('content')

<div class="container-fluid @computer py-5 @endcomputer">
    @if(session()->has('message'))
    <div class="alert alert-warning">
    	{{ session()->get('message') }}
    </div>
    @endif
    <div class="card">
    	<div class="card-body text-center">
    		<img src="{{ asset('assets/checked-checkbox.png') }}" />
    		<h1>Thank you for your Order!</h1>
    		<p>We have received your order. We will contact you shortly.</p>
    	</div>
    </div>
</div>
@endsection
@section('style')
<script>
(function() {
	localStorage.clear();
})();

</script>
@endsection