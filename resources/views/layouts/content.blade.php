@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body" style="display: block;">
				@if($errors!=null && count($errors->all())>0 )
					<div class="alert alert-danger">
						<button class="close" data-close="alert"></button>
						You have some form errors. Please check below.
						{!! validatorMessageStr($errors) !!}
					</div>
				@endif
				@yield('sub-content')
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$('.tt-hint').removeClass('required');
    	$('.tt-hint').hide();
	});
</script>
@endsection
