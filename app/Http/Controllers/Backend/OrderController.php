<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Auth;
use App\Order;
use App\Product;
use App\OrderDetail;
use App\Cashbook;
use App\OrderStatus;
use App\User;
use App\Guest;
use App\Locations\Division;
use App\Locations\Region;

class OrderController extends Controller
{
	public function __construct() {
        $this->middleware('moderator:Order', ['except' => ['store', 'cart', 'checkout', 'orderComplete', 'checkoutLogin']]);
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
        
		$inputs = ['name' => $request->name, 'billing_division_id' => $request->division_id, 'billing_region_id' => $request->region_id, 'billing_address' => $request->address, 'phone' => $request->phone, 'email' => $request->email];
		
		if(Auth::check()) {
			$user = Auth::user();
			$data['customer_id'] = $user->id;
		} else {
			$guest = Guest::create($inputs);
			$data['guest_id'] = $guest->id;
		}
		$data['order_status_id'] = 3;
		$data['payment_id'] = $request->payment_id;
		if($request->payment_id == 1)
		    $data['trxid'] = $request->trxid;
		$order = Order::create($data);
		for($i=0; $i<count($request->product_id); $i++) {
		    $product = Product::find($request->product_id[$i]);
			OrderDetail::create(['order_id' => $order->id, 'product_id' => $product->id, 'quantity' => $request->quantity[$i], 'price' => $product->msrp]);
		}
		$order->update(['amount' => $this->totalPrice($order)]);
		return redirect()->route('order-complete');
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
		$shipping = $this->shipping($order);
		$packaging = $this->packaging($order);
		return view('backend.orders.show', compact('order', 'shipping', 'packaging'));
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
        $order = Order::with(['customer', 'details.product', 'customer.region', 'customer.division', 'payment', 'guest.billing_region', 'guest.billing_division'])->where('id', $id)->first();
        $shipping = $this->shipping($order);
		$packaging = $this->packaging($order);
		$crate = $this->crate($order);
		$carton = $this->carton($order);
		return view('backend.orders.create', compact('order', 'statuses', 'shipping', 'packaging', 'crate', 'carton'));
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
        $order = Order::where('id', 237)->first();
        $divisions = Division::all();
        $regions = Region::all();
        $profile = '';
        if(Auth::check()) {
            $user = Auth::user();
            $profile = User::with('division', 'region')->where('id', $user->id)->first();
        }
		return view('frontend.checkout', compact('divisions', 'regions', 'profile'));
    }
    public function orderComplete()
    {
		return view('frontend.order-complete');
    }
    public function checkoutLogin()
    {
		return redirect()->route('checkout');
    }
    private function shipping($order)
    {
		if($order->total_product<12)
		    return 12*15;
	    return $order->total_product*15;
    }
    private function packaging($order)
    {
        $total = $order->total_product;
		if($total<16)
		    return 50;
		  else if($total<26)
		    return 150;
		  else {
		    $crate = floor($total/25);
		    $reminder = $total%25;
		    $carton = 0;
		    if($reminder<16)
		        $carton = 1;
		    else
		        $crate +=1;
	        return $crate*150+$carton*50;
        }
    }
    private function crate($order) {
        $total = $order->total_product;
        $crate = floor($total/25);
        $reminder = $total%25;
		    $carton = 0;
		    if($reminder<16)
		        $carton = 1;
		    else
		        $crate +=1;
        return $crate;
    }
    private function carton($order) {
        $total = $order->total_product;
        $crate = floor($total/25);
        $reminder = $total%25;
		    $carton = 0;
		    if($reminder<16)
		        $carton = 1;
		    else
		        $crate +=1;
        return $carton;
    }
    private function totalPrice($order)
    {
        return $order->total + $this->shipping($order) + $this->packaging($order);
    }
}
