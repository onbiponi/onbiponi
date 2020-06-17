<?php

namespace App\Http\Services;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Chat;

class UserService
{
	public static function getTotal() {
		$total = User::all()->count();
		return $total;
	}
	
	public static function getUnreadChatNumber() {
	    if(Auth::check()) {
    		$user_id = Auth::user()->id;
    		$message_list = Chat::where('receiver_id', $user_id)
    			->whereNotIn('deleted_by', [-2, $user_id])
    			->whereNull('viewed_at')
    			->get();
		    return $message_list->count();
	    }
		return 0;
	}
}
