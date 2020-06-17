@extends('layouts.dashboard')
@section('title')
{{ __(isset($product)?'Update product':'Create product') }}
@endsection
@section('content')
<div class="content-wrapper">
	<div class="container-fluid">
		<section class="content-header">
			<h3>Product <small>{{ isset($product)?'edit':'create' }}</small></h3>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li><a href="#">Products</a></li>
				<li class="active">{{ isset($product)?'Edit':'Create' }}</li>
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
						<h3 class="box-title"><i class="fa fa-edit"></i> {{ __(isset($product)?'Update product':'Create product') }}</h3>
						<div class="box-tools float-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="row pt-2">
							<div class="col-12">
								<form class="needs-validation" action="@if(isset($product)) {{ route('manage-products.update', $product->id) }} @else {{ route('manage-products.store') }} @endif" method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-12 col-md-6">
											@csrf
											@if(isset($product))
											@method('PUT')
											@endif
											@if(isset($product))
											<input type="hidden" name="id" value="{{ $product->id }}" />
											@endif
											<div class="form-group">
												<label for="category">Category</label>
												<select id="category" name="category_id" class="custom-select" required>
													<option value="0">--Select Category--</option>
													@foreach($categories as $category)
													<option value="{{ $category->id }}" @if(isset($product) && $product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
													@endforeach
												</select>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<div class="form-group">
												<label for="name">Name</label>
												<input id="name" type="text" class="form-control" name="name" value="{{ $product->name ?? '' }}" placeholder="Enter Name" title="Enter Name" required/>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<!--<div class="form-group">
												<label for="color">Color</label>
												<select id="color" name="color_id" class="custom-select" required>
													<option value="0" selected>--Select Color--</option>
													@foreach($colors as $color)
													<option value="{{ $color->id }}" @if(isset($product) && $product->color_id == $color->id) selected @endif>{{ $color->name }}</option>
													@endforeach
												</select>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>-->
											<div class="row">
												<div class="col-6 form-group">
													<input type="file" id="image1" name="image1" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'picture-view1')" accept="image/*" value="Upload image" @if(!isset($product->image1)) required @endif/>
													<div class="valid-feedback">Valid.</div>
													<div class="invalid-feedback">Please fill out this field.</div>
												</div>
												<div class="col-6 form-group">
													<img id="picture-view1" style="width:50px; height:50px" src="{{ asset('/assets/products') }}/{{ $product->image1 ?? 'not-found.jpg' }}" class="img-thumbnail" alt="Product">
												</div>
											</div>
											<div class="row">
												<div class="col-6 form-group">
													<input type="file" id="image2" name="image2" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'picture-view2')" accept="image/*" value="Upload image" @if(!isset($product->image2)) required @endif/>
													<div class="valid-feedback">Valid.</div>
													<div class="invalid-feedback">Please fill out this field.</div>
												</div>
												<div class="col-6 form-group">
													<img id="picture-view2" style="width:50px; height:50px" src="{{ asset('/assets/products') }}/{{ $product->image2 ?? 'not-found.jpg' }}" class="img-thumbnail" alt="Product">
												</div>
											</div>
											<div class="row">
												<div class="col-6 form-group">
													<input type="file" id="image3" name="image3" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'picture-view3')" accept="image/*" value="Upload image" @if(!isset($product->image3)) required @endif/>
													<div class="valid-feedback">Valid.</div>
													<div class="invalid-feedback">Please fill out this field.</div>
												</div>
												<div class="col-6 form-group">
													<img id="picture-view3" style="width:50px; height:50px" src="{{ asset('/assets/products') }}/{{ $product->image3 ?? 'not-found.jpg' }}" class="img-thumbnail" alt="Product">
												</div>
											</div>
											<div class="row">
												<div class="col-6 form-group">
													<input type="file" id="image4" name="image4" class="form-control bg-theme text-white" onchange="displayPhotoOnSelect(this, 'picture-view4')" accept="image/*" value="Upload image" @if(!isset($product->image4)) required @endif/>
													<div class="valid-feedback">Valid.</div>
													<div class="invalid-feedback">Please fill out this field.</div>
												</div>
												<div class="col-6 form-group">
													<img id="picture-view4" style="width:50px; height:50px" src="{{ asset('/assets/products') }}/{{ $product->image4 ?? 'not-found.jpg' }}" class="img-thumbnail" alt="Product">
												</div>
											</div>
										</div>
										<div class="col-12 col-md-6">
											<!--<div class="form-group">
												<label for="size">Size</label>
												<select id="size" name="size_id" class="custom-select" required>
													<option value="0" selected>--Select Size--</option>
													@foreach($sizes as $size)
													<option value="{{ $size->id }}" @if(isset($product) && $product->size_id == $size->id) selected @endif>{{ $size->name }}</option>
													@endforeach
												</select>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>-->
											<div class="form-group">
												<label for="msrp">Price</label>
												<input id="msrp" type="number" class="form-control" name="msrp" value="{{ $product->msrp ?? '' }}" placeholder="Enter Price" title="Enter Price" required/>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<!--<div class="form-group">
												<label for="discount">Discount</label>
												<input id="discount" type="number" class="form-control" name="discount" value="{{ $product->discount ?? '' }}" placeholder="Enter Discount percentage" title="Enter Discount %" required/>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<div class="form-group">
												<label for="stock">Stock</label>
												<input id="stock" type="number" class="form-control" name="stock" value="{{ $product->stock ?? '' }}" placeholder="Enter Stock" title="Enter Stock" required/>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>-->
											<div class="form-group">
												<label for="note">Note:</label>
												<textarea name="note" class="form-control editor-tools" rows="5" id="note" required>{!! $product->note ?? '' !!}</textarea>
												<div class="valid-feedback">Valid.</div>
												<div class="invalid-feedback">Please fill out this field.</div>
											</div>
											<div class="form-group">
												<button id="profile-submit" class="btn btn-theme mt-5" type="submit">Store</button>
											</div>
										</div>
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
        placeholder: 'Enter note for your product',
        tabsize: 2,
        height: 100
      });
    </script>
@endsection