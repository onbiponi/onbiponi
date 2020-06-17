<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_method', 'customer_id', 'guest_id', 'shipper_id', 'order_status_id', 'required_at', 'shipping_date', 'paid_at', 'discount', 'updated_at', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

	protected $dates = ['required_at', 'paid_at', 'updated_at', 'created_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
		'required_at' => 'datetime',
		'paid_at' => 'datetime',
        'updated_at' => 'datetime',
		'created_at' => 'datetime',
    ];
	public function details() {
		return $this->hasMany('App\OrderDetail');
	}
	public function order_details() {
		return $this->hasMany('App\OrderDetail');
	}
	public function products() {
		return $this->belongsToMany('App\Product', 'App\OrderDetail', 'order_id', 'product_id')->selectRaw('products.*, sum(products.msrp*order_details.quantity) as total');
	}
	public function customer() {
		return $this->belongsTo('App\User', 'customer_id', 'id');
	}
	public function guest() {
		return $this->belongsTo('App\Guest');
	}
	public function status() {
		return $this->belongsTo('App\OrderStatus', 'order_status_id', 'id');
	}
	public function getTotalAttribute() {
	    $product = $this->products->first();
		return $product?$product->total:0;
	}
	public function getHasUserAttribute() {
		return $this->customer_id;
	}
}
