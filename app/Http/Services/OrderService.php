<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Builder;
use Auth;
use App\Order;
use Carbon\Carbon;

class OrderService
{
	public static function getStatus() {
		
		$user = Auth::user();
		
		$report = Order::selectRaw('count(*)as total')
			->selectRaw('count(case when order_status_id = 2 then 1 end) as failed')
			->selectRaw('count(case when order_status_id = 3 then 1 end) as incomplete')
			->selectRaw('count(case when order_status_id = 4 then 1 end) as sale')
			->selectRaw('count(case when order_status_id = 6 then 1 end) as cancelled');
		if($user->role_id == 1)
			$report = $report->whereHas('details', function(Builder $query) use($user) {
				$query->whereHas('product', function(Builder $q) use($user) {
					$q->where('supplier_id', $user->id);
				});
			});
		$report = $report->first();
		return $report;
	}
	public static function getOrder() {
		
		$user = Auth::user();
		
		$this_year = Order::selectRaw('count(*) as total, MONTH(created_at) as month');
		if($user->role_id == 1)
			$this_year = $this_year->whereHas('details', function(Builder $query) use($user) {
				$query->whereHas('product', function(Builder $q) use($user) {
					$q->where('supplier_id', $user->id);
				});
			});
		$this_year = $this_year->where('created_at', '>', Carbon::now()->subMonths(7))
		->groupBy('month')
		->orderBy('created_at', 'ASC')
		->get()->toArray();
		$last_year = Order::selectRaw('count(*) as total, MONTH(created_at) as month');
		if($user->role_id == 1)
			$last_year = $last_year->whereHas('details', function(Builder $query) use($user) {
				$query->whereHas('product', function(Builder $q) use($user) {
					$q->where('supplier_id', $user->id);
				});
			});
		$last_year = $last_year->whereBetween('created_at', [Carbon::now()->subMonths(19), Carbon::now()->subMonths(12)])
		->groupBy('month')
		->orderBy('created_at', 'ASC')
		->get()->toArray();
		return ['this_year' => $this_year, 'last_year' => $last_year];
	}
}
