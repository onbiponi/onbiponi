@extends('layouts.common')
@section('title')
Pay by Credit Card
@endsection
@section('content')
<div class="container @computer py-5 @endcomputer">
    <div class="row">
        <div class="col alert alert-warning">
            <h3>We do not charge right now. Please enter any test card number and enjoy free offer. </h3>
            <p class="text-secondary">Here is a test card: 4242424242424242</p>
        </div>
    </div>
    <div class="row">
		<div class="col-0 col-sm-2 col-md-3"></div>
        <div class="col-12 col-sm-8 col-md-6">
            <div class="card card-default credit-card-box mb-5">
                <div class="card-header display-table" >
                    <div class="row display-tr" >
                        <h3 class="card-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive float-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <form action="{{ route('stripe.post') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
						<input type="hidden" name="order_id" value="{{ $order->id }}" />
						<div class='form-group required'>
							<label for="name" >Name on Card</label>
							<input class='form-control card' id="name" name="name" size='4' type='text' autofocus required>
							@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
						<div class='form-group required'>
							<label for="car-no">Card Number</label>
							<input autocomplete='off' class='form-control card-number' id="card-no" name="card_no" size='20' type='text' required>
							@error('card_no')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
                        <div class='row'>
                            <div class='col-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
								<input autocomplete='off' class='form-control card-cvc' name="cvc" placeholder='ex. 311' size='4' type='text' required>
								@error('cvc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class='col-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label>
								<input class='form-control card-expiry-month' name="cc_expiry_month" placeholder='MM' size='2' type='text' required>
								@error('cc_expiry_month')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class='col-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label>
								<input class='form-control card-expiry-year' name="cc_expiry_year" placeholder='YYYY' size='4' type='text' required>
								@error('cc_expiry_year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-12 error form-group d-none'>
                                <div class='alert-danger alert'>Please correct the errors and try again.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Pay Now (${{ $order->total ?? 0 }})</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
      
</div>
@endsection
@section('style')
<style>
	.display-table {
		display: table;
	}
	.display-tr {
		display: table-row;
	}
	.display-td {
		display: table-cell;
		vertical-align: middle;
		width: 61%;
	}
</style>
@endsection
@section('script')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('d-none');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('d-none');
        e.preventDefault();
      }
    });
  
    if (!$form.data('cc-on-file')) {
		e.preventDefault();
		Stripe.setPublishableKey("{{ env('STRIPE_KEY') }}");
		Stripe.createToken({
			number: $('.card-number').val(),
			cvc: $('.card-cvc').val(),
			exp_month: $('.card-expiry-month').val(),
			exp_year: $('.card-expiry-year').val()
		}, stripeResponseHandler);
    }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('d-none')
                .find('.alert')
                .text(response.error.message);
        } else {
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
  
});
</script>
@endsection