@extends('layouts.common')
@section('title')
{{ __('E-commerce templates') }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer" id="cart-page">
	<div class="row">
	    <div class="col-12 col-lg-1">
	    </div>
		<div class="col-12 col-lg-10">
			<div class="card my-5">
				<div class="card-header">
					<div class="card-title">
						<div class="row">
						    @computer
							<div class="col-12 col-md-6">
								<h5><span class="fa fa-shopping-cart"></span> Shopping Cart</h5>
							</div>
							@endcomputer
							<div class="col-12 col-md-6">
								<a href="{{ route('products.index') }}" class="btn btn-primary btn-sm btn-block">
									<span class="fa fa-share-alt"></span> Continue shopping
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="row mb-2" v-for="product in products">
					    @computer
						<div class="col-0 col-md-2 size-11">
						    <img class="img-thumbnail" :src="'{{ url('assets/products') }}/'+product.image1">
						</div>
						@endcomputer
						<div class="col-5 col-md-4 @mobile p-0 @endmobile">
							@computer
							<h4>@{{ product.name }}</h4>
							<small class="text-secondary owl-paragraph" v-html="product.note"></small>
							@else
							<small>@{{ product.name }}</small>
							@endcomputer
						</div>
						<div class="col-5 col-md-3 @mobile p-1 @endmobile">
						    <div class="input-group height-middle @mobile p-0 @endmobile">
						        <div class="input-group-prepend">
						            <span class="input-group-text @mobile p-1 @endmobile">৳@{{ product.msrp }} <span class="text-muted">x</span></span>
						        </div>
							    <input type="number" class="form-control input-sm" v-model="product.quantity" @blur="limitQuantity(product)" min="12">
							</div>
						</div>
						@computer
						<div class="col-0 col-md-2 @mobile p-0 @endmobile">
						    <span class="height-middle pl-2">=৳@{{ product.quantity*product.msrp }}</span>
						</div>
						@endcomputer
						<div class="col-2 col-md-1 @mobile p-0 pl-1 @endmobile">
							<button type="button" class="btn btn-link btn-xs height-middle" @click="remove(product.id)">
								<span class="fa fa-trash text-danger"> </span>
							</button>
						</div>
						<hr>
					</div>
					
				</div>
				<div class="card-footer">
					<div class="row text-center">
						<div class="col-12 col-md-8">
							<h4 class="text-right">Total <strong>৳@{{ total }}</strong></h4>
						</div>
						<div class="col-12 col-md-4">
							<a href="{{ route('checkout') }}" class="btn btn-success btn-block">
								Checkout
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
var cart_page = new Vue({
	el: '#cart-page',
	data: {
		products: cart.products
	},
	methods: {
		remove: function (id) {
			this.products = this.products.filter(function(el) { return el.id != id; });
		},
		decreaseQuantity: function(q) {
			q--;
			if(q<1)
				q = 1;
		},
		limitQuantity: function(p) {
    	    if(p.quantity<12)
    	        p.quantity = 12;
    	}
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
		},
	},
	watch: {
		products: {
			handler: function (n, o) {
				cart.products = n;
			},
			deep:true,
		}
	}
});
</script>
@endsection