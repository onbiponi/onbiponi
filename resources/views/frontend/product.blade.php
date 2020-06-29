@extends('layouts.common')
@section('title')
{{ __($product->name) }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer" id="product">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="size-11 my-2">
                <img class="img-thumbnail" src="{{ url('/') }}/assets/products/{{ $product->image1 ?? 'not-found.jpg' }}" :src="show_image_src" alt="{{ $product->name ?? '' }}" />
            </div>
        </div>
        <div class="col-3 col-md-1">
            <div class="row">
                <div class="col-12 m-1">
                    <div class="size-11">
                        <img class="img-thumbnail" src="{{ url('/') }}/assets/products/{{ $product->image1 ?? 'not-found.jpg' }}" @click.prevent="show_image_src=$event.target.src" alt="{{ $product->name ?? '' }}" />
                    </div>
                </div>
                <div class="col-12 m-1">
                    <div class="size-11">
                        <img class="img-thumbnail" src="{{ url('/') }}/assets/products/{{ $product->image2 ?? 'not-found.jpg' }}" @click.prevent="show_image_src=$event.target.src" alt="{{ $product->name ?? '' }}" />
                    </div>
                </div>
                <div class="col-12 m-1">
                    <div class="size-11">
                        <img class="img-thumbnail" src="{{ url('/') }}/assets/products/{{ $product->image3 ?? 'not-found.jpg' }}" @click.prevent="show_image_src=$event.target.src" alt="{{ $product->name ?? '' }}" />
                    </div>
                </div>
                <div class="col-12 m-1">
                    <div class="size-11">
                        <img class="img-thumbnail" src="{{ url('/') }}/assets/products/{{ $product->image4 ?? 'not-found.jpg' }}" @click.prevent="show_image_src=$event.target.src" alt="{{ $product->name ?? '' }}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9 col-md-5">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $product->name ?? '' }}</h3>
                    <p>{!! $product->note ?? '' !!}</p>
                    <div><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> (0 reviews)</div>
                </div>
                <hr class="w-100">
                <div class="col-12">
                    <p class="text-secondary">Category: {{ $product->category->name ?? 'Uncategorized' }}</p>
                    <p class="display-5 text-primary">৳{{ $product->msrp ?? 0 }} per kg</p>
                </div>
                <hr class="w-100">
                <div class="col-12"><span class="text-danger">Minimum Order: 12kg</span></div>
                <div class="col-12">
                    <div class="btn-group">
                        <div class="input-group my-2">
                            <input type="number" class="form-control" placeholder="Amount in kg" v-model="temp_quantity" @blur="limitQuantity" min="12"/>
                            <div class="input-group-append">
                                <span class="input-group-text">kg</span>
                            </div>
    					</div>
					</div>
					<div class="btn-group my-2">
						<a rel="nofollow" href="#" class="btn btn-success" @click.prevent="floatImage($event)">
							Add to cart
						</a>
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
(function() {
    var product = new Vue({
      el: '#product',
      data: {
    		temp_quantity:12,
    		show_image_src:"{{ url('/') }}/assets/products/{{ $product->image1 ?? 'not-found.jpg' }}"
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
    					"note": @json($product->note)
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
        	},
        	limitQuantity: function() {
        	    if(this.temp_quantity<12)
        	        this.temp_quantity = 12;
        	}
        }
    });
})();
</script>
@endsection