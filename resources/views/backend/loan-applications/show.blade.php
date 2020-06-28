@extends('layouts.dashboard')
@section('title')
{{ __('View Loan Application') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Loan Application <small>view</small></h3>
			<ol class="breadcrumb">
				<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Loan Application</li>
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
						<h3 class="box-title">Read Loan Application</h3>
						<div class="box-tools pull-right">
							<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Previous"><i class="fa fa-chevron-left"></i></a>
							<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Next"><i class="fa fa-chevron-right"></i></a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<table id="dataTables" class="display nowrap" cellspacing="0" width="100%">
							<tbody>
								<tr><td>Name</td><td>{{ $loan_application->name }}</td></tr>
								<tr><td>Email</td><td>{{ $loan_application->email }}</td></tr>
								<tr><td>Phone</td><td>{{ $loan_application->phone }}</td></tr>
								<tr><td>Amount</td><td>{{ $loan_application->amount }}</td></tr>
								<tr><td>Condition</td><td>{{ $loan_application->condition->name }}</td></tr>
								<tr><td>Dependants</td><td>{{ $loan_application->dependant }}</td></tr>
								<tr><td>Date of Birth</td><td>{{ $loan_application->dob }}</td></tr>
								<tr><td>Marital Status</td><td>{{ $loan_application->marital_status }}</td></tr>
								<tr><td>City</td><td>{{ $loan_application->city }}</td></tr>
								<tr><td>Address</td><td>{{ $loan_application->address }}</td></tr>
								<tr><td>House Number</td><td>{{ $loan_application->house_number }}</td></tr>
								<tr><td>Monthly Income</td><td>{{ $loan_application->monthly_income }}</td></tr>
								<tr><td>Gender</td><td>{{ $loan_application->gender }}</td></tr>
								<tr><td>Employment Industry</td><td>{{ $loan_application->employment_industry }}</td></tr>
								<tr><td>Employer Name</td><td>{{ $loan_application->employment_name }}</td></tr>
								<tr><td>Work Phone Number</td><td>{{ $loan_application->work_phone }}</td></tr>
							</tbody>
						</table>
						<!-- /.mailbox-read-message -->
					</div>
					<!-- /.box-body -->
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