@extends('layouts.dashboard')
@section('title')
{{ __(isset($auction)?'Update auction':'Create auction') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Category <small>Create auction</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Auctions</a></li>
				<li class="active">Create</li>
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
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __('Create auction') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12"><!--left col-->
								<form action="{{ route('products.auction.store', $product->id) }}" method="post" enctype="multipart/form-data">
									@csrf
									<div class="form-group">
										<label for="auction-from">Starting Date:</label>
										<input id="auction-from" type="text" class="form-control datepicker" name="auction_from" value="@if($product->auction_from) {{ date('Y/m/d', strtotime($product->auction_from)) ?? '' }} @endif" placeholder="yyyy/mm/dd" title="Starting date" autocomplete="off" required />
									</div>
									<div class="form-group">
										<label for="auction-to">Ending Date</label>
										<input id="auction-to" type="text" class="form-control datepicker" name="auction_to" value="@if($product->auction_to) {{ date('Y/m/d', strtotime($product->auction_to)) ?? '' }} @endif" placeholder="yyyy/mm/dd" title="Ending date" autocomplete="off" required />
									</div>
									<div class="form-group">
										<label for="amount">Minimum Amount</label>
										<input id="amount" type="text" class="form-control" name="auction_amount" value="{{ $product->auction_amount ?? '' }}" placeholder="Amount in BDT" title="Amount" required />
									</div>
									<div class="form-group mt-3">
										<button class="btn btn-success btn-theme" type="submit">{{ __('Save') }}</button>
									</div>
								</form>
							</div><!--/col-9-->
						</div><!--/row-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
	<link href="{{ url('/') }}/css/bootstrap-datepicker.min.css" rel="stylesheet">
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
	<script src="{{ url('/') }}/js/bootstrap-datepicker.min.js"></script>
    <script>
		$('.editor-tools').summernote({
			placeholder: 'Enter email body',
			tabsize: 2,
			height: 100
		});
		$('.datepicker').datepicker({
			autoclose:true,
			disableTouchKeyboard: true,
			todayHighlight: true,
			format: 'yyyy/mm/dd'
		});
    </script>
	
@endsection