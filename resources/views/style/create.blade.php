@extends('layouts.app')
@section('content')
    <section class="content">
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create <small>Referencing Style</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('referencing.store')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Style</label>
                                    <input type="text" name="style" class="form-control"  placeholder="Enter Style Name" value="{{old('style')}}">
                                    
                                </div>
                                @error('style')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('referencing.index')}}" class="btn btn-primary">Back</a>
                            </div>
                        </form>
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
								<h4 class="card-title">Create Style</h4>
								
							</div>
							<div class="card-body">
								<div class="form-validation">
                <form id="quickForm" method="POST" action="{{route('referencing.store')}}">
                @csrf
										<div class="row">
											<div class="col-xl-6">
												
												<div class="mb-3 row">
													<label class="col-lg-4 col-form-label" for="">Style<span
															class="text-danger">*</span>
													</label>
													<div class="col-lg-6">
														<input type="text" name="style" class="form-control"  placeholder="Enter Style Name" value="{{old('style')}}" required>
                            @error('style')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
													</div>
												</div>
												
												
												
												
											</div>
											
										</div>
										<button type="submit" class="btn me-2 btn-primary">Submit</button>
										<a href="{{route('referencing.index')}}" class="btn btn-primary">Back</a>
										
									</form>
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
    $(function () {
  $('#quickForm').validate({
    rules: {
      style: {
        required: true,
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection