<?php

namespace App\Http\Services;

use Auth;
use App\Cashbook;
use Carbon\Carbon;

class CashbookService
{
	public static function getAccount() {
		$user = Auth::user();
		
		$report = Cashbook::selectRaw('sum(case when action = "credit" then amount end) as revenue')
			->selectRaw('sum(case when action = "debit" then amount end) as cost');
		if($user->role_id == 1)
			$report = $report->where('owned_by', $user->id);
		$report = $report->first();
		return $report;
	}
}
