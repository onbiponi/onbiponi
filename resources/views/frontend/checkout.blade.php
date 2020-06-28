@extends('layouts.common')
@section('title')
{{ __('Best Mangoes in Bangladesh') }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer" id="checkout">
    @guest
    <div class="row">
        <div class="col-12">
            <p class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                1-Click Checkout? <a class="alert-link" href="{{ route('checkout-login') }}">Sign up and login</a> for the fastest checkout
            </p>
        </div>
    </div>
    @endguest
    <div class="row">
        <div class="col-12 col-md-7">
            @guest
            <h4 class="mb-3">Billing address</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Name" required v-model="name" />
                    @{{ name }}
                    <div class="text-danger" v-if="!name && submit">Valid name is required.</div>
                </div>
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" required v-model="email" />
                    <div class="text-danger" v-if="!email && submit">Valid email is required.</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 form-group">
					<label for="card-type">City</label>
					<select id="division" name="division_id" class="custom-select" v-model="division_id">
						<option value="0" selected>--Select city--</option>
						@foreach($divisions as $division)
						<option value="{{ $division->id }}" @if($profile && $profile->division && $division->id == $profile->division->id) selected @endif>{{ $division->name ?? '' }}</option>
						@endforeach
					</select>
					<div class="text-danger" v-if="!division_id && submit">Please provide a valid City.</div>
				</div>
                <div class="col-12 col-md-6 form-group">
					<label for="region">Area</label>
					<select id="region" name="region_id" class="custom-select" v-model="region_id">
						<option value="{{ $profile->region->id ?? 0 }}" selected>{{ $profile->region->name ?? '--Select region--'}}</option>
					</select>
					<div class="text-danger" v-if="!region_id && submit">Please provide a valid Area.</div>
				</div>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" col="3" placeholder="1234 Main St" required v-model="address"></textarea>
                <div class="text-danger" v-if="!address && submit">Please enter your address.</div>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" placeholder="Phone" required v-model="phone" />
                <div class="text-danger" v-if="!phone && submit">Valid phone number is required.</div>
            </div>
            @else
            <h4>Your address</h4>
            <div class="img-thumbnail p-3 my-3 bg-light">
                <a class="float-right btn btn-link" href="{{ route('users.edit', $profile->id) }}"><i class="fa fa-edit"></i></a>
                <h5>{{ $profile->name ?? '' }}</h5>
                <div><i class="fa fa-address-card-o"></i> {{ $profile->address ?? '' }}</div>
                <div><strong>{{ $profile->region->name ?? '' }}</strong>, {{ $profile->division->name ?? '' }}</div>
                <p><i class="fa fa-phone-square"></i> {{ $profile->phone }}</p>
            </div>
            <div class="img-thumbnail p-3 mb-2 bg-light">
                <h4>Payment method</h4>
                <div class="d-block">
                  <div class="custom-control custom-radio">
                    <input id="bkash" type="radio" name="payment_id" class="custom-control-input" required v-model="payment_id" :checked="payment_id == 1" value="1" />
                    <label class="custom-control-label" for="bkash">bKash (send money)</label>
                    <a class="btn btn-link float-right" href="#" data-toggle="modal" data-target="#bkash-instruction" v-if="payment_id==1">How to pay?</a>
                    <input type="text" class="form-control" id="trxid" placeholder="TrxID" required v-if="payment_id==1" v-model="trxid" />
                    <div class="text-danger" v-if="payment_id==1 && submit && !trxid">TrxID is required.</div>
                  </div>
                  <div class="custom-control custom-radio">
                    <input id="cash" name="payment_id" type="radio" class="custom-control-input" required="" v-model="payment_id" :checked="payment_id == 2" value="2" >
                    <label class="custom-control-label" for="cash">Cash on Delivery</label>
                  </div>
                </div>
            </div>
            @endguest
        </div>
        <div class="col-12 col-md-5">
            @guest
            <div class="img-thumbnail p-3 mb-2 bg-light">
                <h4>Payment method</h4>
                <div class="d-block">
                  <div class="custom-control custom-radio">
                    <input id="bkash" type="radio" name="payment_id" class="custom-control-input" required v-model="payment_id" :checked="payment_id == 1" value="1" />
                    <label class="custom-control-label" for="bkash">bKash (send money)</label>
                    <a class="btn btn-link float-right" href="#" data-toggle="modal" data-target="#bkash-instruction" v-if="payment_id==1">How to pay?</a>
                    <input type="text" class="form-control" id="trxid" placeholder="TrxID" required v-if="payment_id==1" v-model="trxid" />
                    <div class="text-danger" v-if="payment_id==1 && submit && !trxid">TrxID is required.</div>
                    <div class="text-success" v-else>Send Money To {{ env('PHONE_NUMBER') ?? '01924974960' }}</div>
                  </div>
                  <div class="custom-control custom-radio">
                    <input id="cash" name="payment_id" type="radio" class="custom-control-input" required="" v-model="payment_id" :checked="payment_id == 2" value="2" >
                    <label class="custom-control-label" for="cash">Cash on Delivery</label>
                  </div>
                </div>
            </div>
            @endguest
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">@{{ totalProduct }}</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed" v-for="product in products">
                    <div>
                        <h6 class="my-0">@{{ product.name }} <i class="fa fa-times"></i> @{{ product.quantity }}</h6>
                    </div>
                    <span class="text-muted">৳@{{ product.quantity*product.msrp }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Sub Total:</span>
                    <strong>৳@{{ subTotal }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Shipping Cost:</span>
                    <strong>৳@{{ shipping }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Packaging Cost:</span>
                    <strong>৳@{{ packaging }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between list-group-item-warning">
                    <span>Total (BDT)</span>
                    <strong>৳@{{ total }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="name" v-model="name" />
                        <input type="hidden" name="email" v-model="email" />
                        <input type="hidden" name="division_id" v-model="division_id" />
                        <input type="hidden" name="region_id" v-model="region_id" />
                        <input type="hidden" name="address" v-model="address" />
                        <input type="hidden" name="phone" v-model="phone" />
                        <input type="hidden" name="payment_id" v-model="payment_id" />
                        <input type="hidden" name="trxid" v-model="trxid" v-if="trxid"/>
                        <div v-for="product in products">
                            <input type="hidden" name="product_id[]" v-model="product.id" />
                            <input type="hidden" name="quantity[]" v-model="product.quantity" />
                        </div>
                        <input type="hidden" name="payment_method" value="stripe" />
                        <label class="form-check-label my-2"><input type="checkbox" v-model="terms" value="1" /> I agree to the OnBiponi <a href="{{ route('terms-conditions') }}">Terms of Service</a> and <a href="{{ route('privacy-policy') }}">Privacy Policy</a></label><br/>
                        <input type="submit" class="btn btn-success d-none" value="Order" id="submit" />
                        <a rel="nofollow" href="#" class="btn btn-success" @click.prevent="onSubmit" :class="{'disabled':!terms}">Order</a>
                    </form>
                </li>
            </ul>
        </div>
        
    </div>
    <div class="modal" id="bkash-instruction">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">bKash send money</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <ol>
                        <li>Go to your bKash Mobile Menu by dialing *247#</li>
                        <li>Choose "Send Money" (Option 1)</li>
                        <li>Enter the bKash Account Number: {{ env('MOBILE_NUMBER') ?? '01924974960' }}</li>
                        <li>Enter the amount: @{{ total }}</li>
                        <li>Enter a reference: onbiponi</li>
                        <li>Now enter your bKash Mobile Menu PIN</li>
                        <li>On Successful payment you will receive a TrxID</li>
                        <li>Enter TrxID in onbipni's referred section below.</li>
                    </ol>
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>
                </div>
            
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
var checkout = new Vue({
	el: '#checkout',
	data: {
	    name: "{{ $profile->name ?? '' }}",
	    email: "{{ $profile->email ?? '' }}",
	    division_id: "{{ $profile->division_id ?? '' }}",
	    region_id: "{{ $profile->region_id ?? '' }}",
	    address: @auth @json($profile->address) @else '' @endauth,
	    phone: "{{ $profile->phone ?? '' }}",
	    payment_id: "1",
	    trxid: "",
	    terms: "",
	    submit: "",
		products: cart.products
	},
	methods: {
	    onSubmit: function() {
		    this.submit = true;
		    if((this.phone || this.email) && this.division_id && this.region_id && ((this.payment_id == 1 && this.trxid) || this.payment_id == 2) && this.terms)
		        document.getElementById('submit').click();
		},
		init: function() {
		    var division_el = document.getElementById('division');
		    var region_el = document.getElementById('region');
		    if(division_el&&region_el)
                division_el.addEventListener('change',function() {
                    locationAjaxCall(division_el,region_el);
                });
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
		totalProduct: function() {
		    var total = 0;
		    for(let i=0; i<this.products.length; i++) {
				total += parseInt(this.products[i].quantity);
			}
			return total;
		},
		shipping: function() {
		  if(this.totalProduct<12)
		    return 12*15;
		  else
		    return this.totalProduct*15;
		},
		packaging: function() {
		  if(this.totalProduct<16)
		    return 50;
		  else if(this.totalProduct<26)
		    return 150;
		  else {
		    var crate = Math.floor(this.totalProduct/25);
		    var reminder = this.totalProduct%25;
		    var carton = 0;
		    if(reminder<16)
		        carton = 1;
		    else
		        crate +=1;
	        return crate*150+carton*50;
		  }
		},
		total: function () {
			return this.shipping+this.packaging+this.subTotal;
		}
		
	},
	mounted() {
	    this.init();
	}
});
</script>
@endsection