@extends('layouts.common')
@section('title')
{{ __('Best Mangoes in Bangladesh') }}
@endsection
@section('content')
<div class="container-fluid @computer py-5 @endcomputer">
	<div class="row" id="products">
		@foreach($blogs as $blog)
		<div class="col-12 col-sm-6 col-md-4 col-lg-3">
			<div class="owl-item">
				<a class="size-11 d-block" href="{{ route('blogs.show', $blog->id) }}">
					<img class="" src="{{ asset('/assets/blogs') }}/{{ $blog->thumbnail ?? 'not-found.jpg' }}" alt="{{ $blog->title ?? 'No title' }}" />
				</a>
				<div class="px-2"><small class="text-secondary">Posted By: {{ $blog->user->name }}</small><small class="text-secondary float-right">Published at: {{ $blog->created_at->format('jS M Y') }}</small></div>
				<h4 class="p-2"><a class="text-center" href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title ?? 'No title' }}</a></h4>
				<p class="p-2">{{ excerpt($blog->body) }}</p>
			</div>
		</div>
		@endforeach
		<div class="col-12 d-flex">
			<div class="mx-auto">
			{{ $blogs->links() }}
			</div>
		
		</div>
	</div>
</div>
@endsection