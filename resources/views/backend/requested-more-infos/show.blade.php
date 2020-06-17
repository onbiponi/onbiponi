@extends('layouts.dashboard')
@section('title')
{{ __('View Requested Info') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Requested Info <small>view</small></h3>
			<ol class="breadcrumb">
				<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Requested Info</li>
			</ol>
		</section>
		@if(session()->has('message'))
		<div class="alert alert-warning">
			{{ session()->get('message') }}
		</div>
		@endif
		<div class="row">
			<div class="col-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Read Mail</h3>
						<div class="box-tools pull-right">
							<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
							<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="mailbox-read-info">
						<h3>{{ $info->name ?? '(empty)' }}</h3>
						<h5>From: <a href="{{ url('/single-car-product', $info->id) }}">{{ url('/single-car-product', $info->id) }}</a>
							<span class="mailbox-read-time pull-right">{{ $info->created_at->format('jS M Y') }}</span></h5>
						</div>
						<!-- /.mailbox-read-info -->
						<div class="mailbox-controls with-border text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Delete">
								<i class="fa fa-trash-o"></i></button>
								<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Reply">
								<i class="fa fa-reply"></i></button>
								<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Forward">
								<i class="fa fa-share"></i></button>
							</div>
							<!-- /.btn-group -->
							<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="" data-original-title="Print">
								<i class="fa fa-print"></i></button>
						</div>
						<!-- /.mailbox-controls -->
						<div class="mailbox-read-message">
							{!! $info->message ?? '(empty)' !!}
						</div>
						<!-- /.mailbox-read-message -->
					</div>
					<!-- /.box-body -->
					<!-- /.box-footer -->
					<div class="box-footer">
						<div class="row">
							<div class="col-12 col-sm-6">
								<button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
								<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
							</div>
							<div class="col-12 col-sm-6 text-right">
								<button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
								<button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
							</div>
						</div>
					</div>
					<!-- /.box-footer -->
				</div>
				<!-- /. box -->
			</div>
		</div>
	</div>
</div>
@endsection
@section('style')
	<!-- /dataTables plugin -->
@endsection
@section('script')
@endsection