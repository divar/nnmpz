<div class="modal-dialog" style="@yield('modalClass')">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="">{{ $title }}</h4>
			@if(Request::get('ajax'))
				<button type="button" class="close" data-dismiss="modal" aria-hidden="false"><i class="fa fa-close"></i></button>
			@endif
		</div>
		{{-- <div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				You have some form errors. Please check below.
			</div> --}}
		@yield('sub-content')
	</div>
</div>
<script type="text/javascript">
	// Metronic.formModal();
</script>
@stack('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.tt-hint').removeClass('required');
    	$('.tt-hint').hide();
	});
</script>
