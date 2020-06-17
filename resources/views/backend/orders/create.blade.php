@extends('layouts.dashboard')
@section('title')
{{ __(isset($order)?'Process order':'Create order') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Category <small>{{ isset($order)?'process':'create' }}</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Orders</a></li>
				<li class="active">{{ isset($order)?'Process':'Create' }}</li>
			</ol>
		</section>
		@if(session()->has('message'))
		<div class="alert alert-warning">
			{{ session()->get('message') }}
		</div>
		@endif
		<div class="row">
			<div class="col-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __(isset($order)?'Process order':'Create order') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12 col-sm-6">
								<div class="img-thumbnail d-inline-block mb-3 p-3">
									<h3>Shipping Address</h3>
									<div>{{ $order->customer->name }}</div>
									<div>{{ $order->customer->shipping_address }}</div>
									<div><strong>{{ $order->customer->shipping_region->name }}</strong>, {{ $order->customer->shipping_division->name }}</div>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="img-thumbnail d-inline-block mb-3 p-3">
									<h3>Billing Address</h3>
									<div>{{ $order->customer->name }}</div>
									<div>{{ $order->customer->billing_address }}</div>
									<div><strong>{{ $order->customer->billing_region->name }}</strong>, {{ $order->customer->billing_division->name }}</div>
								</div>
							</div>
							<div class="col-12"><!--left col-->
								<table class="table table-borderless">
									<tbody>
										@php($total = 0)
										@foreach($order->details as $detail)
										<tr>
											<td><img src="{{ url('assets/products') }}/{{ $detail->product->photo ?? 'not-found.jpg'}}" class="myModal-item img-thumbnail" width="100"></td>
											<td>{{ $detail->product->name ?? '' }}</td>
											<td>@if($detail && $detail->product_status_id == 1) Sent to {{ config('app.name') }}
											@elseif($detail && $detail->product_status_id == 2) Not Available
											@endif</td>
											<td>TK {{ $detail->product->msrp ?? '0' }}</td>
											<td>{{ $detail->quantity ?? '0' }}</td>
											<td>TK {{ $detail->product->msrp *  $detail->quantity }}</td>
											@php($total+=($detail->product->msrp *  $detail->quantity))
										</tr>
										@endforeach
									</tbody>
									<tfoot>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>Total:</td>
										<td>TK. {{ $total }}</td>
									</tfoot>
								</table>
							</div><!--/col-9-->
							<div class="col-12 col-sm-2 col-md-6">
							</div>
							<div class="col-12 col-sm-10 col-md-6 text-right">
							@moderator(Order)
								<form action="{{ route('orders.update', $order->id) }}" method="post">
									@method('put')
									@csrf
									<div class="form-group text-left">
										<label for="order-status">Order Status</label>
										<select id="order-status" name="order_status_id" class="custom-select" @if($order->details[0]->product_status_id == 0) disabled @endif>
											<option value="0" selected>--Select Order Status--</option>
											@foreach($statuses as $stat)
											<option value="{{ $stat->id }}" @if(isset($order) && $order->order_status_id == $stat->id) selected @endif>{{ $stat->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<button id="order-submit" class="btn btn-theme mt-5" type="submit">Update</button>
									</div>
								</form>
							@endmoderator
							@user
								<form action="{{ route('order-details.update', $order->id) }}" method="post">
									@method('put')
									@csrf
									<div class="form-group text-left">
										<label for="product-status">Product status</label>
										<select id="product-status" name="product_status_id" class="custom-select">
											<option class="text-dark" value="0" @if(isset($order) && $order->details[0]->product_status_id == 0) selected @endif> -- Select Product Status -- </option>
											<option class="text-success" value="1" @if(isset($order) && $order->details[0]->product_status_id == 1) selected @endif>Sent to {{ config('app.name') }}</option>
											<option class="text-danger" value="2" @if(isset($order) && $order->details[0]->product_status_id == 2) selected @endif>Not available</option>
										</select>
									</div>
									<div class="form-group">
										<button id="order-submit" class="btn btn-theme mt-5" type="submit">Update</button>
									</div>
								</form>
							@enduser
							</div>
						</div><!--/row-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--My Modal -->
        <div class="modal fade" id="myModal" role="dialog" tabindex='-1'>
            <span id="myModal-trigger" class="hidden" data-toggle="modal" data-target="#myModal"></span>
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                 <button type="button" class="close" style="position:absolute; right:0;top:0;font-size:48px;line-height:20px;" data-dismiss="modal">&times;</button>
                 <img id="myModal-img-src" src=""/>
               </div>
             </div>
        </div>
<!--/My Modal-->
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
      $('.editor-tools').summernote({
        placeholder: 'Enter email body',
        tabsize: 2,
        height: 100
      });
    </script>
	<script>
	(function(){myModal()})();
	   function myModal() {
		  var myModal_items = document.getElementsByClassName("myModal-item");
		  for(let i=0; i<myModal_items.length; i++) {
			 myModal_items[i].setAttribute('onclick', 'popup(this)');
		  }
	   }
	   function popup(e) {
		   document.getElementById("myModal-img-src").src = e.src;
		   document.getElementById("myModal-trigger").click();
	   }
	</script>
@endsection