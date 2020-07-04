@extends('layouts.dashboard')
@section('title')
{{ __(isset($blog)?'Update blog':'Create blog') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Category <small>{{ isset($blog)?'edit':'create' }}</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Blogs</a></li>
				<li class="active">{{ isset($blog)?'Edit':'Create' }}</li>
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
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __(isset($blog)?'Update blog':'Create blog') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12"><!--left col-->
								<form action="@if(isset($blog)) {{ route('blogs.update', $blog->id) }} @else {{ route('blogs.store') }} @endif" method="post" enctype="multipart/form-data">
									@csrf
									@if(isset($blog))
										@method('PUT')
									@endif
									<div class="form-group">
										<label for="title">Title</label>
										<input id="title" type="text" class="form-control" name="title" value="{{ $blog->title ?? '' }}" placeholder="Post title" title="Enter post title" />
									</div>
									<div class="form-group">
										<label for="body">Body</label>
										<textarea name="body" class="form-control editor-tools" rows="5" id="note" required>{!! $blog->body ?? '' !!}</textarea>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="row">
										<div class="col-6 form-group">
											<input type="file" id="thumbnail" name="thumbnail" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'picture-view')" accept="image/*" value="Upload image" @if(!isset($blog->thumbnail)) required @endif/>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<div class="col-6 form-group">
											<img id="picture-view" style="width:50px; height:50px" src="{{ asset('/assets/blogs') }}/{{ $blog->thumbnail ?? 'not-found.jpg' }}" class="img-thumbnail" alt="Post Thumbnail">
										</div>
									</div>
									<div class="form-group">
										<label for="name">Description</label>
										<small class="text-secondary">Length should be 100 to 160 characters</small>
										<input id="description" type="text" class="form-control" name="description" value="{{ $blog->description ?? '' }}" placeholder="SEO description" title="SEO description" required/>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group mt-3">
										<button class="btn btn-success btn-theme" type="submit">{{ __(isset($blog)?'Update':'Save') }}</button>
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
        placeholder: 'Enter blog body',
        tabsize: 2,
        height: 100
      });
    </script>
@endsection