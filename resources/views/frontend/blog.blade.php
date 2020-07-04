@extends('layouts.common')
@section('title')
{{ __($blog->name) }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer" id="blog">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
					<h3>{{ $blog->title ?? '' }}</h3>
					<div><small class="text-secondary">Posted By: {{ $blog->user->name }}</small> | <small class="text-secondary">Published at: {{ $blog->created_at->format('jS M Y') }}</small></div>
					<div class="size-11 float-left width-300 mr-3 mb-3">
						<img class="img-thumbnail" src="{{ url('/') }}/assets/blogs/{{ $blog->thumbnail ?? 'not-found.jpg' }}" alt="{{ $blog->title ?? '' }}" width="300" />
                    </div>
                    <p class="text-justify">{!! $blog->description ?? '' !!}</p>
                    
                </div>
        </div>
    </div>
</div>
@endsection
@section('style')
<style>
.width-300 {
	width:300px;
}
</style>
@endsection