@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create <small>Level</small></h3>
                        </div>
                        <form id="quickForm" method="POST" action="{{route('level_study.store')}}">
                            @csrf
                            <div class="card-body">
							    <div class="form-group">

                                    <label >Website type</label>

                                    <select name="website_type" class="form-control">
                                        <option value="">Select website type</option>
                                        <option value="Essay Help">Essay Help</option>
                                        <option value="SOP">SOP</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label >Level Name</label>
                                    <input type="text" name="level_name" class="form-control"  placeholder="Enter Level Name" value="{{old('level_name')}}">
                                    
                                </div>
                                @error('level_name')
                                  <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
								<div class="form-group">
									<label >Additional Percentage Price</label>
									<input type="text" name="price" class="form-control"  placeholder="Enter Price" value="{{old('price')}}">
								</div>
								@error('price')
									<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							</div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('level_study.index')}}" class="btn btn-primary">Back</a>
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
    $(function () {
  $('#quickForm').validate({
    rules: {
      level_name: {
        required: true,
      },	  price: {        required: true,      },
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