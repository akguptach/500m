@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.min.css') }}">
<style>
.nav-item {
padding-right: 2px;
}
</style>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Edit <small>Page</small></h3>
					</div>
					
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
							  <button class="nav-link active" id="basic-tab" data-toggle="tab" data-target="#page" type="button" role="tab" aria-controls="page" aria-selected="true">Page</button>
							</li>
							
							<li class="nav-item" role="presentation">
							  <button class="nav-link" id="faq-tab" data-toggle="tab" data-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false">FAQ</button>
							</li>
							
							<li class="nav-item" role="presentation">
							  <button class="nav-link" id="ratings-tab" data-toggle="tab" data-target="#ratings" type="button" role="tab" aria-controls="ratings" aria-selected="false">Ratings</button>
							</li>
						  </ul>

						  <div class="tab-content" id="myTabContent">

							<div class="tab-pane fade show active" id="page" role="tabpanel" aria-labelledby="page-tab">
							  @include('pages.edit_main')
							</div>

							<div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
								@include('pages.faq')
							</div>

							<div class="tab-pane fade" id="ratings" role="tabpanel" aria-labelledby="ratings-tab">
								@include('pages.ratings')
							</div>

						  </div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script>
	$(function() {
		$('#quickForm').validate({
			rules: {
				page_desc: {
					required: true
				},
				page_title: {
					required: true
				},
				seo_url_slug: {
					required: true
				},
				seo_title: {
					required: true
				},
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			}
		});
	});
</script>
<script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
	$(function() {
		// Summernote    
		$('#summernote').summernote()
	});
</script>
@endsection