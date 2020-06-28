@extends('layouts.dashboard')
@section('title')
{{ __('Cashbook') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Cashbook <small>transactions</small></h3>
			<ol class="breadcrumb">
				<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Cashbook</li>
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
					<div class="box-header with-bcashbook">
						<h3 class="box-title"><i class="fa fa-credit-card mr-1"></i> {{ __('Cashbook') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<table id="dataTables" class="display nowrap" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>ID</th>
									<th>Action</th>
									<th>Order ID</th>
									<th>Amount</th>
									<th>Total</th>
									<th>User</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cashbooks as $cashbook)
								<tr>
									<td>{{ $cashbook->id }}</td>
									<td>{{ $cashbook->action }}</td>
									<td>{{ $cashbook->order_id ?? '(empty)' }}</td>
									<td>{{ $cashbook->amount ?? '0' }}</td>
									<td>{{ $cashbook->cumulative_amount ?? '0' }}</td>
									<td>{{ $cashbook->user->name ?? '(empty)' }}</td>
									<td>{{ $cashbook->created_at->format('jS M Y') ?? '' }}</td>
								</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<th>Action</th>
									<th>Order ID</th>
									<th>Amount</th>
									<th>Total</th>
									<th>User</th>
									<th>Date</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="col-12 text-right"><a class="btn btn-theme" href="{{ route('cashbooks.create') }}">Add transaction</a></div>
			<div class="col-12"><div class="d-flex"><div class="mx-auto">{{ $cashbooks->links() }}</div></div></div>
		</div>
	</div>
</div>
@endsection
@section('style')
	<!-- dataTables plugin -->
	<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" media="all"/>
	<link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet" media="screen">
	<link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" media="all"/>
	<!-- /dataTables plugin -->
@endsection
@section('script')
	<!---dataTables plugin JavaScript -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script src="{{ asset('js/dataTables.js') }}"></script>
	<!--/dataTables plugin JavaScript -->
@endsection