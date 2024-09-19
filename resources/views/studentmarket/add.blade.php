@extends('layouts.app')
@section('content')
<style>
	p.small {
		font-size: 16px;
		margin-left: 24px;
		color: black !important;
	}

	div:has(> ul.pagination) {
		float: right;
		margin-right: 20px;
	}
	.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #dc3545;
}
</style>

<section class="content-header">
	<div class="container-fluid">

		<!-- row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add Deals</h4>

					</div>
					<div class="card-body">
						<div class="form-validation">
							<form class="needs-validation" action="{{route('deals.deal.store')}}" method="POST" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-xl-6">
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Title
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" name="title" type="text" id="title" value="{{ old('title') }}" minlength="1" maxlength="255" placeholder="Enter title here..." required>
												{!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Category
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<select required class="form-control {{ $errors->has('deal_category') ? ' is-invalid' : '' }}" style="width: 100%;" name="deal_category">
												<option value="">Please Select Category
													@if(!empty($dealCategories))
													@foreach ($dealCategories as $dealCategory)
													<option value="{{$dealCategory->id}}" @if(old('deal_category') == $dealCategory->id) selected="selected"
														@endif>{{$dealCategory->category_name}}</option>
													@endforeach
													@endif
												</select>
												{!! $errors->first('deal_category', '<div class="invalid-feedback">:message</div>') !!}

											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Website Type
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												{{ HtmlHelper::WebsiteDropdown('website_type', old('website_type', optional(@$deal)->website_type), false, '', 'website_type') }}
												{!! $errors->first('website_type', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>

										<div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="month_on_domain">Show on
                                                    Home<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="checkbox" @if(old('show_on_home',
                                                        optional(@$deal)->show_on_home) ==1 ) checked="checked" @endif
                                                    name="show_on_home" id="show_on_home" value="1" id="show_on_home">
                                                    {!! $errors->first('show_on_home', '<div class="invalid-feedback">
                                                        :message</div>') !!}
                                                </div>
                                            </div>


										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom02">Deal Image <span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<img src="{{ old('image')}}" width="50px;" />
												<input required class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" type="file" id="image" value="{{ old('image') }}" placeholder="Enter image here...">
												{!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
												<p class="text-muted">Image size:800px*800px(less then 2MB)</p>
											</div>
										</div>


										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom02">Website Logo <span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												
												<input required class="form-control {{ $errors->has('deal_logo') ? ' is-invalid' : '' }}" name="deal_logo" type="file" id="deal_logo"  >
												{!! $errors->first('deal_logo', '<div class="invalid-feedback">:message</div>') !!}
												<p class="text-muted">Image size:400px width(less then 2MB)</p>
											</div>
										</div>

										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Short Description
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<textarea required placeholder="Enter short description here..." class="form-control {{ $errors->has('short_description') ? ' is-invalid' : '' }}" name="short_description">{{ old('short_description') }}</textarea>
												{!! $errors->first('short_description', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
									</div>
									<div class="col-xl-12">
										<div class="mb-3 row">
											<label class="col-lg-2 col-form-label" for="validationCustom01">Long Description
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-10">
												<textarea id="ckeditor" class="editor form-control {{ $errors->has('long_description') ? ' is-invalid' : '' }}" name="long_description">{{ old('long_description') }}</textarea>
												{!! $errors->first('long_description', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
									</div>
									<div class="col-xl-6">
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Website Url
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input required class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" type="url" id="url" value="{{ old('url') }}" minlength="1" placeholder="Enter website url here...">
												{!! $errors->first('url', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="">Price
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<select class="form-control {{ $errors->has('price_type') ? ' is-invalid' : '' }}" name="price_type" id="price_type">
													<option value="Price" @if( old('price_type', optional(@$deal)->price_type) == 'Price') selected="selected" @endif>Price</option>
													<option value="Voucher_Code" @if( old('price_type', optional(@$deal)->price_type) == 'Voucher_Code') selected="selected" @endif>Voucher Code</option>
												</select>
												{!! $errors->first('price_type', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="mb-3 row Voucher_Code" style="display: none;">
											<label for="voucher_code" class="col-form-label col-lg-4">Voucher Code</label>
											<div class="col-lg-6 ">
												<input class="form-control" name="voucher_code" type="text" id="voucher_code" value="{{ old('voucher_code') }}" minlength="1" placeholder="Enter voucher code">
												{!! $errors->first('voucher_code', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="Price">
											<div class="mb-3 row Price" style="display: none;">
												<!-- <label for="price" class="col-form-label col-lg-4">Price and Offer Price</label> -->

												<label for="price" class="col-form-label col-lg-4" style="font-weight:normal;">Price</label>
												<div class="col-lg-6">
													<input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" type="number" id="price" value="{{ old('price') }}" minlength="1" placeholder="Enter price">
													{!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
												</div>



											</div>
											<div class="mb-3 row Price" style="display: none;">
												<!-- <label for="price" class="col-form-label col-lg-4">Price and Offer Price</label> -->


												<label for="offer_price" class="col-form-label col-lg-4" style="font-weight:normal;">Offer Price</label>
												<div class="col-lg-6">
													<input class="form-control {{ $errors->has('offer_price') ? ' is-invalid' : '' }}" name="offer_price" type="number" id="offer_price" value="{{ old('offer_price') }}" minlength="1" placeholder="Enter Offer Price">
													{!! $errors->first('offer_price', '<div class="invalid-feedback">:message</div>') !!}
												</div>


											</div>
										</div>
										<input type="text" class="form-control" name="other_price" value="0" hidden>
									</div>

								</div>
								<button type="submit" class="btn me-2 btn-primary">Submit</button>

							</form>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<script>
	$(function() {
		// Summernote    
		// $('.editor').summernote()

	});

	$(document).ready(function() {
		hideShowPrice("{{old('price_type', 'Price')}}")
		$('#price_type').change(function() {
			hideShowPrice($(this).val())
		});
	})

	function hideShowPrice(val) {
		if (val == 'Price') {
			$('.Price').show();
			$('.Voucher_Code').hide();

			$('#offer_price').attr('required', 'required');
			$('#price').attr('required', 'required');
			$('#voucher_code').removeAttr('required');

		} else if (val == 'Voucher_Code') {
			$('.Voucher_Code').show();
			$('.Price').hide();

			$('#voucher_code').attr('required', 'required');
			$('#price').removeAttr('required');
			$('#offer_price').removeAttr('required');
		} else {
			$('.Voucher_Code').hide();
			$('.Price').hide();
		}
	}
</script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>



@endsection