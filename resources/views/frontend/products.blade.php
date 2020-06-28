@extends('layouts.common')
@section('title')
{{ __('E-commerce templates') }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer">
    <div class="row">
        @computer
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
                <ul class="list-group category_block">
                    @foreach($categories as $category)
                    <li class="list-group-item"><a href="{{ route('products.index') }}?category={{ urlencode($category->name) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase">Last product</div>
                <div class="card-body">
                    <div class="size-11">
                        @computer
                        <img class="img-fluid" src="{{ url('assets/products') }}/{{ $products[0]->image1 ?? 'not-found.jpg' }}" />
                        @else
                        <img class="img-fluid" src="{{ url('assets/products') }}/{{ $products[0]->image3 ?? 'not-found.jpg' }}" />
                        @endcomputer
                    </div>
                    <h4 class="card-title owl-heading">{{ $products[0]->name ?? 'No title' }}</h4>
                    <div class="card-text owl-paragraph">{!! $products[0]->note ?? 'No description' !!}</div>
                    <p class="bloc_left_price">৳{{ $products[0]->msrp ?? 0 }}</p>
                </div>
            </div>
        </div>
        @endcomputer
        <div class="col">
            <div class="row" id="products">
                @foreach($products as $product)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <a href="{{ route('products.show', $product->id) }}" class="size-11 d-block">
                            @computer
                            <img src="{{ url('assets/products') }}/{{ $product->image1 ?? 'not-found.jpg' }}" alt="{{ $product->name ?? 'E-commerce template' }}">
                            @else
                            <img src="{{ url('assets/products') }}/{{ $product->image3 ?? 'not-found.jpg' }}" alt="{{ $product->name ?? 'E-commerce template' }}">
                            @endcomputer
                        </a>
                        <div class="card-body">
                            <h4 class="card-title owl-heading"><a href="{{ route('products.show', $product->id) }}" title="{{ $product->name ?? 'E-commerce template' }}">{{ $product->name ?? 'E-commerce template' }}</a></h4>
                            <div class="card-text owl-paragraph mb-3">{!! $product->note ?? 'Product description' !!}</div>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">৳{{ $product->msrp ?? 0 }}</p>
                                </div>
                                <div class="col">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-block" >Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 d-flex">
                    <div class="mx-auto">
                    {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('style')
<style>
html, body {
  position:relative;
}
.float-it {
	-webkit-transition: all 1000ms ease-out;
       -moz-transition: all 1000ms ease-out;
         -o-transition: all 1000ms ease-out;
            transition: all 1000ms ease-out;
    z-index: 2;
}
</style>
@endsection
@section('script')
<script>
var products = new Vue({
  el: '#products',
  data: {},
  methods: {
  	floatImage: function (e, id, msrp, name, image1, description) {
    	var img = e.target.parentNode.parentNode.parentNode.parentNode.querySelector('img');
		var cloned = img.cloneNode();
		var coords = this.getCoords(img);
		var cart_coords = this.getCoords(document.getElementById('cart'));
		
		var middle_percent = 100; /* Just enter the middle point distance in percentage;*/
		
        cloned.style.top = coords.top+"px";
        cloned.style.left = coords.left+"px";
        cloned.style.width = img.width+"px";
        cloned.style.height = img.height+"px";
		cloned.style.position = "absolute";
		cloned.classList.add('float-it');
		document.body.append(cloned);
		
		setTimeout(function(){
			cloned.style.top = cart_coords.top-100+"px"; /*This is the middle point */
			cloned.style.left = cart_coords.left-100+"px";
			cloned.style.width = img.offsetWidth*middle_percent/400+"px";
			cloned.style.height = img.offsetHeight*middle_percent/400+"px";
			cloned.style.position = "absolute";
		},0);
		setTimeout(function(){
			cloned.style.top = cart_coords.top+10+"px";
			cloned.style.left = cart_coords.left+10+"px";
			cloned.style.width = "0px";
			cloned.style.height = "0px";
			cloned.style.opacity = 0;
		},10*middle_percent);
		var _this = this;
        setTimeout(function(){
            _this.addToCart(id, msrp, name, image1, description);
        }, 1500);
    },
	getCoords: function(elem) { // crossbrowser version
		var box = elem.getBoundingClientRect();

		var body = document.body;
		var docEl = document.documentElement;

		var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
		var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

		var clientTop = docEl.clientTop || body.clientTop || 0;
		var clientLeft = docEl.clientLeft || body.clientLeft || 0;

		var top  = box.top +  scrollTop - clientTop;
		var left = box.left + scrollLeft - clientLeft;

		return { top: Math.round(top), left: Math.round(left) };
	},
	addToCart: function(id, msrp, name, image1, description) {
		var is_same = false;
		for(let i=0; i<cart.products.length; i++) {
			if(cart.products[i].id == id) {
				cart.products[i].quantity = parseInt(cart.products[i].quantity)+1;
				is_same = true;
				break;
			}
		}
		if(!is_same) {
			let product = {
				"id": id,
				"quantity": 1,
				"msrp": msrp,
				"name": name,
				"image1": image1,
				"description": description
			};
			cart.products.unshift(product);
		}
		localStorage.cart = JSON.stringify(cart.products);
	}
  }
})
</script>
@endsection