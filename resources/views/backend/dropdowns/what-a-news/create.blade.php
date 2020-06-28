@extends('layouts.dashboard')
@section('title')
{{ __(isset($what_a_new)?'Update What A New':'Create What A New') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Category <small>{{ isset($what_a_new)?'edit':'create' }}</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">What A News</a></li>
				<li class="active">{{ isset($what_a_new)?'Edit':'Create' }}</li>
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
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __(isset($what_a_new)?'Update What A New':'Create What A New') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12"><!--left col-->
								<form action="@if(isset($what_a_new)) {{ route('what-a-news.update', $what_a_new->id) }} @else {{ route('what-a-news.store') }} @endif" method="post" enctype="multipart/form-data">
									@csrf
									@if(isset($what_a_new))
										@method('PUT')
									@endif
									<div class="form-group">
										<label for="card-type">Category</label>
										<select id="category" name="category_id" class="custom-select">
											<option value="0" selected>--Select Category--</option>
											@foreach($categories as $category)
											<option value="{{ $category->id }}" @if(isset($what_a_new) && $category->id == $what_a_new->category_id) selected @endif>{{ $category->name }}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<label for="name">Name</label>
										<input id="name" type="text" class="form-control" name="name" value="{{ $what_a_new->name ?? '' }}" placeholder="First name" title="Enter your first name if any." />
									</div>
									<div class="form-group mt-3">
										<button class="btn btn-success btn-theme" type="submit">{{ __(isset($what_a_new)?'Update':'Save') }}</button>
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