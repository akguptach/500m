@extends('layouts.app')

@section('content')

<section class="content-header">
	<!-- <div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h4 class="m-0">Create New Affiliate</h4>
                                <div class="ml-auto">
                                    <a href="{{ route('affiliateuser.affiliate.view') }}" class="btn btn-primary"
                                        title="Show All Expert">
                                        <span aria-hidden="true"></span>View Affiliate User
                                    </a>
                                </div>
                            </div>


                            <div class="card-body">

                                <form method="get" class="needs-validation" novalidate
                                    action="{{ route('affiliateuser.affiliate.store') }}" accept-charset="UTF-8" id=""
                                    name="">
                                    {{ csrf_field() }}
                                    @include ('affiliateuser.form', [
                                    'user' => null,
                                    ])
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div> -->
	<div class="container-fluid">

		<!-- row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Form Validation</h4>
						<div class="float-right">
							<a href="{{ route('affiliateuser.affiliate.view') }}" class="btn btn-primary">
								view Affiliate User
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="form-validation">
							<form class="needs-validation" action="{{ route('affiliateuser.affiliate.store') }}">
								@csrf
								<div class="row">
									<div class="col-xl-6">
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">First Name
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" name="first_name" class="form-control" id="validationCustom01" placeholder="Enter first name.." required value="{{ old('first_name')}}">
												{!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Last Name
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" name="last_name" class="form-control" id="validationCustom01" placeholder="Enter Last name.." required value="{{ old('last_name')}}">
												{!! $errors->first('last_name', '<div class=" invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom02">Email <span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" name="email" class="form-control" id="validationCustom02" placeholder="Your valid email.." required value="{{ old('email')}}">
												{!! $errors->first('email', '<div class=" invalid-feedback">:message</div>') !!}
												<div class="invalid-feedback">
													Please enter a Email.
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom03">Password
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<div class="input-group pass-group">
													<input type="password" name="password" class="form-control pass-input" id="validationCustom03" placeholder="Choose a safe one.." required value="{{ old('password') }}">
													{!! $errors->first('password', '<div class=" invalid-feedback">:message</div>') !!}
													<span class="input-group-text pass-handle">
														<i class="fa fa-eye-slash"></i>
														<i class="fa fa-eye"></i>
													</span>
												</div>
												<div class="invalid-feedback">
													Please enter a password.
												</div>
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">About
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" name="about" class="form-control" id="validationCustom01" placeholder="About.." required value="{{ old('about') }}">
												{!! $errors->first('about', '<div class=" invalid-feedback">:message</div>') !!}
											</div>
										</div>
										<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom01">Location
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" name="location" class="form-control" id="validationCustom01" placeholder="Location.." required value="{{ old('location') }}">
												{!! $errors->first('location', '<div class=" invalid-feedback">:message</div>') !!}

											</div>
										</div>

										<div class="form-group row">
											<label class="col-lg-4 col-form-label" for="website_id">Website Type<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
											<?php HtmlHelper::WebsiteTypeDropdown('website_id', old('website_id'), false, 'website_id') ?>
												
											@error('website_id')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
												
											</div>
										</div>




										<div class="mb-3 row">
                                                        <label class="col-lg-4 col-form-label"
                                                            for="validationCustom06">Commission in Percent
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <input type="number"  class="form-control"
                                                                name="commission" id="validationCustom06" 
                                                                placeholder="commission" required
                                                                value="{{ old('commission') }}">
                                                            {!! $errors->first('commission', '<div
                                                                class=" invalid-feedback">:message</div>') !!}
                                                            <div class="invalid-feedback">
                                                                Please enter commission.
                                                            </div>
                                                        </div>
                                                    </div>


										<?php /*<div class="mb-3 row">
											<label class="col-lg-4 col-form-label" for="validationCustom06">Refral Link
												<span class="text-danger">*</span>
											</label>
											<div class="col-lg-6">
												<input type="text" class="form-control" name="referal_link" id="validationCustom06" placeholder="link" required value="{{ old('referal_link') }}">
												{!! $errors->first('referal_link', '<div class=" invalid-feedback">:message</div>') !!}
												<div class="invalid-feedback">
													Please enter a Currency.
												</div>
											</div>
										</div>*/ ?>

									</div>
									<div class="col-xl-6">







									</div>
								</div>
								<button type="submit" class="btn me-2 btn-primary">Submit</button>
								<a href="{{route('students.student.index')}}" class="btn btn-primary">Back</a>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>




@endsection