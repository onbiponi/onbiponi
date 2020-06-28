<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku', 'brand_id', 'model_id', 'package_id', 'manufacturing_year', 'name', 'description', 'supplier_id', 'category_id', 'quantity_per_unit', 'msrp', 'size_id', 'color_id', 'discount', 'weight', 'stock', 'unit_id', 'unit_on_order', 'reorder_level', 'is_available', 'discount_available', 'picture', 'image1', 'image2', 'image3', 'image4', 'ranking', 'note', 'condition_id', 'view', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10', 'image11', 'image12', 'image13', 'image14', 'image15', 'image16', 'image17', 'image18', 'image19', 'image20', 'image21', 'image22', 'image23', 'image24', 'image25', 'image26', 'image27', 'image28', 'image29', 'image30', 'image31', 'image32', 'image33', 'image34', 'image35', 'image36', 'registration_year', 'kms_driven', 'auction_grade_id', 'after_sell_service', 'auction_from', 'auction_to', 'auction_amount', 'car_id', 'motorcycle_id', 'bicycle_id', 'deleted_at', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
	
	public function category() {
		return $this->belongsTo('App\Category');
	}
	public function car() {
		return $this->belongsTo('App\Car');
	}
	public function motorcycle() {
		return $this->belongsTo('App\Motorcycle');
	}
	public function bicycle() {
		return $this->belongsTo('App\Bicycle');
	}
	public function supplier() {
		return $this->belongsTo('App\User', 'supplier_id', 'id');
	}
	public function condition() {
		return $this->belongsTo('App\Dropdowns\Condition');
	}
	public function comments() {
		return $this->hasMany('App\Comment');
	}
	public function reviews() {
		return $this->hasMany('App\Review');
	}
	public function brand() {
		return $this->belongsTo('App\Dropdowns\Brand');
	}
	public function model() {
		return $this->belongsTo('App\Dropdowns\Model');
	}
	public function package() {
		return $this->belongsTo('App\Dropdowns\Package');
	}
	public function auction_grade() {
		return $this->belongsTo('App\Dropdowns\AuctionGrade');
	}
	public function bids() {
		return $this->hasMany('App\Bid');
	}
	public function order_details() {
		return $this->hasMany('App\OrderDetail');
	}
}
