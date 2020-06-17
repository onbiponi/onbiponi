@extends('layouts.dashboard')
@section('title')
{{ __(isset($cashbook)?'Update transaction':'Create transaction') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Category <small>{{ isset($cashbook)?'edit':'create' }}</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Cashbooks</a></li>
				<li class="active">{{ isset($cashbook)?'Edit':'Create' }}</li>
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
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __(isset($cashbook)?'Update transaction':'Create transaction') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12"><!--left col-->
								<form action="@if(isset($cashbook)) {{ route('cashbooks.update', $cashbook->id) }} @else {{ route('cashbooks.store') }} @endif" method="post" enctype="multipart/form-data">
									@csrf
									@if(isset($cashbook))
									@method('PUT')
									@endif
									<div class="form-group">
										<label for="action">Action</label>
										<select id="action" name="action" class="custom-select" required>
											<option value="debit">Cash-out</option>
											<option value="credit">Cash-in</option>
										</select>
									</div>
									<div class="form-group">
										<label for="amount">Amount</label>
										<input type="number" class="form-control" id="amount" name="amount" value="{{ $cashbook->amount ?? '' }}" placeholder="Enter Amount" required />
									</div>
									<div class="form-group">
										<label for="receiver-email">Recipient's email</label>
										<input type="email" class="form-control" id="receiver-email" name="receiver_email" value="{{ $cashbook->receiver_email ?? '' }}" placeholder="Enter Recipient email" required />
									</div>
									<div class="form-group">
										<label for="description">Note:</label>
										<textarea name="description" class="form-control editor-tools" rows="5" id="description">{!! $product->description ?? '' !!}</textarea>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group mt-3">
										<button class="btn btn-success btn-theme" type="submit">{{ __(isset($cashbook)?'Update':'Save') }}</button>
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
@endsection