@extends('layouts.common')
@section('title')
{{ __('E-commerce templates') }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer" id="product">
    <div class="jumbotron">
        <div class="card">
            <div class="card-body">
                <h1>{{ $product->name }}</h1>
                <p>{!! $product->note !!}</p>
                <div>Price: ${{ $product->msrp }} <a class="btn btn-info float-right" href="#" @click.prevent="floatImage($event)">Add to cart</a></div>
            </div>
            <div class="card-body">
                <p>Look the desktop view</p>
            </div>
        </div>
    </div>
    <img src="{{ url('assets/products') }}/{{ $product->image2 ?? 'not-found.jpg' }}" class="w-100" />
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
(function() {
    var product = new Vue({
      el: '#product',
      data: {
    		temp_quantity:1,
      },
      methods: {
            floatImage: function (e) {
                var img = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.querySelector('img');
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
                }, 0);
                setTimeout(function(){
                	cloned.style.top = cart_coords.top+10+"px";
                	cloned.style.left = cart_coords.left+10+"px";
                	cloned.style.width = "0px";
                	cloned.style.height = "0px";
                	cloned.style.opacity = 0;
                }, 10*middle_percent);
                var _this = this;
                setTimeout(function(){
                    _this.addToCart();
                }, 1500);
            },
            addToCart: function() {
    			if(this.temp_quantity<1) {
    				this.temp_quantity = 1;
    				return;
    			}
    			var is_same = false;
    			for(let i=0; i<cart.products.length; i++) {
    				if(cart.products[i].id == {{ $product->id }}) {
    					cart.products[i].quantity = parseInt(cart.products[i].quantity)+parseInt(this.temp_quantity);
    					is_same = true;
    					break;
    				}
    			}
    			if(!is_same) {
    				let product = {
    					"id": {{ $product->id }},
    					"quantity": this.temp_quantity,
    					"msrp": {{ $product->msrp }},
    					"name": "{{ $product->name }}",
    					"image1": "{{ $product->image1 ?? 'not-found.jpg'}}",
    					"description": "{{ $product->description ?? ''}}"
    				};
    				cart.products.unshift(product);
    			}
    			localStorage.cart = JSON.stringify(cart.products);
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
        	}
        },
        watch: {
    		temp_quantity: function() {
    			if(this.temp_quantity<1)
    				this.temp_quantity = 1;
    		}
    	}
    });
})();
</script>
@endsection