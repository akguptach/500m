@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
	j$ = jQuery.noConflict();
	j$(function() {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

		j$("#start_date").datepicker({
			autoclose: true,
			startDate: today,
			todayBtn: 1, changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', // Set the date format to yyyy-mm-dd
		}).on('change', function() {
			j$('#start_date_error').hide(); // Hide error message on change
			validateDates(); // Check date validation after any change
		});

		j$("#end_date").datepicker({
			autoclose: true,
			todayBtn: 1, changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', // Set the date format to yyyy-mm-dd
		}).on('change', function() {
			j$('#end_date_error').hide(); // Hide error message on change
			validateDates(); // Check date validation after any change
		});

		// Custom function to handle form submission
		function handleFormSubmission() {
			var startDate = j$("#start_date").val();
			var endDate = j$("#end_date").val();

			// Validate date format before submission
			if (!isValidDateFormat(startDate)) {
				j$('#start_date_error').show();
				return false;
			}
			if (!isValidDateFormat(endDate)) {
				j$('#end_date_error').show();
				return false;
			}

			// Validate start date should not be greater than end date
			if (new Date(startDate) > new Date(endDate)) {
				j$('#start_date_error').text('Start date cannot be greater than end date.').show();
				return false;
			}

			// Proceed with form submission if dates are valid
			return true;
		}

		// Function to validate date format (YYYY-MM-DD)
		function isValidDateFormat(dateString) {
			var regex = /^\d{4}-\d{2}-\d{2}$/;
			return regex.test(dateString);
		}

		// Function to validate and update error messages
		function validateDates() {
			var startDate = j$("#start_date").val();
			var endDate = j$("#end_date").val();

			if (new Date(startDate) > new Date(endDate)) {
				j$('#start_date_error').text('Start date cannot be greater than end date.').show();
				j$('#end_date_error').text('End date cannot be less than start date.').show();
			} else {
				j$('#start_date_error').hide();
				j$('#end_date_error').hide();
			}
		}

		// Optionally, bind to a button click event to trigger form validation
		j$('#submit_button').on('click', function(e) {
			e.preventDefault();
			if (handleFormSubmission()) {
				// Submit the form if validation passes
				j$('#create_coupon_form').submit();
			}
		});
	});
</script>
<section class="content">
    <div class="container-fluid">
             <!-- row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Edit <small>Coupon</small></h3>

					</div>
					<div class="card-body">
						<div class="form-validation">
							<form method="PUT" class="needs-validation" action="{{ route('coupons.coupon.update', $coupon->id) }}" accept-charset="UTF-8" id="create_coupon_form" name="create_coupon_form">
								@csrf
								<!-- @if($errors->any())
								{!! implode('', $errors->all('<div>:message</div>')) !!}
								@endif -->

								<div class="row">
									<div class="col-xl-6">
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Code<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" class="form-control"  value="{{ old('code', optional($coupon)->code) }}" name="code" type="text" id="code" value="" minlength="1" placeholder="Enter code here..." required>
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Website Type<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												{{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional($coupon)->website_type), false, '', 'website_type') }}
												{!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Start Date<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" onkeydown="return false" name="start_date" value="{{ old('start_date', optional($coupon)->start_date) }}" class="form-control" id="start_date" placeholder="Enter Start Date" required>
												<div class="invalid-feedback" id="start_date_error">
													The start date field must match the format Y-m-d (YYYY-MM-DD).
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for=""> End Date<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" onkeydown="return false" name="end_date" value="{{ old('end_date', optional($coupon)->end_date) }}" class="form-control" id="end_date" placeholder="Enter End Date" required>
												<div class="invalid-feedback" id="end_date_error">
													The end date field must match the format Y-m-d (YYYY-MM-DD).
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Number of users<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="number" name="max_uses" value="{{ old('max_uses', optional($coupon)->max_uses) }}" class="form-control" id="" placeholder="Enter Maximum limit" required>
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Reduction Type
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
											<select class="form-control {{ $errors->has('reduction_type') ? ' is-invalid' : '' }}" name="reduction_type">
													<option value="">--Select--</option>
													@foreach([['label'=>'Percentage','value'=>'PERCENTAGE'],['label'=>'Fixed','value'=>'FIXED']] as $item)
													<option @if(old('reduction_type',  optional($coupon)->reduction_type) == $item['value'])
														selected="selected" @endif value="{{$item['value']}}">{{$item['label']}}</option>
													@endforeach
												</select>
												{!! $errors->first('reduction_type', '<div class="invalid-feedback">:message</div>') !!}
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Reduction Amount<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="number" class="form-control"  value="{{ old('reduction_amount', optional($coupon)->reduction_amount) }}" name="reduction_amount" id="" placeholder="Enter Reduction Amount<" required>
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Code uses per customer <span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="number" class="form-control" value="{{ old('limit_per_users', optional($coupon)->limit_per_users) }}" name="limit_per_users" id="" placeholder="Enter Limit Users" required>
												<div class="invalid-feedback">
													....
												</div>
											</div>
										</div>
									</div>
								</div>
								<button type="submit" class="btn me-2 btn-primary">Submit</button>
								<a href="{{route('coupons.coupon.index')}}" class="btn btn-primary">Back</a>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
    </div>
</section>

@endsection