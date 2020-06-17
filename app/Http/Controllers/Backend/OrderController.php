<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Auth;
use App\Order;
use App\OrderDetail;
use App\Cashbook;
use App\OrderStatus;
use App\User;
use App\Guest;

class OrderController extends Controller
{
	public function __construct() {
        $this->middleware('moderator:Order', ['except' => ['store', 'cart', 'checkout', 'orderComplete']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
		$orders = Order::with('customer', 'status');
		if($user->role_id == 1)
			$orders = $orders->whereHas('details', function(Builder $query) use($user) {
				$query->whereHas('product', function(Builder $q) use($user) {
					$q->where('supplier_id', $user->id);
				});
			});
		$orders = $orders->orderBy('id', 'desc')->get();
		return view('backend.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
		return view('backend.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		/* $inputs = ['name' => $request->name, 'billing_division_id' => $request->billing_division_id, 'billing_region_id' => $request->billing_region_id, 'billing_address' => $request->billing_address, 'phone' => $request->phone];
		if($request->different_shipping == 'true') {
			$inputs['shipping_division_id'] = $request->shipping_division_id;
			$inputs['shipping_region_id'] = $request->shipping_region_id;
			$inputs['shipping_address'] = $request->shipping_address;
		} else {
			$inputs['shipping_division_id'] = $request->billing_division_id;
			$inputs['shipping_region_id'] = $request->billing_region_id;
			$inputs['shipping_address'] = $request->billing_address;
		}
		$data = $request->only('payment_method'); */
		$inputs = ['name' => $request->name];
		$data = ['payment_method' => 'stripe'];
		if(Auth::check()) {
			$user = Auth::user();
			$user->update($inputs);
			$data['customer_id'] = $user->id;
		} else {
		    $inputs['email'] = $request->email;
			$guest = Guest::create($inputs);
			$data['guest_id'] = $guest->id;
		}
		$data['order_status_id'] = 3;
		$order = Order::create($data);
		for($i=0; $i<count($request->product_id); $i++) {
			OrderDetail::create(['order_id' => $order->id, 'product_id' => $request->product_id[$i], 'quantity' => $request->quantity[$i]]);
		}
		if($request->payment_method == 'stripe')
		    return redirect()->route('card-payment', $order->id);
		else
		    return redirect()->route('order-complete')->with('message', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$user = Auth::user();
        $order = Order::with('details.product')
		->where('id', $id)
		->first();
		return view('backend.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$user = Auth::user();
		$statuses = OrderStatus::all();
        $order = Order::with(['customer', 'details.product', 'customer.shipping_region', 'customer.shipping_division', 'customer.billing_region', 'customer.billing_division'])->where('id', $id)->first();
		return view('backend.orders.create', compact('order', 'statuses'));
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
		$data = $request->except('_token', '_method');
		$order = Order::where('id', $id)->with('details.product')->first();
		
		$credited_ids = [3, 4, 5];
		$debited_ids = [6, 7];
		if(in_array($request->order_status_id, $credited_ids) && !in_array($order->order_status_id, $debited_ids)) {
			$this->cashbook($order);
		} elseif(!in_array($request->order_status_id, $debited_ids) && in_array($order->order_status_id, $credited_ids)) {
			$cashbook_id = Cashbook::where('order_id', $id)->pluck('id');
			Cashbook::destroy($cashbook_id);
		}
		$order->update(['order_status_id' => $order->order_status_id]);
		return redirect(route('orders.index'))->with('message', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$order = Order::find($id);
		$order->delete();
		return redirect()->back()->with('message', 'Order has been deleted');
    }
	
	public function incomplete()
    {
		$user = Auth::user();
		$orders = Order::where('order_status_id', 3)->with('customer', 'status');
		if($user->role_id == 1)
			$orders = $orders->whereHas('details', function(Builder $query) use($user) {
				$query->whereHas('product', function(Builder $q) use($user) {
					$q->where('supplier_id', $user->id);
				});
			});
		$orders = $orders->orderBy('id', 'desc')->get();
		
		return view('backend.orders.index', compact('orders'));
    }
	/**
     * Display a listing of the resource for a specific user.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
		$user = Auth::user();
		$orders = Order::where('customer_id', $user->id)->with('customer', 'order_status')->orderBy('id', 'desc')->get();
		return view('backend.orders.index', compact('orders'));
    }
	public function cashbook($order)
    {
		$user = User::whereHas('products', function($query) use($order) {
			$query->whereHas('order_details', function($qry) use($order) {
				$qry->whereHas('order', function($q) use($order) {
					$q->where('id', $order->id);
				});
			});
		})->first();
		$cumulative_amount = Cashbook::latest()->pluck('cumulative_amount')->first();
		$cashbook = [];
		$amount = $this->total($order);
		$cashbook['action'] = 'credit';
		$cashbook['amount'] = $amount;
		$cashbook['cumulative_amount'] = $amount+$cumulative_amount;
		$cashbook['order_id'] = $order->id;
		$cashbook['user_id'] = Auth::user()->id;
		$cashbook['owned_by'] = $user->id;
		Cashbook::create($cashbook);
	}
	public function total($order)
    {
		$total = 0;
		foreach($order->details as $detail) {
			$total+=($detail->product->msrp * $detail->quantity);
		}
		return $total;
	}
	public function cart()
    {
		return view('frontend.cart');
    }
	public function checkout()
    {
		return view('frontend.checkout');
    }
    public function orderComplete()
    {
		return view('frontend.order-complete');
    }
}
