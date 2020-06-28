<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cashbook;
use Auth;

class CashbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$cashbooks = Cashbook::with('order', 'user')->latest()->paginate(50);
		
        return view('backend.cashbook.index', compact('cashbooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cashbook.create');
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
		$data['owned_by'] = User::where('email', $request->receiver_email)->pluck('id');
		
		$cumulative_amount = Cashbook::latest()->pluck('cumulative_amount')->first();
		if($request->action == 'credit')
			$data['cumulative_amount'] = $cumulative_amount+$data['amount'];
		elseif($request->action == 'debit')
			$data['cumulative_amount'] = $cumulative_amount-$data['amount'];
		else
			return redirect()->back()->with('message', 'Error');
		$data['user_id'] = Auth::user()->id;
		Cashbook::create($data);
		return redirect(route('cashbooks.index'))->with('message', 'Transaction created successfully');
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
}
