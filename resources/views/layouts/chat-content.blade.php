<div class="container-fluid bg-light">
	@if(session()->has('message'))
	<div class="alert alert-warning">
		{{ session()->get('message') }}
	</div>
	@endif
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<chat-list v-bind:user='{!! json_encode($user) !!}' v-bind:partner='{!! json_encode($partner) ?? "{}" !!}' v-bind:message_list='{!! json_encode($messages) ?? [] !!}'></chat-list>
		</div>
		<div class="col-md-9 col-sm-6 col-xs-12">
			<chat v-bind:user='{!! json_encode($user) !!}' v-bind:partner='{!! json_encode($partner) ?? "{}" !!}' v-bind:messages='{!! json_encode($messages) ?? [] !!}'></chat>
		</div>
	</div>
</div>