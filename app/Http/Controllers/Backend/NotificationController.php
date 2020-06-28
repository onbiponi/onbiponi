<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use App\Http\Requests\NotificationRequest;
use App\Notifications\EmailNotification;
use App\Notifications\DatabaseNotification;
use App\Notification;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Auth;

class NotificationController extends Controller
{
	public function __construct() {
		$this->middleware('moderator:Notification', ['except' => ['index']]);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
        return view('backend.notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request)
    {
		if(isset($request->mail)) {
			if(isset($request->user_amount) && $request->user_amount == 'all-user') {
				$users = User::all();
				NotificationFacade::send($users, new EmailNotification((object) $request->all()));
			} elseif($request->user_amount == 'individual') {
				User::where('email', $request->email)->first()->notify(new EmailNotification((object) $request->all()));
			}
		} elseif(isset($request->database)) {
			User::where('email', $request->email)->first()->notify(new DatabaseNotification((object) $request->all()));
		} else {
		    User::find(1)->notify(new DatabaseNotification((object) $request->all()))->with('message', 'Thank you. We have received your email. We will contact you shortly.');
		}
        return redirect()->back()->with('message', 'Notification sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::with('user')->find($id);
		if(User::isUserBy($notification->user->id))
			$notification->update(['read_at' => Carbon::now()]);
        return view('backend.notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = User::find($id)->email;
        return view('backend.notifications.create', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	/**
     * Display a listing of the resource for a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
		$notifications = Notification::with('user')->orderBy('id', 'desc')->get();
        return view('backend.notifications.all', compact('notifications'));
    }
}
