$(window).on('scroll', function() {
    var wScroll = $(this).scrollTop();
    
    // Fixed nav
    wScroll > 39 ? $('#navbar').addClass('bg-dark-transparent fixed-top py-0') : $('#navbar').removeClass('bg-dark-transparent fixed-top py-0');
});
/*Owl carousel */
var owl = $('.owl-carousel');
if(owl)
    owl.owlCarousel({
        items:3,
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            768:{
                items:3,
                nav:false
            },
        }
    });
/* Cart page */
if (!localStorage.getItem("cart")) {
	localStorage.cart = '[]';
}
if(document.getElementById('cart'))
var cart = new Vue({
	el: '#cart',
	data: {
		products: JSON.parse(localStorage.cart)
	},
	methods: {
		remove: function (id) {
			this.products = this.products.filter(function(el) { return el.id != id; });
		}
	},
	computed: {
		totalProduct: function() {
			var quantity_obj = {quantity:0};
			if(this.products.length>0) {
				quantity_obj = this.products.reduce(function(previousValue, currentValue) {
					return {
						"quantity": parseInt(previousValue.quantity) + parseInt(currentValue.quantity)
					};
				});
			}
			return quantity_obj.quantity;
		}
	},
	watch: {
		products: {
			handler: function (n, o) {
				localStorage.cart = JSON.stringify(n);
				if(typeof app2 !== 'undefined')
					app2.products = n;
			},
			deep:true,
		}
	}
});