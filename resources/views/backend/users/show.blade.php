@extends('layouts.dashboard')
@section('title')
{{ $profile->name ?? '' }}'s Profile
@endsection
@section('content')

<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Profile <small>Show</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Profile</a></li>
				<li class="active">{{ $profile->name ?? '' }}'s Profile</li>
			</ol>
		</section>
		@if(session()->has('message'))
		<div class="alert alert-warning">
			{{ session()->get('message') }}
		</div>
		@endif
		<div class="row">
			<div class="col-12">
				<div class="box box-info" style="background:#f8fafc">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-edit"></i><a class="btn btn-link" href="{{ route('users.edit', $profile->id) }}">{{ __('Edit profile') }}</a></h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row py-2">
							<div class="col-12 col-md-3"><!--left col-->
								<div class="text-center">
									<img id="display-photo-on-select" src="{{ asset('/assets/profile') }}/{{ $profile->photo }}" class="img-thumbnail rounded-circle" alt="avatar">
								</div>
							</div><!--/col-3-->
							<div class="col-12 col-md-9">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile">Profile</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#address">Address</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#billing">Billing Address</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#shipping">Shipping Address</a></li>
								</ul>
								<div class="tab-content mt-3">
									<div class="tab-pane active" id="profile">
										<table class="table">
											<tbody>
												<tr><td>Name</td><td>{{ $profile->name ?? '' }}</td></tr>
												<tr><td>Phone</td><td>{{ $profile->phone ?? '' }}</td></tr>
												<tr><td>Card Type</td><td>{{ $profile->payment->name ?? '' }}</td></tr>
												<tr><td>Name on Card</td><td>{{ $profile->name_on_card ?? '' }}</td></tr>
												<tr><td>Exp. date</td><td>{{ $profile->card_exp_month ?? '' }}</td></tr>
												<tr><td>Exp. year</td><td>{{ $profile->card_exp_year ?? '' }}</td></tr>
												<tr><td>CVV</td><td>{{ $profile->cvv ?? '' }}</td></tr>
											</tbody>
										</table>
									</div><!--/tab-pane-->
									<div class="tab-pane" id="address">
										<table class="table">
											<tbody>
												<tr><td>City</td><td>{{ $profile->division->name ?? ''}}</td></tr>
												<tr><td>Region</td><td>{{ $profile->region->name ?? ''}}</td></tr>
												<tr><td>Address</td><td>{{ $profile->address ?? ''}}</td></tr>
											</tbody>
										</table>
									</div><!--/tab-pane-->
									<div class="tab-pane" id="billing">
										<table class="table">
											<tbody>
												<tr><td>City</td><td>{{ $profile->billing_division->name ?? ''}}</td></tr>
												<tr><td>Region</td><td>{{ $profile->billing_region->name ?? ''}}</td></tr>
												<tr><td>Address</td><td>{{ $profile->billing_address ?? ''}}</td></tr>
											</tbody>
										</table>
									</div><!--/tab-pane-->
									<div class="tab-pane" id="shipping">
										<table class="table">
											<tbody>
												<tr><td>City</td><td>{{ $profile->shipping_division->name ?? ''}}</td></tr>
												<tr><td>Region</td><td>{{ $profile->shipping_region->name ?? ''}}</td></tr>
												<tr><td>Address</td><td>{{ $profile->shipping_address ?? ''}}</td></tr>
											</tbody>
										</table>
									</div><!--/tab-pane-->
								</div><!--/tab-content-->
							</div><!--/col-9-->
						</div><!--/row-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')

@endsection