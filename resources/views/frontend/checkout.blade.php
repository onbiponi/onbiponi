@extends('layouts.common')
@section('title')
{{ __('E-commerce templates') }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer" id="checkout">
    <div class="row">
        <div class="col-12 col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="" v-model="name" required>
                <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            @if(!Auth::check())
            <div class="from-group">
                <label for="email">Email <span class="text-muted">(required)</span></label>
                <input type="email" class="form-control" id="email" name="email" v-model="email" placeholder="you@example.com" required>
                <div class="invalid-feedback">Valid last name is required.</div>
            </div>
            @endif
        </div>
        <div class="col-12 col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed" v-for="product in products">
                    <div>
                        <h6 class="my-0">@{{ product.name }} <i class="fa fa-times"></i> @{{ product.quantity }}</h6>
                    </div>
                    <span class="text-muted">$@{{ product.msrp }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$@{{ total }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="name" v-model="name" />
                        <input type="hidden" name="email" v-model="email" />
                        <div v-for="product in products">
                            <input type="hidden" name="product_id[]" v-model="product.id" />
                            <input type="hidden" name="quantity[]" v-model="product.quantity" />
                        </div>
                        <input type="hidden" name="payment_method" value="stripe" />
                        <input type="submit" class="btn btn-success" value="Order" />
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
var checkout = new Vue({
	el: '#checkout',
	data: {
	    name: "{{ $user->name ?? '' }}",
	    email: "{{ $user->email ?? '' }}",
		products: cart.products
	},
	computed: {
		subTotal: function () {
			var price = 0;
			for(let i=0; i<this.products.length; i++) {
				price += this.products[i].msrp * this.products[i].quantity;
			}
			return price;
		},
		total: function () {
			return this.subTotal;
		}
	}
});
</script>
@endsection