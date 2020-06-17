<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>{{ config('app.name') ?? url('/') }}</title>
	</head>
	<body>
	
		<div style='width:92%; max-width:800px; margin:0 auto; border:1px solid #dedede; padding:0 3% 5% 3%; display:block; overflow:hidden; font-family:myriad-pro;'>
			<div style="width:96%;padding:0">
				<div style="margin:0 auto; width:160px; max-width:30%;"><img style="width:100%; max-width:100%" src="{{ url('/') }}/{{ config('app.logo') ?? 'assets/logo.png' }}" alt="Logo" /></div>
			</div>
			<hr style="border:1px solid #555;">
			<div style="width:100%;">
				<h3 style="text-transform: uppercase;">Payment Received</h3>
			</div>
			<div style="width:100%;text-align:justify">
				<p>Dear {{ $order->customer->name ?? 'Customer'}},</p>
				<p>Thank you for reaching us. We have received ${{ $amount ?? 0 }} from your order. <a href="{{ route('orders.edit', $order->id) }}">Click Here</a> to view your order. Your order details are indicated below.</p>
			</div>
			<div style="width:100%">
				<p><strong>Note:</strong> {{ $order->note ?? '' }}</p>
			</div>
			<div style="width:100%">
				<span style="text-transform: uppercase;">Order ID: {{ env('APP_NAME_SHORT') ?? '' }}{{ $order->id ?? '' }}</span><br/>
				<span style="text-transform: uppercase; color:#555">Order Date: {{ $order->created_at->format('jS M Y') ?? '' }}</span>
			</div>
			<hr style="color:#555; border-top:1px dotted #555;">
			<div style="width:100%; height:30px;"></div>
			
			<div style="width:100%">
            	<table style="width:100%">
            		@foreach($order->details as $detail)
            		<tr>
            			<td>
            				<img src="{{ url('/assets/products') }}/{{ $detail->product->image1 ?? 'not-found.jpg' }}" alt="{{ $detail->product->name }}" style="width:100px; height:50px; border-radius:5px" />
            			</td>
            			<td>
            				{{ $detail->product->name }}
            			</td>
            			<td>
            				{{ $detail->product->msrp }}
            			</td>
            			<td>
            				{{ $detail->quantity ?? 0}}
            			</td>
            			<td>
            				{{ $detail->total ?? 0}}
            			</td>
            		</tr>
            		@endforeach
            		<tr>
            			<th colspan="4">
            				Total Price
            			</th>
            			<th>
            				{{ $order->total ?? 0}}
            			</th>
            		</tr>
            	</table>
            </div>
			<div style="width:100%; height:30px;"></div>
			<hr style="color:#555; border-top:1px dotted #555;">
			<div style="width:100%; height:30px;"></div>
			<div style="width:100%">
				<p>For any further questions or concerns, please contact at {{ env('CONTACT_PHONE') }}, customer service.</p>
				<span style="color:#555">Thanks for ordering,</span><br/>
				<span style="color:#555"></span><br/>
				<span style="color:#555"><strong>{{ config('app.name') ?? url('/') }} Team</strong></span>
			</div>
		</div>
	</body>
</html>