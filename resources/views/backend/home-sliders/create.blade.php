@extends('layouts.dashboard')
@section('title')
{{ __(isset($home_slider)?'Update Home Slider':'Create Home Slider') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Home Slider <small>{{ isset($home_slider)?'edit':'create' }}</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Home Slider</a></li>
				<li class="active">{{ isset($home_slider)?'Edit':'Create' }}</li>
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
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __(isset($home_slider)?'Update home slider':'Create home slider') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12"><!--left col-->
								<form action="@if(isset($home_slider)) {{ route('home-sliders.update', $home_slider->id) }} @else {{ route('home-sliders.store') }} @endif" method="post" enctype="multipart/form-data">
									@csrf
									@if(isset($home_slider))
										@method('PUT')
									@endif
									<div class="form-group">
										<label for="type">Product type</label>
										<select id="type" name="type" onchange="typeChange(this)" class="custom-select">
											<option value="Car" @if(isset($home_slider) && $home_slider->type == 'Car') selected @endif>Car</option>
											<option value="Motorcycle" @if(isset($home_slider) && $home_slider->type == 'Motorcycle') selected @endif>Motorcycle</option>
											<option value="Bicycle" @if(isset($home_slider) && $home_slider->type == 'Bicycle') selected @endif>Bicycle</option>
										</select>
									</div>
									<div class="form-group for-car">
										<label for="number">No. of Images</label>
										<select id="number" name="number" onchange="numberChange(this)" class="custom-select">
											<option value="3">3</option>
											<option value="6" @if(isset($home_slider) && $home_slider->number == 6) selected @endif>6</option>
										</select>
									</div>
									<div class="row">
										<div class="col-6 form-group">
											<label for="image1">Background Image</label>
											<input type="file" id="image1" name="image1" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'image1-view')" accept="image/*" value="Upload image" />
										</div>
										<div class="col-6 form-group">
											<img id="image1-view" style="width:50px; height:50px" src="{{ asset('/assets/home-sliders') }}/{{ $home_slider->image1 ?? 'not-found.jpg'}}" class="img-thumbnail" alt="Car">
										</div>
									</div>
									<div class="row for-car">
										<div class="col-6 form-group">
											<label for="image2">Image 2</label>
											<input type="file" id="image2" name="image2" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'image2-view')" accept="image/*" value="Upload image" />
										</div>
										<div class="col-6 form-group">
											<img id="image2-view" style="width:50px; height:50px" src="{{ asset('/assets/home-sliders') }}/{{ $home_slider->image2 ?? 'not-found.jpg'}}" class="img-thumbnail" alt="Car">
										</div>
									</div>
									<div class="row for-car">
										<div class="col-6 form-group">
											<label for="image3">Image 3</label>
											<input type="file" id="image3" name="image3" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'image3-view')" accept="image/*" value="Upload image" />
										</div>
										<div class="col-6 form-group">
											<img id="image3-view" style="width:50px; height:50px" src="{{ asset('/assets/home-sliders') }}/{{ $home_slider->image3 ?? 'not-found.jpg'}}" class="img-thumbnail" alt="Car">
										</div>
									</div>
									<div class="row for-car" id="image4-parent">
										<div class="col-6 form-group">
											<label for="image4">Image 4</label>
											<input type="file" id="image4" name="image4" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'image4-view')" accept="image/*" value="Upload image" />
										</div>
										<div class="col-6 form-group">
											<img id="image4-view" style="width:50px; height:50px" src="{{ asset('/assets/home-sliders') }}/{{ $home_slider->image4 ?? 'not-found.jpg'}}" class="img-thumbnail" alt="Car">
										</div>
									</div>
									<div class="row for-car" id="image5-parent">
										<div class="col-6 form-group">
											<label for="image5">Image 5</label>
											<input type="file" id="image5" name="image5" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'image5-view')" accept="image/*" value="Upload image" />
										</div>
										<div class="col-6 form-group">
											<img id="image5-view" style="width:50px; height:50px" src="{{ asset('/assets/home-sliders') }}/{{ $home_slider->image5 ?? 'not-found.jpg'}}" class="img-thumbnail" alt="Car">
										</div>
									</div>
									<div class="row for-car" id="image6-parent">
										<div class="col-6 form-group">
											<label for="image6">Image 6</label>
											<input type="file" id="image6" name="image6" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'image6-view')" accept="image/*" value="Upload image" />
										</div>
										<div class="col-6 form-group">
											<img id="image6-view" style="width:50px; height:50px" src="{{ asset('/assets/home-sliders') }}/{{ $home_slider->image6 ?? 'not-found.jpg'}}" class="img-thumbnail" alt="Car">
										</div>
									</div>
									<div class="form-group for-car">
										<label for="title">Title</label>
										<input id="title" type="text" class="form-control" name="title" value="{{ $home_slider->title ?? '' }}" placeholder="Enter Title" title="Enter Title" />
									</div>
									<div class="form-group for-car">
										<label for="description">Description</label>
										<input id="description" type="text" class="form-control" name="description" value="{{ $home_slider->description ?? '' }}" placeholder="Enter Description" title="Enter Description" />
									</div>
									<div class="form-group mt-3">
										<button class="btn btn-success btn-theme" type="submit">{{ __(isset($home_slider)?'Update':'Save') }}</button>
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
@endsection
@section('script')
    <script>
	(typeChange)();
	function typeChange(control) {
		if(!control) {
			control = {};
			control.value = document.getElementById('type').value;
		}
		if(control.value == 'Car')
			showTypes();
		else
			hideTypes();
	}
	function hideTypes() {
		var types = document.getElementsByClassName('for-car');
		for(let i=0; i<types.length; i++) {
			types[i].classList.add('d-none');
		}
	}
	function showTypes() {
		var types = document.getElementsByClassName('for-car');
		for(let i=0; i<types.length; i++) {
			types[i].classList.remove('d-none');
		}
	}
	(numberChange)();
	function numberChange(control) {
		if(!control) {
			control = {};
			control.value = document.getElementById('number').value;
		}
		if(control.value == 6)
			showImages();
		else
			hideImages();
	}
	function hideImages() {
		document.getElementById('image4-parent').classList.add('d-none');
		document.getElementById('image5-parent').classList.add('d-none');
		document.getElementById('image6-parent').classList.add('d-none');
	}
	function showImages() {
		document.getElementById('image4-parent').classList.remove('d-none');
		document.getElementById('image5-parent').classList.remove('d-none');
		document.getElementById('image6-parent').classList.remove('d-none');
	}
    </script>
@endsection