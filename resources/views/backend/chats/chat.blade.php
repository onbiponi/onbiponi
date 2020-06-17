@extends('layouts.dashboard')
@section('title')
{{ __('Chat') }}
@endsection
@section('content')
<div class="content-wrapper">
	@include('layouts.chat-content')
</div>
@endsection
@section('style')
	<link href="{{ asset('css/chat.css') }}" type="text/css" rel="stylesheet">
@endsection
@section('script')
<script>
(function() {
	/*var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);*/
	var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	var chat_history = document.querySelector('.chat-history');
	if(chat_history)
	chat_history.style.height = (h-104)+'px';
	var chat_inbox = document.querySelector('.chat-inbox');
	if(chat_inbox)
	chat_inbox.style.height = (h-55)+'px';
})();
	
</script>
@endsection