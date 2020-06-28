<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Validator;
use App\Order;
use App\Notifications\PaymentNotification;

class StripePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		//
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
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe($id)
    {
		$order = Order::find($id);
        return view('frontend.stripe.stripe', compact('order'));
    }
	/**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $amount = 0;
		$input = $request->except('_token');
		$order = Order::with('customer', 'guest', 'details.product')->where('id', $request->order_id)->first();
		
		$validator = Validator::make($request->all(), [
			'card_no' => 'required',
			'cc_expiry_month' => 'required',
			'cc_expiry_year' => 'required',
			'cvc' => 'required',
		]);
		if ($validator->fails()) {
			return redirect(route('card-payment', $order->id))->withErrors($validator);
		} else {
			$stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
			try {
		        $amount = $order->total;
		        $description = 'Total charge for the order OB'.$order->id;
				$charge = \Stripe\Charge::create([
					'source' => $request->stripeToken,
					'currency' => 'USD',
					'amount' => 10*100,
					//'amount' => 5*100,
					'description' => $description,
				]);

				if($charge['status'] == 'succeeded') {
					$order->update(['order_status_id' => 3, 'pay_by' => 'stripe']);
					if($order->has_user)
					    $order->customer->notify(new PaymentNotification($order, $amount));
					else
					    \Notification::route('mail', 'rejauldu@gmail.com')
					        ->notify(new PaymentNotification($order, $amount));
					return redirect()->route('order-complete')->with('message', 'Thank you! We have received your order. We will contact you shortly.');
				} else {
					Session::put('error','Payment failed!!');
					return redirect()->route('card-payment', $order->id)->with('message', 'A error has occurred, and you have not been charged. Please try again.');
				}
			} catch (Exception $e) {
				Session::put('error', $e->getMessage());
				return redirect()->route('card-payment', $order->id)->with('message', 'A error has occurred, and you have not been charged. Please try again.');
			} catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
				Session::put('error', $e->getMessage());
				return redirect()->route('card-payment', $order->id)->with('message', 'A error has occurred, and you have not been charged. Please try again.');
			} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
				Session::put('error', $e->getMessage());
				return redirect()->route('card-payment', $order->id)->with('message', 'A error has occurred, and you have not been charged. Please try again.');
			}
			
			return redirect()->route('card-payment', $order->id)->with('message', 'A error has occurred, and you have not been charged. Please try again.');
		}
    }
}
