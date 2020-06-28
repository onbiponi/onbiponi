@extends('layouts.common')
@section('title')
{{ __('E-commerce templates') }}
@endsection
@section('content')
<div class="content py-5  bg-light">
    <div class="container">
    	<div class="row">
    	    <div class="col-md-3"></div>
	        <div class="col-md-6">
                <!-- form user info -->
                <div class="card card-outline-secondary">
                    <div class="card-header">
                        <h3 class="mb-0">Contact Us</h3>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('notifications.store') }}">
                            @csrf
                            <fieldset>
                                <label for="name2" class="mb-0">Name</label>
                                <div class="row mb-1">
                                    <div class="col-lg-12">
                                        <input type="text" name="name" id="name2" class="form-control" required>
                                    </div>
                                </div>
                                <label for="email2" class="mb-0">Email</label>
                                <div class="row mb-1">
                                    <div class="col-lg-12">
                                        <input type="text" name="sender" id="email2" class="form-control" required="">
                                    </div>
                                </div>
                                <label for="name2" class="mb-0">Subject</label>
                                <div class="row mb-1">
                                    <div class="col-lg-12">
                                        <input type="text" name="subject" id="subject" class="form-control" required>
                                    </div>
                                </div>
                                <label for="message2" class="mb-0">Message</label>
                                <div class="row mb-1">
                                    <div class="col-lg-12">
                                        <textarea rows="6" name="body" id="message2" class="form-control" required=""></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-lg">Send Message</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- /form user info -->
            </div>
    	</div>
    </div>
</div>
@endsection