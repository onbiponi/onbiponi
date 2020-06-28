<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Auth;
use App\OrderDetail;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
		$orders = OrderDetail::with('customer', 'status');
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
		$data = $request->except('_token', '_method');
		$order = Order::create($data);
		return redirect(route('orders.index'))->with('message', 'Order created successfully');
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
		$user = Auth::user();
		$detail = OrderDetail::where('order_id', $id)
			->whereHas('product', function(Builder $q) use($user) {
				$q->where('supplier_id', $user->id);
			})->update(['product_status_id' => $request->product_status_id]);
		return redirect()->back()->with('message', 'Product Status updated successfully');
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
		$cumulative_amount = Cashbook::latest()->pluck('cumulative_amount')->first();
		$cashbook = [];
		$amount = $this->total($order);
		$cashbook['action'] = 'credit';
		$cashbook['amount'] = $amount;
		$cashbook['cumulative_amount'] = $amount+$cumulative_amount;
		$cashbook['order_id'] = $order->id;
		$cashbook['user_id'] = Auth::user()->id;
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
}
