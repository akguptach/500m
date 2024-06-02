@extends('layouts.app')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create <small>Coupon Code</small></h3>
          </div>
          <form id="quickForm" method="POST" action="{{route('subject.store')}}">
            @csrf
            <div class="card-body">
			  <div class="form-group">
					<label>Website</label>
					<select name="website_type" class="form-control">
						<option value="">Select website</option>
						<option value="Essay Help">Essay Help</option>
						<option value="SOP">SOP</option>
						<option value="Educrafter" selected="">Educrafter</option>
					</select>
                </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Coupon Code</label>
                <input type="text" name="subject_name" class="form-control">

              </div>
              @error('subject_name')
              <small class="text-danger">{{ $message }}</small>
              @enderror
              <div class="form-group">
                <label for="exampleInputEmail1">Coupon Title</label>
                <input type="text" name="price" class="form-control">
              </div>
              @error('price')
              <small class="text-danger">{{ $message }}</small>
              @enderror

              <div class="form-group">
                <label for="exampleInputEmail1">Max Uses</label>
                <input type="text" name="additional_word_rate" class="form-control" >
              </div>
			   @error('additional_word_rate')
              <small class="text-danger">{{ $message }}</small>
              @enderror
			  <div class="form-group">
                <label for="exampleInputEmail1">Limit Per User</label>
                <input type="text" name="additional_word_rate" class="form-control">
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Enable On (UTC)</label>
                <input type="text" name="additional_word_rate" class="form-control">
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Disable On (UTC)</label>
                <input type="text" name="additional_word_rate" class="form-control">
              </div>
			 
			<div class="row">
			    
				<div class="col-sm-6">
				    <div class="form-group">
				    <label for="exampleInputEmail1">Reduction Amount</label>
					<select name="reduction_type" class="form-control">
						<option value="percent">Percentage</option>
						<option value="fixed">Fixed</option>
					</select>
					</div>
				</div>
				<div class="col-sm-3">
				    <div class="form-group">
					 <label for="exampleInputEmail1">&nbsp;</label>
					<input type="text" name="reduction_amount" value="" id="reduction_amount" class="form-control">
					</div>
				</div>
			</div>
			 
			  
			  
             
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('subject.index')}}" class="btn btn-primary">Back</a>
            </div>
          </form>
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
        subject_name: {
          required: true,
        },
        price: {
          required: true,
          number: true
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
@endsection