<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Builder;
use Auth;
use App\Product;
use Carbon\Carbon;

class ProductService
{
	public static function getProducts() {
		
		$user = Auth::user();
		
		$products = Product::selectRaw('count(*) as total')
		->selectRaw('count(case when (stock-unit_on_order)<=0 then 1 end) as out_of_stock')
		->selectRaw('count(case when is_available=1 then 1 end) as available');
		if($user->role_id == 1)
			$products = $products->where('supplier_id', $user->id);
		$products = $products->first();
		return $products;
	}
	public static function getViewed() {
		
		$user = Auth::user();
		
		$report = Product::orderBy('view', 'DESC');
		if($user->role_id == 1)
			$report = $report->where('supplier_id', $user->id);
		$report = $report->take(4)->get();
		return $report;
	}
	public static function getTotalView() {
		
		$user = Auth::user();
		
		if($user->role_id == 1)
			$total = Product::where('supplier_id', $user->id)->sum('view');
		else
			$total = Product::sum('view');
		return $total?$total:1;
	}
}
