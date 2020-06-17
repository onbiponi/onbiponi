@extends('layouts.dashboard')
@section('title')
Send Notification
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Notification <small>Send</small></h3>
			<ol class="breadcrumb">
				<li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Send Email</li>
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
						<h3 class="box-title"><i class="fa fa-envelope mr-1"></i> {{ __('Send Notification') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12 col-md-12">
								<ul class="nav nav-tabs">
									<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#mail">To Email</a></li>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#database">In {{ config('app.name') ?? url('/') }}</a></li>
								</ul>
								<div class="tab-content mt-3">
									<div id="mail" class="tab-pane active">
										<form class="needs-validation" action="{{ route('notifications.store') }}" method="post">
											@csrf
											<div class="form-group">
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" class="custom-control-input" id="individual1" name="user_amount" value="individual" checked>
													<label class="custom-control-label" for="individual1">Individual</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" class="custom-control-input" id="all-user1" name="user_amount" value="all-user">
													<label class="custom-control-label" for="all-user1">All user</label>
												</div>
											</div>
											<div class="form-group">
												<label for="email1">Email:</label>
												<input type="email" name="email" class="form-control" value="{{ $email ?? '' }}" placeholder="Enter email ID" id="email1" required>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<div class="form-group">
												<label for="subject1">Subject:</label>
												<input type="text" name="subject" class="form-control" placeholder="Subject of email" id="subject1" required>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<!-- toolbar with suitable buttons and dialogues -->
											<div class="form-group">
												<label for="message1">Message:</label>
												<textarea name="body" class="form-control editor-tools" rows="5" id="message1" required></textarea>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<button type="submit" name="mail" class="btn btn-theme" value="mail">Send</button>
										</form>
									</div>
									<div id="database" class="tab-pane">
										<form class="needs-validation" action="{{ route('notifications.store') }}" method="post">
											@csrf
											<div class="form-group">
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" class="custom-control-input" id="individual2" name="user_amount" value="individual" checked>
													<label class="custom-control-label" for="individual2">Individual</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" class="custom-control-input" id="all-user2" name="user_amount" value="all-user">
													<label class="custom-control-label" for="all-user2">All user</label>
												</div>
											</div>
											<div class="form-group">
												<label for="email2">Email:</label>
												<input type="email" name="email" value="{{ $email ?? '' }}" class="form-control" placeholder="Enter email ID" id="email2" required>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<div class="form-group">
												<label for="subject2">Subject:</label>
												<input type="text" name="subject" class="form-control" placeholder="Subject of email" id="subject2" required>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<!-- toolbar with suitable buttons and dialogues -->
											<div class="form-group">
												<label for="message2">Message:</label>
												<textarea name="body" class="form-control editor-tools" rows="5" id="message2" required></textarea>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<button type="submit" name="database" class="btn btn-theme" value="database">Submit</button>
										</form>
									</div>
								</div>
							</div>
						</div>
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
		(function() {
			var individual = [];
			var all_user = [];
			for(let i=0; i<2; i++) {
				individual[i] = document.getElementById("individual"+(i+1));
				all_user[i] = document.getElementById("all-user"+(i+1));
				individual[i].addEventListener('change', function() {
					if( individual[i].checked ) { 
						document.getElementById("email"+(i+1)).disabled = false;
					} else {
						document.getElementById("email"+(i+1)).disabled = true;
						console.log(2);
					}
				});
				all_user[i].addEventListener('change', function() {
					if( all_user.checked ) { 
						document.getElementById("email"+(i+1)).disabled = false; 
					} else {
						document.getElementById("email"+(i+1)).disabled = true; 
					}
				});
			}
		})();
    </script>
@endsection